<?php

	$db_handle = mysqli_connect("localhost","root","redhat@11111p","bluenethack_v0");

//Check connection
	if (mysqli_connect_errno()) {
	  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


	include_once "functions.php";		
?>
