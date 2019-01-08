<?php
//Data Coverage
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("read_ini.php");
include("db_connect.php");
?>
<head>	<link rel="stylesheet" type="text/css" href="css/DataCoverageStyle.css"> </head>
<br>
<br>
<br>
<br>
<div class = "title" >
	<h1> Data Coverage </h1>
</div>
<div class="page-container">
	<table class="Schedule-table">
		<tr class="top-bar">
			<th class="table-top"><b>Match</b></th>
			<th class="table-top"><b>Red 1</b></th>
			<th class="table-top"><b>Red 2</b></th>
			<th class="table-top"><b>Red 3</b></th>
			<th class="table-top"><b>Blue 1</b></th>
			<th class="table-top"><b>Blue 2</b></th>
			<th class="table-top"><b>Blue 3</b></th>
		</tr>
<?php

	$query2 = "SELECT * FROM schedule";
	$result2 = $mysqli->query($query2);
	
	foreach($result2 as $row)
	{
		$teamsList = [];
			$teamsList[] = $row['red_1'];
			$teamsList[] = $row['red_2'];
			$teamsList[] = $row['red_3'];
			$teamsList[] = $row['blue_1'];
			$teamsList[] = $row['blue_2'];
			$teamsList[] = $row['blue_3'];
			$match = $row["match_number"];
?>	
		<tr class="zebra">
			<td class="side-bar"><a href="MatchInfoDisplay.php?match=<?=$row["match_number"];?>" class="side-bar"><b><?=$row["match_number"];?></b></a></td>
			<?php
			foreach($teamsList as $team)
			{
				$query3 = "SELECT COUNT(*) FROM match_data WHERE team_number = $team AND match_number = $match";
				$result3 = $mysqli->query($query3);
				$row = $result3->fetch_array(MYSQLI_ASSOC);
					if($row["COUNT(*)"] == 0)
					{
			?>
			<td class="not-found"><a href="TeamInfoDisplay.php?team=<?=$team;?>" class="not-found"><?=$team;?></a></td>
			<?php
					}else
					{
			?>
			<td class="found"><a href="TeamInfoDisplay.php?team=<?=$team;?>" class="found"><?=$team;?></a></td>
			<?php
					}
			}
			?>
		</tr>
<?php	
	}
?>

	</table>
	<br>
</div>