<?php
//Submits data
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("db_connect.php");
include("DatabaseVerification.php");

?>
<head>	<link rel="stylesheet" type="text/css" href="css/mainpagestyle.css"> 
		<link rel="stylesheet" type="text/css" href="css/dataform.css">
</head>
<br>
<br>
<br>
<br>

<div class="page_container">
<br>
<br>

<?php
	if(isset($_POST['dataSubmit'])){
	//Basic Data	
	$matchNum=(int)$_POST['match_num'];
	$teamNum=(int)$_POST['team_num'];
	$scoutID=(int)$_POST['scoutID'];
	
	$def_category_2=(int)$_POST['def_category_2'];
	$def_category_3=(int)$_POST['def_category_3'];
	$def_category_4=(int)$_POST['def_category_4'];
	$def_category_5=(int)$_POST['def_category_5'];
	//Auton
	$auto_High_Scored=(int)$_POST['auto_High_Scored'];
	$auto_Low_Scored=(int)$_POST['auto_Low_Scored'];
	
	$auto_High_Miss=(int)$_POST['auto_High_Miss'];
	$auto_Low_Miss=(int)$_POST['auto_Low_Miss'];
	
	
	$auto_Defenses_Reached_Sucess=(int)$_POST['auto_Defenses_Reached_Sucess'];
	$auto_Defenses_Crossed_Sucess=(int)$_POST['auto_Defenses_Crossed_Sucess'];
	
	$auto_Defenses_Reached_Failed=(int)$_POST['auto_Defenses_Reached_Failed'];
	$auto_Defenses_Crossed_Failed=(int)$_POST['auto_Defenses_Crossed_Failed'];
	
	$auto_Start_Location=(int)$_POST['auto_Start_Location'];

	if($_POST['Auto_Boulder_Grab']=="on"){$Auto_Boulder_Grab=1;}
	if($_POST['Auto_StartWithBoulder']=="on"){$Auto_StartWithBoulder=1;}
	//Teleop
	$def_crossed_1=(int)$_POST['def_1_crossed'];
	$def_crossed_2=(int)$_POST['def_2_crossed'];
	$def_crossed_3=(int)$_POST['def_3_crossed'];
	$def_crossed_4=(int)$_POST['def_4_crossed'];
	$def_crossed_5=(int)$_POST['def_5_crossed'];
	
	$def_1_weakened=(int)$_POST['def_1_weakened'];
	$def_2_weakened=(int)$_POST['def_2_weakened'];
	$def_3_weakened=(int)$_POST['def_3_weakened'];
	$def_4_weakened=(int)$_POST['def_4_weakened'];
	$def_5_weakened=(int)$_POST['def_5_weakened'];

	$def_1_speed=(int)$_POST['def_1_speed'];
	$def_2_speed=(int)$_POST['def_2_speed'];
	$def_3_speed=(int)$_POST['def_3_speed'];
	$def_4_speed=(int)$_POST['def_4_speed'];
	$def_5_speed=(int)$_POST['def_5_speed'];
	
	$def_1_stuck=(int)$_POST['def_1_stuck'];
	$def_2_stuck=(int)$_POST['def_2_stuck'];
	$def_3_stuck=(int)$_POST['def_3_stuck'];
	$def_4_stuck=(int)$_POST['def_4_stuck'];
	$def_5_stuck=(int)$_POST['def_5_stuck'];
	
	/*if($_POST['def_1_ball']== "on"){$def_1_ball=1;}
	if($_POST['def_2_ball']== "on"){$def_2_ball=1;}
	if($_POST['def_3_ball']== "on"){$def_3_ball=1;}
	if($_POST['def_4_ball']== "on"){$def_4_ball=1;}
	if($_POST['def_5_ball']== "on"){$def_5_ball=1;}*/
	
	//Shooting variables
	$batter_high_Scored=(int)$_POST['batter_high_Scored'];
	$batter_low_Scored=(int)$_POST['batter_low_Scored'];
	$batter_high_Miss=(int)$_POST['batter_high_Miss'];
	$batter_low_Miss=(int)$_POST['batter_low_Miss'];
	$courtyard_high_Scored=(int)$_POST['courtyard_high_Scored'];
	$courtyard_low_Scored=(int)$_POST['courtyard_low_Scored'];
	$courtyard_high_Miss=(int)$_POST['courtyard_high_Miss'];
	$courtyard_low_Miss=(int)$_POST['courtyard_low_Miss'];
	//Climbing variables
	if($_POST['challenge_Sucess']== "on"){$challenge_Sucess=1;}
	if($_POST['Scaled_Sucess']== "on"){$Scaled_Sucess=1;}
	//Defense Rating
	/*
	if(($_POST['defense'] =='0')){$defense="0";}
	elseif(($_POST['defense'] =='25')){$defense="<25";}
	elseif(($_POST['defense'] =='50')){$defense="50";}
	elseif(($_POST['defense'] =='75')){$defense=">75";}*/
	$defense = (int)$_POST['defense'];
	
	//Robot Issues
	if($_POST['no_show']== "on"){$no_show=1;}
	if($_POST['mech_fail']== "on"){$mech_fail=1;}
	if($_POST['lost_comm']== "on"){$lost_comms=1;}
	if($_POST['stuck']== "on"){$stuck=1;}
	if($_POST['tipped']== "on"){$tipped=1;}
	$fouls=(int)$_POST['fouls'];
	$tech_fouls=(int)$_POST['tech_fouls'];
	//Driver Data
	$drive_manuverability=(int)$_POST['drive_manuverability'];
	//$pushing=(int)$_POST['pushing'];
	$Defense_Pushing=(int)$_POST['Defense_Pushing'];
	$Ball_Control=(int)$_POST['Ball_Control'];
	//Comments
	$notes = $mysqli->real_escape_string($_POST['notes']);
	$shooting_location = $mysqli->real_escape_string($_POST['shooting_location']);
	//$notes=$_POST['notes'];
	//$shooting_location=$_POST['shooting_location'];
	$elim = $_POST['elim_match'] == "on";
	//if($_POST['elim_match']== "on"){$elim=1;}
	//else{$elim=0;}
	//$elim=$_POST['elim_match'];
	//var_dump($elim);
	$verification_result=databaseVerification($mysqli,$matchNum,$teamNum,$scoutID,$def_category_2,$def_category_3,$def_category_4,$def_category_5,$elim);
	//var_dump($elim1);
	//var_dump($verification_result);
	//var_dump($teamMatchCheck_result);
	//var_dump($matchNum);
	if($verification_result){
	$query = "INSERT INTO match_data (match_number,team_number,scout_id,def_category_1,def_category_2,def_category_3,def_category_4,def_category_5,auto_High_Scored,auto_Low_Scored,auto_High_Miss,auto_Low_Miss,auto_Defenses_Reached_Sucess,auto_Defenses_Crossed_Sucess,auto_Defenses_Reached_Failed,auto_Defenses_Crossed_Failed,auto_Start_Location,Auto_Boulder_Grab,Auto_StartWithBoulder,def_1_crossed,def_2_crossed,def_3_crossed,def_4_crossed,def_5_crossed,def_1_weakened,def_2_weakened,def_3_weakened,def_4_weakened,def_5_weakened,def_1_speed,def_2_speed,def_3_speed,def_4_speed,def_5_speed,def_1_stuck,def_2_stuck,def_3_stuck,def_4_stuck,def_5_stuck,def_1_ball,def_2_ball,def_3_ball,def_4_ball,def_5_ball,batter_high_Scored,batter_low_Scored,batter_high_Miss,batter_low_Miss,courtyard_high_Scored,courtyard_low_Scored,courtyard_high_Miss,courtyard_low_Miss,challenge_Sucess,Scaled_Sucess,defense,no_show,mech_fail,lost_comms,stuck,tipped,fouls,tech_fouls,drive_manuverability,pushing,Defense_Pushing,Ball_Control,notes,shooting_location) 
					VALUES ('$matchNum','$teamNum','$scoutID',0,'$def_category_2','$def_category_3','$def_category_4','$def_category_5','$auto_High_Scored','$auto_Low_Scored','$auto_High_Miss','$auto_Low_Miss','$auto_Defenses_Reached_Sucess','$auto_Defenses_Crossed_Sucess','$auto_Defenses_Reached_Failed','$auto_Defenses_Crossed_Failed','$auto_Start_Location','$Auto_Boulder_Grab','$Auto_StartWithBoulder','$def_crossed_1','$def_crossed_2','$def_crossed_3','$def_crossed_4','$def_crossed_5','$def_1_weakened','$def_2_weakened','$def_3_weakened','$def_4_weakened','$def_5_weakened','$def_1_speed','$def_2_speed','$def_3_speed','$def_4_speed','$def_5_speed','$def_1_stuck','$def_2_stuck','$def_3_stuck','$def_4_stuck','$def_5_stuck','$def_1_ball','$def_2_ball','$def_3_ball','$def_4_ball','$def_5_ball','$batter_high_Scored','$batter_low_Scored','$batter_high_Miss','$batter_low_Miss','$courtyard_high_Scored','$courtyard_low_Scored','$courtyard_high_Miss','$courtyard_low_Miss','$challenge_Sucess','$Scaled_Sucess','$defense','$no_show','$mech_fail','$lost_comms','$stuck','$tipped','$fouls','$tech_fouls','$drive_manuverability','$pushing','$Defense_Pushing','$Ball_Control','$notes','$shooting_location')";
	$result = $mysqli->query($query);
	$query2 = "INSERT INTO notes (team,match_number,notes) VALUES ('$teamNum','$matchNum','$notes')";
	$result2 = $mysqli->query($query2);
?>
<div class="endBoxGood">
<?php
	if($result&&$result2) {
	echo"Successfully added info";
?>
	<br>
	<br>
	<a href="DataEntry.php" class="fakeButton">Go back to Entering Data</a>
	<br>
	<br>
	<br>
	<a href="index.php" class="fakeButton">Go back to the main site</a>
	<br>
	<br>
</div>
<?php	
	}
	else {
	printf("Errormessage: %s\n", $mysqli->error);
	}
	}
	else{
?>
<div class="endBoxBad">
<?php
		echo"<p>Entry <b>Failed</b> Validation,Try Again.</p>";
?>

	<br>
	<br>
	<a href="DataEntry.php" class="fakeButton">Go back to Entering Data</a>
	<br>
	<br>
	<br>
	<a href="index.php" class="fakeButton">Go back to the main site</a>
	<br>
	<br>
</div>
<?php
}
	}
	?>

