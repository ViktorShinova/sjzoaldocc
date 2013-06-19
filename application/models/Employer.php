<?php 

class Employer extends Eloquent {
	
	public static $table = "employers";
 	public static $timestamps = true;
	public function jobs()
	{
		return $this->belongs_to('Employer');
	}

	public function industry() {
		return $this->belongs_to('Category');
	}
	
}