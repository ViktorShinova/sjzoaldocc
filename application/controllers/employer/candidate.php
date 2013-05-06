<?php

class Employer_Candidate_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				array('search')
		);

		$this->filter('before', 'employer')->only(
				array('search')
		);
	}

	public function get_search() {
		
		
		if(empty($_GET)) {
			return View::make('employer.candidate');
		}
		
		$keywords = $_GET['keywords'];
		$sort = $_GET['sort'];
		
		
		
		
		
		
		
		
		
		
		
		
		
	}

}

