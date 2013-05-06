<?php 

class SubCategory extends Eloquent {
	
	public static $table = "job_sub_category";

	public function jobs()
	{
		return $this->belongs_to('Category');
	}
	
}