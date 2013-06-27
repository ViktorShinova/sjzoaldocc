<?php

class Blurb extends Eloquent {
	
	public static $table = "blurbs";
	
	public function page(){
		return $this->belongs_to('Page');
	}
}