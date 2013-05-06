<?php 

class ApplicantQualifications extends Eloquent {
	
	public static $table = "applicant_qualifications";

	public function applicant()
	{
		return $this->belongs_to('Applicant');
	}
	
}