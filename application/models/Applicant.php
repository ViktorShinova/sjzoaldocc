<?php

class Applicant extends Eloquent {

	public static $table = "applicants";
 	public static $timestamps = true;

	public function qualifications()
	{
		return $this->has_many('ApplicantQualifications');
	}	

	public function resumes()
	{
		return $this->has_many('ApplicantResumes');
	}

	public function coverletters()
	{
		return $this->has_many('ApplicantCoverletters');
	}

	public function work_histories()
	{
		return $this->has_many('ApplicantWorkHistory');
	}

	public function shortlistcategory()
	{
		return $this->has_many('ApplicantShortlistCategory');
	}
	
	public function shortlists()
	{
		return $this->has_many_and_belongs_to('ApplicantShortListCategory', 'applicant_job');
	}

	/*public function applicantjobs()
	{
		return $this->has_many_and_belongs_to('ApplicantJobs');
	}*/

	public function jobs() {
		return $this->has_many_and_belongs_to('Job')->with(array('status', 'shortlist_category_id'));
	}
	
	public function user() {
		return $this->belongs_to('User');
	}
}