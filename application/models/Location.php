<?php

class Location extends Eloquent {
	
	public static $table = "locations";

	public function sub_locations(){
		return $this->has_many("SubLocation");
	}

}