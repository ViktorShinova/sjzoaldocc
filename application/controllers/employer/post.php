<?php

class Employer_Post_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				array('post',
					'index',
					'list',
					'create',
					'edit',
				)
		);

		$this->filter('before', 'employer')->only(
				array('post',
					'index',
					'list',
					'create',
					'edit',
				)
		);
	}

	public function get_list() {
		$jobs = Job::where('end_at', '>', date('Y:m:d H:i:s'))
				->where('employer_id', '=', Session::get('employer_id'))
				->paginate(30);

		return View::make('employer.post_list')->with(array('jobs' => $jobs));
	}

	public function get_create($id = null) {


		$job_categories = Category::lists('name', 'id');
		$locations = Location::lists('name', 'id');
		$work_types = WorkType::lists('name', 'abbr');
		$templates = Template::all();
		$min_salary = $this->_min_salary;
		$max_salary = $this->_calculate_max_salary(0);


		if (!$id) {
			return View::make("employer.post")->with(
							array('categories' => $job_categories,
								'locations' => $locations,
								'workTypes' => $work_types,
								'templates' => $templates,
								'min_salary' => $min_salary,
								'max_salary' => $max_salary,
							)
			);
		} else {
			//get the existing post
			$post = Job::find($id);
			return View::make("employer.post")->with(
							array(
								'categories' => $job_categories,
								'locations' => $locations,
								'workTypes' => $work_types,
								'templates' => $templates,
								'post' => $post,
								'min_salary' => $min_salary,
								'max_salary' => $max_salary,
							)
			);
		}
	}

	public function post_create() {
		$rules = array(
			'title' => 'required|max:255',
			'summary' => 'required|max:255',
			'desc' => 'required',
			'more-info' => 'required',
			'contact' => 'required',
			'min-salary' => 'required|numeric',
			'max-salary' => 'required|numeric'
		);
		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails()) {
			Session::put("old-sub-category", Input::get('sub-category'));
			Session::put("old-sub-location", Input::get('sub-location'));
			return Redirect::to('employer/post/create')->with_errors($validation)->with_input();
		} else {
			Session::forget('notice');
			Session::put('notice', Input::all());



			return Redirect::to('employer/payment');
		}
	}

	public function get_change_status($id = null, $active = '') {
		if (!$id && empty($active)) {
			return false;
		}

		$job = Job::find($id);

		if ($active === 'activate') {
			$job->status = 1;
		} else if ($active === 'deactivate') {
			$job->status = 0;
		}

		$job->save();

		return Redirect::to('employer/post/list');
	}

	public function get_delete($id = null) {
		if (!$id) {
			return false;
		}

		//This has to change. Might need to write my own database connector
		$job = Job::find($id);
		$job->delete();

		return Redirect::to('employer/post/list');
	}

	public function get_edit($id = null) {

		if (!$id) {
			return Redirect::to('employer/post/list');
		}

		$job_categories = Category::lists('name', 'id');
		$locations = Location::lists('name', 'id');
		$work_types = WorkType::lists('name', 'abbr');
		$templates = Template::all();
		$min_salary = $this->_min_salary;
		$max_salary = $this->_calculate_max_salary(0);
		
		$post = Job::find($id);
		return View::make("employer.editpost")->with(
						array(
							'categories' => $job_categories,
							'locations' => $locations,
							'workTypes' => $work_types,
							'templates' => $templates,
							'job' => $post,
							'min_salary' => $min_salary,
							'max_salary' => $max_salary,
						)
		);
	}

	public function post_edit($id = null) {

		if (!$id) {
			return Redirect::to('employer/post/list');
		}

		$rules = array(
			'title' => 'required|max:255',
			'summary' => 'required|max:255',
			'desc' => 'required',
			'more-info' => 'required',
			'contact' => 'required',
			'min-salary' => 'required|numeric',
			'max-salary' => 'required|numeric'
		);
		
		$messages = array (
			'summary' => 'The summary must be less than 255 characters'
		);
		$validation = Validator::make(Input::all(), $rules, $messages);

		if ($validation->fails()) {
			Session::put("old-sub-category", Input::get('sub-category'));
			Session::put("old-sub-location", Input::get('sub-location'));
			return Redirect::to('employer/post/edit/' . $id)->with_errors($validation)->with_input();
		} else {

			$job_ads = Input::all();

			$job = Job::find($id);

			$job->title = $job_ads['title'];
			$job->summary = $job_ads['summary'];
			$job->description = $job_ads['desc'];
			$job->more_info = $job_ads['more-info'];
			$job->video = $job_ads['video'];
			$job->contact = $job_ads['contact'];
			$job->category_id = $job_ads['job-category'];
			$job->sub_category_id = $job_ads['sub-category'];
			$job->min_salary = $job_ads['min-salary'];
			$job->max_salary = $job_ads['max-salary'];
			$job->salary_range = $job_ads['salary-range'];
			$job->payment_structure = $job_ads['pay-struct'];
			$job->work_type = $job_ads['work-type'];
			$job->location_id = $job_ads['job-location'];
			$job->sub_location_id = $job_ads['sub-location'];
			if($job_ads['custom-apply-select'] === 'N') {
				$job->apply = null;
			}
			else {
				$job->apply = $job_ads['custom-apply'];
			}
		
			
			
			$job->template_id = ( (!empty($job_ads['post-selected-template']) ? $job_ads['post-selected-template'] : 1 ) );

			if ($job->save()) {
				Session::flash('success', true);
				
			} else {
				Session::flash('success', false);
			}
			return Redirect::to('employer/post/edit/' . $id);
		}
	}
	
	/**
	 * 
	 * @param type $id
	 * Job Id
	 * @return boolean
	 */
	public function get_details( $id= null ) {
		if(!$id) {return false;}
		
		$job = Job::find($id);
		
		$applicants = DB::table('applicants')
		->join('applicant_job', 'applicants.id', '=', 'applicant_job.applicant_id')
		->join('applicant_resumes', 'applicant_job.applicant_resume_id', '=', 'applicant_resumes.id', 'LEFT OUTER')
		->join('users','users.id', '=', 'applicants.user_id')
		->where('applicant_job.job_id', '=', $id)
		->paginate(10,
				array(
					'applicants.id',
					'applicant_resumes.path',
					'applicant_job.*',
					'applicants.*',
					'users.email',
					'applicant_job.id as applied_id',
					'applicant_job.sent as sent',
				)
		);

		return View::make('employer.details')->with(array('applicants' => $applicants, 'job' => $job));

		//Get the number of applicant who apply and also get who applied
		//show them in a list with their resume at the side and cover letter if any.
		
		
		
	}
	
	public function post_details($id = null) {
		
		if( !$id ) {
			return Redirect::to('employer/post/list');
		}
		var_dump($_POST);
		
		//Session::put('data', $_POST);
		
		$rules = array(
			'email-success' => 'required',
			'email-unsuccess' => 'required',
		);
		
		$validation = Validator::make(Input::all(), $rules );
		if ($validation->fails()) {
		
		
		}
		
		Session::put('email_inputs', $_POST);
		
		return Redirect::to('employer/email/review/' . $id);
		
	}
	
	public function get_remove() {
		if(Session::has('notice')) {
			Session::forget('notice');
		}
		return Redirect::to('employer/post/create');
	}
	
	public function get_archived() {
		$jobs = Job::where('end_at', '<', date('Y:m:d H:i:s'))
				->where('employer_id', '=', Session::get('employer_id'))
				->paginate(10);

		return View::make('employer.archived')->with(array('jobs' => $jobs));
	}

}
