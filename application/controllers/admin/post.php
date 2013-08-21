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
	
	public function get_list() {
		
		$jobs = Job::where('verify', '=', 0)->get();
		
		return View::make('admin.post_list')
				->with('jobs', $jobs);
	}
}
