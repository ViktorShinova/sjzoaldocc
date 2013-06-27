<?php

class Page extends Eloquent {
	
	public static $table = "pages";
	
	public function blurbs() {
		return $this->has_many('blurbs');
	}
}