<?php

$payssion = new PayssionClient('your api key', 'your secretkey');
//please uncomment the following if you use sandbox api_key
//$payssion = new PayssionClient('your api key', 'your secretkey', false);

$response = null;
try {
	$response = $payssion->create(array(
			'amount' => 1,
			'currency' => 'USD',
			'pm_id' => 'hsbc_br',
			'description' => 'order description',
			'order_id' => 'your order id',          //your order id
			'return_url' => 'your return url'   //optional, the return url after payments (for both of paid and non-paid)
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
		    //redirect the users to the redirect url or send the url by email
		    $paylink = $response['redirect_url'];
		    echo $paylink;
	    }
	} else {
	//just in case, should not be here
	}
} else {
	//handle failed
}