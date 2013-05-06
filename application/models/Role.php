<?php

class Role extends Eloquent {
	public static $table = "roles";

	public function user(){
		return $this->has_many('User');
	}
}