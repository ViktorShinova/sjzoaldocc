<?php

class Employer_Profile_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				array('index')
		);

		$this->filter('before', 'employer')->only(
				array('index')
		);
	}

	public function get_index() {
		
		$employer = Employer::find(Session::get('employer_id'));
		$user = Auth::user();
		$countries = Country::where('code', '=', 'AUS')->or_where('code', '=', 'NZL')->order_by('name')->lists('name', 'code');
		return View::make('employer.profile')->with(array('countries' => $countries, 'employer' => $employer, 'user' => $user));
	}

	public function post_index() {
		$uuid = uniqid('', true);
		$employer = Employer::find(Session::get('employer_id'));
		$_post_data = Input::all();
		$_password_flag = false;

		Validator::register('oldpassword', function($attribute, $value, $parameters) {
					$same_password = Hash::check($value, Auth::user()->password);
					if ($same_password) {
						return true;
					} else {
						return false;
					}
				});
		$message = array(
			'oldpassword' => 'The old password entered was incorrect',
			'different' => 'The password entered must be different from the previous record'
		);

		$rules = array(
			'email' => 'required|email',
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
		//check if the password fields are entered.
		if (!empty($_post_data['password']) && !empty($_post_data['password_confirmation']) && !empty($_post_data['old-password'])) {
			$_password_flag = true;
		}

		if ($_password_flag) {
			$pass_rules = array(
				'old-password' => 'required|oldpassword',
				'password' => 'required|confirmed|different:old-password',
				'password_confirmation' => 'required',
			);
			$rules = $rules + $pass_rules;
		}

		$validation = Validator::make(Input::all(), $rules, $message);

		if ($validation->fails()) {
			return Redirect::to('employer/profile')->with_errors($validation)->with_input();
		} else {

			//Company logo
			if (Input::has_file('company-logo')) {
				$company_logo = Input::file('company-logo');

				//We might need to strink the size of the logo
				//Upload the file to employer's unique folder.
				$logo_folder = EMP_UPLOAD_DIR . $employer->unique_folder . '/company-logo';
				var_dump($logo_folder);
				//resize the image first

				$imgHandler = new ImageHandler($logo_folder);
				$imgHandler->setImage($company_logo['tmp_name'], $company_logo['name']);
				$imgHandler->resize(500, 150, true, false);
				$imgHandler->close();
				//Input::upload("company-logo",  PUBLIC_DIR . $logo_folder , $company_logo['name']);
				//Once we upload the file, we need to remove it from the temp folder

				$this->_remove_tmp_files('company-logo', $employer->unique_folder, 'employer');
			}
			$user = Auth::user();
			//backup the user before change
			$user_backup = new UserBackup();
			$user_backup->username = $user->username;
			$user_backup->email = $user->email;
			$user_backup->old_email = $user->old_email;
			$user_backup->password = $user->password;
			$user_backup->role_id = $user->role_id;
			$user_backup->salt = $user->salt;
			$user_backup->guid = $uuid;
			//Change the profile;
			$user->email = $_post_data['email'];
			$user->guid = $uuid;

			if ($_password_flag) {
				$user->password = Hash::make($_post_data['password']);
			}
			$employer->title = $_post_data['title'];
			$employer->first_name = $_post_data['firstname'];
			$employer->last_name = $_post_data['lastname'];
			$employer->application_email = $_post_data['app-email'];
			$employer->contact = $_post_data['contact'];
			$employer->fax = $_post_data['fax'];
			$employer->company = $_post_data['company'];
			$employer->industry = $_post_data['industry'];
			$employer->address = $_post_data['address'];
			$employer->address_2 = $_post_data['address2'];
			$employer->suburb = $_post_data['suburb'];
			$employer->postal = $_post_data['postal'];
			$employer->country = $_post_data['country'];
			$employer->company_size = $_post_data['company-size'];

			if (Input::has_file('company-logo')) {

				$employer->logo_path = $imgHandler->getFrontEndImagePath();
			}

			if ($user->save() && $employer->save() && $user_backup->save()) {
				Session::flash('success', true);
				//send mail to inform the user that his account has change

				$mail = new PHPMailer();
				$mail->IsHTML(true);
				$mail->FromName = COMPANY_NAME;
				$mail->From = ACCOUNT_EMAIL;
				$mail->Subject = "Account information changed";
				$mail->Body = View::make('email.emp_account_change')->with(array('user' => $user, 'employer' => $employer, 'uuid' => $uuid));

				$mail->AddAddress($user->email);
				$mail->AddBCC($user->old_email);

				if (strpos($_SERVER['HTTP_HOST'], '.localhost')) {
					$mail->isSMTP();
					$mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
					$mail->SMTPAuth = true;  // authentication enabled
					$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
					$mail->Host = SMTP;
					$mail->Port = 465;
					$mail->Username = SMTP_USERNAME;
					$mail->Password = SMTP_PASSWORD;
				}

				try {
					if ($mail->Send()) {
						
					} else {
						var_dump($mail);
						die();
					}
				} catch (phpmailerException $e) {
					var_dump($e->errorMessage()); //Pretty error messages from PHPMailer
					die();
				}
				return Redirect::to('employer/profile');
			} else {
				Session::flash('error', true);
				return Redirect::to('employer/profile');
			}
		}
	}

}