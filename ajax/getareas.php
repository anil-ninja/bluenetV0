<?php
session_start();

require_once "../dbConnection.php";

if(isset($_POST['type'])){
	$type = $_POST['type'];
	$data = "<option value='0'>Select Area </option>";
	$area = mysqli_query($db_handle, 'SELECT * FROM area ;');
	while ( $arearow = mysqli_fetch_array($area)) {
		$data .= "<option value=".$arearow['id'].">".$arearow['name']."</option>";
	}
    echo $data ;
}
$data = "";
mysqli_close($db_handle);
?>