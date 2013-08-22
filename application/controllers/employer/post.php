<?php

class Employer_Post_Controller extends Base_Controller {
	protected $_secure_pages = array(
		'post',
		'index',
		'list',
		'create',
		'edit',
		'details',
		'resume',
		'coverletter',
	);
	
	public static $_per_page = 25;
			
			
	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				$this->_secure_pages
		);

		$this->filter('before', 'employer')->only(
				$this->_secure_pages
		);
	}

	public function get_list() {
		$page = Input::get('page', 1);
		$offset = ($page - 1) * static::$_per_page;
		// validate page value
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
		$jobs = DB::query( 'select
				(SELECT 
					COUNT(id) from `applicant_job` where `job_id` = `jobs`.`id` ) as `num_of_applicants`, 
					jobs.*
				FROM 
					`jobs` jobs 
				WHERE 
					`employer_id` = ' . Session::get('employer_id') . ' 
				AND 
					`end_at` > \'' . date('Y:m:d H:i:s') .'\' 
				ORDER BY
					(created_at) desc 
				LIMIT ' . $offset .','.static::$_per_page
					
					
		);
		
		$rows = DB::query('SELECT FOUND_ROWS() as total');
		$row = $rows[0];
		$total = $row->total;
		
		$page = Paginator::page($total, static::$_per_page);
		
//		$jobs = Job::where('end_at', '>', date('Y:m:d H:i:s'))
//				->where('employer_id', '=', Session::get('employer_id'))
//				->order_by('created_at', 'desc')
//				->paginate( 30, array(
//					
//				));
		$results = Paginator::make($jobs, $total, static::$_per_page);
		return View::make('employer.post_list')
				->with('jobs', $results);
	}

	public function get_create($id = null) {

		$job_categories = Category::lists('name', 'id');
		$locations = Location::lists('name', 'id');
		$work_types = WorkType::lists('name', 'abbr');
		$templates = Template::all();
		$min_salary = $this->_min_salary;
		$max_salary = $this->_calculate_max_salary(0, 'annually');


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
			'title' => 'required',
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
		
		$title = Input::get('title');
		
		$slug = Job::slugify($title);
		
		
		$validation = Validator::make(Input::all(), $rules, $messages);

		if ($validation->fails()) {
			Session::put("old-sub-category", Input::get('sub-category'));
			Session::put("old-sub-location", Input::get('sub-location'));
			return Redirect::to('employer/post/create/')->with_errors($validation)->with_input();
		} else {
			$inputs = Input::all();
			$inputs['slug'] = $slug;
			Session::forget('notice');
			Session::put('notice', $inputs);

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
		
		return Redirect::back();
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
		
		$post = Job::find($id);
		$max_salary = $this->_calculate_max_salary(0, $post->salary_type);
		$sub_categories = SubCategory::where('category_id', "=", $post->category_id)->lists("name", "id");
		$sub_categories = array('' => 'Choose a sub category') + $sub_categories;
		
		$sub_locations = SubLocation::where('location_id', "=", $post->location_id)->lists("name", "id");
		$sub_locations = array('' => 'Choose a sub location') + $sub_locations;
		
		return View::make("employer.editpost")->with(
						array(
							'categories' => $job_categories,
							'locations' => $locations,
							'workTypes' => $work_types,
							'templates' => $templates,
							'job' => $post,
							'min_salary' => $min_salary,
							'max_salary' => $max_salary,
							'sub_categories' => $sub_categories,
							'sub_locations' => $sub_locations
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
			$job->description = Formatter::strip_tags($job_ads['desc']);
			$job->more_info = $job_ads['more-info'];
			$job->contact = $job_ads['contact'];
			$job->category_id = $job_ads['job-category'];
			$job->sub_category_id = $job_ads['sub-category'];
			$job->min_salary = $job_ads['min-salary'];
			$job->max_salary = $job_ads['max-salary'];
			$job->salary_range = $job_ads['salary-range'];
			$job->salary_type = $job_ads['sal-type'];
			$job->payment_structure = $job_ads['pay-struct'];
			$job->work_type = $job_ads['work-type'];
			$job->location_id = $job_ads['job-location'];
			$job->sub_location_id = $job_ads['sub-location'];
			if( isset($job_ads['custom-apply-select']) && $job_ads['custom-apply-select'] === 'N') {
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
		
		$applicants = DB::table('applicant_job')
		->join('applicants', 'applicants.id', '=', 'applicant_job.applicant_id', 'LEFT OUTER')
		->join('applicant_resumes', 'applicant_job.applicant_resume_id', '=', 'applicant_resumes.id', 'LEFT OUTER')
		->join('users','users.id', '=', 'applicants.user_id', 'LEFT OUTER')
		->where('applicant_job.job_id', '=', $id)
		->paginate(20,
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
		
		
		
		
		foreach( $applicants->results as $applicant) {
			
			$applicant->is_non_registered = false;
			if( !$applicant->applicant_id) {
				//non-registered users
				
				$data = unserialize($applicant->non_registered_users);
				
				$applicant->first_name = $data['first_name'];
				$applicant->last_name = $data['last_name'];
				$applicant->email = $data['email'];
				$applicant->is_non_registered = true;
				
			}
			
		}
		
		
		return View::make('employer.details')->with(array('applicants' => $applicants, 'job' => $job));

		//Get the number of applicant who apply and also get who applied
		//show them in a list with their resume at the side and cover letter if any.
		
		
		
	}
	
	public function post_details($id = null) {
		
		if( !$id ) {
			return Redirect::to('employer/post/list');
		}
		
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
				->paginate(static::$_per_page);

		return View::make('employer.archived')->with(array('jobs' => $jobs));
	}
	
	
}
