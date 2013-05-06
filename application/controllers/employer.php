<?php

class Employer_Controller extends Base_Controller {
	protected $_secure_pages = array('post',
					'payment',
					'profile',
					'confirm',
					'complete',
					'cancel',
					'confirm',
					'templating',
					'save_template',
					'templates',
					'template_edit',
					'template_delete',
					'template_preview',
					'invoices',
				);
	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				$this->_secure_pages
		);
		
		$this->filter('before', 'employer')->only(
				$this->_secure_pages
		);
	}
	//cur
	public function get_index() {
		return View::make('employer.index');
	}

	/* ===========================================================================================================
	  Employer Resgistration
	  ========================================================================================================== */

	public function get_register() {
		$countries = Country::where('code', '=', 'AUS')->or_where('code', '=', 'NZL')->order_by('name')->lists('name', 'code');
		return View::make("employer.register")->with(array('countries' => $countries));
	}

	public function post_register() {
		$rules = array(
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
			'contact' => 'required',
			'title' => 'required',
			'firstname' => 'required',
			'lastname' => 'required',
			'app-email' => 'required|email',
			'contact' => 'required',
			'address' => 'required',
			'suburb' => 'required',
			'postal' => 'required',
			'company-size' => 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails()) {
			return Redirect::to('employer/register')->with_errors($validation)->with_input();
		} else {

			//Store the transaction in a session
			//
            //Session::put('register', Input::all());
			$register_input = Input::all();
			$user = new User();
			$user->username = $register_input['email'];
			$user->role_id = 1;
			$user->email = $register_input['email'];
			$user->password = Hash::make($register_input['password']);

			if ($user->save()) {

				$employer = new Employer();
				$employer->title = $register_input['title'];
				$employer->first_name = $register_input['firstname'];
				$employer->last_name = $register_input['lastname'];
				$employer->application_email = $register_input['app-email'];
				$employer->contact = $register_input['contact'];
				$employer->fax = $register_input['fax'];
				$employer->company = $register_input['company'];
				$employer->industry = $register_input['industry'];
				$employer->address = $register_input['address'];
				$employer->address_2 = $register_input['address2'];
				$employer->suburb = $register_input['suburb'];
				$employer->postal = $register_input['postal'];
				$employer->country = $register_input['country'];
				$employer->company_size = $register_input['company-size'];
				$employer->unique_folder = hash('md5', $user->username);
				$employer->user_id = $user->id;

				if ($employer->save()) {
					//send an email and then redirects them to the confirmation page.
					return Redirect::to('/login');
				}
			}
		}
	}


	public function post_upload_image($type = null) {
		//check if this is ajax call



		$employer = Employer::find(Session::get("employer_id"));

		$_background_temp_folder = EMP_TMP_FOLDER . $employer->unique_folder . '/backgrounds/' . $type;
		$_logo_temp_folder = EMP_TMP_FOLDER . $employer->unique_folder . '/company-logo/';


		$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
		if (!$type && !$xhr) {
			return false;
		} else {
			//$username = Auth::user()->username;

			if ($type != 'logo') {
				$bg = Input::file("$type-background");

				if ($bg['error'] != 1) {

					Input::upload("$type-background", $_background_temp_folder, $bg['name']);
					
					$_src = str_replace('public/', '', $_background_temp_folder ) . '/'.  $bg['name'];
					
					return json_encode(array('filename' => $bg['name'], 'src' => $_src));
				} else {
					return json_encode(array("message" => $bg));
				}
			} else {

				$logo = Input::file('company-logo');

				if ($logo['error'] != 1) {

					$imgHandler = new ImageHandler($_logo_temp_folder);
					
					$imgHandler->setImage($logo['tmp_name'], $logo['name']);
					$imgHandler->resize(500, 150, true, false);

					$imgHandler->close();
				

					//$_src = str_replace('public/', '', $_logo_temp_folder ) . $logo['name'];
					
					return json_encode(array('filename' => $logo['name'], 'src' => $imgHandler->getFrontEndImagePath()));
				} else {
					return json_encode(array("message" => 'Please try again'));
				}
			}
		}
	}

	public function get_invoices() {
		
		$invoices = Transaction::where('employer_id', '=', Session::get('employer_id'))->paginate(20);
		
		
		$invoices = DB::table('transactions')
				->join('jobs' , 'jobs.id', '=', 'transactions.job_id')
				->where('transactions.employer_id', '=', Session::get('employer_id'))->paginate(20);		
		return View::make('employer.invoice')->with(array('invoices' => $invoices));
		
	}
//	//shift
//	public function post_save_template($id = null) {
//
//		$employer = Employer::find(Session::get("employer_id"));
//
//		$default_css = Template::find(1)->css;
//		if (!$id) {
//			$temp = null;
//		} else {
//			$template = Template::find($id);
//			$temp = unserialize($template->data);
//		}
//
//		//local variable
//		$header_image = null;
//		$body_image = null;
//		$footer_image = null;
//
//		
//		//HEADER
//		$header_text_align = Input::get('head-text-align');
//		$header_repeat = Input::get('header-repeat');
//		$header_position = Input::get('header-position');
//
//		//BODY
//		$body_repeat = Input::get('body-repeat');
//		$body_position = Input::get('body-position');
//
//		//FOOTER
//		$footer_repeat = Input::get('footer-repeat');
//		$footer_position = Input::get('footer-position');
//
//		//Store them in an array in order to serialize them later on
//
//		if (!$temp) {
//			$temp = array(
//				'header_text_align' => $header_text_align,
//				'header_repeat' => $header_repeat,
//				'header_position' => $header_position,
//				'body_repeat' => $body_repeat,
//				'body_position' => $body_position,
//				'footer_repeat' => $footer_repeat,
//				'footer_position' => $footer_position,
//			);
//		} else {
//			$temp['header_text_align'] = $header_text_align;
//			$temp['header_repeat'] = $header_repeat;
//			$temp['header_position'] = $header_position;
//			$temp['body_repeat'] = $body_repeat;
//			$temp['body_position'] = $body_position;
//			$temp['footer_repeat'] = $footer_repeat;
//			$temp['footer_position'] = $footer_position;
//		}
//
//
//		//var_dump($temp);
//		//Image upload
//		if (Input::has_file('header-background')) {
//			$header_image = Input::file('header-background');
//			Input::upload("header-background", EMP_UPLOAD_DIR . $employer->unique_folder . '/backgrounds/header', $header_image['name']);
//			$temp['header_background'] = "/uploads/employer/" . $employer->unique_folder . "/backgrounds/header/{$header_image['name']}";
//		}
//
//		if (Input::has_file('body-background')) {
//			$body_image = Input::file('body-background');
//			Input::upload("body-background", EMP_UPLOAD_DIR . $employer->unique_folder . '/backgrounds/body', $body_image['name']);
//			$temp['body_background'] = "/uploads/employer/" . $employer->unique_folder . "/backgrounds/body/{$body_image['name']}";
//		}
//
//		if (Input::has_file('footer-background')) {
//			$footer_image = Input::file('footer-background');
//			Input::upload("footer-background", EMP_UPLOAD_DIR . $employer->unique_folder . '/backgrounds/footer', $footer_image['name']);
//			$temp['footer_background'] = "/uploads/employer/" . $employer->unique_folder . "/backgrounds/footer/{$footer_image['name']}";
//		}
//
//		$search = array(
//			"/*HEADER-BACKGROUND-REPEAT*/",
//			"/*HEADER-BACKGROUND-IMAGE*/",
//			"/*HEADER-BACKGROUND-POSITION*/",
//			"/*TEXTALIGN*/",
//			"/*BODY-BACKGROUND-REPEAT*/",
//			"/*BODY-BACKGROUND-IMAGE*/",
//			"/*BODY-BACKGROUND-POSITION*/",
//			"/*FOOTER-BACKGROUND-REPEAT*/",
//			"/*FOOTER-BACKGROUND-IMAGE*/",
//			"/*FOOTER-BACKGROUND-POSITION*/"
//		);
//		
//		$replace = array(
//			(!$temp['header_repeat']) ? "" : "background-repeat: {$temp['header_repeat']};",
//			"background-image: " . ((!isset($temp['header_background'])) ? "none;" : "url({$temp['header_background']});" ),
//			(!$temp['header_position']) ? "" : "background-position: {$temp['header_position']} ;",
//			"text-align: {$temp['header_text_align']};",
//			(!$temp['body_repeat']) ? "" : "background-repeat: {$temp['body_repeat']};",
//			"background-image: " . ((!isset($temp['body_background'])) ? "none;" : "url({$temp['body_background']});"),
//			(!$temp['body_position']) ? "" : "background-position: {$temp['body_position']} ;",
//			(!$temp['footer_repeat']) ? "" : "background-repeat: {$temp['footer_repeat']};",
//			"background-image: " . ((!isset($temp['footer_background'])) ? "none;" : "url({$temp['footer_background']});"),
//			(!$temp['footer_position']) ? "" : "background-position: {$temp['footer_position']} ;",
//		);
//
//		$custom_css = str_replace($search, $replace, $default_css);
//		
//		var_dump($custom_css);
//		//die();
//
//		if (!$id) {
//			$template = new Template;
//			$template->css = $custom_css;
//			$template->name = Input::get('template-name');
//			$template->data = serialize($temp);
//			$template->header = ((!isset($temp['header_background'])) ? "" : $temp['header_background']);
//			$template->body = ((!isset($temp['body_background'])) ? "" : $temp['body_background']);
//			$template->footer = ((!isset($temp['footer_background'])) ? "" : $temp['footer_background']);
//			$template->save();
//		} else {
//
//			$template = Template::find($id);
//			$template->css = $custom_css;
//			$template->name = Input::get('template-name');
//			$template->data = serialize($temp);
//			$template->header = ((!isset($temp['header_background'])) ? "" : $temp['header_background']);
//			$template->body = ((!isset($temp['body_background'])) ? "" : $temp['body_background']);
//			$template->footer = ((!isset($temp['footer_background'])) ? "" : $temp['footer_background']);
//			$template->save();
//		}
//
//		//Remove all files in the tmp folder
//		$this->_remove_tmp_files('backgrounds', $employer->unique_folder, 'employer');
//
//		return Redirect::to('/employer/templates/');
//	}
//	//shift
//	public function get_templates() {
//		$templates = Template::order_by('created_at', 'asc')
//				->where('id', "!=", 1)
//				->paginate(20);
//		//die(var_dump($templates->results));
//		return View::make('employer.templates')->with(array('templates' => $templates));
//	}
//	//shift
//	public function post_delete_template($id = null) {
//		if (!$id) {
//			return false;
//		}
//
//		$template = Template::find($id);
//
//		foreach ($template->jobs as $job) {
//			//reset the id of the template to the default one
//			$job->template_id = 1;
//			$job->save();
//		}
//		$template->delete();
//	}
//	//shift
//	public function get_preview_template($id = null) {
//
//		if (!$id) {
//			return false;
//		}
//
//		$template = Template::find($id);
//
//		return View::make('employer.preview')->with(array('template' => $template));
//	}

//	public function get_profile() {
//		$employer = Employer::find(Session::get('employer_id'));
//		$user = Auth::user();
//		$countries = Country::where('code', '=', 'AUS')->or_where('code', '=', 'NZL')->order_by('name')->lists('name', 'code');
//		return View::make('employer.profile')->with(array('countries' => $countries, 'employer' => $employer, 'user' => $user));
//	}
//
//	public function post_profile() {
//		$uuid = uniqid('', true);
//		$employer = Employer::find(Session::get('employer_id'));
//		$_post_data = Input::all();
//		$_password_flag = false;
//
//		Validator::register('oldpassword', function($attribute, $value, $parameters) {
//					$same_password = Hash::check($value, Auth::user()->password);
//					if ($same_password) {
//						return true;
//					} else {
//						return false;
//					}
//				});
//		$message = array(
//			'oldpassword' => 'The old password entered was incorrect',
//			'different' => 'The password entered must be different from the previous record'
//		);
//
//		$rules = array(
//			'email' => 'required|email',
//			'contact' => 'required',
//			'title' => 'required',
//			'firstname' => 'required',
//			'lastname' => 'required',
//			'app-email' => 'required|email',
//			'contact' => 'required',
//			'address' => 'required',
//			'suburb' => 'required',
//			'postal' => 'required',
//			'company-size' => 'required'
//		);
//		//check if the password fields are entered.
//		if (!empty($_post_data['password']) && !empty($_post_data['password_confirmation']) && !empty($_post_data['old-password'])) {
//			$_password_flag = true;
//		}
//
//		if ($_password_flag) {
//			$pass_rules = array(
//				'old-password' => 'required|oldpassword',
//				'password' => 'required|confirmed|different:old-password',
//				'password_confirmation' => 'required',
//			);
//			$rules = $rules + $pass_rules;
//		}
//
//		$validation = Validator::make(Input::all(), $rules, $message);
//
//		if ($validation->fails()) {
//			return Redirect::to('employer/profile')->with_errors($validation)->with_input();
//		} else {
//
//			//Company logo
//			if (Input::has_file('company-logo')) {
//				$company_logo = Input::file('company-logo');
//			}
//			//We might need to strink the size of the logo
//			//Upload the file to employer's unique folder.
//			$logo_folder = EMP_UPLOAD_DIR . $employer->unique_folder . '/company-logo';
//			var_dump($logo_folder);
//			//resize the image first
//
//			$imgHandler = new ImageHandler($logo_folder);
//			$imgHandler->setImage($company_logo['tmp_name'], $company_logo['name']);
//			$imgHandler->resize(500, 150, true, false);
//			$imgHandler->close();
//			//Input::upload("company-logo",  PUBLIC_DIR . $logo_folder , $company_logo['name']);
//			//Once we upload the file, we need to remove it from the temp folder
//
//			$this->_remove_tmp_files('company-logo', $employer->unique_folder, 'employer');
//
//			$user = Auth::user();
//			//backup the user before change
//			$user_backup = new UserBackup();
//			$user_backup->username = $user->username;
//			$user_backup->email = $user->email;
//			$user_backup->old_email = $user->old_email;
//			$user_backup->password = $user->password;
//			$user_backup->role_id = $user->role_id;
//			$user_backup->salt = $user->salt;
//			$user_backup->guid = $uuid;
//			//Change the profile;
//			$user->email = $_post_data['email'];
//			$user->guid = $uuid;
//
//			if ($_password_flag) {
//				$user->password = Hash::make($_post_data['password']);
//			}
//			$employer->title = $_post_data['title'];
//			$employer->first_name = $_post_data['firstname'];
//			$employer->last_name = $_post_data['lastname'];
//			$employer->application_email = $_post_data['app-email'];
//			$employer->contact = $_post_data['contact'];
//			$employer->fax = $_post_data['fax'];
//			$employer->company = $_post_data['company'];
//			$employer->industry = $_post_data['industry'];
//			$employer->address = $_post_data['address'];
//			$employer->address_2 = $_post_data['address2'];
//			$employer->suburb = $_post_data['suburb'];
//			$employer->postal = $_post_data['postal'];
//			$employer->country = $_post_data['country'];
//			$employer->company_size = $_post_data['company-size'];
//
//			if (Input::has_file('company-logo')) {
//				
//				$employer->logo_path = $imgHandler->getFrontEndImagePath();
//			}
//
//			if ($user->save() && $employer->save() && $user_backup->save()) {
//				Session::flash('success', true);
//				//send mail to inform the user that his account has change
//
//				$mail = new Phpmailer();
//				$mail->IsHTML(true);
//				$mail->FromName = COMPANY_NAME;
//				$mail->From = COMPANY_EMAIL;
//				$mail->Subject = "Account information changed";
//				$mail->Body = View::make('email.emp_account_change')->with(array('user' => $user, 'employer' => $employer, 'uuid' => $uuid));
//
//				$mail->AddAddress($user->email);
//				$mail->AddBCC($user->old_email);
//
//				if (strpos($_SERVER['HTTP_HOST'], '.localhost')) {
//					$mail->isSMTP();
//					$mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
//					$mail->SMTPAuth = true;  // authentication enabled
//					$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
//					$mail->Host = SMTP;
//					$mail->Port = 465;
//					$mail->Username = SMTP_USERNAME;
//					$mail->Password = SMTP_PASSWORD;
//				}
//
//				try {
//					if ($mail->Send()) {
//						
//					} else {
//						var_dump($mail);
//						die();
//					}
//				} catch (phpmailerException $e) {
//					var_dump($e->errorMessage()); //Pretty error messages from PHPMailer
//					die();
//				}
//				return Redirect::to('employer/profile');
//			} else {
//				Session::flash('error', true);
//				return Redirect::to('employer/profile');
//			}
//		}
//	}

}