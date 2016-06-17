<?php

// Send an empty HTTP 200 OK response to acknowledge receipt of the notification
header('HTTP/1.1 200 OK');
 
$api_key  = ''; //your api key
$secret_key = ''; //your secret key

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
