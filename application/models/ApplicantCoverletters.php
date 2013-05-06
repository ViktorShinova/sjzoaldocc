<?php 

class ApplicantCoverletters extends Eloquent {
	
	public static $table = "applicant_coverletters";

	public function applicant()
	{
		return $this->belongs_to('Applicant');
	}
	
}