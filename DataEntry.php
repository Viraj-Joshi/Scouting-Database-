<?php
//Make the Data Entry Form
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("db_connect.php");
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
//put querys here
	$query = "SELECT * FROM schedule";
	$result = $mysqli->query($query);
	
	$query2 = "SELECT * FROM scouts";
	$result2 = $mysqli->query($query2);

?>

<!--onsubmit="return validate_data_entry()"-->
	<div class="form_container">
		<form class="datafield" method="post" id="data_form" action="SubmitData.php">
	<h1 class="title">Data Entry</h1>	
			<!--<table><tr>
			<strong><h1 style="color:green">IN HONOR OF VIRAJ JOSHI</h1></strong>
					<td>Fouls(This dropdown isn't actually going to get entered into the database)</td>
				</tr>
				<tr>	
					<td>  you can suck it
					
						<select>
							<option name="Tech Foul" value="0">Tech Foul</option>
							<option name="G4"value="G4">G4(RED+YELLOW CARD)</option>
							<option name="G11"value="G11">G11(YELLOW CARD)</option>
							<option name="G12"value="G12">G12(MAYBE DISABLED)</option>
							<option name="G12-1"value="G12-1">G12-1</option>
							<option name="G13"value="G13">G13</option>
							<option name="G14"value="G12-1">G14(FOUL+YELLOW CARD)</option>
							<option name="G15"value="G15">G15</option>
							<option name="G15"value="G15">G15</option>
							<option name="G16"value="G16">G16</option>
							<option name="G17"value="G17">G17(MAYBE DISABLED)</option>
							<option name="G18"value="G18">G18(MAYBE DISABLED)</option>
							<option name="G20"value="G20">G20(Tech if repeated)</option>
							<option name="G21"value="G21">G21 Tech Foul</option>
							<option name="G22"value="G22">G22(RED CARD)</option>
							<option name="G23"value="G23">G23(YELLOW CARD)</option>
							<option name="G24"value="G24">G24(YELLOW CARD,RED CARD)</option>
							<option name="G26"value="G26">G26(TECH FOUL)</option>
							<option name="G27"value="G27">G27(TECH FOUL PER BOULDER)</option>
							<option name="G33"value="G33">G33(FOUL PER BOULDER)</option>
							<option name="G34"value="G34">G34(FOUL per excess BOULDER)</option>
							<option name="G36"value="G36">G36</option>
							<option name="G37"value="G37">G37(RED CARD)</option>
							<option name="G38"value="G38">G38(FOUL PER EXTRA BOULDER)</option>
							<option name="G39"value="G39">G39(TECH FOUL per BOULDER)</option>
							<option name="G40"value="G40">G40(TECH FOUL per BOULDER)</option>
							<option name="G40-1"value="G40-1">G40-1(TECH FOUL per additonal BOULDER)</option>
							<option name="G43"value="G43">G43</option>
							<option name="G44"value="G44">G44(FOUL+YELLOW CARD)</option>
							<option name="G45"value="G45">G45(TECH FOUL per BOULDER)</option>
							<option name="T10"value="T10">T10</option>
						</select>	
										
					</td> 
				</tr></table>-->	
			
		<div class="blackBox">
			<h2 class="DataTitle">Basic Data</h2>
			<table class="green">
				<p>If this is an Elimination Match:
				<br>Quarterfinal Match #'s are 101 and up
				<br>Semifinal Match #'s are 201 and up
				<br>Final Match #'s are 301 and up
				</p>
				<tr>
					<td></td>
					<td>Elimination Match?</td>
					<td>Match #</td>
					<td>Team #</td>
					<td>Scout ID</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="checkbox" name="elim_match" class="small_num" ></td>
					<td><input type="number" name="match_num" class="small_num" required></td>
					<td><input type="number" name="team_num" class="small_num" required></td>
					<td><input type="number" name="scoutID" class="small_num" required></td>
				</tr>
				
			</table>
			<br>
			<table class="green">
				<tr>
					<td>Defense 1</td>
					<td>Defense 2</td>
					<td>Defense 3</td>
					<td>Defense 4</td>
					<td>Defense 5</td>
				</tr>
				<tr>
					<td>Lowbar</td>
					<!--<td>
						<select name="def_category_2">
							<option name="def_category_A1"value="1">Portcullis</option>
							<option name="def_category_A2"value="2">Cheval de Frise</option>
							<option name="def_category_B1"value="3">Moat</option>
							<option name="def_category_B2"value="4">Ramparts</option>
							<option name="def_category_C1"value="5">Drawbridge</option>
							<option name="def_category_C2"value="6">Sally Port</option>
							<option name="def_category_D1"value="7">Rock Wall</option>
							<option name="def_category_D2"value="8">Rough Terrain</option>
						</select>
					</td>-->
					<td><input type="number" name="def_category_2" class="small_num" min=1 max=8 required></td>
					<td><input type="number" name="def_category_3" class="small_num" min=1 max=8 required></td>
					<td><input type="number" name="def_category_4" class="small_num" min=1 max=8 required></td>
					<td><input type="number" name="def_category_5" class="small_num" min=1 max=8 required></td>
					
				</tr>
			</table>
		</div>
			<br>
			
		<div class="blackBox">
			<table class="green">
			<h2 class="DataTitle">Autonomous</h2>
			<tr>
				<td></td>
				<td>Scored</td>
				<td>Miss</td>
			</tr>
			<tr>
				<td>Auto High</td>
				<td><input type="number" name="auto_High_Scored" class="small_num"></td>
				<td><input type="number" name="auto_High_Miss" class="small_num"></td>
			</tr>
			<tr>
				<td>Auto Low</td>
				<td><input type="number" name="auto_Low_Scored" class="small_num"></td>
				<td><input type="number" name="auto_Low_Miss"class="small_num"></td>
			</tr>
			</table>
			<br>
			<table class="green">
			<tr>
				<td></td>
				<td>Auto Defenses Reached</td>
				<td>Auto Defenses Crossed</td>
			</tr>
			<tr>
				<td>Sucess</td>
				<td><input type="number" name="auto_Defenses_Reached_Sucess" class="small_num"></td>
				<td><input type="number" name="auto_Defenses_Crossed_Sucess" class="small_num"></td>
			</tr>
			<tr>
				<td>Failed</td>
				<td><input type="number" name="auto_Defenses_Reached_Failed" class="small_num"></td>
				<td><input type="number" name="auto_Defenses_Crossed_Failed"class="small_num"></td>
			</tr>
			</table>
			<br>
			<table class="green">
			<tr>
				<td></td>
				<td>Start Location</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="number" name="auto_Start_Location" class="small_num" min=0 max=6 onfocus="if (this.value=='0') this.value = ''" value="0"required></td>
				
			</tr>
			<tr>
				<td></td>
				<td>Boulder Grab Sucess?</td>
				<td>Start With Boulder?</td>
			</tr>
			<tr>
				<td></td> 
				<td><input type="checkbox" name="Auto_Boulder_Grab" class="small_num" ></td>
				<td><input type="checkbox" name="Auto_StartWithBoulder" class="small_num" ></td>
			</tr>
			</table>
		</div>
			<br>
		<div class="blackBox">
			<table class="green">
			<h2 class="DataTitle">Teleop</h2>
				<tr>
					<td></td>
					<td>Defense 1</td>
					<td>Defense 2</td>
					<td>Defense 3</td>
					<td>Defense 4</td>
					<td>Defense 5</td>
				</tr>
				<tr>
					<td>Crossed</td>
					<td><input type="number" name="def_1_crossed" class="small_num"></td>
					<td><input type="number" name="def_2_crossed" class="small_num"></td>
					<td><input type="number" name="def_3_crossed" class="small_num"></td>
					<td><input type="number" name="def_4_crossed" class="small_num"></td>
					<td><input type="number" name="def_5_crossed" class="small_num"></td>
				</tr>
				<tr>
					<td>Weakened</td>
					<td><input type="number" name="def_1_weakened" class="small_num"></td>
					<td><input type="number" name="def_2_weakened" class="small_num"></td>
					<td><input type="number" name="def_3_weakened" class="small_num"></td>
					<td><input type="number" name="def_4_weakened" class="small_num"></td>
					<td><input type="number" name="def_5_weakened" class="small_num"></td>
				</tr>
				<tr>
					<td>Speed</td>
					<td><input type="number" name="def_1_speed" class="small_num"></td>
					<td><input type="number" name="def_2_speed" class="small_num"></td>
					<td><input type="number" name="def_3_speed" class="small_num"></td>
					<td><input type="number" name="def_4_speed" class="small_num"></td>
					<td><input type="number" name="def_5_speed" class="small_num"></td>
				</tr>
				<tr>
					<td>Stuck</td>
					<td><input type="number" name="def_1_stuck" class="small_num"></td>
					<td><input type="number" name="def_2_stuck" class="small_num"></td>
					<td><input type="number" name="def_3_stuck" class="small_num"></td>
					<td><input type="number" name="def_4_stuck" class="small_num"></td>
					<td><input type="number" name="def_5_stuck" class="small_num"></td>
				</tr>
				<!--<tr>
					<td>Ball? (Y/N)</td>
					<td><input type="checkbox" name="def_1_ball" class="small_num" ></td>
					<td><input type="checkbox" name="def_2_ball" class="small_num" ></td>
					<td><input type="checkbox" name="def_3_ball" class="small_num" ></td>
					<td><input type="checkbox" name="def_4_ball" class="small_num" ></td>
					<td><input type="checkbox" name="def_5_ball" class="small_num" ></td>
				</tr>-->
					
			</table>
		</div>
			<br>
			</table>
		<div class="blackBox">
			<h2 class="DataTitle">Shooting</h2>
				<tr>
					<td>
						<table class="green">
								<td></td>
								<td>Scored</td>
								<td>Miss</td>
							</tr>
							<tr>
								<td>Batter High Goal</td>
								<td><input type="number" name="batter_high_Scored" class="small_num"></td>
								<td><input type="number" name="batter_high_Miss" class="small_num"></td>
							</tr>
							<tr>
								<td>Batter Low Goal</td>
								<td><input type="number" name="batter_low_Scored" class="small_num"></td>
								<td><input type="number" name="batter_low_Miss" class="small_num"></td>
								
							</tr>
						</table>
						<br>
						<table class="green">
							<tr>
								<td></td>
								<td>Scored</td>
								<td>Miss</td>
							</tr>
							<tr>
								<td>Courtyard High Goal</td>
								<td><input type="number" name="courtyard_high_Scored" class="small_num"></td>
								<td><input type="number" name="courtyard_high_Miss" class="small_num"></td>
							</tr>
							<tr>
								<td>Courtyard Low Goal</td>
								<td><input type="number" name="courtyard_low_Scored" class="small_num"></td>
								<td><input type="number" name="courtyard_low_Miss" class="small_num"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<br>
		<div class="blackBox">
			<table  class="green">
			<h2 class="DataTitle">Climbing</h2>
				<tr>
					<td>
						<table>
							<tr>
								<td>Challenge Sucess?</td><td>Scaled Sucess?</td>
							</tr>
							<tr>
								<td><input type="checkbox" name="challenge_Sucess" class="small_num" ></td>
								<td><input type="checkbox" name="Scaled_Sucess" class="small_num" ></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<br>
		<div class="blackBox">
			<table class="green">
			<h2 class="DataTitle">Defense Commitment</h2>
				<tr>
					<td>% Time Spent Defending</td>
				</tr>
				<tr>
					<td>
					<!--
						<select name="defense" required>
							<option name="defending_0" value="0">0% Defense</option>
							<option name="defending_25"value="25"><25% Defense</option>
							<option name="defending_50"value="50">50% Defense</option>
							<option name="defending_>75"value="75">>75% Defense</option>
						</select>
						-->
						<input type="number"   name="defense" class="small_num"  min=0 max=100></input>
					</td>
				</tr>
			</table>
		</div>
		<br>
		<div class="blackBox">
			<table class="green">
			<h2 class="DataTitle">Robot Issues</h2>
				<tr>
					<td>No Show</td>
					<td><input type="checkbox" name="no_show"></input></td>
				</tr>
				<tr>
					<td>Mech Fail?</td>
					<td><input type="checkbox" name="mech_fail"></input></td>
				</tr>
				<tr>
					<td>Lost Comms</td>
					<td><input type="checkbox" name="lost_comms"></input></td>
				</tr>
				<tr>
					<td>Stuck</td>
					<td><input type="checkbox" name="stuck"></input></td>
				</tr>
				<tr>
					<td>Tipped</td>
					<td><input type="checkbox" name="tipped"></input></td>
				</tr>
				<tr>
					<td>Fouls</td><td>Tech Fouls</td>
					<!--<td><input type="checkbox" name="fouls"></input></td> -->
				</tr>
				<tr>
				
					<td><input type="number" name="fouls" class="slim"></input></td>
					<td><input type="number" name="tech_fouls" class="slim"></input></td>
				</tr>
				
			</table>
		</div>
			<br>
		<div class="blackBox">
			<table class="green">
			<h2 class="DataTitle">Driver Data</h2>
				<tr>
					<td>Driving</td>
					<td>Defense/Bullying</td>
					<td>Ball Control</td>
					<!--<td>Pushing</td>-->
				</tr>
				<tr>
					<td><input type="number" name="drive_manuverability" class="small_num" style="width:100%;" min=0 max=9></input></td>
					<!--<td><input type="number" name="pushing" style="width:100%;" class="small_num" min=0 max=9 onfocus="if (this.value=='0') this.value = ''" value="0"></input></td>-->
					<td><input type="number" name="Defense_Pushing" style="width:100%;" class="small_num" min=0 max=9></input></td>
					<td><input type="number" name="Ball_Control" style="width:100%;" class="small_num" min=0 max=9></input></td>
				</tr>
			</table>
		</div>
			<br>
		<div class="blackBox">
			
			<table class="green">
			<h2 class="DataTitle">Comments</h2>
				<tr>
					<td>Notes:</td>
					<td>Shooting Location:</td>
				</tr>
				<tr>
					<td><textarea rows=5 cols=30 name="notes"></textarea></td>
					<td><textarea rows=5 cols=20 name="shooting_location"></textarea></td>
				</tr>
			</table>
		</div>
			<br>
			<input type="submit" class="subButton" name="dataSubmit"></input>
		</form>
	</div>
	<br>


</div>
</div>
