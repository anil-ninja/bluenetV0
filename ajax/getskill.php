<?php
session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";

if(isset($_POST['type'])){
	$type = $_POST['type'];
	$data = "<option value='0'>Select Skills </option>";
	$skill = mysqli_query($db_handle, 'SELECT * FROM skill_name ;');
	while ( $skillrow = mysqli_fetch_array($skill)) {
		$data .= "<option value=".$skillrow['id'].">".$skillrow['name']."</option>";
	}
    echo $data ;
}
$data = "";
mysqli_close($db_handle);
?>