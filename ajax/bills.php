<?php

session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";
include_once 'getBillFun.php';

if(isset($_GET['sr_id'])){
	$percent = $_GET['percent'];
	$type = $_GET['type'];
	$sr_id = $_GET['sr_id'];
	$discount = $_GET['discount'];
	$user_id = $_SESSION['user_id'];
	var_dump($_GET);
	if($type == 'worker'){
		$details = mysqli_query ($db_handle, "SELECT * FROM workers WHERE  id = '$sr_id' ;");
		$detailsRow = mysqli_fetch_array($details);
	}
	else if($type == 'employee'){
		$details = mysqli_query ($db_handle, "SELECT * FROM users WHERE  id = '$sr_id' ;");
		$detailsRow = mysqli_fetch_array($details);
	}
	else {
		mysqli_query ($db_handle, "INSERT INTO bills (type, user_id, request_id, details) VALUES ('$type', '$user_id', '$sr_id', '$percent') ;");
		$invoice_id = date('Y-m-d H:i:s').".".mysqli_insert_id($db_handle);
		$details = mysqli_query ($db_handle, "SELECT * FROM service_request WHERE id = '$sr_id' ;");
		$detailsRow = mysqli_fetch_array($details);
		$clientname = $detailsRow['name'];
		$clientmobile = $detailsRow['mobile'];
		$clientaddress = $detailsRow['address'];
		$clientemail = $detailsRow['email'];
		$requirements = $detailsRow['requirements'];
		$clientarea = $detailsRow['area'];
		$salary = $detailsRow['fixed_salary'];
		$worker_id = $detailsRow['done_worker_id'];
		$worker = mysqli_query($db_handle, "SELECT * FROM workers WHERE id = '$worker_id' ;");
		$workerRow = mysqli_fetch_array($worker);
		$workername = $workerRow['first_name']." ".$workerRow['last_name'];
		$workermobile = $workerRow['phone'] ;
		$workeraddress = $workerRow['current_address'] ;
		$service_tax = (($salary*(14.5))/100) ;
		$subtotal = ($service_tax + $salary);
		$invoiceDate = date('d-m-Y');
		if($percent == '20'){
			if($discount != 0){
				$cemDiscount = (($salary*$discount)/100);
				$tobepaid = (($subtotal-$cemDiscount)/5);
				$pending = ($tobepaid*4);
				$finalTotal = ($tobepaid+$pending);
			}
			else {
				$cemDiscount = 0 ;
				$tobepaid = ($subtotal/5);
				$pending = ($tobepaid*4);
				$finalTotal = ($tobepaid+$pending);
			}
			gettwentyBillFun($clientname, $invoiceDate, $clientaddress, $invoice_id, $clientarea, $clientmobile, $clientemail,
                    $requirements, $workername, $workeraddress, $workermobile, $startingDate, $salary,
                    $subtotal, $service_tax, $discount, $cemDiscount, $tobepaid, $pending, $finalTotal, $couponNo);
		}
		else if($percent == '80'){
			if($discount != 0){
				$cemDiscount = (($salary*$discount)/100);
				$paid = (($subtotal-$cemDiscount)/5);
				$tobepaid = ($paid*4);
				$finalTotal = ($tobepaid+$paid);
			}
			else {
				$cemDiscount = 0 ;
				$paid = ($subtotal/5);
				$tobepaid = ($paid*4);
				$finalTotal = ($tobepaid+$paid);
			}
			geteightyBillFun($clientname, $invoiceDate, $clientaddress, $invoice_id, $clientarea, $clientmobile, $clientemail,
                    $requirements, $workername, $workeraddress, $workermobile, $startingDate, $salary,
                    $subtotal, $service_tax, $discount, $cemDiscount, $paid, $tobepaid, $finalTotal, $couponNo);
		}
		else {
			$tobepaid = $salary;
			getondemandBillFun($clientname, $invoiceDate, $clientaddress, $invoice_id, $clientarea, $clientmobile, $clientemail,
                    $requirements, $workername, $workeraddress, $workermobile, $startingDate, $salary,
                    $subtotal, $service_tax, $discount, $cemDiscount, $tobepaid, $pending, $subtotal, $couponNo);
		}
	}
}
mysqli_close($db_handle);
?>