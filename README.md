payssion-php
============

##Prerequisites
   * PHP 7.0 or above
   * curl, json & openssl extensions must be enabled
   
##Usage
``` php
$payssion = new PayssionClient('your api key', 'your secretkey');
//please uncomment the following if you use sandbox api_key
//$payssion = new PayssionClient('your api key', 'your secretkey', false);

$response = null;
try {
    $response = $payssion->getDetails(
        [
            'order_id' => 'your order id',  //your order id
        ]
    );
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
