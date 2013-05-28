<?php

class Applicant_Controller extends Base_Controller {

	public function __construct() {
		parent::__construct();
		$this->filter('before', 'auth')->only(
				array('account',
				)
		);
		$this->filter('before', 'applicant')->only(
				array('account')
		);
	}

	public function get_index() {
		return View::make('applicant.index');
	}

	public function get_account() {

		$id = Session::get('applicant_id');

		$applicant = Applicant::find($id);


		$applicant_qualifications = $applicant->qualifications()->get();
		$applicant_work_histories = $applicant->work_histories()->get();
		$applicant_resumes = $applicant->resumes()->get();
		$applicant_coverletters = $applicant->coverletters()->get();
		$applicant_expertises = null;
		if ($applicant->skills || $applicant->skills != '') {
			$applicant_expertises = array_filter(explode(';', $applicant->skills));
		}

		$locations = Location::lists('name', 'id');
		$job_categories = Category::lists('name', 'id');

		$months = array(
			'01' => 'Jan',
			'02' => 'Feb',
			'03' => 'Mar',
			'04' => 'Apr',
			'05' => 'May',
			'06' => 'Jun',
			'07' => 'Jul',
			'08' => 'Aug',
			'09' => 'Sep',
			'10' => 'Oct',
			'11' => 'Nov',
			'12' => 'Dec'
		);

		$save_status = Input::get('save');

		return View::make("applicant.account")->with(array(
					'locations' => $locations,
					'job_categories' => $job_categories,
					'industries' => $job_categories,
					'months' => $months,
					'years' => array_reverse(range(1960, date("Y"))),
					'user' => Auth::user(),
					'applicant' => $applicant,
					'qualifications' => $applicant_qualifications,
					'experiences' => $applicant_work_histories,
					'expertises' => $applicant_expertises,
					'resumes' => $applicant_resumes,
					'coverletters' => $applicant_coverletters,
					'save_status' => $save_status,
					'host' => $this->_host,
		));
	}

	public function get_profile($slug) {

		if (!Auth::check()) {
			return Redirect::to('/login');
		}

		$user = User::where('id', '=', $slug)->first();

		if ($user) {
			$user = Applicant::where('user_id', '=', $user->id)->first();
		} else {
			$user = Applicant::where('slug', '=', $slug)->first();
		}

		if ($user != null) {

			$user_qualifications = $user->qualifications()->get();
			$user_work_histories = $user->work_histories()->get();

			$user_resumes = $user->resumes()->get();
			$user_coverletters = $user->coverletters()->get();

			$user_privacy_settings = unserialize($user->privacy_settings);

			$preferred_location = Location::find($user->preferred_location);
			$user->preferred_location = $preferred_location->name . ', ' . $preferred_location->state;

			$preferred_job = Category::find($user->preferred_job);
			$user->preferred_job = $preferred_job->name;


			$user->skills = array_filter(explode(';', $user->skills));

			return View::make("applicant.profile")->with(array(
						'user' => $user,
						'qualifications' => $user_qualifications,
						'workhistories' => $user_work_histories,
						'resumes' => $user_resumes,
						'coverletters' => $user_coverletters,
						'privacy_settings' => $user_privacy_settings,
						'notfound' => 0
			));
		} else {

			return View::make("applicant.profile")->with(array(
						'notfound' => 1
			));
		}
	}

	public function post_settings() {
		//die(var_dump(serialize(Input::all())));
		$applicant = Applicant::find(Session::get('applicant_id'));

		$applicant->privacy_settings = serialize(Input::all());
		$applicant->viewable = Input::get('profile_display_is_private');
		$applicant->save();

		Session::flash('success', true);

		return Redirect::to('applicant/settings');
	}

	public function post_basic_profile() {
		$register_input = Input::all();

		$rules = array(
			'firstname' => 'required',
			'lastname' => 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails()) {
			return false;
			//return Redirect::to('applicant/account')->with_errors($validation)->with_input();
		} else {

			//Save User Basic Profile
			$applicant = Applicant::find(Session::get('applicant_id'));
			$applicant->first_name = $register_input['firstname'];
			$applicant->last_name = $register_input['lastname'];
			$applicant->preferred_location = $register_input['location'];
			$applicant->preferred_job = $register_input['category'];
			$applicant->save();
			return true;
		}
	}

	public function get_qualification($id = null) {
		if (!$id) {
			return false;
		}
		$qualification = ApplicantQualifications::find($id)->original;

		if ($qualification) {
			return json_encode(array('success' => true, 'qualification' => $qualification));
		} else {
			return json_encode(array('success' => false));
		}
	}

	public function post_qualification($id = null) {

		$qualification = null;
		if (!$id) {
			$qualification = new ApplicantQualifications();
		} else {
			$qualification = ApplicantQualifications::find($id);
		}
		$applicant_id = Session::get('applicant_id');
		$qualification->applicant_id = $applicant_id;
		$qualification->level = Input::get('qualification-level');
		$qualification->title = Input::get('qualification-title');
		$qualification->institude = Input::get('qualification-school');
		$qualification->field_of_study = Input::get('qualification-field-of-study');
		$qualification->achievements = Input::get('qualification-achievement');
		$qualification->started = Input::get('qualification-started');
		$qualification->ended = Input::get('qualification-ended');

		if ($qualification->save()) {



			$qualifications = ApplicantQualifications::where('applicant_id', '=', $applicant_id)->get();

			$view = View::make('applicant.qualification')->with(array('qualifications' => $qualifications))->render();

			return json_encode(array('success' => true, 'view' => $view));
		} else {
			return json_encode(array('success' => false));
		}
	}

	public function get_experience($id = null) {
		if (!$id) {
			return false;
		}
		$experience = ApplicantWorkHistory::find($id)->original;

		if ($experience) {
			return json_encode(array('success' => true, 'experience' => $experience));
		} else {
			return json_encode(array('success' => false));
		}
	}

	public function post_experience($id = null) {
		$experience = null;
		if (!$id) {
			$experience = new ApplicantWorkHistory();
		} else {
			$experience = ApplicantWorkHistory::find($id);
		}
		$applicant_id = Session::get('applicant_id');

		$experience->applicant_id = $applicant_id;
		$experience->company_name = Input::get('employment-name');
		$experience->industry = Input::get('employment-industry');
		$experience->position = Input::get('employment-position');
		$experience->description = Input::get('employment-scope');

		$experience->started_month = Input::get('employment-started-month');
		$experience->started_year = Input::get('employment-started-year');
		$experience->ended_month = Input::get('employment-ended-month');
		$experience->ended_year = Input::get('employment-ended-year');

		if ($experience->save()) {


			$experiences = ApplicantWorkHistory::where('applicant_id', '=', $applicant_id)->get();

			$view = View::make('applicant.experience')->with(array('experiences' => $experiences))->render();

			return json_encode(array('success' => true, 'view' => $view));
		} else {
			return json_encode(array('success' => false));
		}
	}

	public function post_expertise() {

		if (trim(Input::get('expertise')) == '') {
			return false;
		}

		//semi colon separate

		$applicant_id = Session::get('applicant_id');

		$applicant = Applicant::find($applicant_id);

		//add the expertise into existing skill

		$expertises = array_filter(explode(';', $applicant->skills));

		$similar = false;

		foreach ($expertises as $expertise) {
			if ($expertise == Input::get('expertise')) {
				$similar = true;
			}
		}

		if ($similar) {
			$view = View::make('applicant.expertise')->with(array('expertises' => array_filter($expertises), 'error' => 'An existing record of "' . Input::get('expertise') . '" has been found in your expertise'))->render();
			return json_encode(array('success' => false, 'view' => $view));
		}


		$expertises[] = Input::get('expertise');
		$applicant->skills = implode(';', $expertises);

		if ($applicant->save()) {

			//return the list of expertise;

			$view = View::make('applicant.expertise')->with(array('expertises' => array_filter($expertises)))->render();

			return json_encode(array('success' => true, 'view' => $view));
		}
	}

	public function post_edit_expertise() {

		if (!Input::get('expertise-value')) {
			return false;
		}

		$new_expertise = Input::get('expertise-value');
		$prev_expertise = Input::get('prev-expertise-value');

		$applicant_id = Session::get('applicant_id');
		$applicant = Applicant::find($applicant_id);
		$expertises = array_filter(explode(';', $applicant->skills));

		foreach ($expertises as &$expertise) {

			if ($expertise == $prev_expertise) {

				$expertise = $new_expertise;
			}
		}
		$applicant->skills = implode(';', $expertises);

		if ($applicant->save()) {

			//return the list of expertise;

			$view = View::make('applicant.expertise')->with(array('expertises' => array_filter($expertises), 'message' => 'Expertise has been successfully edited.'))->render();

			return json_encode(array('success' => true, 'view' => $view));
		}
	}

	public function post_delete_expertise() {

		if (!Input::get('expertise')) {
			return false;
		}

		$expertise = Input::get('expertise');


		$applicant_id = Session::get('applicant_id');
		$applicant = Applicant::find($applicant_id);
		$expertises = array_filter(explode(';', $applicant->skills));

		$to_remove = null;
		foreach ($expertises as $key => $_exp) {
			if ($_exp == $expertise) {
				$expertises[$key] = null;
			}
		}




		$applicant->skills = implode(';', array_filter($expertises));

		if ($applicant->save()) {

			//return the list of expertise;

			$view = View::make('applicant.expertise')->with(array('expertises' => array_filter($expertises), 'message' => 'Expertise has been successfully removed.'))->render();

			return json_encode(array('success' => true, 'view' => $view));
		}
	}

	public function post_account() {

		switch (Input::get('form-type')) {
			case 'basic-profile':
				if ($this->post_basic_profile())
					Session::flash('success', true);
				return Redirect::to('applicant/account');
				//return Redirect::to('applicant/account')->with_errors($validation)->with_input();
				break;
			case 'qualification':
				if ($this->post_qualification())
					Session::flash('success', true);
				return Redirect::to('applicant/account');
				break;
			case 'workhistory':
				if ($this->post_workhistory())
					Session::flash('success', true);
				return Redirect::to('applicant/account');
				break;
		}
	}

	public function post_upload_profile_pic() {
		//check if this is ajax call
		$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
		if (!$xhr) {
			return false;
		} else {

			$user = Auth::user();
			$unique_folder = md5($user->username);
			$profile_picture = Input::file('upload-profile-pic');

			$rules = array(
				'upload-profile-pic' => 'image|max:2048|mimes:jpg,gif,png',
			);
			$messages = array(
				'image' => 'The file must be an image',
				'max' => 'The maximum image size is 2MB',
				'mimes' => 'Your image must be .jpg only'
			);

			$validation = Validator::make(Input::file('upload-profile-pic'), $rules, $messages);

			if (!$validation->fails()) {

				//store in tmp folder
				$imgHandler = new ImageHandler(APP_TMP_FOLDER . $unique_folder);

				$imgHandler->setImage($profile_picture['tmp_name'], $profile_picture['name']);
				$imgHandler->resize(470, 273, true, false);
				//release all image memory
				$imgHandler->close();
				return json_encode(array('filepath' => $imgHandler->getFrontEndImagePath()));
			} else {
				$error_message = $validation->errors->first('upload-profile-pic');
				return json_encode(array('error' => $error_message));
			}
		}
	}

	public function post_cropped_profile_pic() {
		//check if this is ajax call
		$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
		if (!$xhr) {
			return false;
		} else {

			$unique_folder = md5(Auth::user()->username);

			$profile_picture = Input::file("upload-profile-pic");

			if ($profile_picture['error'] != 1) {

				$filename = explode('.', $profile_picture['name']);
				$_tmp_image_location = APP_TMP_FOLDER . $unique_folder . '/' . $filename[0] . '.png';

				$imgHandler = new ImageHandler(APP_UPLOAD_DIR . $unique_folder);
				$imgHandler->setImage($_tmp_image_location, $profile_picture['name']);
				$targ_w = $targ_h = 150;
				$imgHandler->crop(0, 0, Input::get('x'), Input::get('y'), Input::get('w'), Input::get('h'), $targ_w, $targ_h);
				//insert/update into database 
				$applicant = Applicant::find(Session::get('applicant_id'));
				$applicant->profilepic = $imgHandler->getFrontEndImagePath();
				$applicant->save();
				$imgHandler->close();

				File::rmdir(APP_TMP_FOLDER . $unique_folder);

				return json_encode(array('filepath' => $imgHandler->getFrontEndImagePath()));
			} else {
				return json_encode(array("message" => $profile_picture));
			}
		}
	}

	public function post_upload_resumecoverletter() {
		//check if this is ajax call
		$applicant_id = Session::get('applicant_id');
		$type = Input::get('type');
		$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';

		//if not ajax
		if (!$xhr) {
			return false;
		}

		$username = md5(Auth::user()->username);

		Validator::register('resume_count_check', function($attribute, $value, $parameters) {
					$resume_count_check = count(ApplicantResumes::where('applicant_id', '=', Session::get('applicant_id'))->get());
					if ($resume_count_check < 4) {
						return true;
					} else {
						return false;
					}
				});

		Validator::register('coverletter_count_check', function($attribute, $value, $parameters) {
					$coverletter_count_check = count(ApplicantCoverletters::where('applicant_id', '=', Session::get('applicant_id'))->get());
					if ($coverletter_count_check < 4) {
						return true;
					} else {
						return false;
					}
				});

		$rules = array(
			'resume-file' => 'max:2048|mimes:pdf,doc,docx|resume_count_check',
			'coverletter-file' => 'max:2048|mimes:pdf,doc,docx|resume_count_check'
		);
		$messages = array(
			'max' => 'The maximum file size is 2MB',
			'mimes' => 'Only .pdf, .doc or .docx are allowed',
			'resume_count_check' => 'You can upload up to a maximum of 4 files only.',
			'coverletter_count_check' => 'You can upload up to a maximum of 4 files only.'
		);

		$validation = Validator::make(Input::file(), $rules, $messages);

		$file = Input::file($type . '-file');

		if ($validation->fails()) {
			$items = null;
			switch($type) {
				
				case 'resume':
					$error_message = $validation->errors->first('resume-file');
					$items = ApplicantResumes::where('applicant_id', '=', $applicant_id)->get();
					break;
				case 'coverletter':
					$error_message = $validation->errors->first('coverletter-file');
					$items = ApplicantCoverletters::where('applicant_id', '=', $applicant_id)->get();
					break;
			}
			
		

			$view = View::make('applicant.' .$type)->with(array($type .'s' => $items, 'error' =>  $error_message ))->render();;

			return json_encode(array('success' => false, 'view' => $view));
			
		}
		
		
		$file['name'] = preg_replace('/\s+/', '-', $file['name']);

		$folder = APP_UPLOAD_DIR . $username . '/' . $type . '/';

		if (!is_dir($folder)) {
			mkdir($folder, 777);
		}

		if (!file_exists($folder . $file['name'])) {
			Input::upload($type . '-file', $folder, $file['name']);

			$path = str_replace('public', '', $folder) . $file['name'];

			//insert into database 
			if ($type == 'resume') {
				$applicant_resume = new ApplicantResumes();
				$applicant_resume->applicant_id = $applicant_id;
				$applicant_resume->resume = $file['name'];
				$applicant_resume->path = $path;
				$applicant_resume->filesize = Formatter::format_bytes($file['size'], 0);
				$applicant_resume->type = Formatter::format_filetype($file['type']);
				$applicant_resume->disabled = 0;
				if ($applicant_resume->save()) {
					$resumes = ApplicantResumes::where('applicant_id', '=', $applicant_id)->get();

					$view = View::make('applicant.resume')->with(array('resumes' => $resumes))->render();;

					return json_encode(array('success' => true, 'view' => $view));
				}
			} else {
				$applicant_covereletter = new ApplicantCoverletters();
				$applicant_covereletter->applicant_id = $applicant_id;
				$applicant_covereletter->coverletter = $file['name'];
				$applicant_covereletter->path = $path;
				$applicant_covereletter->filesize = Formatter::format_bytes($file['size'], 0);
				$applicant_covereletter->type = Formatter::format_filetype($file['type']);
				$applicant_covereletter->disabled = 0;
				$applicant_covereletter->save();

				if ($applicant_covereletter->save()) {
					$coverletters = ApplicantResumes::where('applicant_id', '=', $applicant_id)->get();

					$view = View::make('applicant.resume')->with(array('coverletters' => $coverletters))->render();

					return json_encode(array('success' => true, 'view' => $view));
				}
			}
		} else {
			switch($type) {
				
				case 'resume':
					$items = ApplicantResumes::where('applicant_id', '=', $applicant_id)->get();
					break;
				case 'coverletter':
					
					$items = ApplicantCoverletters::where('applicant_id', '=', $applicant_id)->get();
					break;
			}
			$view = View::make('applicant.' .$type)->with(array($type .'s' => $items, 'error' =>  'File already exists. Please rename or remove your file.' ))->render();;
			return json_encode(array('success' => false, 'view' => $view));
			
		}
	}

	public function post_slug() {
		$applicant = Applicant::find(Session::get('applicant_id'));
		$applicant->slug = Input::get('slug');

		try {
			$applicant->save();
			//return true;
			return json_encode(array('slug' => Input::get('slug')));
		} catch (Exception $e) {
			if ($e->getMessage()) {
				return json_encode(array('error' => 'Slug already been used. Please choose another slug.'));
			}
		}
	}

	public function get_remove_item($id = null, $type = null) {

		if (!$id && $type) {
			return false;
		}


		$applicant_id = Session::get('applicant_id');

		switch ($type) {

			case 'q':

				$affected = DB::table('applicant_qualifications')
						->where('id', '=', $id)
						->where('applicant_id', '=', $applicant_id)
						->delete();

				if ($affected) {

					$qualifications = ApplicantQualifications::where('applicant_id', '=', $applicant_id)->get();

					$view = View::make('applicant.qualification')->with(array('qualifications' => $qualifications, 'message' => 'Selected qualification has been deleted.'))->render();

					return json_encode(array(
						'success' => true,
						'view' => $view));
				}

			case 'e':

				$affected = DB::table('applicant_work_history')
						->where('id', '=', $id)
						->where('applicant_id', '=', $applicant_id)
						->delete();

				if ($affected) {

					$experiences = ApplicantWorkHistory::where('applicant_id', '=', $applicant_id)->get();

					$view = View::make('applicant.experience')->with(array('experiences' => $experiences, 'message' => 'Selected experience has been deleted.'))->render();

					return json_encode(array(
						'success' => true,
						'view' => $view));
				}
		}
	}

	/* ===========================================================================================================
	  Applicant Resgistration
	  ========================================================================================================== */

	public function get_register() {

		$locations = Location::lists('name', 'id');
		$job_categories = Category::lists('name', 'id');

		return View::make("applicant.register")->with(array('locations' => $locations, 'job_categories' => $job_categories, 'industry' => $job_categories));
	}

	public function post_register() {

		$rules = array(
			'email' => 'required|email|max:255|unique:users', //user table
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
			'email' => 'required|email',
			'firstname' => 'required', //applicant table
			'lastname' => 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails()) {
			return Redirect::to('applicant/register')->with_errors($validation)->with_input();
		} else {

			$register_input = Input::all();
			$user = new User();
			$user->username = $register_input['email'];
			$user->role_id = 2;
			$user->email = $register_input['email'];
			$user->password = Hash::make($register_input['password']);

			if ($user->save()) {
				$applicant = new Applicant();
				$applicant->user_id = $user->id;
				$applicant->first_name = $register_input['firstname'];
				$applicant->last_name = $register_input['lastname'];
				$applicant->preferred_location = $register_input['location'];
				$applicant->preferred_job = $register_input['category'];
				$applicant->viewable = 1;

				if ($applicant->save()) {
					//send an email and then redirects them to the confirmation page.
					return Redirect::to('/login/');
				}
			}
		}
	}

	public function get_shortlists() {
		return View::make('applicant.shortlist');
	}

}