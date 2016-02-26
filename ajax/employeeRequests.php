<?php
session_start();

require_once "../components/dbConnection.php";

if(isset($_POST['status'])){
	$user_id = $_POST['user_id'];
	$type = $_POST['type'];
	$status = $_POST['status'];
	$data = "";
	
	if ($status == "picked") $condition = " cem_id = " .$user_id. " AND status = 'open'";
	elseif ($status == "meeting") $condition = " status = 'meeting' AND cem_id = " .$user_id ;
	elseif ($status == "demo") $condition = " status='demo' AND cem_id = " .$user_id ;
	else $condition = " status='done' AND cem_id = " .$user_id ;
	
	$srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition." ; ") ;
    while ($srsrow = mysqli_fetch_array($srs)){
    	$id = $srsrow['id'];
      $color = headerColor($srsrow['priority']);
      $data.= "<div class='list-group'>
	              <p style='font-size:16px;padding-left: 2em;' onclick='completeDetails(".$id.", ".$user_id.");'>
	                <a  class='list-group-item' style='background-color:".$color.";border-color:".$color.";'> 
                    Client Name  <span style='padding-left: 2em'>".strtoupper($srsrow['name'])."</span>
                    <span style='padding-left: 1em'> ID : ".$id." </span>
                    <span style='padding-left: 1em'> Creation Date : ".$srsrow['created_time']." </span>
                    <span style='padding-left: 1em'>Mobile : ".$srsrow['mobile']."</span></a>
	                <a  class='list-group-item'> Address <span style='padding-left: 7em'>".$srsrow['address']."</span></a>
            		</p>
              </div>";
    } 
    echo $data ;
}
$data = "";
mysqli_close($db_handle);
?>