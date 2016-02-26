<?php
session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";
if(isset($_POST['skills'])){
	$skills = $_POST['skills'];
	/*$type = $_POST['type'];*/
	$srs = mysqli_query($db_handle, "SELECT name FROM skill_name WHERE id = '$skills' ;");
	$srsrow = mysqli_fetch_array($srs);
    echo "<div class='values' id=".$skills." data-value=".$skills.">
    		<span class='btn btn-success' style='color: #fff;font-size:14px;font-style: italic;'>&nbsp;&nbsp;".$srsrow['name']. 
                "&nbsp;&nbsp;&nbsp;&nbsp;<span class='badge badge-red' onclick='removeskill(".$skills.");'><i class='fa fa-minus'></i></span>
            </span>
          </div>" ;
}
mysqli_close($db_handle);
?>