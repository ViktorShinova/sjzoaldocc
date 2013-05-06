<?php

class Transaction extends Eloquent {
	public static $table = "transactions";
 	public static $timestamps = true;
	
	public function job () {
		return $this->belongs_to('Job');
	}
	
	public function employer() {
		return $this->belongs_to('Employer');
	}
}