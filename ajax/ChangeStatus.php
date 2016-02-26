<?php

session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";

if(isset($_POST['sr_id'])){
	$newStatus = $_POST['new_status'];
	$sr_id = $_POST['sr_id'];
	$oldStatus = $_POST['old_status'];
	$user_id = $_SESSION['user_id'];
	
	$sql = mysqli_query ($db_handle, "UPDATE service_request SET status = '$newStatus'  WHERE id = '$sr_id' ;");
	$sql = mysqli_query ($db_handle, "INSERT INTO updates( user_id, request_id, old_status, new_status) 
														VALUES ('$user_id', '$sr_id', '$oldStatus', '$newStatus') ;");
	if($newStatus == 'me_open'){
		mysqli_query ($db_handle, "UPDATE service_request SET match_id = 0, match2_id = 0  WHERE id = '$sr_id' ;");
	}
	if($oldStatus == 'demo'){
		$salary = $_POST['salary'];
		mysqli_query ($db_handle, "UPDATE service_request SET fixed_salary = '$salary' WHERE id = '$sr_id' ;");
	}
	if(mysqli_error($db_handle)) return "error" ;
	else return true ;
}
mysqli_close($db_handle);
?>