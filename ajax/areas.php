<?php
session_start();

require_once "../dbConnection.php";
if(isset($_POST['area'])){
	$area = $_POST['area'];
	$type = $_POST['type'];
	$srs = mysqli_query($db_handle, "SELECT name FROM area WHERE id = '$area' ;");
	$srsrow = mysqli_fetch_array($srs);
	if($type == 4)
	    echo "<div class='workerareavalues' id=".$area." data-value=".$area.">
	    		<span class='btn btn-success' style='color: #fff;font-size:14px;font-style: italic;'>&nbsp;&nbsp;".$srsrow['name']. 
	                "&nbsp;&nbsp;&nbsp;&nbsp;<span class='badge badge-red' onclick='removearea(".$area.");'><i class='fa fa-minus'></i></span>
	            </span>
	          </div>" ;
    }
    else {
    	echo "<div class='areavalues' id=".$area." data-value=".$area.">
	    		<span class='btn btn-success' style='color: #fff;font-size:14px;font-style: italic;'>&nbsp;&nbsp;".$srsrow['name']. 
	                "&nbsp;&nbsp;&nbsp;&nbsp;<span class='badge badge-red' onclick='removearea(".$area.");'><i class='fa fa-minus'></i></span>
	            </span>
	          </div>" ;
    }
}
mysqli_close($db_handle);
?>