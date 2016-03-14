<?php
//ini_set("include_path", '/home/yugalsharma/php:' . ini_get("include_path") );
require_once ("lib/nusoap.php");
//require_once ("XML/Serializer.php");
require_once ('MarketClass.php');
$server = new Soap_server();

$ns="http://localhost/bookmarket/?wsdl";
$server->configureWSDL ('server');
$server->wsdl->schemaTargetNamespace = $ns;

$server->register('Market.SubmitLogin',
		array('name'=>'xsd: string'),
		array('return'=>'xsd: string'),
		$ns,
		false,
		'rpc',
		'encoded',
		'Sample function to test json encode'
);

$server->service(file_get_contents('php://input'));
