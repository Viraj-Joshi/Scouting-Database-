<?php
	if(!isset($valid_user) || !isset($user_type))
	{
		header("Location: logout.php");
	}
	else if($valid_user==false || $user_type=="intruder")
	{
		header("Location: index.php?login=invalid");
	}
?>