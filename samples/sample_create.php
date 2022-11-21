<?php
require_once("../lib/PayssionClient.php");

$payssion = new PayssionClient('your api key', 'your secretkey');
//please uncomment the following if you use sandbox api_key
//$payssion = new PayssionClient('your api key', 'your secretkey', false);

$response = null;
try {
	$response = $payssion->create(array(
			'amount' => 1,
			'currency' => 'USD',
			'pm_id' => 'alipay_cn',
			'description' => 'order description',
			'order_id' => 'your order id',          //your order id
			'return_url' => 'your return url'   //optional, the return url after payments (for both of paid and non-paid)
	));
} catch (Exception $e) {
	//handle exception
	echo "Exception: " . $e->getMessage();
}

if ($payssion->isSuccess()) {
    //redirect the users to the payment URL
    $payment_url = $response['redirect_url'];
} else {
	//handle failure
}