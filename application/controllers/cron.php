<?php

class Cron_Controller extends Base_Controller {
	
	protected $_mail = null;
	
	public function __construct() {
		
		$this->_mail = new CHMailer();
		if (strpos($_SERVER['HTTP_HOST'], '.localhost')) {
			$this->_mail->isSMTP();
			$this->_mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
			$this->_mail->SMTPAuth = true;  // authentication enabled
			$this->_mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$this->_mail->Host = SMTP;
			$this->_mail->Port = 465;
			$this->_mail->Username = SMTP_USERNAME;
			$this->_mail->Password = SMTP_PASSWORD;
			$this->_mail->IsHTML();
			$this->_mail->From = 'careermail@careershire.com';
			$this->_mail->FromName = 'Careershire';
		}
	}
	
	public function get_sendmail() {
		
		$applicants = Applicant::all();
		
		foreach( $applicants as $applicant ) {
			
			$search_data = $applicant->job_mail;
			$data = unserialize($search_data);
			
			if( !$data ) { continue; }
			
			$jobs = $this->search_job($data);
			if( empty($jobs)) { continue; }
			
			$size = sizeof($jobs);
			$data = unserialize($applicant->job_mail);
			
			$category = Category::find($data['job-category']);
			$this->_mail->Subject = $size . ' new jobs in ' . $category->name;
			
			$body = View::make('email.jobmail')->with('jobs', $jobs)->render();
			$this->_mail->Body = $body;
			$this->_mail->AddAddress($applicant->user->email);
			if( !$this->_mail->Send()) {
				echo ('fail');
			}
		} 
		
		die();
	}
	
	protected function search_job($params) {
		$relevancy = DB::raw("MATCH (jobs.title, jobs.description, jobs.summary) AGAINST ('" . $params['keywords'] . "' IN NATURAL LANGUAGE MODE) as score");
		$column = 'score';
		$direction = 'desc';
		$select = array(
			'jobs.id',
			'jobs.title',
			'jobs.salary_range',
			'jobs.summary',
			'jobs.slug',
			'employers.company',
			'employers.logo_path as logo',
			'jobs.created_at',
			'locations.name as location_name',
			'sub_locations.name as sub_location_name',
			'job_category.name as category_name',
			'job_category.id as category_id',
			'employers.id as employer_id',
			$relevancy,
		);
		
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
							
							if( isset($params['employer-id']) && !empty($params['employer-id'])) {
								$query->where('jobs.employer_id', '=', $params['employer-id']);
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
				->where('end_at', '>', date('Y-m-d H:i:s'))
				->where('jobs.created_at', '>=', date('Y-m-d 00:00:00'))
				->order_by($column, $direction)
				//->raw_where("CONTAINS (jobs.title,")
				->get($select);
						
			return $jobs;
		
	}

}