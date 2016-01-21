<?php

session_start();

require_once "../dbConnection.php";

if(isset($_POST['remark'])){
	$remark = $_POST['remark'];
	$sr_id = $_POST['id'];
	$date = $_POST['date'];
	$user_id = $_SESSION['user_id'];
	mysqli_query ($db_handle, "INSERT INTO meetings ( match_id, meeting_time, remarks, cem_id) VALUES ('$sr_id', '$date', '$remark', '$user_id') ;");
	mysqli_query ($db_handle, "UPDATE service_request SET status= 'meeting'  WHERE id = '$sr_id' ;");
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}

?>