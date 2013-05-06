<?php 

class Template extends Eloquent {
	public static $table = "templates";
 	public static $timestamps = true;
	
	public function jobs(){
		return $this->has_many('Job');
	}
}