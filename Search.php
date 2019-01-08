<?php
//Search for Teams and Matches
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
//include("db_connect.php");
include("api_connect.php");
/*
		//the url needs a change
		$url = "https://frc-api.firstinspires.org/v2.0/2015/schedule/txho?tournamentLevel=Qualification&teamNumber=624";
		$response = file_get_contents($url,false,$context);*/
?>
<head>
	<link rel="stylesheet" type="text/css" href="css/NoteEntryStyle.css">
	<link rel="stylesheet" type="text/css" href="css/mainpagestyle.css">
	<link rel="stylesheet" type="text/css" href="css/SearchStyle.css"> 
</head>
<br>
<br>
<br>
<br>
<div class = "title">
	<h1> Search for Teams </h1>
</div>
<div class="page_container">
<form class="Searchforsearch" method="get" action="TeamInfoDisplay.php">
<br>

<input type="number" name="team">
<br>
<br>
<br>
<input type="submit" value="Search" class="subButton">
</form>


<br>
<br>
<br>

<div class = "title">
	<h1> Search for Matches </h1>
</div>

<form class="Searchforsearch" method="get" action="MatchInfoDisplay.php">
<br>
	<input type="number" name="match">
	<input type="checkbox" name="playoffs" style="width:30px;padding-top:10px"> <span style="color:#FFF">Playoffs?</span>
<br>
<br>
<br>
<input type="submit" value="Search" class="subButton">
</form>
</div>
<?php

?>
