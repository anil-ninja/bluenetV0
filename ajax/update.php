<?php
session_start();
require_once "../dbConnection.php";
if (isset($_POST['name'])) {
	$name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$timing = $_POST['timing'];
	$timing2 = $_POST['timing2'];
	$salary = $_POST['salary'];
	$salary2 = $_POST['salary2'];
	$area = $_POST['area'];
	$remarks = $_POST['remarks'];
	$worktime = $_POST['work_time'];
	$created_time = $_POST['created_time'];
	$worker_area = $_POST['worker_area'];
	$gender = $_POST['gender'];
	$user_id = $_SESSION['user_id'];
	$sr_id = $_POST['sr_id'];
	$skills = $_POST['skills'];
	$services = $_POST['services'];
	$newskill = $_POST['newskill'];
	if($timing < 12) $time1 = $timing." am";
	else {
		if($timing == 12) $time1 = $timing." pm";
		else $time1 = ($timing-12)." pm";
	}
	if($timing2 < 12) $time2 = $timing2." am";
	else {
		if($timing2 == 12) $time2 = $timing2." pm";
		else $time2 = ($timing2-12)." pm";
	}
	$newtime = $time1."-".$time2;
	$newsalary = $salary."-".$salary2." K";
	$time = date("Y-m-d H:i:s");
	mysqli_query ($db_handle, "UPDATE service_request SET name='$name',mobile='$mobile',requirements='$services',gender='$gender',timings='$newtime',
										expected_salary='$newsalary',address='$address',area='$area',remarks='$remarks',last_updated='$time', 
										worker_area='$worker_area', work_time='$worktime', created_time='$created_time' WHERE id='$sr_id' ;");
	
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
	$newskils = explode(",", $newskill);
	foreach ($newskils as $skil){
		mysqli_query($db_handle,"INSERT INTO skill_name (name) VALUES ('$skil');");
		$skil_id = mysqli_insert_id($db_handle);
		mysqli_query($db_handle,"INSERT INTO skills ( user_id, skill_id, type, employee_id) 
									VALUES ('$sr_id', '$skil_id', 'client', '$user_id');");
	}
	$newskil = explode(",", $skills);
	foreach ($newskil as $skil){
		mysqli_query($db_handle,"INSERT INTO skills ( user_id, skill_id, type, employee_id) 
									VALUES ('$sr_id', '$skil', 'client', '$user_id');");
	}
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}

mysqli_close($db_handle);
?>