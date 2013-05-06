<?php

class DBObject {
	
	protected $_db = null;
	
	public function __construct($connection, $user, $password) {
		$this->initializeDatabaseConnection($connection, $user, $password);
	}
	
	public function initializeDatabaseConnection($connection,  $user, $password) {
		try {
			$this->_db = new PDO($connection, $user, $password);
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch ( Exception $e ) {
			
		}
		
		return true;
	}
	
	
	public function dbExec($query, $params) {
		// Ensure we have a database connection
		if ( !$this->_dbConnectionAvailable() ) {
			//throw new SystemException('No database connection available.', 0);
		}
		
		// Execute the query and return the number of affected rows
		try {
			
			$stmt = $this->_db->prepare($query);
						
			$affected = $stmt->execute($params);
			return $affected;
		} catch ( Exception $e ) {
			echo $e->getMessage();
		}
		
		
	}
	
	
	public function dbQuery($query, $single = false) {
		// Ensure we have a database connection
		if ( !$this->_dbConnectionAvailable() ) {
			//throw new SystemException('No database connection available.', 0);
		}
		
		// Decide what call to make to send data back in
		if ( !$single ) {
			$fetch_mode = 'fetchAll';
		} else {
			$fetch_mode = 'fetch';
		}
		
		// Try our query - return an associative array as a data set and automagically
		// fetch the data for return
		try {
			$result = $this->_db->query($query, PDO::FETCH_ASSOC)->{$fetch_mode}();
		} catch ( Exception $e ) {
			var_dump($e->getMessage());die();
		}
		
		return $result;
	}
	
	protected function _dbConnectionAvailable() {
		return (bool)$this->_db;
	}
}