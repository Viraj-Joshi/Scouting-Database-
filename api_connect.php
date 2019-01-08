<?php
//CONNECT TO THE FRC API
include("read_ini.php");
//$ini['api_encoder'] will be the name that the API Key has in the INI file
	$auth = "Authorization: Basic " . base64_encode($ini['api_user']. ":".$ini['api_token']); 
	
	$opts = array(
		'http'=>array(
			'method'=>"GET",
			'header'=> $auth . "\r\n" . "Accept: application/json"
			)
		);
		
	$context = stream_context_create($opts);

?>