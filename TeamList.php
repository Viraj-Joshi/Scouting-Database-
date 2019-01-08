<?php
//Rankings
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("read_ini.php");
include("db_connect.php");
include("api_connect.php");

	$query2 = "SELECT * FROM teams";
	$result2 = $mysqli->query($query2);
	//$reg = $query2['regional'];
	
	$reg_code = $mysqli->query("SELECT * FROM `regional` LIMIT 1");
	$row = $reg_code->fetch_array(MYSQLI_ASSOC);
	
	$key = $row["eventCode"];
?>
<br>
<br>
<br>
<br>
<br>
<table id="scoutTable">
	<thead>
		<tr class="scoutTHead">
			<th>Team #</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody>
<?php
	$teams = $mysqli->query("SELECT * FROM `teams`");
	
	while($row = $teams->fetch_array(MYSQLI_ASSOC))
	{
		?>
		<tr>
			<td><a href="TeamInfoDisplay.php?team=<?=$row['number'];?>"><?=$row['number']?></a></td>
			<td><?=$row['name']?></td>
		</tr>
		<?php
	}

?>
	</tbody>
</table>