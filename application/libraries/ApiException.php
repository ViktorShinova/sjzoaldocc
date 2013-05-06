<?php
/***************************************************************************
 * lib/ApiException.class.php
 * ---------------
 *   author		-> Damien Koh
 *   started	-> Friday, May 3rd, 2013
 *   modified	-> 
 *   copyright	-> 
 *   email     	-> damien@careershire.com.au
 *
 *
 * dependencies
 * ------------------
 *
 *
 * file description
 * ------------------
 * API Exception implementation
 *
 ***************************************************************************/


abstract class ApiException extends Exception {
	
	                /*--------------------------------------------------------o
	----------------\                        Variables                        |
	    variables    \-------------------------------------------------------*/
	
	protected $_exception_type = 'API Exception';
	
	
	                /*--------------------------------------------------------o
	----------------\                 Constructor / Destructor                |
	     internal    \-------------------------------------------------------*/
	                
	/**
	 * API Exception handling implementation
	 *
	 * @param string $message
	 * @params int $code
	 */
	public function __construct($message = null, $code = 0, $previous = null) {
		parent::__construct($message, $code);
		
		if ( $previous ) {
			parent::__construct($message.' (Chained exception from: '.$previous->getMessage().')', $code);
		} else {
			parent::__construct($message, $code);
		}
	}

	public function __destruct() {
	}
	
	
	                /*--------------------------------------------------------o
	----------------\                     Getter Functions                    |
	     getters     \-------------------------------------------------------*/
	                
	public function getExceptionType() {			return $this->_exception_type;		}
	
	                
	
	                /*--------------------------------------------------------o
	----------------\                     Helper Functions                    |
	     helpers     \-------------------------------------------------------*/
	
	/**
	 * Generate an exception error report to be mailed / logged
	 *
	 * @return string
	 */
	public function generateReport($inject_data = '') {
		// Generate our mail body
		$from = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'CLI';

		$body  = $this->getExceptionType()." encountered on ".date("g:ia d/m/Y")." from $from\n--------------------\n\n";
		
		$body .= "Environment: ".System::getEnvironmentName()."\n";
		$body .= "Encountered In: ".$this->getFile()."\n";
		$body .= "Line: ".$this->getLine()."\n";
		$body .= "Error Message: [".$this->getCode()."] ".$this->getMessage()."\n\n";
		
		$body .= $inject_data;
		
		$body .= "Backtrace Overview:\n".$this->getTraceAsString()."\n\n";
		$body .= "--------------------\n\n";
		
		$body .= "Full Backtrace:\n\n".print_r($this->getTrace(), true)."\n\n";
		$body .= "--------------------\n\n";

		return $body;
	}
	
	/**
	 * Magic!
	 *
	 * @return string
	 */
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
	
}	

