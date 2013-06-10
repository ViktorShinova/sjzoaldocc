<?php

class Employer_Email_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				array('email','review','index')
		);

		$this->filter('before', 'employer')->only(
				array('email','review','index')
		);
	}

	public function get_index() {
		return View::make('employer.email');
	}

	public function post_index() {
		
	}

	public function get_review($id = null) {

		$inputs = Session::get('email_inputs');
		
		if ( !isset($inputs['send-mail']) || !isset($inputs['job-accept']) ) {
			Session::flash('error_message', 'You have either not select any candidates from the list or have not indicated an outcome for the applicant.');
			Session::flash('success_message', $inputs['email-success']);
			Session::flash('unsuccess_message', $inputs['email-unsuccess']);

			return Redirect::to("employer/post/details/$id")->with('selected_mail', isset($inputs['send-mail'])? $inputs['send-mail']: null )->with('selected_status', isset($inputs['job-accept'])? $inputs['job-accept'] : null);
		}
		
		$diff_1 = array_diff_key($inputs['send-mail'], $inputs['job-accept']);
		$diff_2 = array_diff_key($inputs['job-accept'], $inputs['send-mail'] );
		
		
		if ( !empty($diff_1) ||  !empty($diff_2) ) {
			Session::flash('error_message', 'You have either not select any candidates from the list or have not indicated an outcome for the applicant. Please ensure that you have indicate the outcome for applicants you want to send email to.');
			return Redirect::to("employer/post/details/$id")->with('selected_mail', isset($inputs['send-mail'])? $inputs['send-mail']: null )->with('selected_status', isset($inputs['job-accept'])? $inputs['job-accept'] : null);
		}
		
		
		$success_message = $inputs['email-success'];
		$unsuccess_message = $inputs['email-unsuccess'];

		$employer = Employer::find(Session::get('employer_id'));
		$logo = $employer->logo_path;

		$to = "Candidate";

		$sign_off = "Yours Sincerely,<br/>
			Careershire";
		return View::make('employer.email-review')->with(
						array(
							'success_message' => $success_message,
							'unsuccess_message' => $unsuccess_message,
							'email_to' => $to,
							'email_from' => $sign_off,
							'logo' => $logo,
							'job_id' => $id,
							'host' => $_SERVER['HTTP_HOST'],
						)
		);
	}

	public function post_review($id = null) {
		//send email
		if (!$id) {
			return Redirect::to('employer/post/list');
		}
		$inputs = Session::get('email_inputs');
		
		
		$applied_id = array_keys($inputs['send-mail']);

		$success_message = $inputs['email-success'];
		$unsuccess_message = $inputs['email-unsuccess'];

		$successful_candidates = array();
		$unsuccessful_candidates = array();

		foreach ($inputs['job-accept'] as $key => $candidates) {

			if ($candidates == 'accept') {
				$successful_candidates[] = $key;
			} else {
				$unsuccessful_candidates[] = $key;
			}
		}




		//success and can send mail 

		$success_send_mail = array_intersect($applied_id, $successful_candidates);
		$unsuccess_send_mail = array_intersect($applied_id, $unsuccessful_candidates);

		if ($success_send_mail) {

			$successful_candidates = DB::table('applicant_job')
					->join('applicants', 'applicants.id', '=', 'applicant_job.applicant_id', 'LEFT OUTER')
					->join('users', 'users.id', '=', 'applicants.user_id', 'LEFT OUTER')
					->where_in('applicant_job.id', $success_send_mail)
					->get();
		}

		if ($unsuccess_send_mail) {
			$unsuccessful_candidates = DB::table('applicant_job')
					->join('applicants', 'applicants.id', '=', 'applicant_job.applicant_id', 'LEFT OUTER')
					->join('users', 'users.id', '=', 'applicants.user_id', 'LEFT OUTER')
					->where_in('applicant_job.id', $unsuccess_send_mail)
					->get();
		}


		//send bulk email here

		$emp = Employer::where('id', '=', Session::get('employer_id'))->first();
		$sign_off = "Yours Sincerely,<br/>
			" . $emp->company;
		$mail = new PHPMailer();
		$success_body = View::make('email.master')->with(
				array(
					'email_to' => 'Candidate',
					'email_from' => $sign_off,
					'email_body' => $success_message,
					'logo' => $emp->logo_path,
					'host' => $_SERVER['HTTP_HOST'],
				)
		);
		$unsuccess_body = View::make('email.master')->with(
				array(
					'email_to' => 'Candidate',
					'email_from' => $sign_off,
					'email_body' => $unsuccess_message,
					'logo' => $emp->logo_path,
					'host' => $_SERVER['HTTP_HOST'],
				)
		);

		//successful applicant

		$mail->AddReplyTo($emp->application_email);
		$mail->IsHTML(true);
		$mail->Subject = "Outcome of your application.";
		$mail->From = $emp->application_email;
		$mail->FromName = $emp->company;
		

		if (strpos($_SERVER['HTTP_HOST'], '.localhost')) {
			$mail->isSMTP();
			$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true;  // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = SMTP;
			$mail->Port = 465;
			$mail->Username = SMTP_USERNAME;
			$mail->Password = SMTP_PASSWORD;
		}

		$sent = false;

		for ($i = 0; $i < 2; $i++) {

			$sent = false;
			//successful
			if ($i == 0) {
				$sent = $this->_sendBulkMail($successful_candidates, $success_body, $mail);
			}
			//unsuccessful
			else if ($i == 1) {
				
				$sent = $this->_sendBulkMail($unsuccessful_candidates, $unsuccess_body, $mail);
				
			}
		}

		if ($sent) {
			$candidates = array_merge( $success_send_mail, $unsuccess_send_mail);
			
			$affected = DB::table('applicant_job')
					->where_in('id', $candidates)
					->where('job_id', '=', $id)
					->update(array('sent' => true));

			return Redirect::to('employer/post/details/' . $id)->with('success', true);
		}
	}

	public function get_done() {
		return "All done";
	}

	protected function _sendBulkMail($candidates, $body, &$mail) {

		foreach ($candidates as $candidate) {

			if (!$candidate->applicant_id) {
				$data = unserialize($candidate->non_registered_users);
				$mail->AddBCC($data['email'], $data['first_name'] . ' ' . $data['last_name']);
			} else {
				$mail->AddBCC($candidate->email, $candidate->first_name . ' ' . $candidate->last_name);
			}
		}
		

		if (!empty($candidates)) {
			if ($mail->send()) {
				$mail->ClearBCCs();
				
				return true;
			}
			return false;
		}
	}

}

