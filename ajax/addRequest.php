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
	$status = $_POST['new_status'];
	$remarks = $_POST['remarks'];
	$time = $_POST['work_time'];
	$created_time = $_POST['created_time'];
	$worker_area = $_POST['worker_area'];
	$gender = $_POST['gender'];
	$user_id = $_SESSION['user_id'];
	$skill = $_POST['skill'];
	/*for($i=0; $i < $skill; $i++) {
      $requirement .= ", ".$_POST['skill'][$i];
    }
    $str2 = substr($requirement, 1); */
	mysqli_query ($db_handle, "INSERT INTO service_request (name, mobile, requirements, gender, timings, expected_salary, address, area,
										remarks, status, worker_area, work_time, created_time)	VALUES ('$name','$mobile','$skill','$gender','$timing',
										'$salary', '$address', '$area','$remarks', '$status', '$worker_area', '$time', '$created_time');");
	
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