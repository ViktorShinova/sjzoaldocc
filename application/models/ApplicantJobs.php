<?php 

class ApplicantJobs extends Eloquent {
	
	public static $table = "applicant_job";

	public function applicant()
	{
		return $this->belongs_to('Applicant');
	}
	
	public function coverletter() {
		
		return $this->belongs_to('ApplicantCoverletters', 'applicant_coverletter_id');
	}
	public function resume() {
		
		return $this->belongs_to('ApplicantResumes', 'applicant_resume_id');
	}
}