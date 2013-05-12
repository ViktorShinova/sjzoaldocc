<?php

class Employer_Payment_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				array('index', 'complete', 'cancel', 'confirm', 'submit')
		);

		$this->filter('before', 'employer')->only(
				array('index', 'complete', 'cancel', 'confirm', 'submit')
		);
	}

	public function get_index() {

		if (!Session::has('notice')) {
			return Redirect::to('employer/post/create');
		}

		$price = Price::where('status', '=', 'active')->first();
		$countries = Country::lists('name', 'code');
		return View::make("employer.payment")->with(array('post' => Session::get('notice'), 'price' => $price, 'countries' => $countries));
	}

	public function post_submit() {
		
		$price = Price::where('status', '=', 'active')->first()->price;
		Session::put('price', $price);
		
		if (Session::get('notice') != null) {

			$job_ads = Session::get('notice');
			if (isset($_POST['paypal_submit_x'])) {
				$this->process_payment($job_ads);
			} else {
				//Credit card payment
				
		
				$payment = new EWaySinglePayment();
				$payment->setTestMode(true);
				$payment->setCustomerFirstName($_POST['bill_fname']);
				$payment->setCustomerSurname($_POST['bill_lname']);
				
				$payment->setCustomerPhone($_POST['bill_contact']);
				$payment->setCustomerAddress($_POST['bill_address'] . $_POST['bill_address2']);
				$payment->setCustomerSuburb($_POST['bill_suburb']);
				$payment->setCustomerState($_POST['bill_state']);
				$payment->setCustomerCountry($_POST['bill_country']);
				
				$payment->setCCName($_POST['cc_name']);
				$payment->setCCNumber($_POST['cc_num']);
				$payment->setCCCVN($_POST['cc_cvn']);
				$payment->setCCExpMonth($_POST['cc_month']);
				$payment->setCCExpYear($_POST['cc_year']);
				
				$payment->setOrderTotal($price);
				
				$payment->setOrderDescription($job_ads['title']);
				
				$payment->setOrderReference($payment->generateOrderReference());
				$payment->setOrderTXID($payment->generateOrderReference());
				$payment->setPaymentType(EWAY_TYPE);
				var_dump($payment);
				if( $payment->process() ) {
					$job = $this->_create_job();
					
					$payment->setEmployerID(Session::get('employer_id'));
					$payment->set_jobId($job->id);
					$payment->save();
					
					return Redirect::to('employer/payment/complete');
					
				} else {
					$payment->save();
					die();
				}
			
				
				
				//$payment->
				
				
			}
		} else {
			return "Session has time out. Please close this window and try again";
		}
	}

	private function process_payment($job) {

		$paypal = new PayPal();
		$price =Session::get('price');
		
		$paypal->add_items($job['title'], $price, 1);
		$paypal->_set_dg_express_checkout();
	}

	public function get_confirm() {
		//Process paypal
		$paypal = new PayPal();
		$response = $paypal->_do_express_checkout(Input::query('token'));
		$this->_save_transaction($response);
		return View::make('employer.confirmation');
	}

	//This is only for paypal transaciton. Will have to do another one for eway. Will be refactoring this to a class
	private function _save_transaction($paypal_response = null) {

		$job = $this->_create_job();

		//$transaction = new Transaction();

		$transaction_data = array(
			'job_id' => $job->id,
			'employer_id' => Session::get('employer_id'),
		);
		$transaction_data['gateway_txn_id'] = $paypal_response['PAYMENTINFO_0_TRANSACTIONID'];
		$transaction_data['gateway_txn_type'] = $paypal_response['PAYMENTINFO_0_TRANSACTIONTYPE'];
		$transaction_data['gateway_txn_status'] = $paypal_response['PAYMENTINFO_0_PAYMENTSTATUS'];
		$transaction_data['gateway_txn_message'] = $paypal_response['PAYMENTINFO_0_TRANSACTIONID'];
		$transaction_data['local_currency_code'] = $paypal_response['PAYMENTINFO_0_CURRENCYCODE'];
		$transaction_data['gateway_pending_reason'] = $paypal_response['PAYMENTINFO_0_PENDINGREASON'];
		$transaction_data['gateway_fee_amt'] = $paypal_response['PAYMENTINFO_0_FEEAMT'];
		$transaction_data['gateway_tax_amt'] = $paypal_response['PAYMENTINFO_0_TAXAMT'];
		$transaction_data['gateway_error_code'] = $paypal_response['PAYMENTINFO_0_ERRORCODE'];
		$transaction_data['gateway_ack'] = $paypal_response['PAYMENTINFO_0_ACK'];
		$transaction_data['amount'] = $paypal_response['PAYMENTINFO_0_AMT'];
		$transaction_data['gateway_timestamp'] = $paypal_response['TIMESTAMP'];
		$transaction_data['currency_code'] = $paypal_response['PAYMENTINFO_0_CURRENCYCODE'];
		$transaction_data['payment_type'] = PAYPAL_TYPE;

		Transaction::create($transaction_data);
	}

	private function _create_job() {
		$job_ads = Session::get('notice');
		$_job = array(
			'title' => $job_ads['title'],
			'summary' => $job_ads['summary'],
			'description' => $job_ads['desc'],
			'more_info' => $job_ads['more-info'],
			'contact' => $job_ads['contact'],
			'category_id' => $job_ads['job-category'],
			'sub_category_id' => $job_ads['sub-category'],
			'min_salary' => $job_ads['min-salary'],
			'max_salary' => $job_ads['max-salary'],
			'salary_range' => $job_ads['salary-range'],
			'payment_structure' => $job_ads['pay-struct'],
			'work_type' => $job_ads['work-type'],
			'location_id' => $job_ads['job-location'],
			'sub_location_id' => $job_ads['sub-location'],
			'employer_id' => Session::get('employer_id'),
			'template_id' => ( (!empty($job_ads['post-selected-template']) ? $job_ads['post-selected-template'] : 1 ) ),
			'end_at' => date("Y-m-d H:i:s", strtotime("+1 month", strtotime(date('Y-m-d H:i:s')))),
			'status' => 1,
		);
		
		if( isset($job_ads['video'])) {
			$__job['video'] = $job_ads['video'];
		}
		
		if ( isset($job_ads['custom-apply-select']) && $job_ads['custom-apply-select'] === 'Y') {
			$_job['apply'] = $job_ads['custom-apply'];
		} else {
			$_job['apply'] = null;
		}


		$job = Job::create($_job);
		
		return $job;
	}
	
	public function get_complete() {

		if (!Session::has('notice')) {
			return Redirect::to('employer/post/create');
		}

		$post = Session::get('notice');
		$price = Session::get('price');
		//clear the sessions
		Session::forget('notice');
		Session::forget('price');

		return View::make('employer.complete')->with(array('post' => $post, 'price' => $price));
	}

	public function get_cancel() {
		return View::make('employer.cancel');
	}

	public function action_logout() {
		echo "This is the logout action.";
	}

}