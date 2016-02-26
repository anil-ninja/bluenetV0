<?php
session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";
if(isset($_POST['type'])){
	$id = $_POST['id'];
	$type = $_POST['type'];
	$skill = $_POST['skill'];
	$user_id = $_SESSION['user_id'];
	mysqli_query($db_handle, "UPDATE skills SET status ='deleted', employee_id ='$user_id' 
								WHERE user_id = '$id' AND type = '$type' AND skill_id = '$skill';");
	if(mysqli_error($db_handle)) return mysqli_error($db_handle) ;
	else return true ;
}
mysqli_close($db_handle);
?>