<?php
	session_start();
	
	$pass = $_POST['password'];
	
	if(strcmp($pass,"driveteam624")==0)
	{
		$_SESSION['valid'] = true;
		$_SESSION['type'] = "driver";
		session_commit();
		?>
		<script>location.href = "drivers_page.php"</script>
		<?php
	}
	else if(strcmp($pass,"money624admin")==0)
	{
		$_SESSION['valid'] = true;
		$_SESSION['type'] = "admin";
		session_commit();
		?>
		<script>location.href = "mainpage.php"</script>
		<?php
	}
	else if(strcmp($pass,"crscout624")==0)
	{
		$_SESSION['valid'] = true;
		$_SESSION['type'] = "scout";
		session_commit();
		?>
		<script>location.href = "mainpage.php"</script>
		<?php
	}
	else if(strcmp($pass,"dataentry624")==0)
	{
		$_SESSION['valid'] = true;
		$_SESSION['type'] = "data";
		session_commit();
		?>
		<script>location.href = "mainpage.php"</script>
		<?php
	}
	else
	{
		$_SESSION['valid'] = false;
		$_SESSION['type'] = "intruder";
		session_commit();
		?>
		<script>location.href = "index.php?login=invalid"</script>
		<?php
	}
?>