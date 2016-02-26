<?php

session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";

if(isset($_POST['remark'])){
	$remark = $_POST['remark'];
	$sr_id = $_POST['id'];
	$date = $_POST['date'];
	$worker = $_POST['worker'];
	$user_id = $_SESSION['user_id'];
	if ($worker == 1){
		$workerid = mysqli_query ($db_handle, "SELECT match_id FROM service_request WHERE id = '$sr_id' ;");
		$workers = mysqli_fetch_array($workerid);
		$worker_id = $workers['match_id'];
	}
	elseif ($worker == 2) {
		$workerid = mysqli_query ($db_handle, "SELECT match2_id FROM service_request WHERE id = '$sr_id' ;");
		$workers = mysqli_fetch_array($workerid);
		$worker_id = $workers['match2_id'];
	}
	else {
		$worker_id = 0;
	}
	mysqli_query ($db_handle, "INSERT INTO meetings ( match_id, meeting_time, remarks, cem_id, worker_id) 
								VALUES ('$sr_id', '$date', '$remark', '$user_id', '$worker_id') ;");
	if($worker_id != 0){
		mysqli_query ($db_handle, "UPDATE service_request SET status = 'meeting', done_worker_id = '$worker_id' WHERE id = '$sr_id' ;");
	} 
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}
mysqli_close($db_handle);
?>