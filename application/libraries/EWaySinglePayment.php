<?php

class EWaySinglePayment {

	//Variables
	protected $_db = null;
	protected $_order_total = '';
	protected $_eway_customer_id = 87654321;
	protected $_eway_request = null;
	protected $_eway_response = null;
	protected $_eway_trxn = null;
	protected $_eway_trxn_error = null;
	protected $_eway_trxn_status = null;
	protected $_curl_error = '';
	protected $_curl_error_num = 0;
	protected $_process_time = 0;
	protected $_processed = false;
	public static $GATEWAY_TEST = 'https://www.eway.com.au/gateway_cvn/xmltest/testpage.asp';
	public static $GATEWAY_LIVE = 'https://www.eway.com.au/gateway_cvn/xmlpayment.asp';

	protected $_payment_id = 0;
	
//Customer Info       
	protected $_customer_reference = '';
	protected $_customer_title = '';
	protected $_customer_fname = '';
	protected $_customer_sname = '';
	protected $_customer_company = '';
	protected $_customer_job = '';
	protected $_customer_email = '';
	protected $_customer_address = '';
	protected $_customer_suburb = '';
	protected $_customer_state = '';
	protected $_customer_postcode = '';
	protected $_customer_country = '';
	protected $_customer_phone = '';
	protected $_customer_mobile = '';
	protected $_customer_fax = '';
	protected $_customer_url = '';
	protected $_customer_comments = '';
	protected $_customer_entity = '';
	
	protected $_employer_id = '';
	protected $_job_id = '';
	
	
	protected $_order_reference = '';
	protected $_order_desc = '';
	protected $_order_txid = '';
	
	protected $_cc_name = '';
	protected $_cc_number = '';
	protected $_cc_month = '';
	protected $_cc_year = '';
	protected $_cc_cvn = '';
	
	protected $_payment_type = '';
	
	//Setter
	public function setOrderTotal($total) { $this->_order_total = $total; return true; }
	public function setCustomerReference($refid) {		$this->_customer_reference = $refid;		return true;	}
	public function setCustomerTitle($title) {			$this->_customer_title = $title;			return true;	}
	public function setCustomerFirstName($name) {		$this->_customer_fname = $name;				return true;	}
	public function setCustomerSurname($name) {			$this->_customer_sname = $name;				return true;	}
	public function setCustomerCompany($company) {		$this->_customer_company = $company;		return true;	}
	public function setCustomerJob($job) {				$this->_customer_job = $job;				return true;	}
	public function setCustomerEmail($email) {			$this->_customer_email = $email;			return true;	}
	public function setCustomerAddress($address) { 		$this->_customer_address = $address;		return true;	}
	public function setCustomerSuburb($suburb) {		$this->_customer_suburb = $suburb;			return true;	}
	public function setCustomerState($state) {			$this->_customer_state = $state;			return true;	}
	public function setCustomerPostcode($pcode) {		$this->_customer_postcode = $pcode;			return true;	}
	public function setCustomerCountry($country) {		$this->_customer_country = $country;		return true;	}
	public function setCustomerPhone($phone) {			$this->_customer_phone = $phone;			return true;	}
	public function setCustomerMobile($mobile) {		$this->_customer_mobile = $mobile;			return true;	}
	public function setCustomerFax($fax) {				$this->_customer_fax = $fax;				return true;	}
	public function setCustomerURL($url) {				$this->_customer_url = $url;				return true;	}
	public function setCustomerComments($comments) {	$this->_customer_comments = $comments;		return true;	}
	public function setCustomerEntity($entity) {		$this->_customer_entity = $entity;			return true;	}
	public function setEmployerID($employer_id) {		$this->_employer_id = $employer_id;			return true;	}
	public function set_jobId($job_id) {				$this->_job_id = $job_id;					return true;	}
	public function setOrderDescription($desc) {		$this->_order_desc = $desc;					return true;	}
	public function setOrderReference($refid) {			$this->_order_reference = $refid;			return true;	}
	public function setOrderTXID($txid) {				$this->_order_txid = $txid;					return true;	}
	
	public function setCCName($name) {					$this->_cc_name = $name;					return true;	}
	public function setCCNumber($number) {				$this->_cc_number = $number;				return true;	}
	public function setCCExpMonth($month) {				$this->_cc_month = (int)$month;				return true;	}
	public function setCCCVN($cvn) {					$this->_cc_cvn = $cvn;						return true;	}
	public function setPaymentType($type) {				$this->_payment_type = $type;				return true;	}
	
	//Getters
	public function getEWayTXError() {				return $this->_eway_trxn_error;		}
	
	
	
	public function __construct() {
		$this->_db = new DBObject(DATABASE_CONNECTION, DATABASE_USER, DATABASE_PWD);
		$this->_eway_gateway = self::$GATEWAY_LIVE;
	}
	
	public function setTestMode($test) {
		$this->_eway_gateway = ((bool)$test) ? self::$GATEWAY_TEST : self::$GATEWAY_LIVE;
		return true;
	}
	
	
	public function setCCExpYear($year) {
		if ( $year >= 100 ) {
			$this->_cc_year = (int)substr($year, strlen($year) - 2, 2);
		} else {
			$this->_cc_year = (int)$year;
		}
		
		return true;
	}
	
	public function process() {
		$this->_process_time = time();

		// Should do some var checking here
		if (!$this->_processed) {
			$this->_eway_request = $this->generateRequest();
			$ch = curl_init($this->_eway_gateway);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_eway_request);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			$this->_eway_response = curl_exec($ch);

			if (curl_errno($ch) == CURLE_OK) {
				$this->_curl_error_num = curl_errno($ch);
				$this->_curl_error = curl_error($ch);

				// Parse the response
				preg_match_all('/\<([^\/\>]*)\/?\>(.*?)<\/\\1\>/si', $this->_eway_response, $matches, PREG_SET_ORDER);
				preg_match_all('/\<([^\/\>]*)\/?\>(.*?)<\/\\1\>/si', $matches[0][2], $matches, PREG_SET_ORDER);

				if (is_array($matches)) {
					foreach ($matches as $num => $data) {
						$response_parsed[$data[1]] = $data[2];
					}
				}
				
			
				// Store result data
				$this->_eway_trxn = $response_parsed['ewayTrxnNumber'];
				$this->_eway_trxn_status = (strtolower($response_parsed['ewayTrxnStatus']) == 'true') ? 'APPROVED' : 'DECLINED';
				$this->_eway_trxn_error = $response_parsed['ewayTrxnError'];

				// Set our processed flag so we don't redo this transaction
				$this->_processed = true;

				return ( strtolower($response_parsed['ewayTrxnStatus']) === 'true' );
			} else {
				$this->_curl_error_num = curl_errno($ch);
				$this->_curl_error = curl_error($ch);

				return false;
			}
		} else {
			user_error('Transaction ' . $this->_order_reference . ' has already been processed, ignoring.', E_USER_WARNING);
		}

		return false;
	}

	public function save() {
		if ($this->_payment_id) {
			// We don't want to be able to re-save a transaction - it shouldn't be modified for any reason
			return false;
		}
		$query = "	INSERT INTO
						" . TRANSACTION_TABLE . " (
							gateway_txn_status, 
							process_time,
							amount, 
							invoice_desc, 
							invoice_ref,
							processor, 
							processor_txid, 
							processor_msg,
							curl_error_num, 
							curl_error_msg, 
							request_data, 
							response_data,
							title, 
							first_name, 
							surname,
							address, 
							suburb, 
							state, 
							postcode,
							country, 
							phone, 
							cc_name, 
							cc_number,
							ip,
							employer_id,
							job_id,
							payment_type
						)
					VALUES
						(
						
							:status,
							:process_time,
							:amount,
							:invoice_desc,
							:invoice_ref,
							:processor,
							:processor_txid,
							:processor_msg,
							:curl_error_num,
							:curl_error_msg,
							:request_data,
							:response_data,
							:title,
							:first_name,
							:surname,
							:address,
							:surburb,
							:state,
							:postcode,
							:country,
							:phone,
							:cc_name,
							:cc_number,
							:ip,
							:employer_id,
							:job_id,
							:payment_type
						)";
		
						$parameters = array(
							':status' => $this->_eway_trxn_status,
							':process_time' => $this->_process_time,
							':amount' => number_format((float) $this->_order_total, 2, '.', ''),
							':invoice_desc' => $this->_order_desc,
							':invoice_ref' => $this->_order_reference,
							':processor' => "EWay w/ CVN" . (($this->_eway_gateway == self::$GATEWAY_TEST) ? " (Test mode)" : ''),
							':processor_txid' => $this->_eway_trxn,
							':processor_msg' => $this->_eway_trxn_error,
							':curl_error_num' => $this->_curl_error_num,
							':curl_error_msg' => $this->_curl_error,
							':request_data' => $this->generateRequest(true),
							':response_data' => $this->_eway_response,
							':title' => $this->_customer_title,
							':first_name' => $this->_customer_fname,
							':surname' => $this->_customer_sname,
							':address' => $this->_customer_address,
							':surburb' => $this->_customer_suburb,
							':state' => $this->_customer_state,
							':postcode' => $this->_customer_postcode,
							':country' => $this->_customer_country,
							':phone' => $this->_customer_phone,
							':cc_name' => $this->_cc_name,
							':cc_number' => $this->_obfuscate_credit_card($this->_cc_number),
							':ip' => $_SERVER['REMOTE_ADDR'],
							':employer_id' => $this->_employer_id,
							':job_id' => $this->_job_id,
							':payment_type' => $this->_payment_type,
						);

		
		
		
		
		if (!($result = $this->_db->dbExec($query, $parameters))) {
			//$this->throwDBError(__LINE__, __FILE__, __FUNCTION__, __CLASS__, $query, $this->_db->errorMsg());
			return "Error saving transaction log.";
		}

		//$this->_payment_id = $this->_db->insert_id();

		return true;
	}

	/**
	 * Generate EWay request
	 * @param type $mask
	 * @return type
	 */
	public function generateRequest($mask = false) {
		return "<ewaygateway>
	<ewayCustomerID>" . htmlspecialchars($this->_eway_customer_id) . "</ewayCustomerID>
	<ewayTotalAmount>" . round($this->_order_total * 100) . "</ewayTotalAmount>
	<ewayCustomerFirstName>" . htmlspecialchars($this->_customer_fname) . "</ewayCustomerFirstName>
	<ewayCustomerLastName>" . htmlspecialchars($this->_customer_sname) . "</ewayCustomerLastName>
	<ewayCustomerEmail>" . htmlspecialchars($this->_customer_email) . "</ewayCustomerEmail>
	<ewayCustomerAddress>" . htmlspecialchars($this->_customer_address) . "</ewayCustomerAddress>
	<ewayCustomerPostcode>" . htmlspecialchars($this->_customer_postcode) . "</ewayCustomerPostcode>
	<ewayCustomerInvoiceDescription>" . htmlspecialchars($this->_order_desc) . "</ewayCustomerInvoiceDescription>
	<ewayCustomerInvoiceRef>" . htmlspecialchars($this->_order_reference) . "</ewayCustomerInvoiceRef>
	<ewayCardHoldersName>" . htmlspecialchars($this->_cc_name) . "</ewayCardHoldersName>
	<ewayCardNumber>" . htmlspecialchars(($mask) ? substr($this->_cc_number, 0, 4) . 'XXXXXXXX' . substr($this->_cc_number, 12) : $this->_cc_number) . "</ewayCardNumber>
	<ewayCardExpiryMonth>" . htmlspecialchars(str_pad($this->_cc_month, 2, '0', STR_PAD_LEFT)) . "</ewayCardExpiryMonth>
	<ewayCardExpiryYear>" . htmlspecialchars(str_pad($this->_cc_year, 2, '0', STR_PAD_LEFT)) . "</ewayCardExpiryYear>
	" . (($mask) ? '' : "<ewayCVN>" . htmlspecialchars($this->_cc_cvn) . "</ewayCVN>") . "
	<ewayTrxnNumber>" . htmlspecialchars($this->_order_reference) . "</ewayTrxnNumber>
	<ewayOption1></ewayOption1>
	<ewayOption2></ewayOption2>
	<ewayOption3></ewayOption3>
</ewaygateway>";
	}
	
	
	public function generateOrderReference() {
		$query = "	SELECT
					invoice_ref
				FROM
					".TRANSACTION_TABLE."
				WHERE
					invoice_ref LIKE 'CSH-%'
				ORDER BY
					id DESC
				LIMIT
					0, 1
				";
		
		$result = $this->_db->dbQuery($query, true);
				
		
		
		$nextid = str_replace('JACKP-AU-', '', $result['invoice_ref']) + 1;
		//var_dump('CSH-AU-'.str_pad($nextid, 6, '0', STR_PAD_LEFT));
		
		return 'CSH-AU-'.str_pad($nextid, 6, '0', STR_PAD_LEFT);
		
	}
	
	
	private function _obfuscate_credit_card( $num ) {
		if( strlen ($num) < 16 ) {
			return "Invalid Card number. Credit card number is too short";
		}
		else if ( strlen ($num) > 16  ) {
			return "Invalid Card number. Credit card number is too long";
		}
		else {
			return  substr($this->_cc_number, 0, 4).'XXXXXXXX'.substr($this->_cc_number, 12);
		}
		
	}
	

}