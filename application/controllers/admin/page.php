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
require_once('dashboard.php');
class Admin_Page_Controller extends Base_Controller {
	//put your code here
	
	public function __construct() {

		parent::__construct();
		
		$this->filter('before', 'auth')->only(
				array('index')
		);

		$this->filter('before', 'administrator')->only(
				array('index')
		);
	}
	
	
	public function get_index() {
		return View::make('admin.page');
	}
	
	public function post_index() {
		
		$page = new Page();
		
		$page->title = Input::get('title');
		$page->slug = Page::slugify(Input::get('title'));
		$page->content = Input::get('content');
		
		$page->save();
		
		return Redirect::to('/admin/page/list');
		
	}
	
	public function get_list() {
		
		$pages = Page::all();
		
		return View::make('admin.page_list')
				->with('pages', $pages);
		
	}
	
	public function get_edit($id = null) {
		
		$page = Page::find($id);
		
		return View::make('admin.page_edit')
				->with('page', $page);
		
	}
	
	public function post_edit($id = null) {
		$page = Page::find($id);
		
		$page->title = Input::get('title');
		
		$page->content = Input::get('content');
		
		$page->save();
		
		return Redirect::to('/admin/page/list');
	}
}
