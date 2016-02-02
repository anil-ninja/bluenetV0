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
	$newarea = $_POST['newarea'];
	$status = $_POST['new_status'];
	$remarks = $_POST['remarks'];
	$time = $_POST['work_time'];
	$created_time = $_POST['created_time'];
	$worker_area = $_POST['worker_area'];
	$newworkerarea = $_POST['newworkerarea'];
	$gender = $_POST['gender'];
	$user_id = $_SESSION['user_id'];
	$skills = $_POST['skills'];
	$services = $_POST['services'];
	$newskill = $_POST['newskill'];
	$time1 = $timing." am";
	$time2 = $timing2." pm";
	$newtime = $time1."-".$time2;
	$newsalary = $salary."-".$salary2." K";
	$areaworker = "";
	if($worker_area != 0 AND $worker_area != null AND $worker_area != "" ){
		$eachworkarea = explode(",", $worker_area);
		foreach ($eachworkarea as $workareas) {
			$newareaid = trim($workareas);
			$workarea = mysqli_query ($db_handle, "SELECT * FROM area WHERE id='$newareaid');");
			$areas = mysqli_fetch_array($workarea);
			$areaworker .= $areas['name'];
		}
		if($newworkerarea != null AND $newworkerarea != "" AND $newworkerarea != " ") $areaworker = $areaworker.",".$worker_area;
	}
	else $areaworker .= $worker_area;
	$clientarea = "";
	if($area != 0 AND $area != null AND $area != "" ){
		$eachworkarea = explode(",", $area);
		foreach ($eachworkarea as $workareas) {
			$newareaid = trim($workareas);
			$workarea = mysqli_query ($db_handle, "SELECT * FROM area WHERE id='$newareaid');");
			$areas = mysqli_fetch_array($workarea);
			$clientarea .= $areas['name'];
		}
		if($newarea != null AND $newarea != "" AND $newarea != " ") $clientarea = $clientarea.",".$worker_area;
	}
	else $clientarea .= $worker_area;
	mysqli_query ($db_handle, "INSERT INTO service_request (name, mobile, requirements, gender, timings, expected_salary, address, area,
										remarks, status, worker_area, work_time, created_time)	
									VALUES ('$name','$mobile','$services','$gender','$newtime', '$newsalary', '$address', '$clientarea','$remarks', 
										'$status', '$areaworker', '$time', '$created_time');");
	
	$sr_id = mysqli_insert_id($db_handle);
	$eachworkarea = explode(",", $areaworker);
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