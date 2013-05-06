<?php
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}
// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
//$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);


// assign posted variables to local variables
$invoice = $_POST['invoice'];
$txn_id = $_POST['txn_id'];
$txn_type = $_POST['txn_type'];
$payment_date = $_POST['payment_date'];
$payment_status = $_POST['payment_status'];
$payer_status = $_POST['payer_status'];
$payment_type = $_POST['payment_type'];
$payer_id = $_POST['payer_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$payer_email = $_POST['payer_email'];
$contact_phone = $_POST['contact_phone'];
$address_status = $_POST['address_status'];
$address_name = $_POST['address_name'];
$residence_country = $_POST['residence_country'];
$address_country = $_POST['address_country'];
$address_country_code = $_POST['address_country_code'];
$address_state = $_POST['address_state'];
$address_street = $_POST['address_street'];
$address_city = $_POST['address_city'];
$address_zip = $_POST['address_zip'];
$num_cart_items = $_POST['num_cart_items'];
$mc_currency = $_POST['mc_currency'];
$mc_shipping = $_POST['mc_shipping'];
$mc_handling = $_POST['mc_handling'];
$mc_gross = $_POST['mc_gross'];
$mc_fee = $_POST['mc_fee'];
$net_sale = $mc_gross - $mc_fee;
$ipn_track_id = $_POST['ipn_track_id'];
$verify_sign = $_POST['verify_sign'];
$custom = $_POST['custom'];
$payer_name = $_POST['first_name'].' '.$_POST['last_name'];

if (!$fp) {
// HTTP ERROR
} 
else {
fputs ($fp, $header . $req);
	while (!feof($fp)) {
		$res = fgets ($fp, 1024);

			/***********************
			CHECK FOR PRODUCT PRICE IF MATCH
			
			if (strcmp($paypalValue, $databaseValue) != 0){
				$res = "INVALID";
			}
			else{
				$res = "VERIFIED";
			}
			************************/

	
			if (strcmp ($res, "VERIFIED") == 0) { // PAYMENT VALIDATED & VERIFIED!
				
					for($i=1; $i<=$num_cart_items; $i++){
						$items_name .=  $_POST['item_name'.$i.''].', ';
						$items_number .= $_POST['item_number'.$i.''].', ';
						$quantity .=  $_POST['quantity'.$i.''].', ';
						$mc_gross_x .= 	$_POST['mc_gross_'.$i.''].', ';
						//$custom .= 	$_POST['custom'].', ';	
					}//End for loop
					$custom  = 	$_POST['custom'];
					$totalItems = $num_cart_items;
					
					$itemNumber = explode(",", $items_number);
					array_pop($itemNumber);
					
					$itemDetail = explode(",", $items_name);
					array_pop($itemDetail);
					
					$itemQty = explode(",", $quantity);
					array_pop($itemQty);
					
					$itemTotalPrice = explode(",", $mc_gross_x);
					array_pop($itemTotalPrice);
					
					$itemImage = explode(",", $custom);
					end($itemImage);
					prev($itemImage);
					$memberEmail = prev($itemImage);	
					array_pop($itemImage);
					
					$paymentType = ($payment_type != "Bank Transfer") ? "Paypal ($payment_type)" : "Bank Transfer";
					$paypalFee = ($mc_fee == NULL) ? "$0.00" : '$'.$mc_fee;

					if($payment_status == "Awaiting Payment Transaction Details"){
						$paymentStatus =  'Awaiting Payment Transaction Details'; 
					} else if($payment_status == "Pending" || $payment_status == "Processing Payment"){
						 $paymentStatus = 'Processing Payment'; 
						} else if($payment_status == "Completed" || $payment_status == "Processing Order") {
							  $paymentStatus = 'Processing Order';
							} else if($payment_status == "Shipped"){
								 $paymentStatus = 'Shipped';  
								}else if($payment_status == "Denied" || $payment_status == "Cancelled"){
									 $paymentStatus = 'Cancelled';
									}


					if($mc_handling == "5.50"){
						$shippingMethod = 'AUS Standard'; 
					} else if($mc_handling == "18"){
						 $shippingMethod = 'AUS Express'; 
						} else if($mc_handling == "20") {
							  $shippingMethod = 'International Standard';
							} else if($mc_handling == "45"){
								 $shippingMethod = 'International Express';  
								}else if($mc_handling == "0"){
								 $shippingMethod = 'Free Shipping (Promo)';  
								}

				  /*if($payment_status == "Shipped" && $tracking_order_no != NULL){
					$trackFormBtn = '<form id="trackForm" action="http://auspost.com.au/track/track.html" method="post">
						  <input type="submit" value="Track This Order">
						  <input type="hidden" id="trackIds" name="trackIds" value="'.$row_rsInvoice['tracking_order_no'].'">
						  </form>'; 
				  }*/					
				  
					$to      = $memberEmail;
					$subject = 'Your Order Has Been Received (#'.$invoice.')';

		  
					for($i=0; $i<=$totalItems-1; $i++){
						$itemName = explode("|", $itemDetail[$i]);
						$itemSize = explode("|", $itemDetail[$i]);
						$totalQty += $itemQty[$i];
						$itemPrice[$i] = $itemTotalPrice[$i]/$itemQty[$i];
						
						$itemsTR .= '            
						<tr> 
                <td align="left" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: left;">'.$itemName[0].'</td> 
                <td rowspan="2" align="center" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: center;">'.$itemSize[1].'</td> 
                <td rowspan="2" align="center" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: center;">'.$itemQty[$i].'</td> 
                <td rowspan="2" align="right" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: right;">AU $'.ltrim($itemTotalPrice[$i]).'</td> 
            </tr> 
            <tr> 
              <td style="color: #B9B9B9; font-size: 10px; font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; margin: 0; padding: 0;"> 
                Product Code # '.$itemNumber[$i].'<br />  
              </td> 
            </tr> 
            <tr> 
              <td style="height: 10px;" colspan="4">&nbsp;</td> 
            </tr> ';
						
					} //end for loop
		if($first_name == ""){
			$printName = $memberEmail; 
		} else{
			$printName = $first_name;
		}	
$message = '<table width="640" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr><td align="center" style="padding: 30px 0px 20px; text-align: center;"><a href="http://www.kingdommade.com.au" target="_blank"><img src="http://kingdommade.com.au/images/mailer/headerlogo.gif" alt="Kingdom Made - KingdomMade.com.au" width="250px" height="109px" border="0" /></a></td></tr>
  <tr><td><hr style="background-color: #E8E8E8; margin: 5px 0; height: 1px; width: 100%; border: 0px; clear: both;" />
<div align="center" style="color: #777777; font-size: 10px; font-family: Arial, Helvetica, sans-serif; text-align: center;">Be sure to add Kingdom Made [ <a href="mailto:orderstatus@kingdommade.com.au" target="_blank" style="color: #3b5998; text-decoration: none !important;"><u>orderstatus@kingdommade.com.au</u></a> ] to your address book or safe list.<br>* This inbox is unattended, so please do not reply to this email.</div>
<hr style="background-color: #E8E8E8; margin: 5px 0; height: 1px; width: 100%; border: 0px; clear: both;" /></td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td width="640"><p style="font-size: 12px; line-height: 18px; font-family: Georgia, Times, serif; color: #343434; padding-top: 15px; font-style: italic; padding-bottom: 20px;">Dear '.$printName.',</p>
<p style="color: #343434; font-size: 12px; font-family: Georgia,  Times, serif; font-style: italic; line-height: 18px;">Thank you for shopping with Kingdom Made. We began processing your order as soon as you placed it. For this reason, orders cannot be changed or cancelled once they are placed. To check the status of this order or view your order history, visit the following link:</p>
<a href="http://www.kingdommade.com.au/receiptsummary.php?orid='.md5($invoice).'" target="_blank" style="color: #3b5998; font-size: 12px; font-family: Arial, Helvetica, sans-serif; text-decoration: none !important;"><u>http://www.kingdommade.com.au/receiptsummary.php?orid='.md5($invoice).'</u></a><br>
<p style="color: #343434; font-size: 12px; font-family: Georgia,  Times, serif; font-style: italic; line-height: 18px;">You will be sent a shipping confirmation e-mail as soon as your order is dispatched from our warehouse.</p>
<p style="color: #343434; font-size: 12px; font-family: Georgia,  Times, serif; font-style: italic; line-height: 18px;">If you have any questions regarding your order, please email us at <a href="mailto:care@kingdommade.com.au" target="_blank" style="color: #343434; font-weight: bold; text-decoration: none !important;"><u>care@kingdommade.com.au</u></a>, or visit our <a href="http://www.kingdommade.com.au/customercare.php" target="_blank" style="color: #343434; font-weight: bold; text-decoration: none !important;"><u>Customer Care</u></a> page. Be sure to include your order number in all correspondence.</p></td></tr>
  <tr><td style="padding-top: 30px;" width="640"><p style="color: #343434; font-size: 12px; font-family: Georgia,  Times, serif; font-style: italic; line-height: 18px;">Yours sincerely,</p></td></tr>
  <tr><td style="padding: 0px 0px 40px;" width="640"><img src="http://kingdommade.com.au/images/mailer/signature.gif" alt="Kingdom Made - KingdomMade.com.au" width="100px" height="27px" border="0" /></td></tr>
  <tr><td><hr style="background-color: #E8E8E8; margin: 5px 0; height: 1px; width: 100%; border: 0px; clear: both;" /></td></tr>
  <tr><td width="640"><h1 style="color: #343434; font-size: 15px; font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; margin: 0; padding: 0;">Order Summary</h1></td></tr>
  <tr><td><hr style="background-color: #E8E8E8; margin: 5px 0; height: 1px; width: 100%; border: 0px; clear: both;" /></td></tr>
  <tr><td width="640"><table cellspacing="0" border="0" align="center" style="padding: 20px;" cellpadding="0" width="640"> 
      <tr> 
        <td colspan="2" valign="top"><table width="295" border="0" cellspacing="0" cellpadding="0"> 
          <tr>
            <td style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 0 10px 5px 0; font-family: Arial, Helvetica, sans-serif; color: #343434; width: 45%;" colspan="2" width="285px"><h3 align="left" style="color: #444444; font-size: 13px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-transform: uppercase; margin: 0; padding: 0; text-align: left;">Order Details</h3></td>
            </tr>
          <tr> 
            <td style="font-size: 11px; margin: 0; padding: 0 10px 0 0; color: #343434; font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; width: 45%;" width="135px">Order #</td>
            <td style="color: #343434; font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; margin: 0; padding: 0; width: 55%;" width="150px">'.$invoice.'</td> 
          </tr> 
          <tr> 
            <td valign="top" style="font-size: 11px; margin: 0; padding: 0 10px 0 0; color: #343434; font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; width: 45%;">Order Placed On</td> 
            <td style="color: #343434; font-size: 12px; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; width: 55%;">'.$payment_date.'</td> 
            </tr> 
          <tr> 
            <td valign="top" style="font-size: 11px; margin: 0; padding: 0 10px 0 0; color: #343434; font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; width: 45%;">Order Status</td> 
            <td style="color: #343434; font-size: 12px; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; width: 55%;">'.$paymentStatus.'</td> 
            </tr>        
          </table></td> 
        <td width="30px"></td> 
        <td colspan="2" valign="top"><table width="295" border="0" cellspacing="0" cellpadding="0"> 
          <tr>
            <td valign="top" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 0 10px 5px 0; font-family: Arial, Helvetica, sans-serif; color: #343434; width: 45%;" colspan="2" width="285px"><h3 align="left" style="color: #444444; font-size: 13px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-transform: uppercase; margin: 0; padding: 0; text-align: left;">Shipment Details</h3></td>
            </tr>
          <tr> 
            <td valign="top" style="font-size: 11px; margin: 0; padding: 0 10px 0 0; color: #343434; font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; width: 45%;" width="135px">Deliver To</td> 
            <td style="color: #343434; font-size: 12px; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; width: 55%;" width="150px"><strong>'.$address_name.'</strong></td> 
            </tr> 
          <tr> 
            <td></td> 
            <td style="color: #343434; font-size: 12px; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; width: 55%;">'.$address_street.'<br />
    	  '.$address_city.', '.$address_state.', '.$address_zip.' <br />
    	  '.$address_country.' ('.$residence_country.')</td> 
            </tr> 
          <tr> 
            <td style="font-size: 11px; margin: 0; padding: 0 10px 0 0; color: #343434; font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; width: 45%;">Tracking #</td> 
            <td style="color: #343434; font-size: 12px; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; width: 55%;"> 
              <a href="#d41d8cd98f00b204e9800998ecf8427e" style="color: #3b5998; font-family: Arial, Helvetica, sans-serif; text-decoration: none !important;"><u>N/A</u></a>        </td> 
            </tr> 
        </table></td> 
        </tr> 
	</table></td></tr>
  <tr><td><hr style="background-color: #E8E8E8; margin: 5px 0; height: 1px; width: 100%; border: 0px; clear: both;" /></td></tr>
  <tr><td width="640"><table cellspacing="0" border="0" style="margin: 0; padding: 30px 0px 0px;" cellpadding="0" width="640"> 
            <tr style="color: #343434; font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; text-transform: uppercase;"> 
                <td scope="col" align="left" style="text-align: left; padding-bottom: 20px;">Product Description</th> 
                <td scope="col" align="center" style="text-align: center; padding-bottom: 20px;">Size</th> 
                <td scope="col" align="center" style="text-align: center; padding-bottom: 20px;">QTY</th> 
                <td scope="col" align="right" style="text-align: right; padding-bottom: 20px;">Price</th> 
            </tr>
       
			'.$itemsTR.' 
			      
            <tr>
              <td colspan="4"><hr style="background-color: #E8E8E8; margin: 5px 0; height: 1px; width: 100%; border: 0px; clear: both;" /></td>
            </tr>
            <tr> 
                <td align="right" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 5px 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: right;" colspan="3">Merchandise</td> 
                <td align="right" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 5px 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: right;">AU '.sprintf("$%0.2f",ltrim($mc_gross-$mc_handling)).'</td> 
            </tr>
            <tr>
              <td align="right" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 5px 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: right;" colspan="3">Shipping &amp; Handling</td>
              <td align="right" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 5px 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: right;">AU '.sprintf("$%0.2f",$mc_handling).'</td>
            </tr>
            <tr>
              <td align="right" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 5px 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: right;" colspan="3">Order Total</td> 
                <td align="right" style="font-size: 11px; text-transform: uppercase; margin: 0; padding: 5px 0; font-family: Arial, Helvetica, sans-serif; color: #343434; text-align: right;">AU '.sprintf("$%0.2f",ltrim($mc_gross)).'</td> 
            </tr>
            <tr> 
              <td style="height: 10px;" colspan="4"></td> 
            </tr>           
	</table></td></tr>
  <tr><td><table cellspacing="0" border="0" align="center" style="padding-top: 30px; padding-bottom: 10px;" cellpadding="0" width="640">
  <tr>
    <td><p style="color: #343434; font-size: 12px; font-family: Georgia,  Times, serif; font-style: italic; line-height: 18px;">P/S: Do like us on Facebook if you believe you are Kingdom Made!</p></td>
    <td align="right"><a href="http://www.facebook.com/pages/Kingdom-Made/129834883771094" target="_blank"><img src="http://kingdommade.com.au/images/mailer/facebook-like.gif" alt="Like Kingdom Made" width="49px" height="25px" border="0" /></a></td>
  </tr>
</table></td></tr>
</table>';

/*$admin_message = '<table cellpadding="10" cellspacing="0" id="invoice-table" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; border: 1px solid #CFCFCF; margin-bottom: 10px; text-align: left; border-collapse: collapse; width: 900px;">
    <thead style="background: #e8e8e8;">
    	<tr>
    	  <th colspan="4" scope="col">
          ADDITIONAL TRANSACTION INFORMATION</th>
   	  </tr>
    	<tr>
    	  <th width="147" bgcolor="#FFFFFF" scope="col"><strong>TXN ID:</strong></th>
    	  <th width="374" bgcolor="#FFFFFF" scope="col">'.$txn_id.'</th>
    	  <th width="113" bgcolor="#FFFFFF" scope="col"><strong>TXN Type:</strong></th>
    	  <th width="264" valign="top" bgcolor="#FFFFFF" scope="col">'.$txn_type.'</th>
   	  </tr>
    	<tr>
    	  <th valign="top" bgcolor="#FFFFFF" scope="col"><strong>IPN Track ID:</strong></th>
    	  <th valign="top" bgcolor="#FFFFFF" scope="col">'.$ipn_track_id.'</th>
    	  <th bgcolor="#FFFFFF" scope="col"><strong>Verify Sign:</strong></th>
    	  <th valign="top" bgcolor="#FFFFFF" scope="col">'.$verify_sign.'</th>
  	  </tr>
    	<tr>
    	  <th valign="top" bgcolor="#FFFFFF" scope="col"><strong>Paypal Fee:</strong></th>
    	  <th valign="top" bgcolor="#FFFFFF" scope="col">'.$paypalFee.'</th>
    	  <th bgcolor="#FFFFFF" scope="col"><strong>Net Profit:</strong></th>
    	  <th valign="top" bgcolor="#FFFFFF" scope="col"><span style=" font-weight:bold;">'.sprintf("$%0.2f", $net_sale).'</span></th>
   	  </tr>
    </thead>
</table>';*/

					require_once('Connections/kingdomDB.php');
					include('admin/inc/functions.php');
					
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: Kingdom Made <orderstatus@kingdommade.com.au>' . "\r\n";
					$headers .= 'Bcc: '.$admin_email.', orderstatus@kingdommade.com.au' . "\r\n";
					
					mail($to, $subject, $message, $headers);

					 

					mysql_select_db($database_kingdomDB, $kingdomDB);
					$query_rsCheckInvoice = sprintf("SELECT COUNT(*) FROM sales WHERE invoice = %s", GetSQLValueString($invoice, "text"));
					$rsCheckInvoice = mysql_query($query_rsCheckInvoice, $kingdomDB) or die(mysql_error());
					$row_rsCheckInvoice = mysql_fetch_assoc($rsCheckInvoice);
					
					//Check if invoice exists
					if($row_rsCheckInvoice['COUNT(*)'] != "0"){
					/*
										   GetSQLValueString($mc_gross_x, "text"),
										   GetSQLValueString($mc_gross, "text"),
										   GetSQLValueString($mc_fee, "text"),
										   GetSQLValueString($net_sale, "text"),
										   GetSQLValueString($mc_handling, "text"),	
										   GetSQLValueString($mc_currency, "text"),	
					*/
						$updateSQL = sprintf("UPDATE sales SET payment_status=%s, ipn_track_id=%s, verify_sign=%s, mc_fee=%s, net_sale=%s WHERE invoice=%s",
										   GetSQLValueString($payment_status, "text"),
										   GetSQLValueString($ipn_track_id, "text"),
										   GetSQLValueString($verify_sign, "text"),
										   GetSQLValueString($mc_fee, "text"),
										   GetSQLValueString($net_sale, "text"),										   				   
										   GetSQLValueString($invoice, "text"));
						mysql_select_db($database_kingdomDB, $kingdomDB);
						mysql_query($updateSQL, $kingdomDB) or die(mysql_error());
					}
					else{
							mysql_select_db($database_kingdomDB, $kingdomDB);
							$query_rsCusName = sprintf("SELECT uFirstname, uLastname FROM users WHERE uEmail = %s", GetSQLValueString($memberEmail, "text"));
							$rsCusName = mysql_query($query_rsCusName, $kingdomDB) or die(mysql_error());
							$row_rsCusName = mysql_fetch_assoc($rsCusName);
							
							//If member has first and last name, overwrite buyer's name.
							if($row_rsCusName['uFirstname']!=NULL && $row_rsCusName['uLastname']!=NULL){
								$first_name = $row_rsCusName['uFirstname'];
								$last_name = $row_rsCusName['uLastname'];
								}
						$insertSQL = sprintf("INSERT INTO sales (memberEmail, invoice, txn_id, txn_type, payment_date, payment_status, payer_status, payment_type, payer_id, custom, first_name, last_name, payer_email, contact_phone, address_status, address_name, residence_country, address_country, address_country_code, address_state, address_street, address_city, address_zip, num_cart_items, item_number, item_name, quantity, mc_currency, mc_shipping, mc_handling, mc_gross_x, mc_gross, mc_fee, net_sale, ipn_track_id, verify_sign) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
											   GetSQLValueString($memberEmail, "text"),
											   GetSQLValueString($invoice, "text"),
											   GetSQLValueString($txn_id, "text"),
											   GetSQLValueString($txn_type, "text"),
											   GetSQLValueString($payment_date, "text"),
											   GetSQLValueString($payment_status, "text"),
											   GetSQLValueString($payer_status, "text"),
											   GetSQLValueString($payment_type, "text"),
											   GetSQLValueString($payer_id, "text"),
											   GetSQLValueString($custom, "text"),
											   GetSQLValueString($first_name, "text"),
											   GetSQLValueString($last_name, "text"),
											   GetSQLValueString($payer_email, "text"),
											   GetSQLValueString($contact_phone, "text"),
											   GetSQLValueString($address_status, "text"),
											   GetSQLValueString($address_name, "text"),
											   GetSQLValueString($residence_country, "text"),
											   GetSQLValueString($address_country, "text"),
											   GetSQLValueString($address_country_code, "text"),
											   GetSQLValueString($address_state, "text"),
											   GetSQLValueString($address_street, "text"),
											   GetSQLValueString($address_city, "text"),
											   GetSQLValueString($address_zip, "text"),
											   GetSQLValueString($num_cart_items, "text"),
											   GetSQLValueString($items_number, "text"),
											   GetSQLValueString($items_name, "text"),
											   GetSQLValueString($quantity, "text"),
											   GetSQLValueString($mc_currency, "text"),
											   GetSQLValueString($mc_shipping, "text"),
											   GetSQLValueString($mc_handling, "text"),
											   GetSQLValueString($mc_gross_x, "text"),
											   GetSQLValueString($mc_gross, "text"),
											   GetSQLValueString($mc_fee, "text"),
											   GetSQLValueString($net_sale, "text"),
											   GetSQLValueString($ipn_track_id, "text"),
											   GetSQLValueString($verify_sign, "text"));
											   
											mysql_select_db($database_kingdomDB, $kingdomDB);
											mysql_query($insertSQL, $kingdomDB) or die(mysql_error());
											
											//unset($_SESSION['cart']);
											//unset($_SESSION['grandTotal']);
											//unset($_SESSION['shipping']);
											//unset($_SESSION['shippingGrandTotal']);	
												
					}//End Else if $row_rsCheckInvoice == 0

				} //END IF PAYMENT IS VALID

				//IF PAYMENT IS INVALID
				else if (strcmp ($res, "INVALID") == 0) {
				
					// PAYMENT INVALID & INVESTIGATE MANUALY!
					
					$to      = $admin_email;
					$subject = 'Kingdom Made | Invalid Payment';
					$message = '
					
					Dear Administrator,
					
					A payment has been made but is flagged as INVALID.
					Please verify the payment manualy and contact the buyer.
					
					Buyer Email: '.$payer_email.' / '.$memberEmail.'
					';
					$headers = 'From: Admin @ Kingdom Made <administrator@kingdommade.com.au>' . "\r\n";
					
					mail($to, $subject, $message, $headers);
				
				}
}
fclose ($fp);
}
?>
