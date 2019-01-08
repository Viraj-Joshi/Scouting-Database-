<?php
//Setup
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("api_connect.php");
include("db_connect.php");

?>
<head><link rel="stylesheet" type="text/css" href="css/SetupStyle.css"></head>
<br><br>
<br><br>
<div class="title">
	<h1>Website setup</h1>
</div>
<div class="page_container">
	<div>
		<div class="setupdiv">
			<form method="post" action="csv_export.php">
				<input type="submit" name="exportCSV" class="subButton" value="Export CSV Data">
			</form>
		</div>
		<div class="setupdiv">
		
			
				<p class="words">Add a scout here</p>
				<form method="post">
					<input type="text" name="firstname" onfocus="if (this.value=='First Name') this.value = ''" value="First Name"><br><br>
					<input type="text" name="lastname" onfocus="if (this.value=='Last Name') this.value = ''" value="Last Name"><br><br>
					<input type="number" name="Aid"  onfocus="if (this.value=='0') this.value = ''" value="0"><br><br>
					<input type="submit" name="addscout" class="subButton">
					</form>
					<?php
					if(isset($_POST['addscout'])){
					$firstname=$_POST['firstname'];
					$lastname=$_POST['lastname'];
					$Aid=$_POST['Aid'];
					$addscoutquery="INSERT INTO scouts (id,firstname,lastname) VALUES ('$Aid','$firstname','$lastname')";
					$result22 = $mysqli->query($addscoutquery);
					
					if($result22) {
						echo"Successfully added info";	
								}
					else {
						echo "NOpe";	
						}
					}
					?>
				<br><br>
				<p class="words">Remove a scout here</p>
				<form method="post">
					
					<input type="number" name="Rid" onfocus="if (this.value=='0') this.value = ''" value="0">
					<br>
					<br>
					<input type="submit" name="removescout" class="subButton">
					</form>
					<?php
					if(isset($_POST['removescout'])){
					$Rid=$_POST['Rid'];
					$removescoutquery="DELETE FROM scouts WHERE id='$Rid'";
					$result222 = $mysqli->query($removescoutquery);
					if($result222) {
						echo"Successfully removed scout";	
								}
					else {
						echo "Sorry Snoop";	
						}
					}
					?>
				
		</div>
	</div>
	<div>
		<div class="setupdiv">
	<p class="words">Put in event code:</p>
	<form class="loadData" method="post">
	<input type="text" name="eventCode"><br><br>
	<input type="submit" value="Load Data!" class="subButton" name="loadData">
	<!--<input type="submit" value="Load Team List!" class="subButton" name="loadTeam"><br><br>
	<input type="submit" value="Load Match Schedule!" class="subButton" name="loadSchedule">-->
	</form>
<?php

/*JUSTIN'S CODE THAT ISN'T DUMB*/
if(isset($_POST['loadData']))
{
	if(!empty($_POST['eventCode']))
	{
		$eventCode = $_POST['eventCode'];
		
		$mysqli->query("Truncate Table regional");
		$mysqli->query("INSERT INTO regional (`eventCode`) VALUES ('$eventCode')");
		
		$url = "https://frc-api.firstinspires.org/v2.0/2016/teams?eventCode=". $eventCode . "&state=state";
		$response = file_get_contents($url,false,$context);
		$json = json_decode($response, true);
		//var_dump($json[teams]);
		//echo json_encode($json[teams], JSON_PRETTY_PRINT);
		$query = "TRUNCATE TABLE teams";
		$result = $mysqli->query($query);
			foreach ($json[teams] as $team)
			{	
				//var_dump($team);
					$teamName = $team["nameShort"];
					$teamNumber = $team["teamNumber"];
				
					
					$query2 = "INSERT INTO teams (number,name) VALUES ('$teamNumber','$teamName')";
					$result2 = $mysqli->query($query2);
			}
	
		$url = "https://frc-api.firstinspires.org/v2.0/2016/schedule/".$eventCode."?tournamentLevel=qualification";
		$response = file_get_contents($url,false,$context);
		$json = json_decode($response, true);
		$query = "TRUNCATE TABLE schedule";
		$result = $mysqli->query($query);
		//var_dump($json);
		//echo json_encode($json, JSON_PRETTY_PRINT);
		foreach ($json as $schedule)
		{	
			//var_dump($schedule);
			
			foreach ($schedule as $match)
			{ 
			$alliances = $match["Teams"];
			//var_dump($alliances);
			$red1Teams=  $alliances[0];
			$red2Teams=  $alliances[1];
			$red3Teams=  $alliances[2];
			$blue1Teams= $alliances[3];
			$blue2Teams= $alliances[4];
			$blue3Teams= $alliances[5];
							
			$matchNumba = $match["matchNumber"];
			$time = $match["startTime"];
			
			$Red1 = $red1Teams["teamNumber"];
			$Red2 = $red2Teams["teamNumber"];
			$Red3 = $red3Teams["teamNumber"];
			$Blue1 = $blue1Teams["teamNumber"];
			$Blue2 = $blue2Teams["teamNumber"];
			$Blue3 = $blue3Teams["teamNumber"];
			
			$query2 = "INSERT INTO schedule (match_number,time,red_1,red_2,red_3,blue_1,blue_2,blue_3) VALUES ('$matchNumba','$time','$Red1','$Red2','$Red3','$Blue1','$Blue2','$Blue3')";
			$result2 = $mysqli->query($query2);
			//$query3 = "SET FOREIGN_KEY_CHECKS=1";
			//$result3 = $mysqli->query($query3);
			}
		}
	}
}
/*
if(isset($_POST['loadTeam'])){
	if(!empty($_POST['eventCode'])){
$eventCode = $_POST['eventCode'];
if(strcasecmp($eventCode,"TXHO")==0){
	

	
	$url = "https://frc-api.firstinspires.org/v2.0/2016/teams?eventCode=TXHO&state=state";
	$response = file_get_contents($url,false,$context);
	$json = json_decode($response, true);
//var_dump($json[teams]);
//echo json_encode($json[teams], JSON_PRETTY_PRINT);
$query = "TRUNCATE TABLE teams";
$result = $mysqli->query($query);

$query3 = "INSERT INTO teams (regional) VALUES ($eventCode)";
$result3 = $mysqli->query($query);
		foreach ($json[teams] as $team)
		{	
			//var_dump($team);
				$teamName = $team["nameShort"];
				$teamNumber = $team["teamNumber"];
			
				
				$query2 = "INSERT INTO teams (number,name) VALUES ('$teamNumber','$teamName')";
				$result2 = $mysqli->query($query2);
		}

}
else if(strcasecmp($eventCode,"TXSA")==0){
	$url = "https://frc-api.firstinspires.org/v2.0/2016/teams?eventCode=TXSA&state=state";
	$response = file_get_contents($url,false,$context);
	$json = json_decode($response, true);
//var_dump($json[teams]);
//echo json_encode($json[teams], JSON_PRETTY_PRINT);
$query = "TRUNCATE TABLE teams";
$result = $mysqli->query($query);
		foreach ($json[teams] as $team)
		{	
			//var_dump($team);
				$teamName = $team["nameShort"];
				$teamNumber = $team["teamNumber"];
			
				
				$query2 = "INSERT INTO teams (number,name) VALUES ('$teamNumber','$teamName')";
				$result2 = $mysqli->query($query2);
		}
}
else if(strcasecmp($eventCode,"ALHU")==0){
	$url = "https://frc-api.firstinspires.org/v2.0/2016/teams?eventCode=ALHU&state=state";
	$response = file_get_contents($url,false,$context);
	$json = json_decode($response, true);
//var_dump($json[teams]);
//echo json_encode($json[teams], JSON_PRETTY_PRINT);
$query = "TRUNCATE TABLE teams";
$result = $mysqli->query($query);
		foreach ($json[teams] as $team)
		{	
			//var_dump($team);
				$teamName = $team["nameShort"];
				$teamNumber = $team["teamNumber"];
			
				
				$query2 = "INSERT INTO teams (number,name) VALUES ('$teamNumber','$teamName')";
				$result2 = $mysqli->query($query2);
		}
}
else {
	echo "Sorry";
}


	}
}

*/?>
			
	
<?php
if(isset($_POST['loadSchedule'])){
	if(!empty($_POST['eventCode'])){
$eventCode = $_POST['eventCode'];
/*
if(strcasecmp($eventCode,"TXHO")==0){
	*/
	$url = "https://frc-api.firstinspires.org/v2.0/2016/schedule/".$eventCode."?tournamentLevel=qualification";
	$response = file_get_contents($url,false,$context);
	$json = json_decode($response, true);
$query = "TRUNCATE TABLE schedule";
$result = $mysqli->query($query);
 //var_dump($json);
//echo json_encode($json, JSON_PRETTY_PRINT);
		foreach ($json as $schedule)
		{	
		//var_dump($schedule);
		
		foreach ($schedule as $match)
		{ $alliances = $match["Teams"];
		//var_dump($alliances);
		$red1Teams=  $alliances[0];
		$red2Teams=  $alliances[1];
		$red3Teams=  $alliances[2];
		$blue1Teams= $alliances[3];
		$blue2Teams= $alliances[4];
		$blue3Teams= $alliances[5];
		
						
						$matchNumba = $match["matchNumber"];
						$time = $match["startTime"];
						
						$Red1 = $red1Teams["teamNumber"];
						$Red2 = $red2Teams["teamNumber"];
						$Red3 = $red3Teams["teamNumber"];
						$Blue1 = $blue1Teams["teamNumber"];
						$Blue2 = $blue2Teams["teamNumber"];
						$Blue3 = $blue3Teams["teamNumber"];
						
						$query2 = "INSERT INTO schedule (match_number,time,red_1,red_2,red_3,blue_1,blue_2,blue_3) VALUES ('$matchNumba','$time','$Red1','$Red2','$Red3','$Blue1','$Blue2','$Blue3')";
						$result2 = $mysqli->query($query2);
						//$query3 = "SET FOREIGN_KEY_CHECKS=1";
						//$result3 = $mysqli->query($query3);
			}
		}
		/*
}
else if(strcasecmp($eventCode,"TXSA")==0){
	$url = "https://frc-api.firstinspires.org/v2.0/2016/schedule/TXSA?tournamentLevel=qual";
	$response = file_get_contents($url,false,$context);
	$json = json_decode($response, true);
$query = "TRUNCATE TABLE schedule";
$result = $mysqli->query($query);
//$query = "SET FOREIGN_KEY_CHECKS=1";
//$result = $mysqli->query($query);
 //var_dump($json);
//echo json_encode($json, JSON_PRETTY_PRINT);
		foreach ($json as $schedule)
		{	
		//var_dump($schedule);
		
		foreach ($schedule as $match)
		{ $alliances = $match["Teams"];
		//var_dump($alliances);
		$red1Teams=  $alliances[0];
		$red2Teams=  $alliances[1];
		$red3Teams=  $alliances[2];
		$blue1Teams= $alliances[3];
		$blue2Teams= $alliances[4];
		$blue3Teams= $alliances[5];
		
						
						$matchNumba = $match["matchNumber"];
						$time = $match["startTime"];
						
						$Red1 = $red1Teams["teamNumber"];
						$Red2 = $red2Teams["teamNumber"];
						$Red3 = $red3Teams["teamNumber"];
						$Blue1 = $blue1Teams["teamNumber"];
						$Blue2 = $blue2Teams["teamNumber"];
						$Blue3 = $blue3Teams["teamNumber"];
						
						$query2 = "INSERT INTO schedule (match_number,time,red_1,red_2,red_3,blue_1,blue_2,blue_3) VALUES ('$matchNumba','$time','$Red1','$Red2','$Red3','$Blue1','$Blue2','$Blue3')";
						$result2 = $mysqli->query($query2);
						//$query3 = "SET FOREIGN_KEY_CHECKS=1";
						//$result3 = $mysqli->query($query3);
			}
		} 
}
else if(strcasecmp($eventCode,"ALHU")==0){
$url = "https://frc-api.firstinspires.org/v2.0/2016/schedule/ALHU?tournamentLevel=qual";
$response = file_get_contents($url,false,$context);
$json = json_decode($response, true);
$query = "TRUNCATE TABLE schedule";
$result = $mysqli->query($query);
//$query = "SET FOREIGN_KEY_CHECKS=1";
//$result = $mysqli->query($query);
 //var_dump($json);
//echo json_encode($json, JSON_PRETTY_PRINT);
		foreach ($json as $schedule)
		{	
		//var_dump($schedule);
		
		foreach ($schedule as $match)
		{ $alliances = $match["Teams"];
		//var_dump($alliances);
		$red1Teams=  $alliances[0];
		$red2Teams=  $alliances[1];
		$red3Teams=  $alliances[2];
		$blue1Teams= $alliances[3];
		$blue2Teams= $alliances[4];
		$blue3Teams= $alliances[5];
		
						
						$matchNumba = $match["matchNumber"];
						$time = $match["startTime"];
						
						$Red1 = $red1Teams["teamNumber"];
						$Red2 = $red2Teams["teamNumber"];
						$Red3 = $red3Teams["teamNumber"];
						$Blue1 = $blue1Teams["teamNumber"];
						$Blue2 = $blue2Teams["teamNumber"];
						$Blue3 = $blue3Teams["teamNumber"];
						
						$query2 = "INSERT INTO schedule (match_number,time,red_1,red_2,red_3,blue_1,blue_2,blue_3) VALUES ('$matchNumba','$time','$Red1','$Red2','$Red3','$Blue1','$Blue2','$Blue3')";
						$result2 = $mysqli->query($query2);
						//$query3 = "SET FOREIGN_KEY_CHECKS=1";
						//$result3 = $mysqli->query($query3);
					}
				} 
			}
else{
	echo"Sorry Snoop";
		}
		*/
	}
}					
						
?>		
				
</div>
	</div>
	<div>
		<div class="setupdiv">
			<p class="words">Type in Obliteration Password:</p>
			
	<form class="obliterate" method="post">
	<input type="password" name="obliteratePassword"><br><br>
	<input type="submit" value="Obliterate Data!" class="ObliterateButton" name="obliterateData">
    </form>
		<?php 
	if(isset($_POST['obliterateData'])){
		if(!empty($_POST['obliteratePassword'])){
			$obliterationPassword = $_POST['obliteratePassword'];
			if(strcmp($obliterationPassword,"ALLIDOISWIN!")==0){
				
				$query5 = "TRUNCATE TABLE teams";
				$result5 = $mysqli->query($query5);
				$query6 = "TRUNCATE TABLE schedule";
				$result6 = $mysqli->query($query6);
				$query7 = "TRUNCATE TABLE match_data";
				$result7 = $mysqli->query($query7);
				$query8 = "TRUNCATE TABLE notes";
				$result8 = $mysqli->query($query8);
				$query9 = "TRUNCATE TABLE note_entry";
				$result9 = $mysqli->query($query9);
				$query10 = "TRUNCATE TABLE scouts";
				$result10 = $mysqli->query($query10);
				$query11 = "TRUNCATE TABLE regional";
				$result11 = $mysqli->query($query11);
				$query21 = "TRUNCATE TABLE team_performance";
				$result21 = $mysqli->query($query21);
			}
			else{
				echo "Nope!";
				
			}
		}
	}
	?>
		</div>
	

</div>
