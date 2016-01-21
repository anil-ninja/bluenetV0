<?php

session_start();

require_once "../dbConnection.php";

if(isset($_POST['remark'])){
	$remark = $_POST['remark'];
	$sr_id = $_POST['id'];
	$date = $_POST['date'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$user_id = $_SESSION['user_id'];
	
	$worker = mysqli_query ($db_handle, "SELECT id FROM workers WHERE first_name = '$name' AND phone = '$phone' ;");
	$workers = mysqli_fetch_array($worker);
	$worker_id = $workers['id'];

	mysqli_query ($db_handle, "INSERT INTO meetings ( match_id, meeting_time, remarks, cem_id, worker_id) 
								VALUES ('$sr_id', '$date', '$remark', '$user_id', '$worker_id') ;");
	mysqli_query ($db_handle, "UPDATE service_request SET status = 'meeting', done_worker_id = '$worker_id' WHERE id = '$sr_id' ;");
 
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}

?>