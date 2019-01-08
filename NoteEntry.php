<?php
//Note Entry
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("db_connect.php");
?>
<head>	
	<link rel="stylesheet" type="text/css" href="css/mainpagestyle.css">
	<link rel="stylesheet" type="text/css" href="css/NoteEntryStyle.css"> 
</head>
<br>
<br>
<br>
<br>
<div class="title">
	<h1>Note Entry</h1>
</div>
<div class="page_container">
<form class="NoteEntry" method="post">

<span class="teamsearch">Search For a Team:</span><input type="number" name="selectteam">
<br>
<br>
<br>
<textarea rows="7" cols="50" name="notes" placeholder="Type notes here!!!"></textarea>
<br>
<br>
<input type="submit" value="Enter!" class="subButton" name="submitnotes">
</form>
</div>
<?php
if(isset($_POST['submitnotes'])){
if(isset($_POST['selectteam']) && isset($_POST['notes'])) {
	$teamselect=$_POST['selectteam'];
	//$notes=$_POST['notes'];	
	$notes = $mysqli->real_escape_string($_POST['notes']);
	$query = "INSERT INTO note_entry (selectteam,notes) VALUES ('$teamselect','$notes')";
	$result = $mysqli->query($query);
	if($result) {
		echo"Successfully added notes";	
	}
	else {
		echo"NOPE!<br>";	
		printf("Errormessage: %s\n", $mysqli->error);
	}
}
}
?>
