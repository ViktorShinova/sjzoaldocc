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
					'resume',
					'coverletter'
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
		$countries = Country::where('code', '=', 'AUS')
				->or_where('code', '=', 'NZL')
				->order_by('name')
				->lists('name', 'code');
		$industries = Category::lists('name', 'id');
		return View::make("employer.register")
				->with('countries', $countries)
				->with('industries', $industries);
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

	protected function _validate_image($name) {
		
		
		$rules = array(
			$name => 'image|max:2048|mimes:jpg,gif,png',
		);
		$messages = array(
			'image' => 'The uploaded file is not an image.',
			'max' => 'The maximum file size is 2MB.',
			'mimes' => 'Your image must be either .jpg, .gif, or .png.'
		);

		$validation = Validator::make(Input::file(), $rules, $messages);

		if ($validation->fails()) {
			
			return  $validation->errors->first($name);
		} 
		
		return null;
	}
	public function post_upload_image($type = null) {
		//check if this is ajax call

		$employer = Employer::find(Session::get("employer_id"));

		$_background_temp_folder = EMP_TMP_FOLDER . $employer->unique_folder . '/backgrounds/' . $type;
		//$_logo_temp_folder = EMP_TMP_FOLDER . $employer->unique_folder . '/company-logo/';
		$logo_folder = EMP_UPLOAD_DIR . $employer->unique_folder . '/company-logo/';

		$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
		if (!$type && !$xhr) {
			return false;
		} else {
			//$username = Auth::user()->username;
			
			if ($type != 'logo') {
				if ( ($message = $this->_validate_image("$type-background")) ) {
					return json_encode(array("success" => false, 'message' => $message));
				}
				
				$bg = Input::file("$type-background");

				if ($bg['error'] != 1) {

					Input::upload("$type-background", $_background_temp_folder, $bg['name']);
					
					$_src = str_replace('public/', '', $_background_temp_folder ) . '/'.  $bg['name'];
					
					return json_encode(array('success' => true, 'filename' => $bg['name'], 'src' => $_src));
					
				} else {
					return json_encode(array("message" => $bg));
				}
			} else {
				
				if ( ($message = $this->_validate_image("company-logo")) ) {
					return json_encode(array("success" => false, 'message' => $message));
				}
				
				$logo = Input::file('company-logo');
				
				if ($logo['error'] != 1) {

					$imgHandler = new ImageHandler($logo_folder);
					
					$imgHandler->setImage($logo['tmp_name'], $logo['name']);
					$imgHandler->resize(500, 150, true, false);

					$imgHandler->close();

					$employer->logo_path = $imgHandler->getFrontEndImagePath();
					$employer->save();
			
					return json_encode(array('success'=> true, 'filename' => $logo['name'], 'src' => $imgHandler->getFrontEndImagePath()));
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
	
	public function get_resume($applied_id) {
		if(!$applied_id) {
			return false;
		}
		//the applicant must apply to that job before the employer can view
		
		$data = ApplicantJobs::find($applied_id);
		
		if ( $data->applicant_resume_id ) {
			
			header('Content-disposition: attachment; filename='. $data->resume->resume);
			header('Content-type: ' . Formatter::format_reverse_filetype($data->resume->type));
			readfile( $_SERVER['DOCUMENT_ROOT'] . $data->resume->path );
			die();
			
		} else {
			echo "This applicant has not registered with the system or has not submitted a resume. Please kindly check your email as all resumes will be sent to your nominated email address for applicantions.";
		}
		
	}

	public function get_coverletter($applied_id) {
		if(!$applied_id) {
			return false;
		}
		
		$data = ApplicantJobs::find($applied_id);
		
		if ( !empty( $data->write_coverletter)  ) {
			
			echo $data->write_coverletter;
			
		} else if ( $data->applicant_coverletter_id ) {
			
			header('Content-disposition: attachment; filename='. $data->coverletter->coverletter);
			header('Content-type: ' . Formatter::format_reverse_filetype($data->coverletter->type));
			readfile( $_SERVER['DOCUMENT_ROOT'] . $data->coverletter->path );
			die();
		} else {
			echo "Applicant has not submitted any coverletter.";
		}
 		
	}

}