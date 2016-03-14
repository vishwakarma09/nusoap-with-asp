<?php 
	error_reporting(E_ALL);
	require_once("EncryptionClass.php");
	
	// $key = 'sandeep';
	// $crypt = new Encryption($key);
	// $encrypted_string = $crypt->encrypt('this is a test');
	// $decrypted_string = $crypt->decrypt($encrypted_string);
	
	$key = 'sandeep';
	$crypt = new Encryption($key);
	$encodedImage = base64_encode(file_get_contents("flower.jpg"));
	$encryptedImage = $encrypted_string = $crypt->encrypt($encodedImage);
	$decryptedImage = $crypt->decrypt($encryptedImage);
	file_put_contents("new floder.jpg", base64_decode($decryptedImage));
	