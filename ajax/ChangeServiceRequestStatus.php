<?php

session_start();

require_once "../dbConnection.php";


	
	$newStatus = $_POST['new_status'];
	$sr_id = $_POST['sr_id'];
	$oldStatus = $_POST['old_status'];
	$user_id = $_SESSION['user_id'];
	
	$sql = mysqli_query ($db_handle, "UPDATE service_request SET status= '$newStatus', me_id= '$user_id'  WHERE id = '$sr_id' ;");
	$sql = mysqli_query ($db_handle, "INSERT INTO updates( user_id, request_id, old_status, new_status) 
														VALUES ('$user_id', '$sr_id', '$oldStatus', '$newStatus') ;");
	if(mysqli_connect_errno()){	

	}
	else { 
		//header("Location: #"); 
	}

?>