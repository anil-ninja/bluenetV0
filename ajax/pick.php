<?php
session_start();
require_once "../dbConnection.php";
if(isset($_POST['request_id'])){
	$request_id = $_POST['request_id'];
	$me_id = $_SESSION['user_id'];
	$type = $_SESSION["employee_type"];
	if($type == "me"){	
		mysqli_query($db_handle,"UPDATE service_request SET me_id = '$me_id' WHERE id = '$request_id';") ;
		if(mysqli_error($db_handle)) return false ;
		else return true ;
	}
	else {
		mysqli_query($db_handle,"UPDATE service_request SET cem_id = '$me_id' WHERE id = '$request_id';") ;
		if(mysqli_error($db_handle)) return false ;
		else return true ;
	}
}
mysqli_close($db_handle);
?>