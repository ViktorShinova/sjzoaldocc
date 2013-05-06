<?php 

class ApplicantResumes extends Eloquent {
	
	public static $table = "applicant_resumes";

	public function applicant()
	{
		return $this->belongs_to('Applicant');
	}
	
}