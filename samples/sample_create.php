<?php

$payssion = new PayssionClient('your merchant id', 'your appname', 'your secretkey');

$response = null;
try {
	$response = $payssion->create(array(
			'amount' => 1,
			'currency' => 'USD',
			'pm_id' => 'hsbc_br',
			'description' => 'order description',
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
	$todo = $response['todo'];
	if ($todo) {
		$todo_list = explode('|', $todo);
		if (in_array("instruct", $todo_list)) {
			//show offline bank account info by showorder param
			// 			"bankaccount":
			// 			{
			// 				"Banco":"Caixa Econ\u00f3mica Federal",
			// 				"Benefici\u00e1rio":"DICLOMERC SERVI\u00c7OS T\u00c9CNICOS EIRELI- ME",
			// 				"Ag\u00eancia":"1525 op 3",
			// 				"Conta":"2640-0",
			// 				"Referencia":"12345",
			// 				"show_order":"Banco|Benefici\u00e1rio|Ag\u00eancia|Conta|Referencia"
			// 			}
			$bankaccount = $response['bankaccount'];
			echo print_r($bankaccount, true);
	    } else if (in_array("redirect", $todo_list)) {
		    //send payment url by email
		    $paylink = $response['redirect_url'];
		    echo $paylink;
	    }
	} else {
	//just in case, should not be here
	}
} else {
	//handle failed
}