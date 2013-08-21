<?php

class CHMailer extends PHPMailer {

	protected $_data;
	protected $_subject;
	protected $_template;
	protected $_recipients;
	protected $_attachments;
	protected $_CC;
	protected $_BCC;
	protected $_reply_to;
	
	protected $_mail = null;

	public function __construct() {
		
		/** mail configurations **/
		if (strpos($_SERVER['HTTP_HOST'], '.localhost')) {
			$this->isSMTP();
			$this->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
			$this->SMTPAuth = true;  // authentication enabled
			$this->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$this->Host = SMTP;
			$this->Port = 465;
			$this->Username = SMTP_USERNAME;
			$this->Password = SMTP_PASSWORD;
			$this->IsHTML();
		}
	}
}