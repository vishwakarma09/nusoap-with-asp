<?php

require_once ("lib/nusoap.php");
$client = new nusoap_client("http://vbelievesports.org/testing/api/index.php?wsdl");

$error = $client->getError();
if ($error) {
	echo "Error: $error";
}

/*
$json = json_encode(array("data"=>array(
		"firstname"=>"api_first",
		"middlename"=>"api_middle",
		"lastname"=>"api_last",
		"email"=>"api4@vbelievesports.org",		
		"dob"=>"1990-07-09",					//yyyy/mm/dd
		"password"=>"somepassword",
		"address"=>"were api lives?, in the programmer head!",					//CityID
		"state"=>2,
		"city"=>1,				
		"pin"=>123456,
		"gender"=>1, //1- Male, 2- Female, 3- Other
		"age"=>21,
		"landlinephone"=>"9807654321",
		"mobilephone"=>"9807654321"
)));

$res = $client->call("vBelieve.MemberSignUp",array($json));
*/

$json = '{"data":{"firstname":"Yfhfh","middlename":"nvhf","lastname":"jgjt","email":"abc@sfdfabcqasdaweqw.com","dob":"2015-7-9","password":123,"address":"gCtgfg","state":0,"city":0,"pin":355555,"gender":0,"age":25,"landlinephone":467865,"mobilephone":9765432455}}';
$res = $client->call("vBelieve.MemberSignUp",array($json));

$error = $client->getError();
if ($error) {
	echo "$error";
} Else {
	echo "$res";
}
	

	
?>