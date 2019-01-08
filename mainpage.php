<?php
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("db_connect.php");
//Check to make sure the user is logged in

	$result=$mysqli->query("SELECT * FROM regional LIMIT 1");
	$row = $result->fetch_array(MYSQLI_ASSOC);
?>
<head>	<link rel="stylesheet" type="text/css" href="css/mainpagestyle.css"> </head>
<br>
<br>
<br>
<br>
<div class="page_container">
	<h1> 624 Scouting Main Page - <?=$row['eventCode']?></h1>
	
	<div class="quickLinks">
		Greetings, 
		<?php
			if($user_type == "driver")
			{
				echo "Drive Team Member. The fact that you have gotten here is surprising. I congratulate thee, but please go back to your"; 
				?>
					<a href="drivers_page.php">designated page.</a>
				<?php
			}
			else if($user_type == "admin")
			{
				echo "Admin. These pages might be of interest to you:<br><br>"; 
				?>
					<a href="DataCoverage.php">Data Coverage</a>
					<br>
					<a href="Setup.php">Setup</a>
				<?php
			}
			else if($user_type == "data")
			{
				echo "Data Entry. These pages might be of interest to you:<br><br>"; 
				?>
					<a href="DataEntry.php">Data Entry</a><br>
				<?php
			}
			else if($user_type == "scout")
			{
				echo "Scout. These pages might be of interest to you:<br><br>"; 
				?>
					<a href="Search.php">Search For Teams/Matches</a>
					<br>
				<?php
			}
		?>
	</div>
</div>