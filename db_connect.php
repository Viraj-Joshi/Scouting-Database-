<?php
	error_reporting(E_ALL ^ E_NOTICE);
	
	$ini = parse_ini_file("./config.ini");

	//if you ever want to access your own database instead, this is the place to do it.
	//Just uncomment out and add in your own info.
	//$dbhost = localhost /*$ini['dbhost']*/;
	//$dbname =  scout2016     /*$ini['dbname']*/;
	//$dbuser = SkaiCow       /*$ini['dbuser']*/;
	//$dbpass = clutchcode01       /*$ini['dbpass']*/; 
	
	//$dbname =  testdatabase2     /*$ini['dbname']*/;
	//$dbuser = anuragtest       /*$ini['dbuser']*/;
	//$dbpass = helloworld       /*$ini['dbpass']*/; 
 
	

	
//this is if you want to connect to the team624 database
	$dbhost = $ini['dbhost'];
	$dbname = $ini['dbname'];
	$dbuser = $ini['dbuser'];
	$dbpass = $ini['dbpass'];
	
	$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	
	// check connection 
	 if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	
	
	
?>