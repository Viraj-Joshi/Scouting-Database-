<?php
	session_start();
	$_SESSION['valid']=false;
	$_SESSION['type']="intruder";
	session_destroy();
?>
	<script>location.href = "index.php?login=loggedOut"</script>
<?php

?>