<?php

class SubLocation extends Eloquent {
	
	public static $table = "sub_locations";

	public function location () {
		return $this->belongs_to("Location");
	}

}