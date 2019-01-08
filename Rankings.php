<?php
//Rankings
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("read_ini.php");
include("db_connect.php");
include("api_connect.php");

	//$query2 = "SELECT * FROM teams";
	//$result2 = $mysqli->query($query2);
	//$reg = $query2['regional'];
	
	$reg_code = $mysqli->query("SELECT * FROM `regional` LIMIT 1");
	$row = $reg_code->fetch_array(MYSQLI_ASSOC);
	
	$key = $row["eventCode"];

	//NEW API CALL FOR 2.0
	//$url = "https://frc-api.firstinspires.org/v2.0/2016/rankings/SCMB";
	$url = "https://frc-api.firstinspires.org/v2.0/2016/rankings/" . $key;
	$response = file_get_contents($url,false,$context);
	
	//hint: use json_decode to decode $response. Look it up.

?>
<head>	<link rel="stylesheet" type="text/css" href="css/RankingsStyle.css"> 


</head>
<br>
<br>
<br>
<br>
<div class = "title" >
	<h1> Rankings </h1>
</div>
	
	<table class = "rankingsTable">

		<tr class="THead">
			<th>Rank</th>
			<th>Team Number</th>
			<th>Qual Average</th>
			<th>Auto Points</th>
			<th>Defense Points</th>
			<th>Low & high goal Points</th>
			<th>scale & challenge Points</th>
			<th>Wins</th>
			<th>Losses</th>
			<th>Ties</th>
			<th>DQ</th>
			<th>Matches Played</th>
		</tr>
<!--<pre>-->
	<?php
		//mysqli_select_db($mysqli,"mynewdatabase3");
		$json = json_decode($response, true);
		//echo json_encode($json/*, JSON_PRETTY_PRINT*/);  /use this for unformatted json 
		//var_dump($json);//use this if you want to see if you are getting all the elements from the API url
		foreach ($json as $rank)
		{
			foreach ($rank as $team)
			{
				//var_dump($team);
				$roast = $team["rank"];
				$teamNumber = $team["teamNumber"];
				$qualAverage = $team["qualAverage"];
				$rankScore = $team["sortOrder1"];
				$autoPoints = $team["sortOrder2"];
				$defensePoints = $team['sortOrder5'];
				$goalPoints = $team["sortOrder4"];
				$scalePoints = $team["sortOrder3"];
				$wins = $team["wins"];
				$losses = $team["losses"];
				$ties = $team["ties"];
				$dq = $team["dq"];
				$matchesPlayed = $team["matchesPlayed"];
				
				/*$sql="INSERT INTO teamatevents2(teamNumber,rank,qualAverage,autoPoints,containerPoints,coopertitionPoints,litterPoints,totePoints,wins,losses,ties)
				VALUES('$teamNumber','$roast','$qualAverage',$autoPoints,'$containerPoints',$coopertitionPoints,'$litterPoints','$totePoints','$wins','$losses','$ties')";
				
					$result=mysqli_query($mysqli,$sql);
					if(!$result){
					echo 'Fail';
				} else{
					echo 'Sucess420';
				}*/

					
				
	?>
	<!--</pre>-->
					<tr class="bodyRow">
						<td class="body"><b><?php echo $roast; ?></b></td> 
						<td class="body"><a href="TeamInfoDisplay.php?team=<?=$teamNumber;?>"><?php echo $teamNumber; ?></a></td>
						<td class="body"><?php echo $qualAverage; ?></td> 
						<td class="body"><?php echo $autoPoints; ?></td> 
						<td class="body"><?php echo $defensePoints; ?></td> 
						<td class="body"><?php echo $goalPoints; ?></td>
						<td class="body"><?php echo $scalePoints; ?></td> 
						<td class="body"><?php echo $wins; ?></td> 
						<td class="body"><?php echo $losses; ?></td> 
						<td class="body"><?php echo $ties; ?></td> 
						<td class="body"><?php echo $dq; ?></td>
						<td class="body"><?php echo $matchesPlayed; ?></td> 
					</tr>
					<?php
			}
		}
	?>
	</table>
<br>