<?php 

class ApplicantShortlistCategory extends Eloquent {
	
	public static $table = "shortlist_category";
	public static $timestamps = false;
	
	public function applicant()
	{
		$this->has_many_and_belongs_to('Applicant', 'applicant_job');
	}
}