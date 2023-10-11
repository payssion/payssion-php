<?php
require_once("../lib/PayssionClient.php");

$payssion = new PayssionClient('your api key', 'your secretkey');
//please uncomment the following if you use sandbox api_key
//$payssion = new PayssionClient('your api key', 'your secretkey', false);

$response = null;
try {
	$response = $payssion->refund(array(
	    'transaction_id' => 'Your payssion transaction id',
	    'amount' => 1,
	    'currency' => 'USD',
	));
} catch (Exception $e) {
	//handle exception
	echo "Exception: " . $e->getMessage();
}

if ($payssion->isSuccess()) {
    $refund_transaction_id = $response['refund']['transaction_id'];
} else {
	//handle failure
}