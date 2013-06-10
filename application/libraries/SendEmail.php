<?php

class SendEmail {

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
		$this->_mail = new PHPMailer();
		/** mail configurations **/
		if (strpos($_SERVER['HTTP_HOST'], '.localhost')) {
			$this->_mail->isSMTP();
			$this->_mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
			$this->_mail->SMTPAuth = true;  // authentication enabled
			$this->_mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$this->_mail->Host = SMTP;
			$this->_mail->Port = 465;
			$this->_mail->Username = SMTP_USERNAME;
			$this->_mail->Password = SMTP_PASSWORD;
		}
	}
	
	//SETTERS
	protected function setData( $data )			{ $this->_data =		$data; return true; }
	protected function setSubject( $data )		{ $this->_subject =		$data; return true; }
	protected function setTemplate( $data )		{ $this->_template =	$data; return true; }
	protected function setRecipents( $data )	{ $this->_recipients =	$data; return true; }
	protected function setAttachments( $data )	{ $this->_attachments = $data; return true; }
	protected function setCC( $data )			{ $this->_CC =			$data; return true; }
	protected function setBCC( $data )			{ $this->_BCC =			$data; return true; }
	protected function setReplyTo( $data )		{ $this->_reply_to =	$data; return true; }
	
	
	protected function isHTML() {
		$this->_mail->IsHTML(true);
	}
	
	
	
	public function send() {

		/** initialize phpmailer **/
	
		/** mail headers stuff **/
		if ( $mail->_reply_to) {
			
		}
		
		
		$mail->From = COMPANY_EMAIL;
		$mail->FromName = COMPANY_NAME;
		$mail->Subject  = $this->_subject;

		if( $this->_recipients ) {
			
			foreach($this->_recipients as $key => $value ) {
				$mail->AddAddress($value['email'], (isset ($value['name'])? $value['name'] : '' ) );
			}
		}
		if($this->_CC) {
			
			foreach( $this->_CC as $key => $value ) {
				$mail->AddCC($value['email'], (isset ($value['name'])? $value['name'] : '' ) );
			}			
		}
		if($this->_BCC) {
			
			foreach( $this->_BCC as $key => $value) {
				$mail->AddBCC($value['email'], (isset ($value['name'])? $value['name'] : '' ) );
			}
		}

		/** mail attachments **/
		
		foreach( $this->_attachments as $attachment ) {
			//error Value: 0; There is no error, the file uploaded with success.
			//error Value: 4; No file was uploaded.
			if($attachment['error'] == 0) {
				$mail->AddAttachment($attachment['tmp_name'], $attachment['name']);
			}
		}	
		
		if( $this->_template ) {
			$mail->Body = View::make('email.'.$this->_template)->with(array(
							'data' => $this->_data
						));
		} else {
			$mail->Body = $this->_data;
		}
		/** send email **/
		if( !$mail->send() ) { return false;  }
		return true;
	}
	
}