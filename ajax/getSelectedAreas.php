<?php
session_start();

require_once "../dbConnection.php";
if(isset($_POST['sr_id'])){
	$sr_id = $_POST['sr_id'];
	
	$data = "";
	$area = mysqli_query($db_handle, "SELECT area FROM service_request WHERE id = '$sr_id' ;");
	$areasRow = mysqli_fetch_array($area);
	$areas = explode(",", $areasRow['area']);
	$eacharea = trim($areas);
	foreach ($areas as $value) {
		if($value != null AND $value != "" AND $value != " "){
			$areaname = mysqli_query($db_handle, "SELECT id FROM area WHERE name = '$value' ;");
			$areanameRow = mysqli_fetch_array($areaname);
			$area_id = $areanameRow['id'];
			$data .= "<div class='areavalues' id=".$area_id." data-value=".$area_id.">
			    		<span class='btn btn-success' style='color: #fff;font-size:14px;font-style: italic;'>&nbsp;".$value. 
			                "&nbsp;&nbsp;<span class='badge badge-red' onclick='removearea(".$area_id.");'>
			                <i class='fa fa-minus'></i></span>
			            </span>
			        </div>" ;
		}
	}
	echo $data ;
}
mysqli_close($db_handle);
?>