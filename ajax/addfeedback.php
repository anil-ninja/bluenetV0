<?php

session_start();

require_once "../components/dbConnection.php";

if(isset($_POST['id'])){
	$type = $_POST['type'];
	$sr_id = $_POST['id'];
	$feedback = $_POST['feedback'];
	$user_id = $_SESSION['user_id'];
	$srs = mysqli_query ($db_handle, "SELECT * FROM service_request WHERE id = '$sr_id' ;");
	$srsrow = mysqli_fetch_array($srs);
	$worker_id = $srsrow['done_worker_id'];
	if($type == 'client'){
		mysqli_query ($db_handle, "INSERT INTO feedback ( feedback_id, type, request_id, feedback, operator_id, status) 
									VALUES ('$sr_id', '$type', '$sr_id', '$feedback', '$user_id', 'done') ;");
	}
	else {
		mysqli_query ($db_handle, "INSERT INTO feedback ( feedback_id, type, request_id, feedback, operator_id, status) 
									VALUES ('$worker_id', '$type', '$sr_id', '$feedback', '$user_id', 'done') ;");
	}
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}
mysqli_close($db_handle);
?>