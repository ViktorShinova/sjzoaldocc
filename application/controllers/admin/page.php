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
class Admin_Page_Controller extends Base_Controller {
	//put your code here
	
	
	public function get_index() {
		return View::make('admin.page');
	}
	
	public function post_index() {
		
		$page = new Page();
		
		$page->title = Input::get('title');
		
		$page->html = Input::get('html');
		
		$page->save();
		
	}
}
