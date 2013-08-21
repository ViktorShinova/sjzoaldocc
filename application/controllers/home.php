<?php

class Home_Controller extends Base_Controller {

	public function get_index() {
		// This is slower. Uncomment this line and compare it in profiler
		//$jobs = Job::with(array('advertiser','category', 'location'))->get();

		$job_categories = array('' => 'All Categories') + Category::lists('name', 'id');
		$locations = array('' => 'All of Australia')  +  Location::lists('name', 'id');
		$work_types = WorkType::lists('name', 'abbr');
		
		
		$jobs = DB::table('jobs')->take(9)
				->order_by('created_at', 'asc')
				->join('employers', 'jobs.employer_id', '=', 'employers.id')
				->join('job_category', 'jobs.category_id', '=', 'job_category.id')
				->join('job_sub_category', 'jobs.sub_category_id', '=', 'job_sub_category.id')
				->join('locations', 'jobs.location_id', '=', 'locations.id')
				->get(
				array(
					'jobs.id',
					'jobs.title',
					'jobs.salary_range',
					'jobs.summary',
					'jobs.slug as slug',
					'employers.company',
					'jobs.created_at',
					'locations.name as location_name',
					'job_category.name as category_name',
					'job_category.id as category_id',
					'jobs.created_at as created_at',
					'employers.logo_path as logo'
				)
		);
		$i = 0;
		foreach ($jobs as $job) {

			$job->color_code = $this->colors[$i];
			$job->summary = (strlen($job->summary) > 140) ? substr($job->summary, 0, 140) . '...' : $job->summary;

			$i++;
		}


		return View::make('home.index')->with(array('jobs' => $jobs, 'locations' => $locations, 'categories' => $job_categories, 'work_types' => $work_types));
	}

	public function get_login() {

		return View::make('home.login');
	}

	public function post_login() {

		$username = Input::get('username');
		$password = Input::get('password');

		$user = User::login($username, $password);
		
		
		
		if (!$user) {
			return Redirect::to('login')->with('error', true);
		} else {
			$referer = "";
			if (User::is_in_role('employer', $user)) {
				$employer_id = Employer::where('user_id', '=', $user->id)->first()->id;
				Session::put('employer_id', $employer_id);
				//default if refer is empty
				$referer = '/employer/post/list';
				
			} elseif ( User::is_in_role ('applicant', $user) ) {
				
				$applicant_id = Applicant::where('user_id', '=', $user->id)->first()->id;
				Session::put('applicant_id', $applicant_id);
	
				$referer = "/applicant/account";
			}
			
			if (Session::has('referer')) {
				
				if( !strpos(Session::get('referer'), "login") ) {
					$referer = Session::get('referer');
				} 				
			} 
			
			
			return Redirect::to( $this->_cleanReturnUrl($referer) );
		}
		
	}

	public function get_logout() {
		if (Auth::check()) {
			
			$is_employer = Auth::user()->is_in_role('employer', Auth::user());			
			Auth::logout();
			Session::flush();
			
			if($is_employer) {
				return Redirect::to('/employer');
			}
			else {
				return Redirect::to('/');
			}
			
		}
		
		return Redirect::to('/');
	}
	
	public function get_resetpassword() {
		return View::make('home.resetpassword');
	}
	
	public function post_resetpassword() {
		
		
		if( !Input::get('email')) {
			return false;			
		}
		//will only have one
		$user = User::where('email', '=', Input::get('email'))->first();
			
		
		if( $user ) {
			$password = Generator::generatePassword();
			$user->password = Hash::make($password);
			$user->save();
		}
		
		
		$mail = new CHMailer();
		$mail->IsHTML(true);
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
		
		$mail->Subject = "Password Reset Request.";
		$mail->Body = View::make('email.master')->with('email_body', "Your password has been reset. Your new password is " . $password . '.')->render();
	    $mail->AddAddress($user->email);
		$mail->From = ACCOUNT_EMAIL;
		$mail->FromName = COMPANY_NAME;
		$mail->send();
		
		return Redirect::to('resetpassword')->with('success', true);
		
	}
	
	protected function get_page($title = null) {
		
		if (!$title) {
			return;
		}
		
		//get the page from database and display.
		//together with template;
		//
		echo 'content';
		//page title
	}

}