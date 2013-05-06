<?php 

class WorkType extends Eloquent {
	
	public static $table = "work_type";

	public function jobs()
	{
		return $this->has_many('Job');
	}
	
}