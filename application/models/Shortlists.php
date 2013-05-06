<?php

class Shortlists extends Eloquent {
	
	public static $table = "shortlists";

	public function applicant()
	{
		return $this->belongs_to('Applicant');
	}

	public function job()
	{
		return $this->belongs_to('Job');
	}
	
}