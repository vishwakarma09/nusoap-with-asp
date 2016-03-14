<?php

require_once ("lib/nusoap.php");
$client = new nusoap_client("http://vbelievesports.org/testing/api/index.php?wsdl");

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
			$jsonDecoded = json_decode($res, true);
    		$token = $jsonDecoded['SessionID'];
	}

//die("created session ID $token");

/*
$json = json_encode(array("token"=>$token,"data"=>array(
		"candfirstname"=>"Google",
		"candmiddlename"=>"Moogle",
		"candlastname"=>"api_last",
		"canddob"=>"07/25/1990",		//mm/dd/yyyy
		"candaddress"=>"This is a dummy address 123",
		"candstate"=>3,					//StateID
		"candcity"=>15,					//CityID
		"candpin"=>"144001",
		"candgender"=>1,				//1- Male, 2- Female, 3- Other
		"candage"=>"9",
		"candidateLandline"=>"1234567890",
		"candidateMobile"=>"9807654321"
)));
*/
	

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
			"candidatelat"=>"31.3282122",
			"candidatelng"=>"76.0507949"
	),"token"=>$token));
	
$res = $client->call("vBelieve.ReportTalent",array($json));


$error = $client->getError();
if ($error) {
	echo "$error";
} Else {
	echo "$res";
}
	
?>