<?php
session_start();

require_once "../dbConnection.php";

if(isset($_POST['sr_id'])){
	$sr_id = $_POST['sr_id'];
	$type = $_POST['type'];
	$data = "";
	if($type == 1){
		$srs = mysqli_query($db_handle, "SELECT * FROM notes WHERE sr_id = $sr_id AND about = 'client_request' ORDER BY date DESC;");
	}
	else if ($type == 2){
		$srs = mysqli_query($db_handle, "SELECT * FROM notes WHERE sr_id = $sr_id AND about = 'worker' ORDER BY date DESC;");
	}
	else if ($type == 3){
		$srs = mysqli_query($db_handle, "SELECT * FROM notes WHERE sr_id = $sr_id AND about = 'meeting' ORDER BY date DESC;");
	}
	else {
		$srs = mysqli_query($db_handle, "SELECT * FROM notes WHERE sr_id = $sr_id AND about = 'match' ORDER BY date DESC;");
	}
	while ( $srsrow = mysqli_fetch_array($srs)) {
		$data .= "<span>".$srsrow['note']."</span> on ".$srsrow['date']."<br/>";
	}
    echo $data ;
}
$data = "";
mysqli_close($db_handle);
?>