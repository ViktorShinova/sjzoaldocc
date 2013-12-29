<?php 
require_once('Connections/kingdomDB.php'); 
include('admin/inc/functions.php');

session_start();
error_reporting(5);

	
$arrayDiscountedProducts = CheckDiscountedProducts();
$arrayKidsProducts = CheckKidsProducts();

$invoice = invoice(4);
$countryCode = CountryCode($_POST['country']);			
$params = array(
                'cmd' => '_cart',
                'business' => 'paypal@kingdommade.com.au',
				//'business' => 'victor_1309492850_biz@hotmail.com',
                'return' => 'http://www.kingdommade.com.au/orderhistory.php',	
				'handling_cart' => $_POST['shippingMethod'],
				//'currency_code' => 'USD',
				'currency_code' => 'AUD',
				'address_override' => '0',
				'first_name' => $_POST['firstName'],
				'last_name' => $_POST['lastName'],
				'country' => $_POST['country'],
				'city' => $_POST['city'],
				'lc' => $countryCode,
				'state' => $_POST['state'],
				'address1' => $_POST['address1'],
				'address2' => $_POST['address2'],
				'zip' => $_POST['zip'],
				'email' => $_SESSION['KDM_Username'],				
				'no_shipping' => '0',
				'no_note' => '1',
                'invoice'  => $invoice,
				'upload' => '1'
               );
			
	//Get values from session and put into array
	$cartArray = explode(",", $_SESSION['KDM_Cart']);
	
	//Assign individual values to array respectively
	foreach($cartArray as $cart){
		list($selectedID[], $selectedSize[], $selectedQty[]) = explode("|", $cart);
	}
	
	$n = 1;
	for ($i=0; $i <= count($selectedID)-1; $i++){
    mysql_select_db($database_kingdomDB, $kingdomDB);
	$query_rsCart = sprintf("SELECT * FROM products WHERE pID = %s", GetSQLValueString($selectedID[$i], "int"));
    $rsCart = mysql_query($query_rsCart, $kingdomDB) or die(mysql_error());
    $row_rsCart = mysql_fetch_assoc($rsCart);
    $totalRows_rsCart = mysql_num_rows($rsCart);

	$productImage = explode(",", $row_rsCart['pImg']);
	$custom .= $productImage[0].',';
	
	//$params = array_merge($params, array('item_name_'.$n.'' => ''.$row_rsCart['pName'].' | '.$selectedSize[$i].'', 'item_number_'.$n.'' => ''.$row_rsCart['pSerial'].'', 'item_number_'.$n.'' => ''.$row_rsCart['pSerial'].'', 'amount_'.$n.'' => ''.$row_rsCart['pPrice'].'', 'quantity_'.$n.'' => ''.$selectedQty[$i].''));
			
	//check discount
	if($_SESSION['KDM_Coupon_Val'] && $_SESSION['KDM_Promo_Count'] >= 2 && $_SESSION['KDM_Coupon_Des'] != "Discount off any adult tees" 
	&& $_SESSION['KDM_Coupon_Des'] != "Discount off regular items"){
		if (!in_array($row_rsCart['pID'], $arrayDiscountedProducts)) { //if item not in already discounted products, apply discount.
			$percentage = '0.'.$_SESSION['KDM_Coupon_Val'];
			$productPrice = $row_rsCart['pPrice'] * (1 - $percentage);
		}
		else{ //no discount
			$productPrice = $row_rsCart['pPrice'];
		}

	}
	else if($_SESSION['KDM_Coupon_Val'] && $_SESSION['KDM_Coupon_Des'] == "Discount off any adult tees"){
		if (!in_array($row_rsCart['pID'], $arrayKidsProducts)) {
			$percentage = '0.'.$_SESSION['KDM_Coupon_Val'];
			$productPrice = $row_rsCart['pPrice'] * (1 - $percentage);
		}
		else{ //no discount
			$productPrice = $row_rsCart['pPrice'];
		}		
	}
	else if($_SESSION['KDM_Coupon_Val'] && $_SESSION['KDM_Coupon_Des'] == "Discount off regular items"){
		if (!in_array($row_rsCart['pID'], $arrayDiscountedProducts)) {
			$percentage = '0.'.$_SESSION['KDM_Coupon_Val'];
			$productPrice = $row_rsCart['pPrice'] * (1 - $percentage);
		}
		else{
			//pay normal price
			$productPrice = $row_rsCart['pPrice'];
		}
	}		
	else{
		$productPrice = $row_rsCart['pPrice'];	
	}
	
	$params = array_merge($params, array('item_name_'.$n.'' => ''.$row_rsCart['pName'].' | '.$selectedSize[$i].'', 'item_number_'.$n.'' => ''.$row_rsCart['pSerial'].'', 'amount_'.$n.'' => ''.$productPrice.'', 'quantity_'.$n.'' => ''.$selectedQty[$i].''));	
	
	$n++;
	}
	
	$params = array_merge($params);
	$paramsFinal = array_merge($params, array('custom' => ''.$custom.$_SESSION['KDM_Username'].','.$_SESSION['KDM_Coupon'].','));							
			//print_r($params);
						   
            //$api_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?';
			$api_url = 'https://www.paypal.com/cgi-bin/webscr?';
			//$api_url = 'cart.php?';
    
            // Construct the URL
            foreach ($paramsFinal as $key => $value )
            {
				//echo $key.' => '.$value.'<br/>';
                $api_url .= $key . '=' . urlencode($value) . '&';
            }
    
            $result = file_get_contents($api_url);  // You can use curl instead of this
			unset($_SESSION['KDM_Coupon']);
			unset($_SESSION['KDM_Coupon_Des']);
			unset($_SESSION['KDM_Coupon_Val']);
			mysql_free_result($rsCart);

            // direct the user to the paypal
            header('Location:'.$api_url);
