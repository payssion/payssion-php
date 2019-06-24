<?php

// Send an empty HTTP 200 OK response to acknowledge receipt of the notification
header('HTTP/1.1 200 OK');
 
$api_key  = ''; //your api key
$secret_key = ''; //your secret key

//only when you request payments in json
if (isset($_SERVER['CONTENT_TYPE']) && false !== strpos($_SERVER['CONTENT_TYPE'], 'json')) {
	$body = file_get_contents("php://input");
	$body_params = json_decode($body, true);
	if($body_params) {
		foreach($body_params as $param_name => $param_value) {
			$_POST[$param_name] = $param_value;
		}
	}
}

// Assign payment notification values to local variables
$pm_id = $_POST['pm_id'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];
$order_id = $_POST['order_id'];
$state = $_POST['state'];

$check_array = array(
		$api_key,
		$pm_id,
		$amount,
		$currency,
		$order_id,
		$state,
		$secret_key
);

$check_msg = implode('|', $check_array);
$check_sig = md5($check_msg);
$notify_sig = $_POST['notify_sig'];
if ($notify_sig == $check_sig) {
	//handle payment notification
	//you must make sure the amount is equal to the order amount you created
	switch ($state) {
		case 'completed':
			//$order_id should be your order id
			//update the order as paid
			break;
		case 'paid_partial':
			//this is rare case if it goes here
			break;
		case 'pending':
			break;
		case 'failed':	
			break;
		case 'expired':		
			break;
		case 'error':
			break;
		default:
			//please refer to the following URL for more states:
			//https://payssion.com/en/docs/#api-reference-payment-notifications
			break;
	}
}
