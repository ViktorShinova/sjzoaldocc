<?php 

class ApplicantWorkHistory extends Eloquent {
	
	public static $table = "applicant_work_history";

	public function applicant()
	{
		return $this->belongs_to('Applicant');
	}
	
}