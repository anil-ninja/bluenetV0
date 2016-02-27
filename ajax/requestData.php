<?php
session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";
if (isset($_POST['status'])) {
  $status = $_POST['status'];
  $user_id = $_SESSION['user_id'];
  $type = $_SESSION['employee_type'];
  $condition = "";
  switch($type){
  	case 'me':
  		switch ($status) {
  			case 'picked':
  				$condition = " me_id = " .$user_id." AND (match_id = 0 OR match2_id = 0) AND (status='open' OR status='me_open' OR status='meeting')" ;
  				break;

  			case 'done':
  				$condition = " me_id = " .$user_id." AND status !='open' AND status!='me_open' And status!='meeting' AND done_worker_id != 0" ;
  				break;

  			case '24':
  				$condition = "  (status='open' OR status='me_open') AND me_id = 0 AND work_time = 24 " ;
  				break;
  			
  			default:
  				$condition = " (status='open' OR status='me_open') AND me_id = 0 AND work_time != 24 " ;
  				break;
  		}
  		break;

  	case 'cem':
  		switch ($status) {
  			case 'picked':
  				$condition = " cem_id = " .$user_id. " AND status = 'open'";
  				break;
  			
  			case 'match':
  				$condition = " cem_id = 0 AND me_id != 0 AND status = 'open' AND (match_id != 0 OR match2_id != 0)" ;
  				break;

  			case 'meeting':
  				$condition = " status = 'meeting' AND cem_id = " .$user_id ;
  				break;

  			case 'demo':
  				$condition = " status='demo' AND cem_id = " .$user_id ;
  				break;

  			case 'done':
  				$condition = " status='done' AND cem_id = " .$user_id ;
  				break;

  			case '24':
  				$condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time = 24 " ;
  				break;

  			default:
  				$condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time != 24 " ;
  				break;
  		}
  		break;

  	case 'admin':
  		switch ($status) {
  			case 'all':
  				$condition = " 1 ";
  				break;
  			
  			case 'open':
  				$condition = " cem_id = 0 AND me_id = 0 ";
  				break;
  			
  			case 'cem_open':
  				$condition = " cem_id = 0 AND me_id != 0 AND (match_id != 0 OR match2_id != 0)" ;
  				break;
  			
  			case '24':
  				$condition = " work_time = 24 " ;
  				break;
  			
  			default:
  				$condition = "status = '$status' " ;
  				break;
  		}
  		break;

  	case 'cem_manager':
  		break;

  	case 'accountant':
  		break;

  	case 'ba':
  		
  		break;

  	case 'dev':
  		break;

  	case 'operator':
  		switch ($status) {
  			case 'followback':
  				$condition = "status = 'followback' " ;
  				break;

  			case 'feedback':
  				$condition = "status = 'feedback' " ;
  				break;
  			
  			default:
  				$condition = "status = 'followback' " ;
  				break;
  		}
  		break;

  }
}
mysqli_close($db_handle);
?>