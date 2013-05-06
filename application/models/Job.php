<?php 

class Job extends Eloquent {
	public static $table = "jobs";
 	public static $timestamps = true;
	public function employer()
	{
		return $this->belongs_to('Employer');
	}

	public function category()
	{
		return $this->belongs_to('Category');
	}

	public function location() 
	{
		return $this->belongs_to('Location');
	}

	public function sub_location() {
		return $this->belongs_to('SubLocation');
	}
	public function template() 
	{
		return $this->belongs_to('Template');
	}
	
	public function applicants() {
		return $this->has_many_and_belongs_to('Applicant')->with(array('status', 'shortlist_category_id'));
	}
	
	public function invoice() {
		return $this->has_one('Transaction');
	}

}