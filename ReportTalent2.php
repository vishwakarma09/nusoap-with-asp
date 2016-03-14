<?php

require_once ("lib/nusoap.php");
$client = new nusoap_client("http://vbelievesports.org/testing/api/index.php?wsdl");

$error = $client->getError();
if ($error) {
	echo "Error: $error";
}

$json = json_encode(array("data"=>array(
		"candfirstname"=>"Google",
		"candmiddlename"=>"Moogle",
		"candlastname"=>"api_last",
		"canddob"=>"07/25/1990",		//mm/dd/yyyy
		"candaddress1"=>"First Line",
		"candaddress2"=>"Second Line",
		"candaddress3"=>"3rd line",
		"candstate"=>3,					//StateID
		"candcity"=>15,					//CityID
		"candpin"=>"144001",
		"candgender"=>1,				//1- Male, 2- Female, 3- Other
		"candage"=>"9",
		"candidateLandline"=>"1234567890",
		"candidateMobile"=>"9807654321",
		"reporterfirstname"=>"Dragon",
		"reportermiddlename"=>"Heart",
		"reporterlastname"=>"last",
		"reportermobile"=>"2342323232",
		"reporteremail"=>"reporter@email.com"
)));

$res = $client->call("vBelieve.ReportTalent",array($json));


$error = $client->getError();
if ($error) {
	echo "$error";
} Else {
	echo "$res";
}
	
?>