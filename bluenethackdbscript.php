<?php
$db_handle = mysqli_connect("localhost","root","redhat@11111p","bluenethack");
$db_handle22 = mysqli_connect("localhost","root","redhat@11111p","bluenethack_v0");
$data = mysqli_query ($db_handle, "SELECT * FROM service_request ;");
while($datarow = mysqli_fetch_array($data)){
	$name = $datarow['name'];	$mobile = $datarow['mobile'];	$requirements = $datarow['requirements'];	$gender = $datarow['gender'];
	$timings = $datarow['timings'];	$expected_salary = $datarow['expected_salary'];	$address = $datarow['address'];	$area = $datarow['area'];
	$remarks = $datarow['remarks'];	$worker_area = $datarow['worker_area'];	$work_time = $datarow['work_time'];	$created_time = $datarow['created_time'];
	$date = $datarow['date'];	$status = $datarow['status'];	$match_name = $datarow['match_name'];	$match_mobile = $datarow['match_mobile'];
	$match2_name = $datarow['match2_name'];	$match2_mobile = $datarow['match2_mobile']; $sr_id = $datarow['id'];
	if($gender == 'F') $gend = "female";
	elseif($gender == 'M') $gend = "male";
	else $gend = "any";
	if($match_mobile == 0) $match_id = 0;
	else {
		mysqli_query($db_handle22, "INSERT INTO workers (first_name, phone, me_id) VALUES ('$match_name','$match_mobile', '8');");
		$match_id = mysqli_insert_id($db_handle22);
	}
	if($match2_mobile == 0) $match2_id = 0;
	else {
		mysqli_query($db_handle22, "INSERT INTO workers (first_name, phone, me_id) VALUES ('$match2_name','$match2_mobile', '8');");
		$match2_id = mysqli_insert_id($db_handle22);
	}
	mysqli_query($db_handle22, "INSERT INTO service_request (name, mobile, requirements, gender, timings, expected_salary, address, area, remarks, worker_area, work_time, created_time, date, status, match_id, match2_id, cem_id, me_id) VALUES ('$name', '$mobile', '$requirements', '$gend', '$timings', '$expected_salary', '$address', '$area', '$remarks', '$worker_area', '$work_time', '$created_time', '$date', '$status', '$match_id', '$match2_id', '6', '8');");
	$newSrID = mysqli_insert_id($db_handle22);
	$notes = mysqli_query ($db_handle, "SELECT * FROM notes WHERE sr_id = '$sr_id';");
	$notesRow = mysqli_fetch_array($notes);
	$note = $notesRow['note'];	$dateN = $notesRow['date'];	$cem_id = $notesRow['cem_id'];
	if(($dateN != 0) OR ($note != "")){
		mysqli_query($db_handle22, "INSERT INTO notes (sr_id, note, date, cem_id, about) VALUES ('$newSrID', '$note', '$dateN', '6', 'client_request');");
	}
	$updates = mysqli_query ($db_handle, "SELECT * FROM `updates` WHERE request_id = '$sr_id';");
	$updatesRow = mysqli_fetch_array($updates);
	$update_time = $updatesRow['update_time'];	$old_status = $updatesRow['old_status'];	$new_status = $updatesRow['new_status'];
	if(($update_time != 0) OR ($old_status != "") OR ($new_status != "") ){
		mysqli_query($db_handle22, "INSERT INTO updates(user_id, update_time, request_id, old_status, new_status) VALUES ('6', '$update_time', '$newSrID', '$old_status', '$new_status');");
	}
	echo "Done \n";
}
?>
