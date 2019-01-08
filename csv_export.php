<?php
//include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
//include("navbar.php");
include("db_connect.php");
include("GetTeamData.php");

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

$query = "SELECT `number` FROM `teams`";
$result = $mysqli->query($query);

$numbers = [];

$csv = [];

while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$numbers[] = $row['number'];
}

$i=1;

$csv[0][] = "Team #";
$csv[0][] = "Points Contributed Total";
$csv[0][] = "Points Contributed High";
$csv[0][] = "Points Contributed Average";
$csv[0][] = "Auto Total Score";
$csv[0][] = "Auto High Score";
$csv[0][] = "Auto Average Score";
$csv[0][] = "Challenge %";
$csv[0][] = "Scale %";
$csv[0][] = "Low Bar Crosses";
$csv[0][] = "Portcullis Crosses";
$csv[0][] = "Cheval de Frise Crosses";
$csv[0][] = "Moat Crosses";
$csv[0][] = "Ramparts Crosses";
$csv[0][] = "Drawbridge Crosses";
$csv[0][] = "Sally Port Crosses";
$csv[0][] = "Rock Wall Crosses";
$csv[0][] = "Rough Terrain Crosses";

$csv[0][] = "High Goal Total";
$csv[0][] = "High Goal High";
$csv[0][] = "High Goal Average";
$csv[0][] = "Low Goal Total";
$csv[0][] = "Low Goal High";
$csv[0][] = "Low Goal Average";

$csv[0][] = "Total Goals";
$csv[0][] = "Fouls";
$csv[0][] = "Stuck";
$csv[0][] = "Defense Capability";

foreach($numbers as $n)
{
	$data = getCSVData($mysqli,$n);
	
	$csv[$i][] = $n;
	$csv[$i][] = $data['total_points'];
	$csv[$i][] = $data['high_points'];
	$csv[$i][] = $data['average_points'];
	$csv[$i][] = $data['auto_points'];
	$csv[$i][] = $data['high_auto_points'];
	$csv[$i][] = $data['average_auto_points'];
	$csv[$i][] = $data['challenge_total'];
	$csv[$i][] = $data['scale_total'];
	
	$csv[$i][] = $data['lowbar_cross'];
	$csv[$i][] = $data['portcullis_cross'];
	$csv[$i][] = $data['chili_fries_cross'];
	$csv[$i][] = $data['moat_cross'];
	$csv[$i][] = $data['ramparts_cross'];
	$csv[$i][] = $data['drawbridge_cross'];
	$csv[$i][] = $data['sally_port_cross'];
	$csv[$i][] = $data['rockwall_cross'];
	$csv[$i][] = $data['rough_terrain_cross'];
	
	$csv[$i][] = $data['high_total'];
	$csv[$i][] = $data['high_high'];
	$csv[$i][] = $data['high_average'];
	
	$csv[$i][] = $data['low_total'];
	$csv[$i][] = $data['low_high'];
	$csv[$i][] = $data['low_average'];
	
	$csv[$i][] = $data['total_goals'];
	$csv[$i][] = $data['fouls'];
	$csv[$i][] = $data['stuck'];
	$csv[$i][] = $data['defense_capability'];
		
	$i++;
}

foreach($csv as $row)
{
	fputcsv($output, $row);
}
?>