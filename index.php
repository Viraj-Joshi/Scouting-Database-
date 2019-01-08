<?php
include("HeadTemplate.php");
include("UserVerification.php");

//If already signed in, don't sign in again
if(isset($valid_user) && isset($user_type))
{
	if($valid_user = true)
	{
		if(strcmp($user_type,"driver")==0)
		{
			?>
			<script>location.href = "drivers_page.php"</script>
			<?php
		}
		else if(strcmp($user_type,"intruder")!=0)
		{
			?>
			<script>location.href = "mainpage.php"</script>
			<?php
		}
	}
}

?>
<html>
	<body id="index_body">
	<br>
	<br>
		<div id="dialog_centerer">
			<!-- This is going to be the team's logo -->
			<img src="images/pretty_green_text.png"></img>
	
			<?php
			if(isset($_GET['login']))
			{
				if(strcmp($_GET['login'],"invalid")==0)
				{
			?>
					<div class="error_message"> <!-- Make this a red error message -->
						Invalid Login Information
					</div>
			<?php
				}
				else if(strcmp($_GET['login'],"loggedOut")==0)
				{
					?>
						<div class="logout_message"> <!-- Make this a green message -->
							Successfully Logged Out!
						</div>
					<?php
				}
			}
			?>
			
			<!-- Make this into a cool login dialog box thing pls -->
			<div class="loginDialog">
			<h1>Scouting Database</h1>
			<h3>Login Password </h3>
				<form method="post" action="login.php">
					<input type="password" name ="password"></input><br><br>
					<input type="submit" name="Submit" class="subButton"></input>
				</form>
			</div>
		</div>
	</body>
</html>