<?php 

class Employer extends Eloquent {
	
	public static $table = "employers";
 	public static $timestamps = true;
	public function jobs()
	{
		return $this->belongs_to('Employer');
	}
	
}