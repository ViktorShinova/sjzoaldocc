<?php 

class PayPal {
	
	public $payment_option = "PayPal";
	// ==================================
    // PayPal Express Checkout Module
    // ==================================
    //'------------------------------------
    //' The paymentAmount is the total value of 
    //' the purchase.
    //'
    //' TODO: Enter the total Payment Amount within the quotes.
    //' example : $paymentAmount = "15.00";
    //'------------------------------------
	public $payment_amount = '';
	 //'------------------------------------
    //' The currencyCodeType  
    //' is set to the selections made on the Integration Assistant 
    //'------------------------------------
	public $currency_code = "AUD";
	public $payment_type = "Sale";
	//'------------------------------------
    //' The returnURL is the location where buyers return to when a
    //' payment has been succesfully authorized.
    //'
    //' This is set to the value entered on the Integration Assistant 
    //'------------------------------------
	public $return_url = PAYPAL_CONFIRM;
	//'------------------------------------
    //' The cancelURL is the location buyers are sent to when they hit the
    //' cancel button during authorization of payment during the PayPal flow
    //'
    //' This is set to the value entered on the Integration Assistant 
    //'------------------------------------
	public $cancel_url = PAYPAL_CANCEL;
	public $items = array();

	public $final_payment = 0;
	public $payer_id = 0;

	public $PayPalApi = null;

	public function __construct() {
		//Set sandbox to true
		$this->PayPalApi = new PayPalApi(true);
	}

	public function _set_dg_express_checkout() {

		//Total up the amount of all items
		
		foreach($this->items as $item){
			$this->payment_amount += $item['amt'];
		}

		//set the express checkout
		$respArray = $this->PayPalApi->SetExpressCheckoutDG( $this->payment_amount, $this->currency_code, $this->payment_type, 
												$this->return_url, $this->cancel_url, $this->items );
		
		$ack = strtoupper($respArray['ACK']);

		if($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING")
        {
                $token = urldecode( $respArray["TOKEN"] );
                $this->PayPalApi->RedirectToPayPalDG( $token );
        }
        else  
        {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
                
                echo "SetExpressCheckout API call failed. ";
                echo "Detailed Error Message: " . $ErrorLongMsg;
                echo "Short Error Message: " . $ErrorShortMsg;
                echo "Error Code: " . $ErrorCode;
                echo "Error Severity Code: " . $ErrorSeverityCode;
        }
	}

	public function add_items( $name, $amount, $quantity ) {
		$this->items[] = array('name' => $name, 'amt' => $amount, 'qty' => 1);
	}


	public function _do_express_checkout ( $token ) {

		
		$res = $this->PayPalApi->GetExpressCheckoutDetails( $token );
		/*
		 '------------------------------------
		 ' The paymentAmount is the total value of
		 ' the purchase. 
		 '------------------------------------
		 */
		
		$this->final_payment = $res['AMT'];
		$this->payer_id = $res['PAYERID'];
		$this->currency_code = $res['CURRENCYCODE'];

		$response = $this->PayPalApi->ConfirmPayment ( $token, $this->payment_type, $this->currency_code ,$this->payer_id, $this->final_payment );
		$ack = strtoupper($response["ACK"]);

		if( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" )
		{
			
			return $response;
		}
		else {
			
			return null;
		}
	}
	

}


		
