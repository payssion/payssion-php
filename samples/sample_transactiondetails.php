<?php

$payssion = new PayssionClient('your api key', 'your secretkey');
//please uncomment the following if you use sandbox api_key
//$payssion = new PayssionClient('your api key', 'your secretkey', false);

$response = null;
try {
	$response = $payssion->getDetails(array(
			'order_id' => 'your order id',  //your order id
			));
} catch (Exception $e) {
	//handle exception
	echo "Exception: " . $e->getMessage();
}

if ($payssion->isSuccess()) {
	//handle success
	$transaction = $response['transaction'];
	$pm_id = $transaction['pm_id'];
	$amount = $transaction['amount'];
	$currency = $transaction['currency'];
	$order_id = $transaction['order_id'];
	$state = $transaction['state'];
} else {
	//handle failed
}