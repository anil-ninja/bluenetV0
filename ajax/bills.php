<?php

session_start();

require_once "../components/dbConnection.php";

if(isset($_POST['sr_id'])){
	$percent = $_POST['percent'];
	$type = $_POST['type'];
	$sr_id = $_POST['sr_id'];
	$user_id = $_SESSION['user_id'];
	if($type == 'worker'){
		$details = mysqli_query ($db_handle, "SELECT * FROM workers WHERE  id = '$sr_id' ;");
		$detailsRow = mysqli_fetch_array($details);
	}
	else if($type == 'employee'){
		$details = mysqli_query ($db_handle, "SELECT * FROM users WHERE  id = '$sr_id' ;");
		$detailsRow = mysqli_fetch_array($details);
	}
	else {
		$details = mysqli_query ($db_handle, "SELECT * FROM service_request WHERE id = '$sr_id' ;");
		$detailsRow = mysqli_fetch_array($details);
		$clientname = $detailsRow['name'];
		$clientmobile = $detailsRow['mobile'];
		$clientaddress = $detailsRow['address'];
		$clientemail = $detailsRow['email'];
		$requirements = $detailsRow['requirements'];
		$salary = $detailsRow['fixed_salary'];
		$worker_id = $detailsRow['done_worker_id'];
		$worker = mysqli_query($db_handle, "SELECT * FROM workers WHERE id = '$worker_id' ;");
		$workerRow = mysqli_fetch_array($worker);
		$workername = $workerRow['first_name']." ".$workerRow['last_name'];
		$workermobile = $workerRow['phone'] ;
		$workeraddress = $workerRow['current_address'] ;
		$service_tax = (($salary*(14.5))/100) ;
		$subtotal = ($service_tax + $salary);
		if($percent == '20'){
			$tobepaid = ($subtotal/5);
			$pending = ($subtotal-$tobepaid);
		}
		else if($percent == '80'){
			$paid = ($subtotal/5);
			$tobepaid = ($subtotal-$paid);
		}
		else {
			$tobepaid = $salary;
		}
	}
}
mysqli_close($db_handle);
?>