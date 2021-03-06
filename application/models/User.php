<?php

class User extends Eloquent {
	public static $table = "users";
	public static $timestamps = true;
	public function role(){
		return $this->belongs_to('Role');
	}

	public static function is_in_role($role, $user) {
		$valid = false;
		$roles = !is_array($role)? array($role) : $role;

		foreach($roles as $role) {
			if($user->role->name === $role) {
				$valid = true;
			}
		}

		return $valid;
	}

	public function generate_password( $password ) {
		return Hash::make($password);
	}

	public static function login( $username, $password ) {
		$credentials = array('username' => $username, 'password' => $password);

		if (Auth::attempt( $credentials ) ) {
			return Auth::user();
		}
		else
		{
			return null;
		}
	}
	
	public static function is_applicant() {
		
		if( Auth::check() && Auth::user()->role_id == '2' ) {
			return true;
		}
		return false;
		
	}
	
	public static function is_employer() {
		
		if( Auth::check() && Auth::user()->role_id == '1' ) {
			return true;
		}
		return false;
		
	}
	
	public function employer() {
		
		return $this->has_one('Employer');
		
	}
	
	public function applicant() {
		
		return $this->has_one('Applicant');
		
	}
	
	
	public static function transfer($user) {
		
		$follow_referer = true;
		if (User::is_in_role('employer', $user)) {
			$employer_id = Employer::where('user_id', '=', $user->id)->first()->id;
			Session::put('employer_id', $employer_id);
			//default if refer is empty
			$referer = '/employer/post/list';

		} elseif ( User::is_in_role ('applicant', $user) ) {

			$applicant_id = Applicant::where('user_id', '=', $user->id)->first()->id;
			Session::put('applicant_id', $applicant_id);

			$referer = "/applicant/account";
		} elseif( User::is_in_role('administrator', $user)) {
			$referer = "/admin/dashboard/";
			$follow_referer = false;
			
		}
		
		if (Session::has('referer') && !Session::get('impersonate') && $follow_referer) {

			if( !strpos(Session::get('referer'), "login") ) {
				$referer = Session::get('referer');
			} 				
		} 


		return $referer;
		
	}
}