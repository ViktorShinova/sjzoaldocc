<?php

class SendEmail {

	private $email_data;
	private $email_subject;
	private $email_template;
	private $email_recipients;
	private $email_attachments;
	private $email_recipients_CC;
	private $email_recipients_BCC;
	private $email_from_applicant;

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
		return $this;
	}

	public function send() {

		/** initialize phpmailer **/
		$mail = new PHPMailer();

		/** mail configurations **/
		if (strpos($_SERVER['HTTP_HOST'], '.localhost')) {
			$mail->isSMTP();
			$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true;  // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = SMTP;
			$mail->Port = 465;
			$mail->Username = SMTP_USERNAME;
			$mail->Password = SMTP_PASSWORD;
		}
		$mail->IsHTML(true);

		/** mail headers stuff **/
		$mail->AddReplyTo($this->email_from_applicant);
		$mail->From = COMPANY_EMAIL;
		$mail->FromName = COMPANY_NAME;
		$mail->Subject  = $this->email_subject;

		if(isset($this->email_recipients)) {
			
			foreach($this->email_recipients as $email => $name) {
				$mail->AddAddress($email, $name);
			}
		}
		if(isset($this->email_recipients_CC)) {
			
			foreach( $this->email_recipients_CC as $email => $name ) {
				$mail->AddCC($email, $name);
			}			
		}
		if(isset($this->email_recipients_BCC)) {
			
			foreach( $this->email_recipients_BCC as $email => $name) {
				$mail->AddBCC($email, $name);
			}
		}

		/** mail attachments **/
		
		foreach( $this->email_attachments as $attachment ) {
			//error Value: 0; There is no error, the file uploaded with success.
			//error Value: 4; No file was uploaded.
			if($attachment['error'] == 0) {
				$mail->AddAttachment($attachment['tmp_name'], $attachment['name']);
			}
		}	

		$mail->Body = View::make('email.'.$this->email_template)->with(array(
							'data' => $this->email_data
						));


		/** send email **/
		if( !$mail->send() ) { return false;  }
		return true;
	}

}