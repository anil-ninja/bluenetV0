<?php
session_start();
require_once "../components/dbConnection.php";

if(isset($_POST['type'])){
	$type = $_POST['type'];
	$user_id = $_POST['id'];
	if($type == 'cem'){
		$picked = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(*) AS cnt FROM service_request 
															WHERE cem_id = '$user_id' and status = 'open' GROUP BY date;");
		while ( $pickedRow =  mysqli_fetch_array($picked)) {
			$date = $pickedRow['date'];
			$pickedcnt = $pickedRow['cnt'];
		}
		$meeting = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(*) AS cnt FROM service_request 
															WHERE cem_id = '$user_id' and status = 'meeting' GROUP BY date;");
		while ( $meetingRow =  mysqli_fetch_array($meeting)) {
			$date = $meetingRow['date'];
			$meetingcnt = $meetingRow['cnt'];
		}
		$demo = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(*) AS cnt FROM service_request 
															WHERE cem_id = '$user_id' and status = 'demo' GROUP BY date;");
		while ( $demoRow =  mysqli_fetch_array($demo)) {
			$date = $demoRow['date'];
			$democnt = $demoRow['cnt'];
		}
		$done = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(*) AS cnt FROM service_request 
															WHERE cem_id = '$user_id' and status = 'done' GROUP BY date;");
		while ( $doneRow =  mysqli_fetch_array($done)) {
			$date = $doneRow['date'];
			$donecnt = $doneRow['cnt'];
		}
	}
	elseif($type == 'me'){
		$picked = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(*) AS cnt FROM service_request 
															WHERE me_id = '$user_id' and AND (match_id = 0 OR match2_id = 0) AND 
															(status='open' OR status='me_open' OR status='meeting') GROUP BY date;");
		while ( $pickedRow =  mysqli_fetch_array($picked)) {
			$date = $pickedRow['date'];
			$pickedcnt = $pickedRow['cnt'];
		}
		$done = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(*) AS cnt FROM service_request 
															WHERE me_id = '$user_id' and status !='open' AND status!='me_open' AND 
															done_worker_id != 0 GROUP BY date;");
		while ( $doneRow =  mysqli_fetch_array($done)) {
			$date = $doneRow['date'];
			$donecnt = $doneRow['cnt'];
		}
	}
	else {}
}
mysqli_close($db_handle);
?>