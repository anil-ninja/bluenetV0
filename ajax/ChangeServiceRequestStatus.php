<?php

session_start();

require_once "../dbConnection.php";

if(isset($_POST['sr_id'])){
	$newStatus = $_POST['new_status'];
	$sr_id = $_POST['sr_id'];
	$oldStatus = $_POST['old_status'];
	$user_id = $_SESSION['user_id'];
	
	$sql = mysqli_query ($db_handle, "UPDATE service_request SET status= '$newStatus'  WHERE id = '$sr_id' ;");
	$sql = mysqli_query ($db_handle, "INSERT INTO updates( user_id, request_id, old_status, new_status) 
														VALUES ('$user_id', '$sr_id', '$oldStatus', '$newStatus') ;");
	if($newStatus == 'me_open'){
		mysqli_query ($db_handle, "UPDATE service_request SET match_id = 0, match2_id = 0  WHERE id = '$sr_id' ;");
	}
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}

?>