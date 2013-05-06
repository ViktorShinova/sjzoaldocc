<?php


class Category extends Eloquent {
	
	public static $table = "job_category";

	public function subCategory() 
	{
		return $this->has_many('SubCategory');
	}
}