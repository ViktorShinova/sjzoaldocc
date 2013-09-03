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
class Admin_Dashboard_Controller extends Base_Controller {
	//put your code here
	
	public function __construct() {

		parent::__construct();

	}
	public function get_index() {
		return View::make('admin.dashboard');
	}
}
