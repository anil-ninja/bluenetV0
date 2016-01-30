<?php
session_start();
require_once "../dbConnection.php";
if(isset($_POST['first_name'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	/*$address_proof_name = $_POST['address_proof_name'];
	$address_proof_id = $_POST['address_proof_id'];
	$id_proof_name = $_POST['id_proof_name'];
	$id_proof_id = $_POST['id_proof_id'];*/
	$mobile = $_POST['mobile'];
	$emergancy_mobile = $_POST['emergancy_mobile'];
	$age = $_POST['age'];
	$current_address = $_POST['current_address'];
	$parmanent_address = $_POST['parmanent_address'];
	$education = $_POST['education'];
	$experience = $_POST['experience'];
	$gender = $_POST['gender'];
	$birth_date = $_POST['birth_date'];
	$work_time = $_POST['work_time'];
	$remarks = $_POST['remarks'];
	$police = $_POST['police'];
	$languages = $_POST['languages'];
	$skills = $_POST['skills'];
	$services = $_POST['services'];
	$newskill = $_POST['newskill'];
	$request_id = $_POST['request_id'];
	$type = $_POST['type'];
	$me_id = $_SESSION['user_id'];
	$timing = $_POST['timing'];
	$timing2 = $_POST['timing2'];
	$salary = $_POST['salary'];
	$salary2 = $_POST['salary2'];
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
	mysqli_query($db_handle,"INSERT INTO workers (first_name, last_name, phone, gender, birth_date, age, education, languages, expected_salary, 
										current_address, permanent_address, timings, work_time, varification_status, emergency_phone,  experience, 
										remarks, service, me_id) 
									VALUES ('$first_name', '$last_name', '$mobile', '$gender', '$birth_date', '$age', '$education', '$languages', 
										'$newsalary', '$current_address', '$parmanent_address', '$newtime', '$work_time', '$police', 
										'$emergancy_mobile', '$experience',	'$remarks', '$services', '$me_id');");
	$worker_id = mysqli_insert_id($db_handle);
	$newskils = explode(",", $newskill);
	foreach ($newskils as $skil){
		mysqli_query($db_handle,"INSERT INTO skill_name (name) VALUES ('$skil');");
		$skil_id = mysqli_insert_id($db_handle);
		mysqli_query($db_handle,"INSERT INTO skills ( user_id, skill_id, type, employee_id) 
									VALUES ('$worker_id', '$skil_id', 'worker', '$me_id');");
	}
	$newskil = explode(",", $skills);
	foreach ($newskil as $skil){
		mysqli_query($db_handle,"INSERT INTO skills ( user_id, skill_id, type, employee_id) 
									VALUES ('$worker_id', '$skil', 'worker', '$me_id');");
	}
	if($type == 1){
		mysqli_query($db_handle,"UPDATE service_request SET match_id = '$worker_id' where id = '$request_id' ;");
	}
	else if ($type == 2){
		mysqli_query($db_handle,"UPDATE service_request SET match2_id = '$worker_id' where id = '$request_id' ;");
	}
	else {}
	
	if(mysqli_error($db_handle)) return false ;
	else return true ;
}
mysqli_close($db_handle);
/*address_proof_name, address_proof_id, id_proof_name, id_proof_id,
'$address_proof_name', '$address_proof_id', '$id_proof_name', '$id_proof_id',*/
?>