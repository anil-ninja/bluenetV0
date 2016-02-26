<?php
session_start();
require_once "../components/dbConnection.php";
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
if(isset($_POST['request_id'])){
	$request_id = $_POST['request_id'];
	$me_id = $_SESSION['user_id'];
	$type = $_SESSION["employee_type"];
	$newdate = date("Y-m-d H:i:s");
	if($type == "me"){	
		mysqli_query($db_handle,"UPDATE service_request SET me_id = '$me_id', last_updated = '$newdate' WHERE id = '$request_id';") ;
		if(mysqli_error($db_handle)) return false ;
		else return true ;
	}
	else {
		mysqli_query($db_handle,"UPDATE service_request SET cem_id = '$me_id', last_updated = '$newdate' WHERE id = '$request_id';") ;
		if(mysqli_error($db_handle)) return false ;
		else return true ;
	}
	mysqli_query ($db_handle, "INSERT INTO updates( user_id, request_id, old_status, new_status) 
														VALUES ('$me_id', '$request_id', 'open', 'picked') ;");
}
mysqli_close($db_handle);
?>