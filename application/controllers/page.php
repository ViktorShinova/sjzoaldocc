<?php

class Page_Controller extends Base_Controller {
	
	
	public function get_page($slug = null) {
		
		if( !$slug ) {
			return Response::error('404');
		}
		
		$page = Page::where('slug', '=', $slug)->first();
		
		
		return View::make('page.page')
				->with('html', $page->html);
		
	}
	
}
