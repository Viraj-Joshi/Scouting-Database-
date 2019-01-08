<?php
//Raw Data
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("read_ini.php");
include("db_connect.php");

?>
<head>	<link rel="stylesheet" type="text/css" href="css/raw_data.css"> </head>
<br>
<br>
<br>
<br>
<div class="title">
	<h1>Raw Data</h1>
</div>
<div class="page_container">
	<div class="raw_data">
		<table class="rawTable">
			<tr class="rawTopRow">
				<!-- Put Column Headers Here -->
				<td class="rawTop"><p class="rawP">ID</P></td>
				<td class="rawTop"><p class="rawP">Match #</P></td>
				<td class="rawTop"><p class="rawP">Team #</P></td>
				<td class="rawTop"><p class="rawP">Scout ID</P></td>
				<td class="rawTop"><p class="rawP">Defense Category 1</P></td>
				<td class="rawTop"><p class="rawP">Defense Category 2</P></td>
				<td class="rawTop"><p class="rawP">Defense Category 3</P></td>
				<td class="rawTop"><p class="rawP">Defense Category 4</P></td>
				<td class="rawTop"><p class="rawP">Defense Category 5</P></td>
				<td class="rawTop"><p class="rawP">Auto High Scored</P></td>
				<td class="rawTop"><p class="rawP">Auto Low Scored</P></td>
				<td class="rawTop"><p class="rawP">Auto High Missed</P></td>
				<td class="rawTop"><p class="rawP">Auto Low Missed</P></td>
				<td class="rawTop"><p class="rawP">Auto defensed Reached</P></td>
				<td class="rawTop"><p class="rawP">Auto Defensed Crossed</P></td>
				<td class="rawTop"><p class="rawP">Auto Defensed Reached Failed</P></td>
				<td class="rawTop"><p class="rawP">Auto Defensed Crossed Failed</P></td>
				<td class="rawTop"><p class="rawP">Auto Starting Location</P></td>
				<td class="rawTop"><p class="rawP">Auto Start With Boulder</P></td>
				<td class="rawTop"><p class="rawP">Auto Boulder Grabbed</P></td>
				<td class="rawTop"><p class="rawP">Defense Crossed 1</P></td>
				<td class="rawTop"><p class="rawP">Defense Crossed 2</P></td>
				<td class="rawTop"><p class="rawP">Defense Crossed 3</P></td>
				<td class="rawTop"><p class="rawP">Defense Crossed 4</P></td>
				<td class="rawTop"><p class="rawP">Defense Crossed 5</P></td>
				<td class="rawTop"><p class="rawP">Defense Weakened 1</P></td>
				<td class="rawTop"><p class="rawP">Defense Weakened 2</P></td>
				<td class="rawTop"><p class="rawP">Defense Weakened 3</P></td>
				<td class="rawTop"><p class="rawP">Defense Weakened 4</P></td>
				<td class="rawTop"><p class="rawP">Defense Weakened 5</P></td>
				<td class="rawTop"><p class="rawP">Defense Speed 1</P></td>
				<td class="rawTop"><p class="rawP">Defense Speed 2</P></td>
				<td class="rawTop"><p class="rawP">Defense Speed 3</P></td>
				<td class="rawTop"><p class="rawP">Defense Speed 4</P></td>
				<td class="rawTop"><p class="rawP">Defense Speed 5</P></td>
				<td class="rawTop"><p class="rawP">Defense Stuck 1</P></td>
				<td class="rawTop"><p class="rawP">Defense Stuck 2</P></td>
				<td class="rawTop"><p class="rawP">Defense Stuck 3</P></td>
				<td class="rawTop"><p class="rawP">Defense Stuck 4</P></td>
				<td class="rawTop"><p class="rawP">Defense Stuck 5</P></td>
				<!--<td class="rawTop"><p class="rawP">Defense With Ball 1</P></td>
				<td class="rawTop"><p class="rawP">Defense With Ball 2</P></td>
				<td class="rawTop"><p class="rawP">Defense With Ball 3</P></td>
				<td class="rawTop"><p class="rawP">Defense With Ball 4</P></td>
				<td class="rawTop"><p class="rawP">Defense With Ball 5</P></td>-->
				<td class="rawTop"><p class="rawP">Batter High Scored</P></td>
				<td class="rawTop"><p class="rawP">Batter Low Scored</P></td>
				<td class="rawTop"><p class="rawP">Batter High Missed</P></td>
				<td class="rawTop"><p class="rawP">Batter Low Missed</P></td>
				<td class="rawTop"><p class="rawP">Courtyard High Scored</P></td>
				<td class="rawTop"><p class="rawP">Courtyard Low Scored</P></td>
				<td class="rawTop"><p class="rawP">Courtyard High Missed</P></td>
				<td class="rawTop"><p class="rawP">Courtyard Low Missed</P></td>
				<td class="rawTop"><p class="rawP">Challenged Suceed</P></td>
				<td class="rawTop"><p class="rawP">Scaled Suceed</P></td>
				<td class="rawTop"><p class="rawP">Defense Rating</P></td>
				<td class="rawTop"><p class="rawP">No Show?</P></td>
				<td class="rawTop"><p class="rawP">Mechanical Failure?</P></td>
				<td class="rawTop"><p class="rawP">Lost Comms?</P></td>
				<td class="rawTop"><p class="rawP">Got Stuck?</P></td>
				<td class="rawTop"><p class="rawP">Got Tipped Over</P></td>
				<td class="rawTop"><p class="rawP">Fouls?</P></td>
				<td class="rawTop"><p class="rawP">Tech Fouls?</P></td>
				<td class="rawTop"><p class="rawP">Driving Manuverability</P></td>
				<td class="rawTop"><p class="rawP">Defense Pushing</P></td>
				<td class="rawTop"><p class="rawP">Ball Control</P></td>
			</tr>
			<?php
			
				$query = "SELECT * FROM match_data";
				$result = $mysqli->query($query);
				
				foreach($result as $row)
				{
					?>
					<tr class="rawZebra">
						<td class="rawBody"><?=$row["id"];?></td>
						<td class="rawBody"><?=$row['match_number'];?></td>
						<td class="rawBody"><?=$row['team_number'];?></td>
						<td class="rawBody"><?=$row['scout_id'];?></td>	
						<td class="rawBody"><?=$row['def_category_1'];?></td>
						<td class="rawBody"><?=$row['def_category_2'];?></td>
						<td class="rawBody"><?=$row['def_category_3'];?></td>
						<td class="rawBody"><?=$row['def_category_4'];?></td>
						<td class="rawBody"><?=$row['def_category_5'];?></td>
						<td class="rawBody"><?=$row['auto_High_Scored'];?></td>
						<td class="rawBody"><?=$row['auto_Low_Scored'];?></td>
						<td class="rawBody"><?=$row['auto_High_Miss'];?></td>
						<td class="rawBody"><?=$row['auto_Low_Miss'];?></td>
						<td class="rawBody"><?=$row['auto_Defenses_Reached_Sucess'];?></td>
						<td class="rawBody"><?=$row['auto_Defenses_Crossed_Sucess'];?></td>
						<td class="rawBody"><?=$row['auto_Defenses_Reached_Failed'];?></td>
						<td class="rawBody"><?=$row['auto_Defenses_Crossed_Failed'];?></td>
						<td class="rawBody"><?=$row['auto_Start_Location'];?></td>
						<td class="rawBody"><?=$row['Auto_StartWithBoulder'];?></td>
						<td class="rawBody"><?=$row['Auto_Boulder_Grab'];?></td>
						<td class="rawBody"><?=$row['def_1_crossed'];?></td>
						<td class="rawBody"><?=$row['def_2_crossed'];?></td>
						<td class="rawBody"><?=$row['def_3_crossed'];?></td>
						<td class="rawBody"><?=$row['def_4_crossed'];?></td>
						<td class="rawBody"><?=$row['def_5_crossed'];?></td>
						<td class="rawBody"><?=$row['def_1_weakened'];?></td>
						<td class="rawBody"><?=$row['def_2_weakened'];?></td>
						<td class="rawBody"><?=$row['def_3_weakened'];?></td>
						<td class="rawBody"><?=$row['def_4_weakened'];?></td>
						<td class="rawBody"><?=$row['def_5_weakened'];?></td>
						<td class="rawBody"><?=$row['def_1_speed'];?></td>
						<td class="rawBody"><?=$row['def_2_speed'];?></td>
						<td class="rawBody"><?=$row['def_3_speed'];?></td>
						<td class="rawBody"><?=$row['def_4_speed'];?></td>
						<td class="rawBody"><?=$row['def_5_speed'];?></td>
						<td class="rawBody"><?=$row['def_1_stuck'];?></td>
						<td class="rawBody"><?=$row['def_2_stuck'];?></td>
						<td class="rawBody"><?=$row['def_3_stuck'];?></td>
						<td class="rawBody"><?=$row['def_4_stuck'];?></td>
						<td class="rawBody"><?=$row['def_5_stuck'];?></td>
						<!--<td class="rawBody"><?=$row['def_1_ball'];?></td>
						<td class="rawBody"><?=$row['def_2_ball'];?></td>
						<td class="rawBody"><?=$row['def_3_ball'];?></td>
						<td class="rawBody"><?=$row['def_4_ball'];?></td>
						<td class="rawBody"><?=$row['def_5_ball'];?></td>-->
						<td class="rawBody"><?=$row['batter_high_Scored'];?></td>
						<td class="rawBody"><?=$row['batter_low_Scored'];?></td>
						<td class="rawBody"><?=$row['batter_high_miss'];?></td>
						<td class="rawBody"><?=$row['batter_low_miss'];?></td>
						<td class="rawBody"><?=$row['courtyard_high_Scored'];?></td>
						<td class="rawBody"><?=$row['courtyard_low_Scored'];?></td>
						<td class="rawBody"><?=$row['courtyard_high_Miss'];?></td>
						<td class="rawBody"><?=$row['courtyard_low_miss'];?></td>
						<td class="rawBody"><?=$row['challenge_Sucess'];?></td>
						<td class="rawBody"><?=$row['scaled_Sucess'];?></td>
						<td class="rawBody"><?=$row['defense'];?></td>
						<td class="rawBody"><?=$row['no_show'];?></td>
						<td class="rawBody"><?=$row['mech_fail'];?></td>
						<td class="rawBody"><?=$row['lost_comms'];?></td>
						<td class="rawBody"><?=$row['stuck'];?></td>
						<td class="rawBody"><?=$row['tipped'];?></td>
						<td class="rawBody"><?=$row['fouls'];?></td>
						<td class="rawBody"><?=$row['tech_fouls'];?></td>
						<td class="rawBody"><?=$row['drive_manuverability'];?></td>
						<td class="rawBody"><?=$row['Defense_Pushing'];?></td>
						<td class="rawBody"><?=$row['Ball_Control'];?></td>
					</tr>
					<?php
				}
			?>
		</table>
	</div>
</div>