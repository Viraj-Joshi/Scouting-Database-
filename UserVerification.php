<?php
	error_reporting(E_ALL ^ E_NOTICE);
	
	$valid_user = false;
	$user_type = "intruder";
	
	session_start();
	
	$valid_user = $_SESSION['valid'];
	$user_type = $_SESSION['type'];
	
?>