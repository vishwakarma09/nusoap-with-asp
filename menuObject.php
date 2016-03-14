<?php 
	
	require_once("MarketClass.php");
	$market = new Market();
	
	$menu64 = $market->GetXMLMenu();
	echo base64_decode($menu64);