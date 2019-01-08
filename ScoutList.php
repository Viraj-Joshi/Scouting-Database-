<?php
//Scout List
include("HeadTemplate.php");
include("UserVerification.php");
include("kick_intruders.php");
include("navbar.php");
include("db_connect.php");
?>
<br>
<br>
<br>
<br>

<div class = "title" >
	<h1> Scout List </h1>
</div>

<div class="page_container">

	<!-- Make this table look good -->

	<table id="scoutTable">
		<tr class="scoutTHead">
			<th>ID</th>
			<th>First</th>
			<th>Last</th>
		</tr>
		<?php
			$query = "SELECT * FROM scouts";
			$result = $mysqli->query($query);
			
			while($row = $result->fetch_array(MYSQLI_ASSOC))
			{
		?>
			<tr>
				<td><?php echo $row['id'];?></td>
				<td><?php echo $row['firstname']; ?></td>
				<td><?php echo $row['lastname']; ?></td>
			</tr>
		<?php
			}
		?>
	</table>
</div>