<?php

require_once ("lib/nusoap.php");
$client = new nusoap_client("http://localhost/bookmarket/?wsdl");

//echo $client;

$error = $client->getError();
if ($error) {
	echo "Error: $error";
}

$json = json_encode(array("userid"=>"1","activationcode"=>"abc"));

$res = $client->call("Market.SubmitLogin",array("name"=>$json));


$error = $client->getError();
if ($error) {
	echo "$error";
} Else {
	echo "$res";
}