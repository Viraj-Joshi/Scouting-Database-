<?php 
 //This navbar should be enough, but we will need to account for the user type
 //This means that different users will see different things
 include("UserVerification.php");
?>


<body>
<!--<div class="navbar">-->
<header>

	<?php
			if(strcmp($user_type,"driver")==0)
			{
		?>
			<a class="logo" href="drivers_page.php"></img></a>
		<?php		
			}
			else if(strcmp($user_type,"data")==0)
			{
		?>
			<a class="logo" href="DataEntry.php"></img></a>
		<?php
			}
			else
			{
		?>
			<a class="logo" href="mainpage.php"></img></a>
		
		<?php
			}
		?>
		
<nav>
<a href="#" id="menu-icon"></a>
	<ul class="navbar">
		
		
		<?php
			if(strcmp($user_type,"data")==0 || strcmp($user_type,"admin")==0 )
			{
			
		?>
			<li class="navbar"><a class="navbar" href="DataEntry.php">Data Entry</a></li>
		<?php
			}
		?>
			<li class="navbar"><a class="navbar" href="MatchSchedule.php">Match Schedule</a></li>
			<li class="navbar"><a class="navbar" href="Search.php">Search</a></li>
			<li class="navbar"><a class="navbar" href="TeamList.php">Team List</a></li>
			<li class="navbar"><a class="navbar" href="DataCoverage.php">Data Coverage</a></li>
			<li class="navbar"><a class="navbar" href="Rankings.php">Rankings</a></li>
			<li class="navbar"><a class="navbar" href="ScoutList.php">Scout List</a></li>
		<?php
			if(strcmp($user_type,"admin")==0)
			{
		?>
			<li class="navbar"><a class="navbar" href="Setup.php">Setup</a></li>
			<li class="navbar"><a class="navbar" href="RawData.php">Raw Data</a></li>
			<li class="navbar"><a class="navbar" href="NoteEntry.php">Note Entry</a></li>
<!--			<li class="navbar"><a class="navbar" href="picture_upload.php">Images</a></li> -->
		<?php
			}
			if(strcmp($user_type,"driver")==0)
			{
		?>
			<li class="navbar"><a class="navbar" href="matchManagement.php">Manage Matches</a></li>
		<?php
			}
		?>
			<li class="navbar"><a class="navbar" href="logout.php">Logout</a></li>
	</ul>
</nav>
</header>
<!--</div>-->