<?php
session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";

if(isset($_POST['user_id'])){
	$user_id = $_POST['user_id'];
	$type = $_POST['type'];
	$data = "";
	if($type == 'cem'){
		$data .= "<div class='list-group'>
	                <p style='font-size:16px;padding-left: 2em;'>
	                    <a  class='list-group-item active'> Picked Requests ". countRequest('picked', $type, $user_id,  $db_handle)."<button class='btn btn-success pull-right' onclick='viewrequestDetails(\"picked\", \"".$type."\", ".$user_id.");'>Details</button></a>
	                    <a class='list-group-item'>Meeting Requests".countRequest('meeting', $type, $user_id, $db_handle)."<button class='btn btn-success pull-right' onclick='viewrequestDetails(\"meeting\",\"".$type."\", ".$user_id.")'>Details</button></a>
	                    <a  class='list-group-item'> Demo Requests".countRequest('demo', $type, $user_id,  $db_handle)."  <button class='btn btn-success pull-right' onclick='viewrequestDetails(\"demo\", \"".$type."\", ".$user_id.")'>Details</button></a>
	                    <a  class='list-group-item'> Done Requests".countRequest('done', $type, $user_id, $db_handle)."<button class='btn btn-success pull-right' onclick='viewrequestDetails(\"done\", \"".$type."\", ".$user_id.")'>Details</button></a>
	                </p>
	            </div>";
	}
	else if($type == 'me'){
		$data .= "<div class='list-group'>
	                <p style='font-size:16px;padding-left: 2em;'>
	                    <a  class='list-group-item active'> Picked Requests". countRequest('picked', $type, $user_id,  $db_handle)."<button class='btn btn-success pull-right' onclick='viewrequestDetails(\"picked\",\"".$type."\", ".$user_id.")'>Details</button></a>
	                    <a  class='list-group-item'> Done Requests".countRequest('done', $type, $user_id, $db_handle)."<button class='btn btn-success pull-right' onclick='viewrequestDetails(\"done\",\"".$type."\", ".$user_id.")'>Details</button></a>
	                </p>
	            </div>";
	}
	else if($type == 'operator'){}
	else if($type == 'admin'){}
	else if($type == 'accountant'){}
	else if($type == 'ba'){}
	else if($type == 'dev'){}
	else {}
	
    echo $data ;
}
$data = "";
mysqli_close($db_handle);
?>