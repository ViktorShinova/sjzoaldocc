<?php 

class ApplicantJobs extends Eloquent {
	
	public static $table = "applicant_job";

	public function applicant()
	{
		return $this->belongs_to('Applicant');
	}
	
}