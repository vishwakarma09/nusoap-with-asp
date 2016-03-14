<?php

require_once ("lib/nusoap.php");
$client = new nusoap_client("http://vbelievesports.org/testing/api/index.php?wsdl");

//echo $client;

$error = $client->getError();
if ($error) {
	echo "Error: $error";
}

$json = json_encode(array("data"=>array("email"=>"a@a.com","password"=>"a")));
$res = $client->call("vBelieve.SubmitLogin",array($json));


$error = $client->getError();
if ($error) {
	echo "$error";
} Else {
	echo "$res";
}