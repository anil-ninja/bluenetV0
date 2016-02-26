<?php require_once "dbConnection.php" ;?>
<ul>
	<?php
		$srs = mysqli_query($db_handle, "SELECT name FROM area; ") ;
		while ($srsrow = mysqli_fetch_array($srs)){
			$allarea = $srsrow['name'];
				echo "<li><a href=\"findAreaRequests.php?area=".$allarea."\">".$allarea."</a></li>" ;	
		} 
	?>
</ul>