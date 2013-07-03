<?php

class Page_Controller extends Base_Controller {

	public function get_page($slug = null) {

		if (!$slug) {
			return Response::error('404');
		}

		$page = Page::where('slug', '=', $slug)->first();

		if (!$page) {
			return Response::error('404');
		}

		return View::make('page.page')
						->with('content', $page->content);
	}

}
