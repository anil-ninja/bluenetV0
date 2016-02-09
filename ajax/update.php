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
	$areas = $_POST['area'];
	$newarea = $_POST['newarea'];
	$status = $_POST['new_status'];
	$remarks = $_POST['remarks'];
	$time = $_POST['work_time'];
	$created_time = $_POST['created_time'];
	$worker_areas = $_POST['worker_area'];
	$newworkerarea = $_POST['newworkerarea'];
	$gender = $_POST['gender'];
	$user_id = $_SESSION['user_id'];
	$skills = $_POST['skills'];
	$services = $_POST['services'];
	$newskill = $_POST['newskill'];
	$sr_id = $_POST['sr_id'];
	$priority = $_POST['priority'];
	$time11 = explode(":", $timing);
	$time22 = explode(":", $timing2);
	if($time11[0] < 12) $time1 = $timing." am";
	else {
		if($time11[0] == 12) $time1 = $timing." pm";
		else $time1 = ($time11[0]-12).":".$time11[1]." pm";
	}
	if($time22[0] < 12) $time2 = $timing2." am";
	else {
		if($time22[0] == 12) $time2 = $timing2." pm";
		else $time2 = ($time22[0]-12).":".$time22[1]." pm";
	}
	$newtime = $time1."-".$time2;
	$workerareas = "";
	if($worker_areas != 0 AND $worker_areas != null AND $worker_areas != "" ){
		$eachworkerarea = explode(",", $worker_areas);
		foreach ($eachworkerarea as $workerarea) {
			$areaid = trim($workerarea);
			$workerareaname = mysqli_query($db_handle, "SELECT * FROM area WHERE id = '$areaid' ;");
			$workerareanameRow = mysqli_fetch_array($workerareaname);
			$workerareas .= $workerareanameRow['name'].",";
		}
		if($newworkerarea != null AND $newworkerarea != "" AND $newworkerarea != " ") $workerareas = $workerareas.$newworkerarea;
	}
	else $workerareas .= $newworkerarea;
	$clientarea = "";
	if($areas != 0 AND $areas != null AND $areas != "" ){
		$eacharea = explode(",", $areas);
		foreach ($eacharea as $area) {
			$areaid = trim($area);
			$areaname = mysqli_query ($db_handle, "SELECT * FROM area WHERE id='$areaid';");
			$areanameRow = mysqli_fetch_array($areaname);
			$clientarea .= $areanameRow['name'].",";
		}
		if($newarea != null AND $newarea != "" AND $newarea != " ") $clientarea = $clientarea.$newarea;
	}
	else $clientarea .= $newarea;
	$newdate = date("Y-m-d H:i:s");
	$user_id = $_SESSION['user_id'];
	mysqli_query ($db_handle, "UPDATE service_request SET name='$name',mobile='$mobile',requirements='$services',gender='$gender',timings='$newtime',
										min_salary='$salary',max_salary='$salary2',address='$address',area='$clientarea',remarks='$remarks',
										last_updated='$newdate',worker_area='$workerareas', work_time='$time', created_time='$created_time', 
										user_id = '$user_id',priority = '$priority' WHERE id ='$sr_id' ;");
	
	$sr_id = mysqli_insert_id($db_handle);
	$eachworkarea = explode(",", $workerareas);
	foreach ($eachworkarea as $workareas) {
		$newarea = trim($workareas);
		if($newarea != null OR $newarea != "" OR $newarea != " "){
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
	}
	$newskils = explode(",", $newskill);
	if($newskils != null OR $newskils != "" OR $newskils != " "){
		foreach ($newskils as $skil){
			mysqli_query($db_handle,"INSERT INTO skill_name (name) VALUES ('$skil');");
			$skil_id = mysqli_insert_id($db_handle);
			mysqli_query($db_handle,"INSERT INTO skills ( user_id, skill_id, type, employee_id) 
										VALUES ('$sr_id', '$skil_id', 'client', '$user_id');");
		}
	}
	$newskil = explode(",", $skills);
	if($newskil != null OR $newskil != "" OR $newskil != " " OR $newskil != 0){
		foreach ($newskil as $skil){
			mysqli_query($db_handle,"INSERT INTO skills ( user_id, skill_id, type, employee_id) 
										VALUES ('$sr_id', '$skil', 'client', '$user_id');");
		}
	}
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}

mysqli_close($db_handle);
?>