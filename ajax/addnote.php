<?php

session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";

if(isset($_POST['id'])){
	$type = $_POST['type'];
	$sr_id = $_POST['id'];
	$note = $_POST['note'];
	$user_id = $_SESSION['user_id'];
	mysqli_query ($db_handle, "INSERT INTO notes ( sr_id, note, cem_id, about) VALUES ('$sr_id', '$note', '$user_id', '$type') ;");
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}
mysqli_close($db_handle);
?>