<?php
	//Match Display
	//Search for Teams and Matches
	include("HeadTemplate.php");
	include("UserVerification.php");
	include("kick_intruders.php");
	include("navbar.php");
	include("db_connect.php");
	include("api_connect.php");
	include("GetTeamData.php");
?>

<head>
	<link rel="stylesheet" type="text/css" href="css/NoteEntryStyle.css">
	<link rel="stylesheet" type="text/css" href="css/mainpagestyle.css">
	<link rel="stylesheet" type="text/css" href="css/SearchStyle.css"> 
</head>
<div class="page_container">
<br>
<br>
<form class="Searchforsearch" method="get" action="MatchInfoDisplay.php">
<br><br>
	<input type="number" name="match">
	<input type="checkbox" name="playoffs" style="width:30px;padding-top:10px"> <span style="color:#FFF">Playoffs?</span>
<br>
<br>
<input type="submit" value="Search" class="subButton">
</form>
<br>
<br>
<?php
	$match = $_GET['match'];
	$isPlayoff = $_GET['playoffs'] == "on";
	
	if(!$isPlayoff)
	{
		
?>
	<h1> Qualification Match <?php echo $match; ?> </h1>
	<?php
	}
	else
	{
?>
	<h1> Elimination Match <?php echo $match; ?> </h1>
<?php
	}
?>
	<?php
	
	$query1 = "SELECT * FROM schedule WHERE match_number='$match'";
	$result1 = $mysqli->query($query1);
	if ($result1->num_rows > 0) {
		
		?>
		<?php 
		// output data of each row
    while($row = $result1->fetch_assoc()) {
		$red1=$row["red_1"];
		$red2=$row["red_2"];
		$red3=$row["red_3"];
		$blue1=$row["blue_1"];
		$blue2=$row["blue_2"];
		$blue3=$row["blue_3"];
		?>
		<?php 
	$query2 = "SELECT * FROM teams WHERE number='$red1'";
	$result2 = $mysqli->query($query2);
	
	if ($result2->num_rows > 0){
	// output data of each row
    while($row1 = $result2->fetch_assoc()) {
			?>
		<?php 
	$query4 = "SELECT * FROM teams WHERE number='$red2'";
	$result4 = $mysqli->query($query4);
	
	if ($result4->num_rows > 0){
	// output data of each row
    while($row3 = $result4->fetch_assoc()) {
			?>
			<?php 
	$query6 = "SELECT * FROM teams WHERE number='$red3'";
	$result6 = $mysqli->query($query6);
	
	if ($result6->num_rows > 0){
	// output data of each row
    while($row5 = $result6->fetch_assoc()) {
			?>
			<?php 
	$query8 = "SELECT * FROM teams WHERE number='$blue1'";
	$result8 = $mysqli->query($query8);
	
	if ($result8->num_rows > 0){
	// output data of each row
    while($row7 = $result8->fetch_assoc()) {
			?>
			<?php 
	$query10 = "SELECT * FROM teams WHERE number='$blue2'";
	$result10 = $mysqli->query($query10);
	
	if ($result10->num_rows > 0){
	// output data of each row
    while($row9 = $result10->fetch_assoc()) {
			?>
			<?php 
	$query12 = "SELECT * FROM teams WHERE number='$blue3'";
	$result12 = $mysqli->query($query12);
	
	if ($result12->num_rows > 0){
	// output data of each row
    while($row11 = $result12->fetch_assoc()) {
			?>
			<?php
			
			$red1Info = getTeamData($mysqli,$red1);
			$red2Info = getTeamData($mysqli,$red2);
			$red3Info = getTeamData($mysqli,$red3);
			$blue1Info = getTeamData($mysqli,$blue1);
			$blue2Info = getTeamData($mysqli,$blue2);
			$blue3Info = getTeamData($mysqli,$blue3);
			//var_dump($red1Info);
			?>
	
	
<div class="matchDisplay">
    <table class="matchTable">
	<thead>
			<tr class="topRow">
			<th class="topTime">startTime</th>
			<td class='tim'><?php echo $row["time"];?></td>
			<th class="topTime" rowspan = "3" colspan = "1">Name</th>
			<th class="topTime" rowspan = "1" colspan = "4">Auto</th>
			<th class="topTime" rowspan = "1" colspan = "2">Teleop Shooting</th>
			<th class="topTime" rowspan = "1" colspan = "28">Defense</th>
			<th class="topTime" rowspan = "1" colspan = "2">Climbing</th>
			<th class="topTime" rowspan = "1" colspan = "7">Robot Issues</th>
			</tr>
			<tr class="topRow">
			<th id="oneline" class="topTime"rowspan = "2" colspan = "1">Alliance</th>
			<th class='topTime'rowspan = "2" colspan = "1">Team Number</th>
			<!--Auto-->
			<th class='topTime'rowspan = "2" colspan = "1">High Goal%</th>
			<th class='topTime'rowspan = "2" colspan = "1">Low Goal%</th>
			<th class='topTime'rowspan = "2" colspan = "1">Reached</th>
			<th class='topTime'rowspan = "2" colspan = "1">Crossed</th>
			<!--Teleop/Shooting-->
			<th class='topTime'rowspan = "2" colspan = "1">High Goal%</th>
			<th class='topTime'rowspan = "2" colspan = "1">Low Goal%</th>
			<!--Defense-->
			<th class='topTime'rowspan = "1" colspan = "3">Lowbar</th>
			<th class='topTime'rowspan = "1" colspan = "3">Portcullis</th>
			<th class='topTime'rowspan = "1" colspan = "3">Cheval de Frise</th>
			<th class='topTime'rowspan = "1" colspan = "3">Moat</th>
			<th class='topTime'rowspan = "1" colspan = "3">Ramparts</th>
			<th class='topTime'rowspan = "1" colspan = "3">Drawbridge</th>
			<th class='topTime'rowspan = "1" colspan = "3">Sally Port</th>
			<th class='topTime'rowspan = "1" colspan = "3">Rock Wall</th>
			<th class='topTime'rowspan = "1" colspan = "3">Rough Terrain</th>
			<th class='topTime'rowspan = "2" colspan = "1">Defense Rating</th>
			<!--Climbing-->
			<th class='topTime'rowspan = "2" colspan = "1">Challenge Sucess?</th>
			<th class='topTime'rowspan = "2" colspan = "1">Scaled Sucess?</th>
			<!--Robot Issues-->
			<th class='topTime'rowspan = "2" colspan = "1">No Show</th>
			<th class='topTime'rowspan = "2" colspan = "1">Mech Fail</th>
			<th class='topTime'rowspan = "2" colspan = "1">Lost Comms</th>
			<th class='topTime'rowspan = "2" colspan = "1">Stuck</th>
			<th class='topTime'rowspan = "2" colspan = "1">Tipped</th>
			<th class='topTime'rowspan = "2" colspan = "1">Fouls</th>
			<th class='topTime'rowspan = "2" colspan = "1">Tech Fouls</th>
	</tr>
	<tr>
		<!--Lowbar-->
		<th class='topTime'>Crossed</th>
		<th class='topTime'>Speed</th>
		<th class='topTime'>Stuck</th>
		<!--<th class='topTime'>Ball?</th>-->
		<!--Portcullis-->	
		<th class='topTime'>Crossed</th>
		<th class='topTime'>Speed</th>
		<th class='topTime'>Stuck</th>
		<!--<th class='topTime'>Ball?</th>-->
		<!--Cheval de Frise-->
		<th class='topTime'>Crossed</th>
		<th class='topTime'>Speed</th>
		<th class='topTime'>Stuck</th>
		<!--<th class='topTime'>Ball?</th>-->
		<!--Moat-->
		<th class='topTime'>Crossed</th>
		<th class='topTime'>Speed</th>
		<th class='topTime'>Stuck</th>
		<!--<th class='topTime'>Ball?</th>-->
		<!--Ramparts-->
		<th class='topTime'>Crossed</th>
		<th class='topTime'>Speed</th>
		<th class='topTime'>Stuck</th>
		<!--<th class='topTime'>Ball?</th>-->
		<!--Drawbridge-->
		<th class='topTime'>Crossed</th>
		<th class='topTime'>Speed</th>
		<th class='topTime'>Stuck</th>
		<!--<th class='topTime'>Ball?</th>-->
		<!--Sally Port-->
		<th class='topTime'>Crossed</th>
		<th class='topTime'>Speed</th>
		<th class='topTime'>Stuck</th>
		<!--<th class='topTime'>Ball?</th>-->
		<!--Rock Wall-->
		<th class='topTime'>Crossed</th>
		<th class='topTime'>Speed</th>
		<th class='topTime'>Stuck</th>
		<!--<th class='topTime'>Ball?</th>-->
		<!--Rough Terrain-->
		<th class='topTime'>Crossed</th>
		<th class='topTime'>Speed</th>
		<th class='topTime'>Stuck</th>
		<!--<th class='topTime'>Ball?</th>-->
		
	</tr>
		</thead>
			<tr class="topRow">
			<th class="TopRed">Red1</th>
			<th class='red'><a href="TeamInfoDisplay.php?team=<?=$red1;?>"><?php echo $red1;?></a></th>
			<th class='red'><?php echo $row1["name"];?></th>
			<th class='red'>
			<!--Auto-->
			<?php 
				if($red1Info["auto_high_total"] == 0){echo 0;}
				else{echo round($red1Info["auto_high"]/$red1Info["auto_high_total"]*100,0);}	
			?>%
			</th>
			<th class='red'>
			<?php 
				if($red1Info["auto_low_total"] == 0){echo 0;}
				else{echo round($red1Info["auto_low"]/$red1Info["auto_low_total"]*100,0);}	
			?>%
			</th>
			<th class='red'><?php echo $red1Info["auto_def_reach"];?></th>
			<th class='red'><?php echo $red1Info["auto_def_cross"];?></th>
			<th class='red'>
			<!--Teleop/Shooting---->
			<?php 
				if($red1Info["teleop_high_total"] == 0){echo 0;}
				else{echo round($red1Info["teleop_high"]/$red1Info["teleop_high_total"]*100,0);}	
			?>%
			</th>
			<th class='red'>
			<?php 
				if($red1Info["teleop_low_total"] == 0){echo 0;}
				else{echo round($red1Info["teleop_low"]/$red1Info["teleop_low_total"]*100,0);}
			?>%
			</th>
			<!--Lowbar-->
			<th class='red'><?=$red1Info['lowbar_cross']?></th>
			<th class='red'><?=$red1Info['lowbar_speed']?></th>
			<th class='red'><?=$red1Info['lowbar_stuck']?></th>
			<!--<th class='red'><?=$red1Info['lowbar_ball']?></th>-->
			<!--Portcullis-->
			<th class='red'><?=$red1Info['portcullis_cross']?></th>
			<th class='red'><?=$red1Info['portcullis_speed']?></th>
			<th class='red'><?=$red1Info['portcullis_stuck']?></th>
			<!--<th class='red'><?=$red1Info['portcullis_ball']?></th>-->
			<!--Cheval de Frise-->
			<th class='red'><?=$red1Info['chili_fries_cross']?></th>
			<th class='red'><?=$red1Info['chili_fries_speed']?></th>
			<th class='red'><?=$red1Info['chili_fries_stuck']?></th>
			<!--<th class='red'><?=$red1Info['chili_fries_ball']?></th>-->
			<!--Moat-->
			<th class='red'><?=$red1Info['moat_cross']?></th>
			<th class='red'><?=$red1Info['moat_speed']?></th>
			<th class='red'><?=$red1Info['moat_stuck']?></th>
			<!--<th class='red'><?=$red1Info['moat_ball']?></th>-->
			<!--Ramparts-->
			<th class='red'><?=$red1Info['ramparts_cross']?></th>
			<th class='red'><?=$red1Info['ramparts_speed']?></th>
			<th class='red'><?=$red1Info['ramparts_stuck']?></th>
			<!--<th class='red'><?=$red1Info['ramparts_ball']?></th>-->
			<!--Drawbridge-->
			<th class='red'><?=$red1Info['drawbridge_cross']?></th>
			<th class='red'><?=$red1Info['drawbridge_speed']?></th>
			<th class='red'><?=$red1Info['drawbridge_stuck']?></th>
			<!--<th class='red'><?=$red1Info['drawbridge_ball']?></th>-->
			<!--Sally Port-->
			<th class='red'><?=$red1Info['sally_port_cross']?></th>
			<th class='red'><?=$red1Info['sally_port_speed']?></th>
			<th class='red'><?=$red1Info['sally_port_stuck']?></th>
			<!--<th class='red'><?=$red1Info['sally_port_ball']?></th>-->
			<!--Rock Wall-->
			<th class='red'><?=$red1Info['rockwall_cross']?></th>
			<th class='red'><?=$red1Info['rockwall_speed']?></th>
			<th class='red'><?=$red1Info['rockwall_stuck']?></th>
			<!--<th class='red'><?=$red1Info['rockwall_ball']?></th>-->
			<!--Rough Terrain-->
			<th class='red'><?=$red1Info['rough_terrain_cross']?></th>
			<th class='red'><?=$red1Info['rough_terrain_speed']?></th>
			<th class='red'><?=$red1Info['rough_terrain_stuck']?></th>
			<!--<th class='red'><?=$red1Info['rough_terrain_ball']?></th>-->
			<!--Defense Rating-->
			<th class='red'><?=$red1Info['defense']?></th>
			<!--Climbing-->
			<th class='red'><?=$red1Info['challenge']?></th>
			<th class='red'><?=$red1Info['climbs']?></th>
			<!--Robot Issues-->
			<th class='red'><?=$red1Info['no_show']?></th>
			<th class='red'><?=$red1Info['mech_fail']?></th>
			<th class='red'><?=$red1Info['lost_comms']?></th>
			<th class='red'><?=$red1Info['stuck']?></th>
			<th class='red'><?=$red1Info['tipped']?></th>
			<th class='red'><?=$red1Info['fouls']?></th>
			<th class='red'><?=$red1Info['tech_fouls']?></th>
			</tr>
			<tr class="topRow">
			<th class="TopRed">Red2</th>
			<th class='red'><a href="TeamInfoDisplay.php?team=<?=$red2;?>"><?php echo $red2;?></a></th>
			<th class='red'><?php echo $row3["name"];?></th>
			<th class='red'>
			<!--Auto-->
			<?php 
				if($red2Info["auto_high_total"] == 0){echo 0;}
				else{echo round($red2Info["auto_high"]/$red2Info["auto_high_total"]*100,0);}	
			?>%
			</th>
			<th class='red'>
			<?php 
				if($red2Info["auto_low_total"] == 0){echo 0;}
				else{echo round($red2Info["auto_low"]/$red2Info["auto_low_total"]*100,0);}	
			?>%
			</th>
			<th class='red'><?php echo $red2Info["auto_def_reach"];?></th>
			<th class='red'><?php echo $red2Info["auto_def_cross"];?></th>
			<th class='red'>
			<!--Teleop/Shooting---->
			<?php 
				if($red2Info["teleop_high_total"] == 0){echo 0;}
				else{echo round($red2Info["teleop_high"]/$red2Info["teleop_high_total"]*100,0);}	
			?>%
			</th>
			<th class='red'>
			<?php 
				if($red2Info["teleop_low_total"] == 0){echo 0;}
				else{echo round($red2Info["teleop_low"]/$red2Info["teleop_low_total"]*100,0);}
			?>%
			</th>
			<!--Lowbar-->
			<th class='red'><?=$red2Info['lowbar_cross']?></th>
			<th class='red'><?=$red2Info['lowbar_speed']?></th>
			<th class='red'><?=$red2Info['lowbar_stuck']?></th>
			<!--<th class='red'><?=$red2Info['lowbar_ball']?></th>-->
			<!--Portcullis-->
			<th class='red'><?=$red2Info['portcullis_cross']?></th>
			<th class='red'><?=$red2Info['portcullis_speed']?></th>
			<th class='red'><?=$red2Info['portcullis_stuck']?></th>
			<!--<th class='red'><?=$red2Info['portcullis_ball']?></th>-->
			<!--Cheval de Frise-->
			<th class='red'><?=$red2Info['chili_fries_cross']?></th>
			<th class='red'><?=$red2Info['chili_fries_speed']?></th>
			<th class='red'><?=$red2Info['chili_fries_stuck']?></th>
			<!--<th class='red'><?=$red2Info['chili_fries_ball']?></th>-->
			<!--Moat-->
			<th class='red'><?=$red2Info['moat_cross']?></th>
			<th class='red'><?=$red2Info['moat_speed']?></th>
			<th class='red'><?=$red2Info['moat_stuck']?></th>
			<!--<th class='red'><?=$red2Info['moat_ball']?></th>-->
			<!--Ramparts-->
			<th class='red'><?=$red2Info['ramparts_cross']?></th>
			<th class='red'><?=$red2Info['ramparts_speed']?></th>
			<th class='red'><?=$red2Info['ramparts_stuck']?></th>
			<!--<th class='red'><?=$red2Info['ramparts_ball']?></th>-->
			<!--Drawbridge-->
			<th class='red'><?=$red2Info['drawbridge_cross']?></th>
			<th class='red'><?=$red2Info['drawbridge_speed']?></th>
			<th class='red'><?=$red2Info['drawbridge_stuck']?></th>
			<!--<th class='red'><?=$red2Info['drawbridge_ball']?></th>-->
			<!--Sally Port-->
			<th class='red'><?=$red2Info['sally_port_cross']?></th>
			<th class='red'><?=$red2Info['sally_port_speed']?></th>
			<th class='red'><?=$red2Info['sally_port_stuck']?></th>
			<!--<th class='red'><?=$red2Info['sally_port_ball']?></th>-->
			<!--Rock Wall-->
			<th class='red'><?=$red2Info['rockwall_cross']?></th>
			<th class='red'><?=$red2Info['rockwall_speed']?></th>
			<th class='red'><?=$red2Info['rockwall_stuck']?></th>
			<!--<th class='red'><?=$red2Info['rockwall_ball']?></th>-->
			<!--Rough Terrain-->
			<th class='red'><?=$red2Info['rough_terrain_cross']?></th>
			<th class='red'><?=$red2Info['rough_terrain_speed']?></th>
			<th class='red'><?=$red2Info['rough_terrain_stuck']?></th>
			<!--<th class='red'><?=$red2Info['rough_terrain_ball']?></th>-->
			<!--Defense Rating-->
			<th class='red'><?=$red2Info['defense']?></th>
			<!--Climbing-->
			<th class='red'><?=$red2Info['challenge']?></th>
			<th class='red'><?=$red2Info['climbs']?></th>
			<!--Robot Issues-->
			<th class='red'><?=$red2Info['no_show']?></th>
			<th class='red'><?=$red2Info['mech_fail']?></th>
			<th class='red'><?=$red2Info['lost_comms']?></th>
			<th class='red'><?=$red2Info['stuck']?></th>
			<th class='red'><?=$red2Info['tipped']?></th>
			<th class='red'><?=$red2Info['fouls']?></th>
			<th class='red'><?=$red2Info['tech_fouls']?></th>
			</tr>
			<tr class="topRow">
			<th class="TopRed">Red3</th>
			<th class='red'><a href="TeamInfoDisplay.php?team=<?=$red3;?>"><?php echo $red3;?></a></th>
			<th class='red'><?php echo $row5["name"];?></th>
			<th class='red'>
			<!--Auto-->
			<?php 
				if($red3Info["auto_high_total"] == 0){echo 0;}
				else{echo round($red3Info["auto_high"]/$red3Info["auto_high_total"]*100,0);}	
			?>%
			</th>
			<th class='red'>
			<?php 
				if($red3Info["auto_low_total"] == 0){echo 0;}
				else{echo round($red3Info["auto_low"]/$red3Info["auto_low_total"]*100,0);}	
			?>%
			</th>
			<th class='red'><?php echo $red3Info["auto_def_reach"];?></th>
			<th class='red'><?php echo $red3Info["auto_def_cross"];?></th>
			<th class='red'>
			<!--Teleop/Shooting---->
			<?php 
				if($red3Info["teleop_high_total"] == 0){echo 0;}
				else{echo round($red3Info["teleop_high"]/$red3Info["teleop_high_total"]*100,0);}	
			?>%
			</th>
			<th class='red'>
			<?php 
				if($red3Info["teleop_low_total"] == 0){echo 0;}
				else{echo round($red3Info["teleop_low"]/$red3Info["teleop_low_total"]*100,0);}
			?>%
			</th>
			<!--Lowbar-->
			<th class='red'><?=$red3Info['lowbar_cross']?></th>
			<th class='red'><?=$red3Info['lowbar_speed']?></th>
			<th class='red'><?=$red3Info['lowbar_stuck']?></th>
			<!--<th class='red'><?=$red3Info['lowbar_ball']?></th>-->
			<!--Portcullis-->
			<th class='red'><?=$red3Info['portcullis_cross']?></th>
			<th class='red'><?=$red3Info['portcullis_speed']?></th>
			<th class='red'><?=$red3Info['portcullis_stuck']?></th>
			<!--<th class='red'><?=$red3Info['portcullis_ball']?></th>-->
			<!--Cheval de Frise-->
			<th class='red'><?=$red3Info['chili_fries_cross']?></th>
			<th class='red'><?=$red3Info['chili_fries_speed']?></th>
			<th class='red'><?=$red3Info['chili_fries_stuck']?></th>
			<!--<th class='red'><?=$red3Info['chili_fries_ball']?></th>-->
			<!--Moat-->
			<th class='red'><?=$red3Info['moat_cross']?></th>
			<th class='red'><?=$red3Info['moat_speed']?></th>
			<th class='red'><?=$red3Info['moat_stuck']?></th>
			<!--<th class='red'><?=$red3Info['moat_ball']?></th>-->
			<!--Ramparts-->
			<th class='red'><?=$red3Info['ramparts_cross']?></th>
			<th class='red'><?=$red3Info['ramparts_speed']?></th>
			<th class='red'><?=$red3Info['ramparts_stuck']?></th>
			<!--<th class='red'><?=$red3Info['ramparts_ball']?></th>-->
			<!--Drawbridge-->
			<th class='red'><?=$red3Info['drawbridge_cross']?></th>
			<th class='red'><?=$red3Info['drawbridge_speed']?></th>
			<th class='red'><?=$red3Info['drawbridge_stuck']?></th>
			<!--<th class='red'><?=$red3Info['drawbridge_ball']?></th>-->
			<!--Sally Port-->
			<th class='red'><?=$red3Info['sally_port_cross']?></th>
			<th class='red'><?=$red3Info['sally_port_speed']?></th>
			<th class='red'><?=$red3Info['sally_port_stuck']?></th>
			<!--<th class='red'><?=$red3Info['sally_port_ball']?></th>-->
			<!--Rock Wall-->
			<th class='red'><?=$red3Info['rockwall_cross']?></th>
			<th class='red'><?=$red3Info['rockwall_speed']?></th>
			<th class='red'><?=$red3Info['rockwall_stuck']?></th>
			<!--<th class='red'><?=$red3Info['rockwall_ball']?></th>-->
			<!--Rough Terrain-->
			<th class='red'><?=$red3Info['rough_terrain_cross']?></th>
			<th class='red'><?=$red3Info['rough_terrain_speed']?></th>
			<th class='red'><?=$red3Info['rough_terrain_stuck']?></th>
			<!--<th class='red'><?=$red3Info['rough_terrain_ball']?></th>-->
			<!--Defense Rating-->
			<th class='red'><?=$red3Info['defense']?></th>
			<!--Climbing-->
			<th class='red'><?=$red3Info['challenge']?></th>
			<th class='red'><?=$red3Info['climbs']?></th>
			<!--Robot Issues-->
			<th class='red'><?=$red3Info['no_show']?></th>
			<th class='red'><?=$red3Info['mech_fail']?></th>
			<th class='red'><?=$red3Info['lost_comms']?></th>
			<th class='red'><?=$red3Info['stuck']?></th>
			<th class='red'><?=$red3Info['tipped']?></th>
			<th class='red'><?=$red3Info['fouls']?></th>
			<th class='red'><?=$red3Info['tech_fouls']?></th>
			</tr> 
			<tr class="topRow">
			<th class="TopBlue">Blue1</th>
			<th class='blue'><a href="TeamInfoDisplay.php?team=<?=$blue1;?>"><?php echo $blue1;?></a></th>
			<th class='blue'><?php echo $row7["name"];?></th>
			<th class='blue'>
			<!--Auto-->
			<?php 
				if($blue1Info["auto_high_total"] == 0){echo 0;}
				else{echo round($blue1Info["auto_high"]/$blue1Info["auto_high_total"]*100,0);}	
			?>%
			</th>
			<th class='blue'>
			<?php 
				if($blue1Info["auto_low_total"] == 0){echo 0;}
				else{echo round($blue1Info["auto_low"]/$blue1Info["auto_low_total"]*100,0);}	
			?>%
			</th>
			<th class='blue'><?php echo $blue1Info["auto_def_reach"];?></th>
			<th class='blue'><?php echo $blue1Info["auto_def_cross"];?></th>
			<th class='blue'>
			<!--Teleop/Shooting---->
			<?php 
				if($blue1Info["teleop_high_total"] == 0){echo 0;}
				else{echo round($blue1Info["teleop_high"]/$blue1Info["teleop_high_total"]*100,0);}	
			?>%
			</th>
			<th class='blue'>
			<?php 
				if($blue1Info["teleop_low_total"] == 0){echo 0;}
				else{echo round($blue1Info["teleop_low"]/$blue1Info["teleop_low_total"]*100,0);}
			?>%
			</th>
			<!--Lowbar-->
			<th class='blue'><?=$blue1Info['lowbar_cross']?></th>
			<th class='blue'><?=$blue1Info['lowbar_speed']?></th>
			<th class='blue'><?=$blue1Info['lowbar_stuck']?></th>
			<!--<th class='blue'><?=$blue1Info['lowbar_ball']?></th>-->
			<!--Portcullis-->
			<th class='blue'><?=$blue1Info['portcullis_cross']?></th>
			<th class='blue'><?=$blue1Info['portcullis_speed']?></th>
			<th class='blue'><?=$blue1Info['portcullis_stuck']?></th>
			<!--<th class='blue'><?=$blue1Info['portcullis_ball']?></th>-->
			<!--Cheval de Frise-->
			<th class='blue'><?=$blue1Info['chili_fries_cross']?></th>
			<th class='blue'><?=$blue1Info['chili_fries_speed']?></th>
			<th class='blue'><?=$blue1Info['chili_fries_stuck']?></th>
			<!--<th class='blue'><?=$blue1Info['chili_fries_ball']?></th>-->
			<!--Moat-->
			<th class='blue'><?=$blue1Info['moat_cross']?></th>
			<th class='blue'><?=$blue1Info['moat_speed']?></th>
			<th class='blue'><?=$blue1Info['moat_stuck']?></th>
			<!--<th class='blue'><?=$blue1Info['moat_ball']?></th>-->
			<!--Ramparts-->
			<th class='blue'><?=$blue1Info['ramparts_cross']?></th>
			<th class='blue'><?=$blue1Info['ramparts_speed']?></th>
			<th class='blue'><?=$blue1Info['ramparts_stuck']?></th>
			<!--<th class='blue'><?=$blue1Info['ramparts_ball']?></th>-->
			<!--Drawbridge-->
			<th class='blue'><?=$blue1Info['drawbridge_cross']?></th>
			<th class='blue'><?=$blue1Info['drawbridge_speed']?></th>
			<th class='blue'><?=$blue1Info['drawbridge_stuck']?></th>
			<!--<th class='blue'><?=$blue1Info['drawbridge_ball']?></th>-->
			<!--Sally Port-->
			<th class='blue'><?=$blue1Info['sally_port_cross']?></th>
			<th class='blue'><?=$blue1Info['sally_port_speed']?></th>
			<th class='blue'><?=$blue1Info['sally_port_stuck']?></th>
			<!--<th class='blue'><?=$blue1Info['sally_port_ball']?></th>-->
			<!--Rock Wall-->
			<th class='blue'><?=$blue1Info['rockwall_cross']?></th>
			<th class='blue'><?=$blue1Info['rockwall_speed']?></th>
			<th class='blue'><?=$blue1Info['rockwall_stuck']?></th>
			<!--<th class='blue'><?=$blue1Info['rockwall_ball']?></th>-->
			<!--Rough Terrain-->
			<th class='blue'><?=$blue1Info['rough_terrain_cross']?></th>
			<th class='blue'><?=$blue1Info['rough_terrain_speed']?></th>
			<th class='blue'><?=$blue1Info['rough_terrain_stuck']?></th>
			<!--<th class='blue'><?=$blue1Info['rough_terrain_ball']?></th>-->
			<!--Defense Rating-->
			<th class='blue'><?=$blue1Info['defense']?></th>
			<!--Climbing-->
			<th class='blue'><?=$blue1Info['challenge']?></th>
			<th class='blue'><?=$blue1Info['climbs']?></th>
			<!--Robot Issues-->
			<th class='blue'><?=$blue1Info['no_show']?></th>
			<th class='blue'><?=$blue1Info['mech_fail']?></th>
			<th class='blue'><?=$blue1Info['lost_comms']?></th>
			<th class='blue'><?=$blue1Info['stuck']?></th>
			<th class='blue'><?=$blue1Info['tipped']?></th>
			<th class='blue'><?=$blue1Info['fouls']?></th>
			<th class='blue'><?=$blue1Info['tech_fouls']?></th>
			</tr>
			<tr class="topRow">
			<th class="TopBlue">Blue2</th>
			<th class='blue'><a href="TeamInfoDisplay.php?team=<?=$blue2;?>"><?php echo $blue2;?></a></th>
			<th class='blue'><?php echo $row9["name"];?></th>
			<th class='blue'>
			<!--Auto-->
			<?php 
				if($blue2Info["auto_high_total"] == 0){echo 0;}
				else{echo round($blue2Info["auto_high"]/$blue2Info["auto_high_total"]*100,0);}	
			?>%
			</th>
			<th class='blue'>
			<?php 
				if($blue2Info["auto_low_total"] == 0){echo 0;}
				else{echo round($blue2Info["auto_low"]/$blue2Info["auto_low_total"]*100,0);}	
			?>%
			</th>
			<th class='blue'><?php echo $blue2Info["auto_def_reach"];?></th>
			<th class='blue'><?php echo $blue2Info["auto_def_cross"];?></th>
			<th class='blue'>
			<!--Teleop/Shooting---->
			<?php 
				if($blue2Info["teleop_high_total"] == 0){echo 0;}
				else{echo round($blue2Info["teleop_high"]/$blue2Info["teleop_high_total"]*100,0);}	
			?>%
			</th>
			<th class='blue'>
			<?php 
				if($blue2Info["teleop_low_total"] == 0){echo 0;}
				else{echo round($blue2Info["teleop_low"]/$blue2Info["teleop_low_total"]*100,0);}
			?>%
			</th>
			<!--Lowbar-->
			<th class='blue'><?=$blue2Info['lowbar_cross']?></th>
			<th class='blue'><?=$blue2Info['lowbar_speed']?></th>
			<th class='blue'><?=$blue2Info['lowbar_stuck']?></th>
			<!--<th class='blue'><?=$blue2Info['lowbar_ball']?></th>-->
			<!--Portcullis-->
			<th class='blue'><?=$blue2Info['portcullis_cross']?></th>
			<th class='blue'><?=$blue2Info['portcullis_speed']?></th>
			<th class='blue'><?=$blue2Info['portcullis_stuck']?></th>
			<!--<th class='blue'><?=$blue2Info['portcullis_ball']?></th>-->
			<!--Cheval de Frise-->
			<th class='blue'><?=$blue2Info['chili_fries_cross']?></th>
			<th class='blue'><?=$blue2Info['chili_fries_speed']?></th>
			<th class='blue'><?=$blue2Info['chili_fries_stuck']?></th>
			<!--<th class='blue'><?=$blue2Info['chili_fries_ball']?></th>-->
			<!--Moat-->
			<th class='blue'><?=$blue2Info['moat_cross']?></th>
			<th class='blue'><?=$blue2Info['moat_speed']?></th>
			<th class='blue'><?=$blue2Info['moat_stuck']?></th>
			<!--<th class='blue'><?=$blue2Info['moat_ball']?></th>-->
			<!--Ramparts-->
			<th class='blue'><?=$blue2Info['ramparts_cross']?></th>
			<th class='blue'><?=$blue2Info['ramparts_speed']?></th>
			<th class='blue'><?=$blue2Info['ramparts_stuck']?></th>
			<!--<th class='blue'><?=$blue2Info['ramparts_ball']?></th>-->
			<!--Drawbridge-->
			<th class='blue'><?=$blue2Info['drawbridge_cross']?></th>
			<th class='blue'><?=$blue2Info['drawbridge_speed']?></th>
			<th class='blue'><?=$blue2Info['drawbridge_stuck']?></th>
			<!--<th class='blue'><?=$blue2Info['drawbridge_ball']?></th>-->
			<!--Sally Port-->
			<th class='blue'><?=$blue2Info['sally_port_cross']?></th>
			<th class='blue'><?=$blue2Info['sally_port_speed']?></th>
			<th class='blue'><?=$blue2Info['sally_port_stuck']?></th>
			<!--<th class='blue'><?=$blue2Info['sally_port_ball']?></th>-->
			<!--Rock Wall-->
			<th class='blue'><?=$blue2Info['rockwall_cross']?></th>
			<th class='blue'><?=$blue2Info['rockwall_speed']?></th>
			<th class='blue'><?=$blue2Info['rockwall_stuck']?></th>
			<!--<th class='blue'><?=$blue2Info['rockwall_ball']?></th>-->
			<!--Rough Terrain-->
			<th class='blue'><?=$blue2Info['rough_terrain_cross']?></th>
			<th class='blue'><?=$blue2Info['rough_terrain_speed']?></th>
			<th class='blue'><?=$blue2Info['rough_terrain_stuck']?></th>
			<!--<th class='blue'><?=$blue2Info['rough_terrain_ball']?></th>-->
			<!--Defense Rating-->
			<th class='blue'><?=$blue2Info['defense']?></th>
			<!--Climbing-->
			<th class='blue'><?=$blue2Info['challenge']?></th>
			<th class='blue'><?=$blue2Info['climbs']?></th>
			<!--Robot Issues-->
			<th class='blue'><?=$blue2Info['no_show']?></th>
			<th class='blue'><?=$blue2Info['mech_fail']?></th>
			<th class='blue'><?=$blue2Info['lost_comms']?></th>
			<th class='blue'><?=$blue2Info['stuck']?></th>
			<th class='blue'><?=$blue2Info['tipped']?></th>
			<th class='blue'><?=$blue2Info['fouls']?></th>
			<th class='blue'><?=$blue2Info['tech_fouls']?></th>
			</tr>
			<tr class="topRow">
			<th class="TopBlue">Blue3</th>
			<th class='blue'><a href="TeamInfoDisplay.php?team=<?=$blue3;?>"><?php echo $blue3;?></a></th>
			<th class='blue'><?php echo $row11["name"];?></th>
			<th class='blue'>
			<!--Auto-->
			<?php 
				if($blue3Info["auto_high_total"] == 0){echo 0;}
				else{echo round($blue3Info["auto_high"]/$blue3Info["auto_high_total"]*100,0);}	
			?>%
			</th>
			<th class='blue'>
			<?php 
				if($blue3Info["auto_low_total"] == 0){echo 0;}
				else{echo round($blue3Info["auto_low"]/$blue3Info["auto_low_total"]*100,0);}	
			?>%
			</th>
			<th class='blue'><?php echo $blue3Info["auto_def_reach"];?></th>
			<th class='blue'><?php echo $blue3Info["auto_def_cross"];?></th>
			<th class='blue'>
			<!--Teleop/Shooting---->
			<?php 
				if($blue3Info["teleop_high_total"] == 0){echo 0;}
				else{echo round($blue3Info["teleop_high"]/$blue3Info["teleop_high_total"]*100,0);}	
			?>%
			</th>
			<th class='blue'>
			<?php 
				if($blue3Info["teleop_low_total"] == 0){echo 0;}
				else{echo round($blue3Info["teleop_low"]/$blue3Info["teleop_low_total"]*100,0);}
			?>%
			</th>
			<!--Lowbar-->
			<th class='blue'><?=$blue3Info['lowbar_cross']?></th>
			<th class='blue'><?=$blue3Info['lowbar_speed']?></th>
			<th class='blue'><?=$blue3Info['lowbar_stuck']?></th>
			<!--<th class='blue'><?=$blue3Info['lowbar_ball']?></th>-->
			<!--Portcullis-->
			<th class='blue'><?=$blue3Info['portcullis_cross']?></th>
			<th class='blue'><?=$blue3Info['portcullis_speed']?></th>
			<th class='blue'><?=$blue3Info['portcullis_stuck']?></th>
			<!--<th class='blue'><?=$blue3Info['portcullis_ball']?></th>-->
			<!--Cheval de Frise-->
			<th class='blue'><?=$blue3Info['chili_fries_cross']?></th>
			<th class='blue'><?=$blue3Info['chili_fries_speed']?></th>
			<th class='blue'><?=$blue3Info['chili_fries_stuck']?></th>
			<!--<th class='blue'><?=$blue3Info['chili_fries_ball']?></th>-->
			<!--Moat-->
			<th class='blue'><?=$blue3Info['moat_cross']?></th>
			<th class='blue'><?=$blue3Info['moat_speed']?></th>
			<th class='blue'><?=$blue3Info['moat_stuck']?></th>
			<!--<th class='blue'><?=$blue3Info['moat_ball']?></th>-->
			<!--Ramparts-->
			<th class='blue'><?=$blue3Info['ramparts_cross']?></th>
			<th class='blue'><?=$blue3Info['ramparts_speed']?></th>
			<th class='blue'><?=$blue3Info['ramparts_stuck']?></th>
			<!--<th class='blue'><?=$blue3Info['ramparts_ball']?></th>-->
			<!--Drawbridge-->
			<th class='blue'><?=$blue3Info['drawbridge_cross']?></th>
			<th class='blue'><?=$blue3Info['drawbridge_speed']?></th>
			<th class='blue'><?=$blue3Info['drawbridge_stuck']?></th>
			<!--<th class='blue'><?=$blue3Info['drawbridge_ball']?></th>-->
			<!--Sally Port-->
			<th class='blue'><?=$blue3Info['sally_port_cross']?></th>
			<th class='blue'><?=$blue3Info['sally_port_speed']?></th>
			<th class='blue'><?=$blue3Info['sally_port_stuck']?></th>
			<!--<th class='blue'><?=$blue3Info['sally_port_ball']?></th>-->
			<!--Rock Wall-->
			<th class='blue'><?=$blue3Info['rockwall_cross']?></th>
			<th class='blue'><?=$blue3Info['rockwall_speed']?></th>
			<th class='blue'><?=$blue3Info['rockwall_stuck']?></th>
			<!--<th class='blue'><?=$blue3Info['rockwall_ball']?></th>-->
			<!--Rough Terrain-->
			<th class='blue'><?=$blue3Info['rough_terrain_cross']?></th>
			<th class='blue'><?=$blue3Info['rough_terrain_speed']?></th>
			<th class='blue'><?=$blue3Info['rough_terrain_stuck']?></th>
			<!--<th class='blue'><?=$blue3Info['rough_terrain_ball']?></th>-->
			<!--Defense Rating-->
			<th class='blue'><?=$blue3Info['defense']?></th>
			<!--Climbing-->
			<th class='blue'><?=$blue3Info['challenge']?></th>
			<th class='blue'><?=$blue3Info['climbs']?></th>
			<!--Robot Issues-->
			<th class='blue'><?=$blue3Info['no_show']?></th>
			<th class='blue'><?=$blue3Info['mech_fail']?></th>
			<th class='blue'><?=$blue3Info['lost_comms']?></th>
			<th class='blue'><?=$blue3Info['stuck']?></th>
			<th class='blue'><?=$blue3Info['tipped']?></th>
			<th class='blue'><?=$blue3Info['fouls']?></th>
			<th class='blue'><?=$blue3Info['tech_fouls']?></th>
			</tr>
	</table>
</div>	
<br><br><br>
<?php
				
					
		}
	}
		?>
<?php
				
					
		}
	}
		?>
<?php
				
					
		}
	}
		?>
<?php
				
					
		}
	}
		?>
<?php
				
					
		}
	}
		?>
<?php
				
					
		}
	}
		?>
	<?php
    }
	
}
	?>
<div>