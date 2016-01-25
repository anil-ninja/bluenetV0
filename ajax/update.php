<?php
session_start();
require_once "../dbConnection.php";
if (isset($_POST['name'])) {
	$name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$timing = $_POST['timing'];
	$salary = $_POST['salary'];
	$area = $_POST['area'];
	$remarks = $_POST['remarks'];
	$time = $_POST['work_time'];
	$created_time = $_POST['created_time'];
	$worker_area = $_POST['worker_area'];
	$gender = $_POST['gender'];
	$user_id = $_SESSION['user_id'];
	$skill = $_POST['skills'];
	$sr_id = $_POST['sr_id'];
	$time = date("Y-m-d H:i:s");
	$sql = mysqli_query ($db_handle, "UPDATE service_request SET name='$name',mobile='$mobile',requirements='$skill',gender='$gender',timings='$timing',
										expected_salary='$salary',address='$address',area='$area',remarks='$remarks',last_updated='$time', 
										worker_area='$worker_area', work_time='$work_time', created_time='$created_time' WHERE id='$sr_id' ;");
	$sr_id = mysqli_insert_id($db_handle);
	$eachworkarea = explode(",", $worker_area);
	foreach ($eachworkarea as $workareas) {
		$newarea = trim($workareas);
		$workarea = mysqli_query ($db_handle, "SELECT * FROM area WHERE name='$newarea');");
		if(mysqli_num_rows($workarea) != 0){
			$areas = mysqli_fetch_array($workarea);
			$area_id = $areas['id'];
			mysqli_query ($db_handle, "INSERT INTO sr_area (id, sr_id) VALUES ('$area_id', '$sr_id');");
		}
		else {
			mysqli_query ($db_handle, "INSERT INTO area (name) VALUES ('$newarea');");
			$area_id = mysqli_insert_id($db_handle);
			mysqli_query ($db_handle, "INSERT INTO sr_area (id, sr_id) VALUES ('$area_id', '$sr_id');");
		}
	}
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}

mysqli_close($db_handle);
?>