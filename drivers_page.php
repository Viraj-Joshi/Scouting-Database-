<?php
//Check to make sure the drive team is logged in
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");

if(isset($valid_user) && isset($user_type))
{
	if($valid_user && $user_type=="driver")
	{
		include("navbar.php");
		include("api_connect.php");
		include("db_connect.php");
		include("GetTeamData.php");
		/*
		$url = "https://frc-api.firstinspires.org/v2.0/2015/schedule/txho?tournamentLevel=Qualification&teamNumber=624";
		$response = file_get_contents($url,false,$context);
		*/
		$teamsList = [];
		
		$matches_query = "SELECT * FROM `schedule` WHERE (`red_1`=624 OR `red_2`=624 OR `red_3`=624 OR `blue_1`=624 OR `blue_2`=624 OR `blue_3`=624)";
		$result = $mysqli->query($matches_query);
?>	



<!-- Make this page Tablet Friendly -->
<body onload="load()">
<head>
	<link rel="stylesheet" type="text/css" href="css/DankDriverPageStyle.css">
	<link rel="stylesheet" type="text/css" href="css/mainpagestyle.css"> 
	<link rel="stylesheet" type="text/css" href="css/dataform.css">
</head>

<script src="./scripts/dropdown.js"></script>

<div class="page_container">
	<div class="form_container">
		<form class="datafield" method="post">
<div class="container">
<br>
<br><br>
	<h2 class=drivers><span>Drive Team Page</span></h2>
	
	<h2 class=drivers>Upcoming Matches</h2>

	<ul id="match_list">
	<?php 
		/*
		$json = json_decode($response, true);
		//echo json_encode($json, JSON_PRETTY_PRINT);
		
		
		foreach($json as $schedule)
		{
			foreach($schedule as $match)
			{
				*/
		$it = 0;
		
		while($row = $result->fetch_array(MYSQLI_ASSOC))
		{
				
				$description = "Qualification " . $row['match_number'];
				?>
				<li class="slideli" id="slide_li_<?= $it ?>">
					<span class="collapseView" id="slide_span_<?= $it ?>">
						<button class="slidebutton" id="slide_button_<?= $it ?>" onclick="expand('<?= $it ?>')" type="button">-</button>
						<?php echo $description; ?>
					</span>
				</li>
				<div id="slide_<?= $it ?>" class="slidediv">
				
				<?php
					$iter = 1;
					$red = true;
					$teamsList = [];
					$teamsList[] = $row['red_1'];
					$teamsList[] = $row['red_2'];
					$teamsList[] = $row['red_3'];
					$teamsList[] = $row['blue_1'];
					$teamsList[] = $row['blue_2'];
					$teamsList[] = $row['blue_3'];
					/*
					foreach($match["Teams"] as $teams)
					{*/
					foreach($teamsList as $teams)
					{
						//$teamsList[] = $teams["teamNumber"];
						
						if($teams == 624)
						{
							if($iter > 3)
							{
								$red=false;
							}
						}
						
						$iter++;
					}
					//}
					
					//var_dump($teamsList);
				?>
				<h3 style="color:#000"> Our Alliance </h3>
				<?php
					if($red == true)
					{
						?>
						<table>
							<tr>		
								<td></td>
								<td class="red_text">Red 1</td>
								<td class="red_text">Red 2</td>
								<td class="red_text">Red 3</td>
							</tr>
						<?php
						$iter=0;
						$limit=2;
					}
					else
					{
						?>
						
						<table>
							<tr>
								<td></td>
								<td class="blue_text">Blue 1</td>
								<td class="blue_text">Blue 2</td>
								<td class="blue_text">Blue 3</td>
							</tr>
						<?php
						$iter=3;
						$limit=5;
					}
					?>
					<tr>
					<td></td>
					<?php
					
					$data = [];
					
					for(;$iter<=$limit;$iter++)
					{
						$data[] = getTeamData($mysqli,$teamsList[$iter]);
						?>
						<td><a href="TeamInfoDisplay.php?team=<?=$teamsList[$iter]?>"><?=$teamsList[$iter]?></a></td>
						<?php
					}
					
				?>
				
				
					</tr>
					<tr>
						<td>Favorite Defense</td>
						<td><?= $data[0]['favorite_defense_name']?></td>
						<td><?= $data[1]['favorite_defense_name']?></td>
						<td><?= $data[2]['favorite_defense_name']?></td>
					</tr>
					<tr>
						<td>Least Favorite Defense</td>
						<td><?= $data[0]['hated_defense_name']?></td>
						<td><?= $data[1]['hated_defense_name']?></td>
						<td><?= $data[2]['hated_defense_name']?></td>
					</tr>
					<tr>
						<td>Preferred Starting Position</td>
					</tr>
					<tr>
						<td>Auto Reach</td>
						<td><?=$data[0]['auto_def_reach']?> / <?=$data[0]['auto_def_reach_total']?></td>
						<td><?=$data[1]['auto_def_reach']?> / <?=$data[1]['auto_def_reach_total']?></td>
						<td><?=$data[2]['auto_def_reach']?> / <?=$data[2]['auto_def_reach_total']?></td>
					</tr>
					<tr>
						<td>Auto Cross</td>
						<td><?=$data[0]['auto_def_cross']?> / <?=$data[0]['auto_def_cross_total']?></td>
						<td><?=$data[1]['auto_def_cross']?> / <?=$data[1]['auto_def_cross_total']?></td>
						<td><?=$data[2]['auto_def_cross']?> / <?=$data[2]['auto_def_cross_total']?></td>
					</tr>
					<tr>
						<td>Auto Low Goal</td>
						<td><?=$data[0]['auto_low']?> / <?=$data[0]['auto_low_total']?></td>
						<td><?=$data[1]['auto_low']?> / <?=$data[1]['auto_low_total']?></td>
						<td><?=$data[2]['auto_low']?> / <?=$data[2]['auto_low_total']?></td>
					</tr>
					<tr>
						<td>Auto High Goal</td>
						<td><?=$data[0]['auto_high']?> / <?=$data[0]['auto_high_total']?></td>
						<td><?=$data[1]['auto_high']?> / <?=$data[1]['auto_high_total']?></td>
						<td><?=$data[2]['auto_high']?> / <?=$data[2]['auto_high_total']?></td>
					</tr>
					<tr>
						<td>Teleop High Goal</td>
						<td><?=$data[0]['teleop_high']?> / <?=$data[0]['teleop_high_total']?></td>
						<td><?=$data[1]['teleop_high']?> / <?=$data[1]['teleop_high_total']?></td>
						<td><?=$data[2]['teleop_high']?> / <?=$data[2]['teleop_high_total']?></td>
					</tr>
					<tr>
						<td>Teleop Low Goal</td>
						<td><?=$data[0]['teleop_low']?> / <?=$data[0]['teleop_low_total']?></td>
						<td><?=$data[1]['teleop_low']?> / <?=$data[1]['teleop_low_total']?></td>
						<td><?=$data[2]['teleop_low']?> / <?=$data[2]['teleop_low_total']?></td>
					</tr>
					<tr>
						<td>Climb Amounts</td>
						<td><?=$data[0]['climbs']?></td>
						<td><?=$data[1]['climbs']?></td>
						<td><?=$data[2]['climbs']?></td>
					</tr>
					<tr>
						<td>Fouls</td>
						<td><?=$data[0]['fouls']?></td>
						<td><?=$data[1]['fouls']?></td>
						<td><?=$data[2]['fouls']?></td>
					</tr>
					<tr>
						<td>Tech Fouls</td>
						<td><?=$data[0]['tech_fouls']?></td>
						<td><?=$data[1]['tech_fouls']?></td>
						<td><?=$data[2]['tech_fouls']?></td>
					</tr>
				</table>
				<h3 style="color:#000"> Our Opposition </h3>
				<?php
					if($red == false)
					{
						?>
						<table>
							<tr>	
								<td></td>
								<td class="red_text">Red 1</td>
								<td class="red_text">Red 2</td>
								<td class="red_text">Red 3</td>
							</tr>
						<?php
						$iter=0;
						$limit=2;
					}
					else
					{
						?>
						
						<table>
							<tr>
								<td></td>
								<td class="blue_text">Blue 1</td>
								<td class="blue_text">Blue 2</td>
								<td class="blue_text">Blue 3</td>
							</tr>
						<?php
						$iter=3;
						$limit=5;
					}
					?>
					<tr>
						<td></td>
					<?php
					$data = [];
					
					for(;$iter<=$limit;$iter++)
					{
						$data[] = getTeamData($mysqli,$teamsList[$iter]);
						?>
						
						<td><a href="TeamInfoDisplay.php?team=<?=$teamsList[$iter]?>"><?=$teamsList[$iter]?></a></td>
						
						<?php
					}
				?>
				</tr>
				<tr>
					<td>Favorite Defense</td>
					<td><?= $data[0]['favorite_defense_name']?></td>
					<td><?= $data[1]['favorite_defense_name']?></td>
					<td><?= $data[2]['favorite_defense_name']?></td>
				</tr>
				<tr>
					<td>Least Favorite Defense</td>
					<td><?= $data[0]['hated_defense_name']?></td>
					<td><?= $data[1]['hated_defense_name']?></td>
					<td><?= $data[2]['hated_defense_name']?></td>
				</tr>
				<tr>
					<td>Center Boulder Grabs</td>
					<td><?=$data[0]['boulder_grabs']?></td>
					<td><?=$data[1]['boulder_grabs']?></td>
					<td><?=$data[2]['boulder_grabs']?></td>
				</tr>
				<tr>
					<td>Teleop High Goal</td>
					<td><?=$data[0]['teleop_high']?> / <?=$data[0]['teleop_high_total']?></td>
					<td><?=$data[1]['teleop_high']?> / <?=$data[1]['teleop_high_total']?></td>
					<td><?=$data[2]['teleop_high']?> / <?=$data[2]['teleop_high_total']?></td>
				</tr>
				<tr>
					<td>Teleop Low Goal</td>
					<td><?=$data[0]['teleop_low']?> / <?=$data[0]['teleop_low_total']?></td>
					<td><?=$data[1]['teleop_low']?> / <?=$data[1]['teleop_low_total']?></td>
					<td><?=$data[2]['teleop_low']?> / <?=$data[2]['teleop_low_total']?></td>
				</tr>
				<tr>
					<td>Fouls</td>
					<td><?=$data[0]['fouls']?></td>
					<td><?=$data[1]['fouls']?></td>
					<td><?=$data[2]['fouls']?></td>
				</tr>
				<tr>
					<td>Tech Fouls</td>
					<td><?=$data[0]['tech_fouls']?></td>
					<td><?=$data[1]['tech_fouls']?></td>
					<td><?=$data[2]['tech_fouls']?></td>
				</tr>
				</table>	
					
					
				</div>
				<br>
				<?php
				$it++;
		}
//			}
//		}
		
		
		//echo json_encode($match, JSON_PRETTY_PRINT);
				
				//echo $item['description'];
	?>
	</ul>
	
</div>

<?php
	}
}
?>