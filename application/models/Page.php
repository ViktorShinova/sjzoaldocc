<?php

class Page extends Eloquent {
	
	public static $table = "pages";
	
	public static function slugify($title) {
		$title = strtolower($title);
		$slug =  preg_replace("/[^a-zA-Z 0-9]+/", "", $title);
		$slug =  str_replace(' ', '_', $slug);
		
		$count = Page::where('slug', 'LIKE' , "%$slug%")->count();
		
		if( $count != 0) {
			$count = $count + 1;
			
			$slug = $slug . '_' . $count;
			return $slug;
		}
		
		return $slug;
	}
}