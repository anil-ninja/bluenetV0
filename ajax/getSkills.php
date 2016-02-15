<?php
session_start();

require_once "../dbConnection.php";
if(isset($_POST['type'])){
	$id = $_POST['id'];
	$type = $_POST['type'];
	$data = "";
	$skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                                            AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
	while ( $skillrow = mysqli_fetch_array($skill)) {
		$skills = $skillrow['id'];
		$data .= "<div class='values' id=".$skills." data-value=".$skills.">
		    		<span class='btn btn-success' style='color: #fff;font-size:14px;font-style: italic;'>&nbsp;".$skillrow['name']. 
		                "&nbsp;&nbsp;<span class='badge badge-red' onclick='deleteskill(".$skills.",".$id.",\"".$type."\");'>
		                <i class='fa fa-minus'></i></span>
		            </span>
		        </div>" ;
	}
	echo $data ;
}
mysqli_close($db_handle);
?>