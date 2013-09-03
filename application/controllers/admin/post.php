<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author Damien
 */

class Admin_Post_Controller extends Base_Controller {
	//put your code here
	public function __construct() {

		parent::__construct();
		
		$this->filter('before', 'auth')->only(
				array('list' , 'view', 'verify', 'delete')
		);

		$this->filter('before', 'administrator')->only(
				array('list' , 'view', 'verify', 'delete')
		);
	}
	
	public function get_list() {
		
		$jobs = Job::all();
		
		return View::make('admin.post_list')
				->with('jobs', $jobs);
	}
	
	public function get_view($id = null) {
		
		if (!$id) {
			return false;
		}
		
		$job = Job::find($id);
		
		return View::make('admin.view')->with(array(
					'job' => $job,
		));
	}
	
	public function get_verify($id = null, $status = null) {
		
		if (!$id) {
			return false;
		}
		$job = Job::find($id);
		
		$job->verify = $status;
		$job->save();
		
		return Redirect::to('admin/post/list');

	}
	
	public function get_delete( $id = null) {
		if (!$id) {
			return false;
		}
		$job = Job::find($id);
		$job->delete();
		
		return Redirect::to('admin/post/list');
	}
}
