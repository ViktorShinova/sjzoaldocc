<?php

class Job_Controller extends Base_Controller {

	const NO_FILE_UPLOAD = 4;
	const JOB_APPLY_TPL = 'job-apply';
	const APPLIED = 1;

	protected $_months = array(
		'0' => '0 month',
		'1' => '1 month',
		'2' => '2 months',
		'3' => '3 months',
		'4' => '4 months',
		'5' => '5 months',
		'6' => '6 months',
		'7' => '7 months',
		'8' => '8 months',
		'9' => '9 months',
		'10' => '10 months',
		'11' => '11 months',
		'12' => '12 months',
		'13' => '13 months',
		'14' => '14 months',
		'15' => '15 months',
		'16' => '16 months',
		'17' => '17 months',
		'18' => '18 months',
		'19' => '19 months',
		'20' => '20 months',
	);
	
	protected $_years = array(
		'0' => '0 year',
		'1' => '1 year',
		'2' => '2 years',
		'3' => '3 years',
		'4' => '4 years',
		'5' => '5 years',
		'6' => '6 years',
		'7' => '7 years',
		'8' => '8 years',
		'9' => '9 years',
		'10' => '10 years',
		'11' => '11 years',
		'12' => '12 years',
		'13' => '13 years',
		'14' => '14 years',
		'15' => '15 years',
		'16' => '16 years',
		'17' => '17 years',
		'18' => '18 years',
		'19' => '19 years',
		'20' => '20 years',
	);

	//private $words = array("the", "and", "is", "are", "or", "an", "a", "as");
//	private function tokenizer($keywords) {
//		//first we check for quotes. If they are present, we must put them together as a phrase. If not, separate them.
//		//var_dump($keywords);
//		if (strpos($keywords, '"') !== false) {
//
//			$all_phrase = $this->advance_tokenizer($keywords);
//		}
//
//		//this will be the last one do be done.
//		// a better tokenizer is to remove conjuntive from the phrase.
//		// Conjuntive are as follows: The, And, Is, ... 
//		$tokens = explode(' ', preg_replace('/\s\s+/', ' ', trim($keywords)));
//		$keywords = array_diff($tokens, $this->words);
//
//		return $keywords;
//	}
//	private function advance_tokenizer($token, $test = true) {
//		//this will return an array of token phrase
//		//
//		
//		$tokens = array();
//
//		if ($test === false) {
//			//var_dump($first);
//			//var_dump($token);
//		}
//		//get all values in quotes
//		preg_match_all('/\"([^\"]*?)\"/', $token, $matches, PREG_SET_ORDER);
//		var_dump(preg_split('/\"([^\"]*?)\"/', $token));
//		//preg_match_all('/\^\"([^\"]*?)\"/', $token, $matches, PREG_SET_ORDER);
//		// foreach($matches as $value) {
//		// 	$tokens[] = $value[1];
//		// }
//
//		var_dump($matches);
//	}

	public function get_search() {
		$job_categories = array('' => 'All Categories') + Category::lists('name', 'id');
		$locations = array('' => 'All of Australia') + Location::lists('name', 'id');
		$work_types = WorkType::lists('name', 'abbr');

		//get the pre selected work type
		$selected_work_types = Input::get('work-type');

		$params = Input::all();

		//tokenize the keywords
		//$filtered_keywords = $this->tokenizer($params['keywords']);

		if (isset($params['min-salary'])) {
			$min_salary = $params['min-salary'];
			$max_salary = $this->_calculate_max_salary($min_salary);
		} else {
			$max_salary = $this->_calculate_max_salary(0);
		}
		//var_dump($max_salary);
		$relevancy = null;
		$column = 'created_at';
		$direction = 'desc';

		if (isset($params['keywords']) && !empty($params['keywords'])) {
			$relevancy = DB::raw("MATCH (jobs.title, jobs.description, jobs.summary) AGAINST ('" . $params['keywords'] . "' IN NATURAL LANGUAGE MODE) as score");
			$column = 'score';
			$direction = 'desc';
		}



		if (isset($params['sort']) && $params['sort'] == 'date-desc') {
			$column = 'created_at';
			$direction = 'desc';
		} else if (isset($params['sort']) && $params['sort'] == 'date-asc') {
			$column = 'created_at';
			$direction = 'asc';
		} else if (isset($params['sort']) && $params['sort'] == 'title') {
			$column = 'title';
			$direction = 'asc';
		}

		$select = array(
			'jobs.id',
			'jobs.title',
			'jobs.salary_range',
			'jobs.summary',
			'employers.company',
			'employers.logo_path as logo',
			'jobs.created_at',
			'locations.name as location_name',
			'sub_locations.name as sub_location_name',
			'job_category.name as category_name',
			'job_category.id as category_id',
			$relevancy,
		);
		$select = array_filter($select);

		$jobs = DB::table('jobs')
				->join('employers', 'jobs.employer_id', '=', 'employers.id')
				->join('job_category', 'jobs.category_id', '=', 'job_category.id')
				->join('job_sub_category', 'jobs.sub_category_id', '=', 'job_sub_category.id')
				->join('locations', 'jobs.location_id', '=', 'locations.id')
				->join('sub_locations', 'jobs.sub_location_id', '=', 'sub_locations.id')
				->where(function ($query) use ($params) {
							// over here, we check to see if the search params are avalialbe
							//Job Category and Sub Category
							if (isset($params['job-category']) && !empty($params['job-category'])) {
								$query->where('job_category.id', '=', $params['job-category']);
							}
							if (isset($params['job-sub-category']) && !empty($params['job-sub-category'])) {
								$query->where('job_sub_category.id', '=', $params['job-sub-category']);
							}
							//Location and Sub Location
							if (isset($params['job-location']) && !empty($params['job-location'])) {
								$query->where('jobs.location_id', '=', $params['job-location']);
							}
							if (isset($params['job-sub-location']) && !empty($params['job-sub-location'])) {
								$query->where('jobs.sub_location_id', '=', $params['job-sub-location']);
							}

							//SALARY
							if (isset($params['min-salary'])) {
								$query->where('jobs.min_salary', '>=', $params['min-salary']);
							}

							if (isset($params['max-salary']) && !empty($params['max-salary'])) {
								$query->where('jobs.max_salary', '<=', $params['max-salary']);
							}

							if (isset($params['keywords']) && !empty($params['keywords'])) {
								$query->raw_where("MATCH (jobs.title, jobs.description, jobs.summary) AGAINST ('" . $params['keywords'] . "' IN NATURAL LANGUAGE MODE)");
							}
						})
				->where(function ($query) use ($params) {

							if (isset($params['work-type']) && !empty($params['work-type'])) {

								$types = $params['work-type'];

								foreach ($types as $type) {
									$query->or_where('jobs.work_type', 'LIKE', "%$type%");
								}
								//$query->where('jobs.location_id', '=', $params['work-type']);
							}
						})
				->where('status', '=', '1')
				->where('end_at', '>', date('Y:m:d H:i:s'))
				->order_by($column, $direction)
				//->raw_where("CONTAINS (jobs.title,")
				->paginate(20, $select);


		$is_applicant = false;
		$is_employer = false;
		$applicant_shortlists = null;
		//check if the user is login and if he is employer or applicant
		if (Auth::check() && Auth::user()->role_id == '2') {

			$applicant_id = Session::get('applicant_id');

			$is_applicant = true;


			//Get shortlist	
			$applicant_shortlists = Shortlists::where('applicant_id', '=', $applicant_id)->lists('job_id');
		} else if (Auth::check() && Auth::user()->role_id == '1') {
			$is_employer = true;
		}





		//The search field can be search in title, desciption, company. Search for each word instead of searching the pharse which will yield more results
		//

		//sort by most recent
		//sort by salary highest
		//sort by most relevant (title)
		//sort by alphabet



		return View::make('job.jobs')->with(array(
					"jobs" => $jobs,
					'locations' => $locations,
					'categories' => $job_categories,
					'work_types' => $work_types,
					'selected_work_types' => $selected_work_types,
					'selected_category' => Input::get('job-category'),
					'selected_sub_category' => Input::get('job-sub-category'),
					'selected_location' => Input::get('job-location'),
					'selected_sub_location' => Input::get('job-sub-location'),
					'selected_min_salary' => Input::get('min-salary'),
					'selected_max_salary' => Input::get('max-salary'),
					'min_salary' => $this->_min_salary,
					'max_salary' => $max_salary,
					'keywords' => Input::get('keywords'),
					'sort_order' => Input::get('sort'),
					'is_applicant' => $is_applicant,
					'applicant_shortlists' => $applicant_shortlists,
					'is_employer' => $is_employer
						)
		);
	}

	public function get_article($id = null) {

		if (!$id) {
			//return the job listing page. or return a 404 page not found or tell the user the job has expired
		}

		$job = Job::find($id);

		//Relevant Jobs
//		$related_jobs = DB::table('jobs')->order_by(DB::raw('RAND()'))
//						->join('employers', 'jobs.employer_id', '=', 'employers.id')
//						->join('job_category', 'jobs.category_id', '=', 'job_category.id')
//						->join('locations', 'jobs.location_id', '=', 'locations.id')
//						->join('sub_locations', 'jobs.sub_location_id', '=', 'sub_locations.id')
//						->where('jobs.category_id', '=', $job->category_id)
//						->where('jobs.location_id', '=', $job->location_id)
//						->where('jobs.sub_category_id', '=', $job->sub_category_id)
//						->where('jobs.work_type', '=', $job->work_type)
//						->where('jobs.id', '!=', $job->id)
//						->where('jobs.status', '=', '1')
//						->where('jobs.end_at', '>', date('Y:m:d H:i:s'))
//						->take(3)->get(array(
//			'jobs.id',
//			'jobs.title',
//			'jobs.summary',
//			'employers.company as company',
//			'locations.name as location_name',
//		));

		$is_applicant = false;
		$is_employer = false;
		//check if the user is login and if he is employer or applicant
		if (Auth::check() && Auth::user()->role_id == '2') {
			$is_applicant = true;
		} else if (Auth::check() && Auth::user()->role_id == '1') {
			$is_employer = true;
		}

		$applicant_job = ApplicantJobs::where('applicant_id', '=', Session::get('applicant_id'))
						->where('job_id', '=', $id)->first();
		$is_applied = false;
		if ($applicant_job) {
			if (Auth::check() && $applicant_job->status == 1) {
				$is_applied = true;
			}
		}

		return View::make('job.article')->with(array(
					'job1' => $job,
					//'related_jobs' =>			$related_jobs,
					'is_applicant' => $is_applicant,
					'is_applied' => $is_applied,
					'is_employer' => $is_employer,
		));
	}

//	public function post_load_shortlist_category($job_id = null) {
//
//		$job_id = Input::get('article-id');
//		$markup = "";
//
//		if(Session::get('applicant_id')) {
//			$shortlist_categories = Applicant::find(Session::get('applicant_id'))->shortlistcategory()->get();
//			$shortlisted_category = Applicant::find(Session::get('applicant_id'))->shortlists()->where('job_id', '=', $job_id)->first();
//
//			foreach($shortlist_categories as $shortlist_category) {
//				if($shortlisted_category) {
//					$selected = ($shortlisted_category->id == $shortlist_category->id) ? 'checked="checked"' : " ";
//				} else {
//					$selected = "";
//				}
//				
//				$markup .= '<li role="presentation">
//								<input type="radio" name="job_shortlist_category" '.$selected.' value="'.$shortlist_category->id.'"> '.$shortlist_category->name.'	
//							</li>';
//			}
//		}
//
//		$markup .= '<li role="presentation" class="divider"></li>
//					<li role="presentation">
//						<a role="button" tabindex="-1" href="#create-group" data-toggle="modal"><i class="icon-th-large"></i> Create new tag</a>
//					</li>';
//
//		return $markup;
//	}
//	public function get_shortlist_tag() {
//		$user = Auth::user();
//		$tag = null;
//
//		if (isset($user->id)) {
//			$shortlist_categories = Applicant::find(Session::get('applicant_id'))->shortlistcategory()->get();
//
//			foreach ($shortlist_categories as $shortlist_category) {
//				$tag[] = $shortlist_category->name;
//			}
//		}
//		return json_encode($tag);
//	}
//	public function post_update_shortlist_tag() {
//
//		$tags = Input::get('tags');
//
//		$shortlist_categories = Applicant::find(Session::get('applicant_id'))->shortlistcategory()->get();
//
//		$shortlist_categories_array = array();
//
//		foreach ($shortlist_categories as $shortlist_category) {
//
//			$shortlist_categories_array[] = $shortlist_category->name;
//
//			if (count($tags) > 0) {
//				if (!in_array($shortlist_category->name, $tags)) {
//					$shortlist_category->delete($shortlist_category->id);
//				}
//			} else {
//				$shortlist_category->delete($shortlist_category->id);
//			}
//		}
//
//		foreach ($tags as $tag) {
//			if (count($shortlist_categories_array) > 0) {
//				if (!in_array($tag, $shortlist_categories_array)) {
//					$new_shortlist_category = new ApplicantShortlistCategory();
//					$new_shortlist_category->applicant_id = Session::get('applicant_id');
//					$new_shortlist_category->name = $tag;
//					$new_shortlist_category->save();
//				}
//			} else {
//				$new_shortlist_category = new ApplicantShortlistCategory();
//				$new_shortlist_category->applicant_id = Session::get('applicant_id');
//				$new_shortlist_category->name = $tag;
//				$new_shortlist_category->save();
//			}
//		}
//	}

	public function post_shortlist($job_id = null, $type = null) {

		if (!$job_id && !$type) {
			return false;
		}

		$applicant_id = Session::get('applicant_id');

		switch ($type) {

			case "insert":

				$shortlist = Shortlists::where('applicant_id', '=', $applicant_id)
						->where('job_id', '=', $job_id)
						->first();


				if ($shortlist) {
					return json_encode(array('success' => false, 'message' => 'You have already shortlisted this job'));
				}

				$shortlist = new Shortlists();

				$shortlist->applicant_id = $applicant_id;
				$shortlist->job_id = $job_id;

				try {
					if ($shortlist->save()) {
						return json_encode(array('success' => true));
					} else {
						throw new SystemException('Unable to add job to shortlist for ' . $applicant_id . ' with job : ' . $job_id);
					}
				} catch (Exception $e) {
					throw new SystemException($e->getMessage(), $e->getCode());
				}

				break;

			case "delete":
				try {

					$affected = $shortlist = DB::table('shortlists')->where('applicant_id', '=', $applicant_id)
							->where('job_id', '=', $job_id)
							->delete();


					if (!$affected) {
						throw new SystemException("No records found or deleted");
					} else {
						return json_encode(array('success' => true));
					}
				} catch (Exception $e) {
					throw new SystemException($e->getMessage(), $e->getCode());
				}


				break;

			default:
				break;
		}
	}

	public function get_apply($id = null) {
		if (!$id) {
			return false;
		}

		$applicant = $applicant_resumes = $applicant_coverletters = null;
		$is_employer = $is_applied = $is_applicant = false;

		$job = Job::find($id);


		if (Auth::check() && Auth::user()->role_id == '2') {
			$applicant = Applicant::find(Session::get('applicant_id'));
			$is_applicant = true;
			$applicant->email = Auth::user()->email;
			$applicant_resumes = $applicant->resumes()->get();
			$applicant_coverletters = $applicant->coverletters()->get();

			$applicant_job = ApplicantJobs::where('applicant_id', '=', Session::get('applicant_id'))
							->where('job_id', '=', $id)->first();

			if ($applicant_job != null && $applicant_job->status == 1) {
				$is_applied = true;
			}
		} else if (Auth::check() && Auth::user()->role_id == '1') {
			$is_employer = true;
//				$applicant = new Applicant();
//				$applicant->email = null;
//				$applicant->first_name = null;
//				$applicant->last_name = null;
//				$applicant->contact_number = null;
		}

		return View::make("job.apply")->with(array(
					'job' => $job,
					'applicant' => $applicant,
					'resumes' => $applicant_resumes,
					'coverletters' => $applicant_coverletters,
					'is_applicant' => $is_applicant,
					'is_applied' => $is_applied,
					'is_employer' => $is_employer,
					'years' => $this->_years,
					'months' => $this->_months
		));
	}

	public function post_apply($id = null) {
		if (!$id) {
			return false;
		}

		
		$rules = array(
			'upload-resume' => 'max:2048|mimes:pdf,doc,docx',
			'upload-coverletter' => 'max:2048|mimes:pdf,doc,docx'
		);
		$messages = array(
			'max' => 'The maximum file size is 2MB',
			'mimes' => 'Only .pdf, .doc or .docx are allowed',
		);

		$validation = Validator::make(Input::file(), $rules, $messages);

		if ($validation->fails()) {

			return Redirect::to('/job/apply/' . $id )->with_errors($validation)->with_input();

		}
		
		$input = Input::all();
		$job = Job::find($id);

		$employer = $job->employer;

		//email employer
		$mail = new PHPMailer();
		$data['submissionData'] = Input::all();


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

		$mail->Subject = 'You\'ve received a new job application! - Careerhire';
		$mail->isHtml();
		$mail->AddAddress($employer->application_email, $employer->title . ' ' . $employer->first_name . ' ' . $employer->last_name);
		$mail->AddReplyTo(Input::get('email'));



		//gather all the this job and employer details
		$data['job'] = $job->original;
		$data['employer'] = $employer->original;

		//pass applicant email
		//if user logged-in
		if (Session::has('applicant_id')) {
			$applicant_id = Session::get('applicant_id');
			$apply_job = new ApplicantJobs();
			$apply_job->job_id = $id;
			$apply_job->applicant_id = $applicant_id;
			$apply_job->applicant_resume_id = $input['selected-resume'];

			$apply_job->applicant_coverletter_id = $input['selected-coverletter'];

			$apply_job->write_coverletter = strip_tags(nl2br($input['write-coverletter']));
			$apply_job->alternate_contact_details = serialize(array($input['email'], $input['contact']));

			$apply_job->status = self::APPLIED;

			$apply_job->save();

			//gather data of applicant
			$data['applicant'] = array_merge((array) $apply_job->original, (array) Applicant::find($apply_job->applicant_id)->original);



			//gather data of attachments
			if ($input['selected-resume'] != 0) {
				$resume_file = ApplicantResumes::find($input['selected-resume'])->original;
				$resume_file['name'] = $resume_file['resume'];
				unset($resume_file['resume']);


				$resume_file['tmp_name'] = $_SERVER["DOCUMENT_ROOT"] . $resume_file['path'];


				unset($resume_file['path']);
				$resume_file['error'] = 0;
				$applicant_resume_file = $resume_file;
			} else {
				
				$applicant_resume_file = Input::file('upload-resume');
				
		
		
				//validate
				if( Input::get('add-resume-to-account')  == 1) {
					
					$filename = preg_replace('/\s+/', '-', $applicant_resume_file['name']);
					
					ApplicantResumes::uploadResume($filename, $applicant_resume_file['size'], $applicant_resume_file['type'], 'upload-resume');
					
				}
				
			}

			if ($input['selected-coverletter'] != 0) {
				$coverletter_file = ApplicantCoverletters::find($input['selected-coverletter'])->original;
				$coverletter_file['name'] = $coverletter_file['coverletter'];
				unset($coverletter_file['coverletter']);
				$coverletter_file['tmp_name'] = $_SERVER["DOCUMENT_ROOT"] . $coverletter_file['path'];
				unset($coverletter_file['path']);
				$coverletter_file['error'] = 0;
				$applicant_coverletter_file = $coverletter_file;
			} else {
				$applicant_coverletter_file = Input::file('upload-coverletter');
				
				if( Input::get('add-coverletter-to-account')  == 1) {
					
					$filename = preg_replace('/\s+/', '-', $applicant_coverletter_file['name']);
					
					ApplicantCoverletters::uploadCoverletter($filename, $applicant_coverletter_file['size'], $applicant_coverletter_file['type'], 'upload-coverletter');
					
				}
			}

			$data['applicant']['attachments'] = array('resume' => $applicant_resume_file, 'coverletter' => $applicant_coverletter_file);
		} else {

			//non-registered users
			$apply_job = new ApplicantJobs();
			$apply_job->job_id = $id;
			$apply_job->write_coverletter = strip_tags(nl2br($input['write-coverletter']));
			$apply_job->non_registered_users = serialize($input);
			$apply_job->status = APPLIED;
			$apply_job->save();

			//gather data of applicant
			$data['applicant'] = $apply_job->original;

			//gather data of attachments
			$data['applicant']['attachments'] = array('resume' => Input::file('upload-resume'), 'coverletter' => Input::file('upload-coverletter'));
		}

		//pass all attachments


		$attachment = $data['applicant']['attachments'];

		if (isset($attachment['error']) && $attachment['error'] == 0) {
			$mail->AddAttachment($attachment['tmp_name'], $attachment['name']);
		}

		$mail->Body = View::make('email.' . self::JOB_APPLY_TPL)
				->with(array(
					'data' => $data
				)
		);

		if ($mail->send()) {
			Session::flash('success', true);
			return Redirect::to('job/apply/' . $id);
		}
	}

}