<?php

class Employer_Email_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				array('email')
		);

		$this->filter('before', 'employer')->only(
				array('payment')
		);
	}

	public function get_index() {
		return View::make('employer.email');
	}

	public function post_index() {
		
	}

	public function get_review($id = null) {

		$inputs = Session::get('email_inputs');

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
						)
		);
	}

	public function post_review($id = null) {
		//send email
		if(!$id) {
			return Redirect::to('employer/post/list');
		}
		$inputs = Session::get('email_inputs');
		$applicants_id = null;
		if (isset($inputs['send-mail'])) {
			$applicants_id = array_keys($inputs['send-mail']);
		}
		
		if(!$applicants_id) {
			Session::flash('error_message',  'You have not select any candidates from the list');
			Session::flash('success_message', $inputs['email-success']);
			Session::flash('unsuccess_message', $inputs['email-unsuccess']);
			
			return Redirect::to("employer/post/details/$id");
		}
		
		
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
		
		$success_send_mail = array_intersect($applicants_id, $successful_candidates);
		$unsuccess_send_mail = array_intersect($applicants_id, $unsuccessful_candidates);

		if ($success_send_mail) {
			$successful_candidates = Applicant::with('user')->where_in('id', $success_send_mail)->get();
		}

		if ($unsuccess_send_mail) {
			$unsuccessful_candidates = Applicant::with('user')->where_in('id', $unsuccess_send_mail)->get();
		}
		
		//send bulk email here

		$emp = Employer::where('id', '=', Session::get('employer_id'))->first();
		$sign_off = "Yours Sincerely,<br/>
			" . $emp->company;
		$mail = new PHPMailer();
		$success_body = View::make('email.email-master')->with(
				array(
					'email_to' => 'Candidate',
					'email_from' => $sign_off,
					'email_body' => $success_message,
					'logo' => $emp->logo_path,
				)
		);
		$unsuccess_body = View::make('email.email-master')->with(
				array(
					'email_to' => 'Candidate',
					'email_from' => $sign_off,
					'email_body' => $unsuccess_message,
					'logo' => $emp->logo_path,
				)
		);
		
		//successful applicant

		$mail->AddReplyTo($emp->application_email);
		$mail->IsHTML(true);
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
			if( $i == 0 ) {
				
				foreach ($successful_candidates as $applicant) {
					$mail->AddBCC($applicant->user->email, $applicant->first_name . ' ' . $applicant->last_name);
				}
				$mail->Body = $success_body;
				
				if(!empty($successful_candidates)) {
					if( $mail->send() ) {
						$sent = true;
						$mail->ClearBCCs();
					}
				}
				
			}
			//unsuccessful
			else if ($i == 1) {
				foreach ($unsuccessful_candidates as $applicant) {
					$mail->AddBCC($applicant->user->email, $applicant->first_name . ' ' . $applicant->last_name);
				}
				$mail->Body = $unsuccess_body;
				
				if(!empty($unsuccessful_candidates)) {
					if( $mail->send() ) {
						$sent = true;
						$mail->ClearBCCs();
					}
				}
			}
		}

		if($sent) {
			//update
			$affected = DB::table('applicant_job')
					->where_in('id', $inputs['applied_id'])
					->where_in('applicant_id', $applicants_id )
					->where('job_id', '=', $id)			
					->update(array('sent' => true));
			
			return $affected;
				
		}

	}

	public function get_done() {
		return "All done";
	}

}

