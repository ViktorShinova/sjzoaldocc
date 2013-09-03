<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Damien
 */
class Admin_User_Controller extends Base_Controller {
	
	protected $_secure_pages = array('list' , 'login', 'detail');
	public function __construct() {

		parent::__construct();
		
		$this->filter('before', 'auth')->only(
				$this->_secure_pages
		);

		$this->filter('before', 'administrator')->only(
				$this->_secure_pages
		);
	}
	
	public function get_list() {
		
		$users = User::all();
		
		return View::make('admin.users')
				->with('users', $users);
		
	}
	
	public function get_login($id = null) {
		
		if( !$id ) {
			return false;
		}
		
		$user = User::find($id);
		if( !$user) {
			return false;
		}
		
		//impersonate the user
		$user = Session::get('user');
		Session::put('impersonate', true);
		Session::put('admin_id', $user->id);
		Auth::login($id);
		
		$referer = User::transfer(Auth::user());
		
		
		return Redirect::to($referer);
		
	}
	
	public function get_detail($id = null) {
		if( !$id ) {
			return false;
		}
		
		$user = User::find($id);
		
		return View::make('admin.user-detail')
				->with('user', $user);
	}
	
}