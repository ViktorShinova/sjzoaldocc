<?php
/***************************************************************************
 * lib/SystemException.class.php
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

class SystemException extends ApiException {
	
	                /*--------------------------------------------------------o
	----------------\                        Variables                        |
	    variables    \-------------------------------------------------------*/
	                
	protected $_exception_type = 'System Exception';
	
	
	
	
	                /*--------------------------------------------------------o
	----------------\                 Constructor / Destructor                |
	     internal    \-------------------------------------------------------*/
	                
	/**
	 * API System exception handling
	 *
	 * @param string $message		Error code message
	 * @param int $code				Error code number
	 * @param Exception $previous	Previous exception for exception chaining
	 */
	public function __construct($message = '', $code = 0, Exception $previous = null) {
		parent::__construct($message, $code, $previous);
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
	
	
	                /*--------------------------------------------------------o
	----------------\                     Setter Functions                    |
	     setters     \-------------------------------------------------------*/
	                
	                
	                
	                
	                /*--------------------------------------------------------o
	----------------\                     Getter Functions                    |
	     getters     \-------------------------------------------------------*/
	
	
	                
	                
	                /*--------------------------------------------------------o
	----------------\                     Error Reporting                     |
	     logging     \-------------------------------------------------------*/
	
	
}

