payssion-php
============

##Prerequisites
   * PHP 5.3 or above
   * curl, json & openssl extensions must be enabled
   
##Usage
``` php
$payssion = new PayssionClient($api_key, $secret_key);

$response = null;
try {
	$response = $payssion->create(array(
			'amount' => 1,
			'currency' => 'USD',
			'pm_id' => 'cashu',
			'track_id' => 'track_id',          //optional, your order id or transaction id
			'sub_track_id' => 'sub_track_id',  //optional
			'payer_ref' => '00003456789',
			'payer_name' => 'user name',
			'payer_email' => 'user@mail.com',
			'notify_url' => 'your notify url', //optional, the notify url on your server side
			'success_url' => 'your notify url',//optional,  the redirect url after success payments
			'fail_url' => 'your fail url'      //optional, the redirect url after failed payments
	));
} catch (Exception $e) {
	//handle exception
	echo "Exception: " . $e->getMessage();
}

if ($payssion->isSuccess()) {
	//handle success
} else {
	//handle failed
}

```

PAYSSION PHP library
