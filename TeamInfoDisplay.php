<?php
	//Team Display
	//Search for Teams and Matches
	include("HeadTemplate.php");
	include("UserVerification.php");
	include("kick_intruders.php");
	include("navbar.php");
	include("db_connect.php");
	include("api_connect.php");
	include("GetTeamData.php");
?>
<br>
<br>
<br>
<br>
<head>
	<link rel="stylesheet" type="text/css" href="css/mainpagestyle.css">
	<link rel="stylesheet" type="text/css" href="css/SearchStyle.css"> 
	<link rel="stylesheet" type="text/css" href="css/raw_data.css">
	<link rel="stylesheet" type="text/css" href="css/info-bar.css"> 
	<!--<link rel="stylesheet" type="text/css" href="css/MatchScheduleStyle.css">-->
</head>

<?php
	$team = $_GET['team'];
	
	$query2 = "SELECT * FROM teams WHERE number='$team'";
	$result2 = $mysqli->query($query2);
	
	if ($result2->num_rows > 0){
	// output data of each row
    while($row1 = $result2->fetch_assoc()) {
		$teamname=$row1["name"];
?>
<?php
	$dat = getTeamData($mysqli, $team);
	

	
	$team_query = "SELECT `match_number`, `team_number` FROM `match_data` WHERE team_number = '$team'";
?>
<div class="page_container">
<br>
<br>
<!--<div class="info-bar-holder">
    <div class="bar-group">
		<div class="info-bar" id="auto-bar">
			<div class="left section">
				<div class="left info-content">
					<div class="info-title">Autonomous</div>
					<div class="row">
					Auto High: <b><?=$dat['auto_high']?></b> out of <b><?=$dat['auto_high_total']?></b>
					</div>
					<div class="row">
					Auto Low: <b><?=$dat['auto_low']?></b> out of <b><?=$dat['auto_low_total']?></b>
					</div>
					<div class="row">
					Auto Low: <b><?=$dat['auto_low']?></b> out of <b><?=$dat['auto_low_total']?></b>
					</div>
				</div>
				<div class="grippy-circles" id="auto-gippies">
					<p>                              </p>
				</div>
			</div>
			<div class="right section">
				<div class="right info-content">
					<div class="table-holder">
						<table class="matchByMatch">
							<thead>
							<th>Matches</th>
							
							<th class="topTime" rowspan = "1" colspan = "5">Defense Stats<br>Ball,Crossed,Speed,Stuck</th>
							<?php
							foreach($result as $m)
							{ 
							//$match = getTeamMatchData($mysqli, $team, $playerMatch);
							?>
							<th><?=$m['match_number']?></th>
							<?php } ?>
							</thead>
							<tbody>
								<tr>
								<td class="vertical" ><p>Auto High:</p></td>
								<?php 
								$result = $mysqli->query($team_query);
								while($row = $result->fetch_array(MYSQLI_ASSOC))
								{
									$playerMatch = $row["match_number"];
									$match = getTeamMatchData($mysqli, $team, $playerMatch);
									?>
									<td><?=$match['auto_high'];?></td>
									<?php  
								}
								?>
								</tr>
								<tr>
								<td class="vertical" ><p>Auto Low:</p></td>
									<?php 
									$result = $mysqli->query($team_query);
									while($row = $result->fetch_array(MYSQLI_ASSOC))
									{
										$playerMatch = $row["match_number"];
										$match = getTeamMatchData($mysqli, $team, $playerMatch);
										?>
										<td><?=$match['auto_low'];?></td>
										<?php  
									}
									?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			
			</div>
		</div>
    </div>
</div>-->
<br>
<br>
<form class="Searchforsearch" method="get" action="TeamInfoDisplay.php">
	<input type="number" name="team">
	<input type="submit" value="Search" class="subButton">
</form>
<br>
<br>
	<!--<img src="/team_pics/<?=$team?>.png" width=400 height=400 class="image"></img>-->
	<a href="/team_pics/<?=$team?>.png">Robot Picture</a>
<br>

	<h1><?php echo "Team " . $team. " - ".$teamname; ?></h1>
	<?php
		}
	}
	?>

<h3>Matches Played: <?=$dat["played"]?></h3>
<?php
if($dat["played"]>0)
{

?>
<h1>Scoring</h1>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "6">Auto</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">High Goals</th>
			<th class='topTime'rowspan = "1" colspan = "1">Low Goals</th>
			<th class='topTime'rowspan = "1" colspan = "1">Defenses Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Defenses Reached</th>
			<th class='topTime'rowspan = "1" colspan = "1">Start With Boulder?</th>
			<th class='topTime'rowspan = "1" colspan = "1">Boulder Grab Success?</th>
		</tr>
	</thead>
	<tbody>
		<tr class="Row">
			<td class="teamTBody"><?=$dat['auto_high']?>/<?=$dat['auto_high_total']?></td>
			<td class="teamTBody"><?=$dat['auto_low']?>/<?=$dat['auto_low_total']?></td>
			<td class="teamTBody"><?=$dat['auto_def_cross']?>/<?=$dat['auto_Defenses_Crossed_Failed']+$dat['auto_def_cross']?></td>
			<td class="teamTBody"><?=$dat['auto_def_reach']?>/<?=$dat['auto_def_reach']+$dat['auto_Defenses_Reached_Failed']?></td>
			<td class="teamTBody"><?=$dat['Auto_StartWithBoulder']?>/<?=$dat['played']?></td>
			<td class="teamTBody"><?=$dat['boulder_grabs']?></td>
		</tr>
	</tbody>
		
</table>
<br><br>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "3">Shooting Statistics High</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">Teleop High Goals</th>
			<th class='topTime'rowspan = "1" colspan = "1">Batter High Goals</th>
			<th class='topTime'rowspan = "1" colspan = "1">Court High Goals</th>
		</tr>
	</thead>
	<tbody>
	
		<tr class="Row">
			<td class="teamTBody"><?=$dat['teleop_high']?>/<?=$dat['teleop_high_total']?></td>
			<td class="teamTBody"><?=$dat['batter_high']?>/<?=$dat['batter_high_total']?></td>
			<td class="teamTBody"><?=$dat['courtyard_high']?>/<?=$dat['court_high_total']?></td>
		</tr>
	</tbody>
		
</table>
<br><br>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "3">Shooting Statistics Low</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">Teleop Low Goals</th>
			<th class='topTime'rowspan = "1" colspan = "1">Batter Low Goals</th>
			<th class='topTime'rowspan = "1" colspan = "1">Court Low Goals</th>
		</tr>
	</thead>
	<tbody>
	
		<tr class="Row">
			<td class="teamTBody"><?=$dat['teleop_low']?>/<?=$dat['teleop_low_total']?></td>
			<td class="teamTBody"><?=$dat['batter_low']?>/<?=$dat['batter_low_total']?></td>
			<td class="teamTBody"><?=$dat['courtyard_low']?>/<?=$dat['court_low_total']?></td>
		</tr>
	</tbody>
		
</table>
<br><br>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "2">Climbing Averages</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">Challenge Success?</th>
			<th class='topTime'rowspan = "1" colspan = "1">Scaled Success?</th>
		</tr>
	</thead>
	<tbody>
		<tr class="Row">
			<td class="teamTBody"><?=$dat['challenge']?></td>
			<td class="teamTBody"><?=$dat['climbs']?></td>
		</tr>
	</tbody>
		
</table>
<br>
<h1>Outer Works Stats</h1>
<br>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "6">Low Bar</th>
		</tr>
		<tr class="topRow">
		<!--ONE SUGGESTION I WOULD MAKE IS TO TAKE THE # OF TIMES CROSSED/# of Appearances -->
			<th class='topTime'rowspan = "1" colspan = "1">Appearances</th>
			<th class='topTime'rowspan = "1" colspan = "1">Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1"> Avg.Speed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Stuck</th>
			<th class='topTime'rowspan = "1" colspan = "1">Auto Crossed</th>
		</tr>
	</thead>
	<?php
		$def = getAutoDef($mysqli,$team);
	?>
	<tbody>
		<tr class="Row">
			<td class="teamTBody"><?=$dat['lowbar_faced']?></td>
			<?php
			if($dat['lowbar_faced']>0)
			{
			?>
			<td class="teamTBody"><?=$dat['lowbar_cross'] /*/ $dat['lowbar_faced']*/?></td>
			<td class="teamTBody"><?=round($dat['lowbar_speed'] / $dat['lowbar_faced'],2)?></td>
			<td class="teamTBody"><?=$dat['lowbar_stuck'] /*/ $dat['lowbar_faced']*/?></td>
			<td class="teamTBody"><?=$def['auto_Crossed_0']?></td>
			<?php
				}
				else{
					?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
					<?php
				}
			?>
			
		</tr>
	</tbody>
		
</table>
<br>
<table class="teamTable">
	<thead>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "10">Category A</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "5">Portcullis</th>
			<th class='topTime'rowspan = "1" colspan = "5">Cheval De Frise</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">Appearances</th>
			<th class='topTime'rowspan = "1" colspan = "1">Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Avg.Speed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Stuck</th>
			<!--<th class='topTime'rowspan = "1" colspan = "1">BALLS!!!</th>-->
			<th class='topTime'rowspan = "1" colspan = "1">Auto Crossed</th>
			
			<th class='topTime'rowspan = "1" colspan = "1">Appearances</th>
			<th class='topTime'rowspan = "1" colspan = "1">Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Avg.Speed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Stuck</th>
			<!--<th class='topTime'rowspan = "1" colspan = "1">BALLS!!!</th>-->
			<th class='topTime'rowspan = "1" colspan = "1">Auto Crossed</th>
		</tr>
	</thead>
	<tbody>
		<tr class="Row">
		<?php
			if($dat['portcullis_faced']>0)
			{
		?>
			<td class="teamTBody"><?=$dat['portcullis_faced']?></td>
			<td class="teamTBody"><?=$dat['portcullis_cross'] /*/ $dat['portcullis_faced']*/?></td>
			<td class="teamTBody"><?=round($dat['portcullis_speed'] / $dat['portcullis_faced'],2)?></td>
			<td class="teamTBody"><?=$dat['portcullis_stuck'] // $dat['portcullis_faced']?></td>
			<!--<td class="teamTBody"><?=$dat['portcullis_ball'] /*/ $dat['portcullis_faced']*/?></td>-->
			<td class="teamTBody"><?=$def['auto_Crossed_1']?></td>
			<?php
				}
				else{
					?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
					<?php
				}
			?>
			
			<?php
				if($dat['chili_fries_faced']>0)
				{
			?>
			<td class="teamTBody"><?=$dat['chili_fries_faced']?></td>
			<td class="teamTBody"><?=$dat['chili_fries_cross'] /*/ $dat['chili_fries_faced']*/?></td>
			<td class="teamTBody"><?=round($dat['chili_fries_speed'] / $dat['chili_fries_faced'],2)?></td>
			<td class="teamTBody"><?=$dat['chili_fries_stuck'] // $dat['chili_fries_faced']?></td>
			<!--<td class="teamTBody"><?=$dat['chili_fries_ball'] /*/ $dat['chili_fries_faced']*/?></td>-->
			<td class="teamTBody"><?=$def['auto_Crossed_2']?></td>
			<?php
				}
				else{
					?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
					<?php
				}
			?>
		</tr>
	</tbody>
		
</table>
<br>
<table class="teamTable">
	<thead>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "10">Category B</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "5">Moat</th>
			<th class='topTime'rowspan = "1" colspan = "5">Ramparts</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">Appearances</th>
			<th class='topTime'rowspan = "1" colspan = "1">Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Avg.Speed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Stuck</th>
			<!--<th class='topTime'rowspan = "1" colspan = "1">BALLS!!!</th>-->
			<th class='topTime'rowspan = "1" colspan = "1">Auto Crossed</th>
			
			<th class='topTime'rowspan = "1" colspan = "1">Appearances</th>
			<th class='topTime'rowspan = "1" colspan = "1">Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Avg.Speed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Stuck</th>
			<!--<th class='topTime'rowspan = "1" colspan = "1">BALLS!!!</th>-->
			<th class='topTime'rowspan = "1" colspan = "1">Auto Crossed</th>
		</tr>
	</thead>
	<tbody>
		<tr class="Row">
			<?php
				if($dat['moat_faced']>0)
				{
			?>
			<td class="teamTBody"><?=$dat['moat_faced']?></td>
			<td class="teamTBody"><?=$dat['moat_cross'] /*/ $dat['moat_faced']*/?></td>
			<td class="teamTBody"><?=round($dat['moat_speed'] / $dat['moat_faced'],2)?></td>
			<td class="teamTBody"><?=$dat['moat_stuck']//$dat['moat_faced']?></td>
			<!--<td class="teamTBody"><?=$dat['moat_ball'] /*/ $dat['moat_faced']*/?></td>-->
			<td class="teamTBody"><?=$def['auto_Crossed_3']?></td>
			<?php
				}
				else{
					?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
					<?php
				}
			?>
			
			<?php
				if($dat['ramparts_faced']>0)
				{
			?>
			<td class="teamTBody"><?=$dat['ramparts_faced']?></td>
			<td class="teamTBody"><?=$dat['ramparts_cross'] /*/ $dat['ramparts_faced']*/?></td>
			<td class="teamTBody"><?=round($dat['ramparts_speed'] / $dat['ramparts_faced'],2)?></td>
			<td class="teamTBody"><?=$dat['ramparts_stuck'] // $dat['ramparts_faced']?></td>
			<!--<td class="teamTBody"><?=$dat['ramparts_ball'] // $dat['ramparts_faced']?></td>-->
			<td class="teamTBody"><?=$def['auto_Crossed_4']?></td>
			<?php
				}
				else{
					?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
					<?php
				}
			?>
		</tr>
	</tbody>
		
</table>
<br>
<table class="teamTable">
	<thead>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "10">Category C</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "5">Drawbridge</th>
			<th class='topTime'rowspan = "1" colspan = "5">Sally Port</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">Appearances</th>
			<th class='topTime'rowspan = "1" colspan = "1">Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Avg.Speed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Stuck</th>
			<!--<th class='topTime'rowspan = "1" colspan = "1">BALLS!!!</th>-->
			<th class='topTime'rowspan = "1" colspan = "1">Auto Crossed</th>
			
			<th class='topTime'rowspan = "1" colspan = "1">Appearances</th>
			<th class='topTime'rowspan = "1" colspan = "1">Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Avg.Speed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Stuck</th>
			<!--<th class='topTime'rowspan = "1" colspan = "1">BALLS!!!</th>-->
			<th class='topTime'rowspan = "1" colspan = "1">Auto Crossed</th>
		</tr>
	</thead>
	<tbody>
		<tr class="Row">
			<?php
				if($dat['drawbridge_faced']>0)
				{
			?>
			<td class="teamTBody"><?=$dat['drawbridge_faced']?></td>
			<td class="teamTBody"><?=$dat['drawbridge_cross'] // $dat['drawbridge_faced']?></td>
			<td class="teamTBody"><?=round($dat['drawbridge_speed'] / $dat['drawbridge_faced'],2)?></td>
			<td class="teamTBody"><?=$dat['drawbridge_stuck'] // $dat['drawbridge_faced']?></td>
			<!--<td class="teamTBody"><?=$dat['drawbridge_ball'] // $dat['drawbridge_faced']?></td>-->
			<td class="teamTBody"><?=$def['auto_Crossed_5']?></td>
			<?php
				}
				else{
					?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
					<?php
				}
			?>
			
			<?php
				if($dat['sally_port_faced']>0)
				{
			?>
			<td class="teamTBody"><?=$dat['sally_port_faced']?></td>
			<td class="teamTBody"><?=$dat['sally_port_cross'] // $dat['sally_port_faced']?></td>
			<td class="teamTBody"><?=round($dat['sally_port_speed'] / $dat['sally_port_faced'],2)?></td>
			<td class="teamTBody"><?=$dat['sally_port_stuck'] // $dat['sally_port_faced']?></td>
			<!--<td class="teamTBody"><?=$dat['sally_port_ball'] // $dat['sally_port_faced']?></td>-->
			<td class="teamTBody"><?=$def['auto_Crossed_6']?></td>
			<?php
				}
				else{
					?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
					<?php
				}
			?>
		</tr>
	</tbody>
		
</table>
<br>
<table class="teamTable">
	<thead>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "10">Category D</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "5">Rough Terrain</th>
			<th class='topTime'rowspan = "1" colspan = "5">Rock Wall</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">Appearances</th>
			<th class='topTime'rowspan = "1" colspan = "1">Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Avg.Speed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Stuck</th>
			<!--<th class='topTime'rowspan = "1" colspan = "1">BALLS!!!</th>-->
			<th class='topTime'rowspan = "1" colspan = "1">Auto Crossed</th>
			
			<th class='topTime'rowspan = "1" colspan = "1">Appearances</th>
			<th class='topTime'rowspan = "1" colspan = "1">Crossed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Avg.Speed</th>
			<th class='topTime'rowspan = "1" colspan = "1">Stuck</th>
			<!--<th class='topTime'rowspan = "1" colspan = "1">BALLS!!!</th>-->
			<th class='topTime'rowspan = "1" colspan = "1">Auto Crossed</th>
		</tr>
	</thead>
	<tbody>
		<tr class="Row">
			<?php
				if($dat['rough_terrain_faced']>0)
				{
			?>
			<td class="teamTBody"><?=$dat['rough_terrain_faced']?></td>
			<td class="teamTBody"><?=$dat['rough_terrain_cross'] // $dat['rough_terrain_faced']?></td>
			<td class="teamTBody"><?=round($dat['rough_terrain_speed'] / $dat['rough_terrain_faced'],2)?></td>
			<td class="teamTBody"><?=$dat['rough_terrain_stuck'] // $dat['rough_terrain_faced']?></td>
			<!--<td class="teamTBody"><?=$dat['rough_terrain_ball'] // $dat['rough_terrain_faced']?></td>-->
			<td class="teamTBody"><?=$def['auto_Crossed_8']?></td>
			<?php
				}
				else{
					?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
					<?php
				}
			?>
			
			<?php
				if($dat['rockwall_faced']>0)
				{
			?>
			<td class="teamTBody"><?=$dat['rockwall_faced']?></td>
			<td class="teamTBody"><?=$dat['rockwall_cross'] // $dat['rockwall_faced']?></td>
			<td class="teamTBody"><?=round($dat['rockwall_speed'] / $dat['rockwall_faced'],2)?></td>
			<td class="teamTBody"><?=$dat['rockwall_stuck'] // $dat['rockwall_faced']?></td>
			<!--<td class="teamTBody"><?=$dat['rockwall_ball']  // $dat['rockwall_faced']?></td>-->
			<td class="teamTBody"><?=$def['auto_Crossed_7']?></td>
			<?php
				}
				else{
					?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
					<?php
				}
			?>
		</tr>
	</tbody>
		
</table>

<br>
<h1>Other</h1>
<br>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "7">Alerts</th>
		</tr>
		<tr class="topRow">
			<th class='topTime' rowspan = "1" colspan = "1">Fouls</th>
			<th class='topTime' rowspan = "1" colspan = "1">Tech Fouls</th>
			<th class='topTime' rowspan = "1" colspan = "1">No Shows</th>
			<th class='topTime' rowspan = "1" colspan = "1">Mechanical Failures</th>
			<th class='topTime' rowspan = "1" colspan = "1">Lost Communication</th>
			<th class='topTime' rowspan = "1" colspan = "1">Tipped</th>
			<th class='topTime' rowspan = "1" colspan = "1">Stuck</th>
		</tr>
	</thead>
	<tbody>
		<tr class="Row">
			<td class="teamTBody"><?=$dat['fouls']?></td>
			<td class="teamTBody"><?=$dat['tech_fouls']?></td>
			<td class="teamTBody"><?=$dat['no_show']?></td>
			<td class="teamTBody"><?=$dat['mech_fail']?></td>
			<td class="teamTBody"><?=$dat['lost_comms']?></td>
			<td class="teamTBody"><?=$dat['tipped']?></td>
			<td class="teamTBody"><?=$dat['stuck']?></td>
		</tr>
	</tbody>
		
</table>
<br><br>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "3">Driver Data Averages</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">Driving/Maneuverability</th>
			<th class='topTime'rowspan = "1" colspan = "1">Defense/Pushing</th>
			<th class='topTime'rowspan = "1" colspan = "1">Ball Control</th>
			<!--<th class='topTime'rowspan = "1" colspan = "1">Pushing</th>-->
		</tr>
	</thead>
	<tbody>
		<tr class="Row">
		<?php
		if($dat["played"] > 0)
		{
			?>
			<td class="teamTBody"><?=$dat['drive_manuverability'] / $dat["played"]?></td>
			<td class="teamTBody"><?=round($dat['Defense_Pushing'] / $dat["played"],2)?></td>
			<td class="teamTBody"><?=round($dat['Ball_Control'] / $dat["played"],2)?></td>
			<!--<td class="teamTBody"><?=$dat['pushing'] / $dat["played"]?></td>-->
			<?php
		}
		else
		{
			?>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<td class="teamTBody">0</td>
			<!--<td class="teamTBody">0</td>-->
			<?php
		}
			?>
		</tr>
	</tbody>
	
</table>
<br><br>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "4"> Average Defense Time%</th>
		</tr>
	</thead>
	<tbody>
		<tr class="teamRow">
		<?php
		if($dat["played"] > 0)
		{
			?>
			<td class="teamTBody"><?=$dat['defense'] / $dat["played"];?>%</td>
		<?php
		}
		else
		{
			?>
			<td class="teamTBody">Data Unavailable</td>
			<?php
		}
			?>
		</tr>
	</tbody>
	
</table>
<br>
<table class="teamTable">
	<thead>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "2">Outer Works Scores</th>
		</tr>
		<tr class="topRow">
			<th class='topTime'rowspan = "1" colspan = "1">Defense Name</th>
			<th class='topTime'rowspan = "1" colspan = "1">Score</th>
		</tr>
		
	</thead>
	<tbody>
		<tr class="teamRow">
			<td class="teamTBody"><?= getDefenseName(0); ?></td>
			<td class="teamTBody"><?=$dat['def_prefs'][0]?></td>
		</tr>
		<tr class="teamRow">
			<td class="teamTBody"><?= getDefenseName(1); ?></td>
			<td class="teamTBody"><?=$dat['def_prefs'][1]?></td>
		</tr>
		<tr class="teamRow">
			<td class="teamTBody"><?= getDefenseName(2); ?></td>
			<td class="teamTBody"><?=$dat['def_prefs'][2]?></td>
		</tr>
		<tr class="teamRow">
			<td class="teamTBody"><?= getDefenseName(3); ?></td>
			<td class="teamTBody"><?=$dat['def_prefs'][3]?></td>
		</tr>
		<tr class="teamRow">
			<td class="teamTBody"><?= getDefenseName(4); ?></td>
			<td class="teamTBody"><?=$dat['def_prefs'][4]?></td>
		</tr>
		<tr class="teamRow">
			<td class="teamTBody"><?= getDefenseName(5); ?></td>
			<td class="teamTBody"><?=$dat['def_prefs'][5]?></td>
		</tr>
		<tr class="teamRow">
			<td class="teamTBody"><?= getDefenseName(6); ?></td>
			<td class="teamTBody"><?=$dat['def_prefs'][6]?></td>
		</tr>
		<tr class="teamRow">
			<td class="teamTBody"><?= getDefenseName(7); ?></td>
			<td class="teamTBody"><?=$dat['def_prefs'][7]?></td>
		</tr>
		<tr class="teamRow">
			<td class="teamTBody"><?= getDefenseName(8); ?></td>
			<td class="teamTBody"><?=$dat['def_prefs'][8]?></td>
		</tr>
	</tbody>
		
</table>
<br>
<h1>Match Notes</h1>
<br><br>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime' rowspan = "1" colspan = "1">Match #</th>
			<th class='topTime' rowspan = "1" colspan = "4">Notes</th>
		</tr>
	</thead>
	<tbody>	
		<?php
			$note_query = "SELECT `match_number`,`notes`,`team` FROM `notes` WHERE team='$team' ORDER BY `match_number` ASC";
			$notes = $mysqli->query($note_query);
			
			while($row = $notes->fetch_array(MYSQLI_ASSOC))
			{
				?>
				<tr class="teamRow">
					<td class="teamTBody"><?=$row["match_number"]?></td>
					<td class="teamTBody"><?=$row["notes"]?></td>
				</tr>
				<?php
			}
		?>
	</tbody>
</table>
<br>
<br>
<?php
}
?>
<h1>Other Notes</h1>
<br><br>
<table class="teamTable">
	<thead>
		
		<tr class="topRow">
			<th class='topTime' rowspan = "1" colspan = "4">Note</th>
		</tr>
	</thead>
	<tbody>	
		<?php
			$note_query2 = "SELECT * FROM note_entry WHERE selectteam='$team' ORDER BY id ASC";
			$notes2 = $mysqli->query($note_query2);
			
			while($row2 = $notes2->fetch_array(MYSQLI_ASSOC))
				{
					?>
					<tr class="teamRow">
						<td class="teamTBody"><?=$row2['notes']?></td>
					</tr>
					<?php
			}
		?>
	</tbody>
</table>
<?php
if($dat["played"]>0)
{
?>
<h1>Match-By-Match</h1>
<table class="teamTable">
	<thead>
		<tr>
			<th class="topTime" rowspan = "1" colspan = "6">Match Defense Statistics</th>
			<th class="topTime" rowspan = "1" colspan = "5">Defense Stats<br>Crossed,Speed,Stuck</th>
		</tr>
		<tr>
			<th class="topTime"rowspan = "1" colspan = "1">Match #</th>
			<th class="topTime"rowspan = "1" colspan = "1">Position 1</th>
			<th class="topTime"rowspan = "1" colspan = "1">Position 2</th>
			<th class="topTime"rowspan = "1" colspan = "1">Position 3</th>
			<th class="topTime"rowspan = "1" colspan = "1">Position 4</th>
			<th class="topTime"rowspan = "1" colspan = "1">Position 5</th>
			<th class="topTime"rowspan = "1" colspan = "1">1 Stats</th>
			<th class="topTime"rowspan = "1" colspan = "1">2 Stats</th>
			<th class="topTime"rowspan = "1" colspan = "1">3 Stats</th>
			<th class="topTime"rowspan = "1" colspan = "1">4 Stats</th>
			<th class="topTime"rowspan = "1" colspan = "1">5 Stats</th>
		</tr>
	</tbody>
	<tbody>
		<?php
			$result = $mysqli->query($team_query);
			
			while($row = $result->fetch_array(MYSQLI_ASSOC))
			{
				$playerMatch = $row["match_number"];
				$match = getTeamMatchData($mysqli, $team, $playerMatch);
				
		?>
		<tr class="teamRow">
			<td class="teamTBody"><?=$playerMatch?></td>
			<td class="teamTBody"><?=getDefenseName($match['def_pos_types'][0])?></td>
			<td class="teamTBody"><?=getDefenseName($match['def_pos_types'][1])?></td>
			<td class="teamTBody"><?=getDefenseName($match['def_pos_types'][2])?></td>
			<td class="teamTBody"><?=getDefenseName($match['def_pos_types'][3])?></td>
			<td class="teamTBody"><?=getDefenseName($match['def_pos_types'][4])?></td>
			<td class="teamTBody"><?=$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][0]))).'_cross'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][0]))).'_speed'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][0]))).'_stuck']//.','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][0]))).'_ball']?></td>
			<td class="teamTBody"><?=$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][1]))).'_cross'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][1]))).'_speed'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][1]))).'_stuck']//.','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][1]))).'_ball']?></td>
			<td class="teamTBody"><?=$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][2]))).'_cross'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][2]))).'_speed'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][2]))).'_stuck']//.','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][2]))).'_ball']?></td>
			<td class="teamTBody"><?=$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][3]))).'_cross'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][3]))).'_speed'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][3]))).'_stuck']//.','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][3]))).'_ball']?></td>
			<td class="teamTBody"><?=$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][4]))).'_cross'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][4]))).'_speed'].','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][4]))).'_stuck']//.','.$match[strtolower(str_replace(' ','_',getDefenseName($match['def_pos_types'][4]))).'_ball']?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
<br>
<?php

	$result2 = $mysqli->query($team_query);

?>
<table class="teamTable">
	<thead>
		<tr>
			<th class="topTime" rowspan = "1" colspan = "10">Match Shooting Statistics</th>
		</tr>
		<tr>
			<th class="topTime"rowspan = "1" colspan = "1">Match #</th>
			<th class="topTime"rowspan = "1" colspan = "1">Auto high %</th>
			<th class="topTime"rowspan = "1" colspan = "1">Auto Low %</th>
			<th class="topTime"rowspan = "1" colspan = "1">Batter High %</th>
			<th class="topTime"rowspan = "1" colspan = "1">Batter Low %</th>
			<th class="topTime"rowspan = "1" colspan = "1">Court High %</th>
			<th class="topTime"rowspan = "1" colspan = "1">Court Low %</th>
			<th class="topTime"rowspan = "1" colspan = "1">Shooting Location</th>
		</tr>
	</tbody>
	<tbody>
		<?php
			while($row = $result2->fetch_array(MYSQLI_ASSOC))
			{
				$playerMatch = $row["match_number"];
				$match = getTeamMatchData($mysqli, $team, $playerMatch);
		?>
		<tr class="teamRow">
			<td class="teamTBody"><?=$playerMatch;?></td>
			<td class="teamTBody"><?php if($match['auto_high_total'] > 0){ echo $match['auto_high'].'/'.$match['auto_high_total'];}else{ echo "N/A"; }?></td>
			<td class="teamTBody"><?php if($match['auto_low_total'] > 0){ echo $match['auto_low'].'/'.$match['auto_low_total'];}else{ echo "N/A"; }?></td>
			<td class="teamTBody"><?php if($match['batter_high_total'] > 0){ echo $match['batter_high'],'/'.$match['batter_high_total']; }else{ echo "N/A"; }?></td>
			<td class="teamTBody"><?php if($match['batter_low_total'] > 0){ echo $match['batter_low'].'/'.$match['batter_low_total']; }else{ echo "N/A"; }?></td>
			<td class="teamTBody"><?php if($match['court_high_total'] > 0){ echo $match['courtyard_high'].'/'.$match['court_high_total']; }else{ echo "N/A"; }?></td>
			<td class="teamTBody"><?php if($match['court_low_total'] > 0){ echo $match['courtyard_low'].'/'.$match['court_low_total']; }else{ echo "N/A"; }?></td>
			<td class="teamTBody"><?=$match['shooting_location']?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
<br>
<?php

	$result3 = $mysqli->query($team_query);

?>
<table class="teamTable">
	<thead>
		<tr>
			<th class="topTime" rowspan = "1" colspan = "9">Match Foul Statistics</th>
		</tr>
		<tr>
			<th class="topTime"rowspan = "1" colspan = "1">Match #</th>
			<th class="topTime"rowspan = "1" colspan = "1">Fouls</th>
			<th class="topTime"rowspan = "1" colspan = "1">Tech Fouls</th>
			<th class="topTime"rowspan = "1" colspan = "1">No Show</th>
			<th class="topTime"rowspan = "1" colspan = "1">Mech Fail</th>
			<th class="topTime"rowspan = "1" colspan = "1">Lost Comm</th>
			<th class="topTime"rowspan = "1" colspan = "1">Tipped</th>
			<th class="topTime"rowspan = "1" colspan = "1">Stuck</th>
		</tr>
	</tbody>
	<tbody>
		<?php
			while($row = $result3->fetch_array(MYSQLI_ASSOC))
			{
				$playerMatch = $row["match_number"];
				$match = getTeamMatchData($mysqli, $team, $playerMatch);
		?>
		<tr class="teamRow">
			<td class="teamTBody"><?=$playerMatch?></td>
			<td class="teamTBody"><?=$match['fouls']?></td>
			<td class="teamTBody"><?=$match['tech_fouls']?></td>
			<td class="teamTBody"><?=$match['no_show']?></td>
			<td class="teamTBody"><?=$match['mech_fail']?></td>
			<td class="teamTBody"><?=$match['lost_comms']?></td>
			<td class="teamTBody"><?=$match['tipped']?></td>
			<td class="teamTBody"><?=$match['stuck']?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
<br>

						<br><br>
<div class="raw_data">
	<table class="rawTable">
		<thead>
		
		<tr class="topRow">
			<th class='topTime' rowspan = "1" colspan = "65">Raw Data</th>
		</tr>
	</thead>
			<tr class="rawTopRow">
				<!-- Put Column Headers Here -->
				<td class="rawTop"><p class="rawP">Match #</P></td>
				<td class="rawTop"><p class="rawP">Team #</P></td>
				<td class="rawTop"><p class="rawP">Scout ID</P></td>
				<td class="rawTop"><p class="rawP">Scout Name</P></td>
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
			
				$query = "SELECT * FROM match_data WHERE team_number = '$team' ";
				$result = $mysqli->query($query);
				
				foreach($result as $row)
				{
					$scout_id=$row['scout_id'];
					$query2 = "SELECT * FROM scouts WHERE id = '$scout_id' ";
					$result2 = $mysqli->query($query2);
				foreach($result2 as $row2)
				{	//$team. " - ".$teamname;
					$name=$row2['firstname']." ".$row2['lastname'];
					?>
					<tr class="rawZebra">
						<td class="rawBody"><?=$row['match_number'];?></td>
						<td class="rawBody"><?=$row['team_number'];?></td>
						<td class="rawBody"><?=$scout_id;?></td>	
						<td class="rawBody"><?=$name;?></td>
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
				}
			?>
		</table>
	</div>

<?php
}else
{
	//var_dump($dat);
?>
<br>
<br>
<h2>There is not data for this team yet.</h2>
<?php
}
?>
<br>
<br>
</div>




