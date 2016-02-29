<?php
session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";

if(isset($_POST['phone'])){
	$phone = $_POST['phone'];
	$srs = mysqli_query($db_handle, "SELECT * FROM workers WHERE phone = '$phone' OR emergency_phone = '$phone' 
															OR emergency_phone LIKE '%".$phone."%' OR phone LIKE '%".$phone."%';");
	if(mysqli_num_rows($srs) != 0){
		$srsrow = mysqli_fetch_array($srs) ;
		$color = headerColor($srsrow['priority']);
		$data.= "<div class='list-group'>
        	        <p style='font-size:16px;padding-left: 2em;'>
            	      <a  class='list-group-item' style='background-color:".$color.";border-color:".$color.";'>
            	      	 Worker Name  <span style='padding-left: 5em'>".$srsrow['first_name']." ".$srsrow['last_name']."</span>
            	      	<span style='padding-left: 3em'>ID : ".$srsrow['id']."</span>
            	      	<span style='padding-left: 3em'>Creation Date : ".$srsrow['creation_date']."</span></a>
                	  <a  class='list-group-item'> Mobile  <span style='padding-left: 6em'>".$srsrow['phone']."</span>
                	  	<span style='padding-left: 3em'>Age : ".$srsrow['age']."</span>
                	  	<span style='padding-left: 3em'>Gender : ".$srsrow['gender']."</span></a>
            	      <a  class='list-group-item'> Current Address <span style='padding-left: 5em'>".$srsrow['current_address']."</span></a>
                	  <a  class='list-group-item'> Permanent Address <span style='padding-left: 5em'>".$srsrow['permanent_address']."</span></a>
	                  <a  class='list-group-item'> Salary Criteria <span style='padding-left: 3em'>
	                  	".$srsrow['min_salary']."-".$srsrow['max_salary']." K </span>
	                  	<span style='padding-left: 3em'>Working Time : ".$srsrow['work_time']." Hours</span>
	                  	<span style='padding-left: 3em'>Timings : ".$srsrow['timings']."</span></a>
	                  <a  class='list-group-item'> Remarks <span style='padding-left: 6em'>".$srsrow['remarks']."</span></a>
	                  <a  class='list-group-item'> Education <span style='padding-left: 5em'>".$srsrow['education']."</span>
	                  	<span style='padding-left: 3em'>Police Varification : ".$srsrow['varification_status']."</span></a>   
	                  <a  class='list-group-item'> Services <span style='padding-left: 5em'>".$srsrow['service']."</span>
	                  	<span style='padding-left: 3em'>Experience : ".$srsrow['experience']."</span></a>       
	          		</p>
	          	</div>";
	}
	else {
		$request = mysqli_query($db_handle, "SELECT * FROM service_request WHERE mobile = '$phone' OR mobile LIKE '%".$phone."%'
																					OR remarks LIKE '%".$phone."%';");
		if(mysqli_num_rows($request) != 0){
			$requestRow = mysqli_fetch_array($request);
			$id = $requestRow['id'];
			$cem_id = $requestRow['cem_id'];
			$me_id = $requestRow['me_id'];
			$recolor = headerColor($srsrow['priority']);
        	$skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                                      AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
        	$data.= "<div class='list-group'>
	        	        <p style='font-size:16px;padding-left: 2em;'>
		                  <a  class='list-group-item' style='background-color:".$recolor.";border-color:".$recolor.";'>
		                    Client Name  <span style='padding-left: 5em'>".strtoupper($requestRow['name'])."</span>
	                        <span style='padding-left: 3em'> ID : ".$id." </span>
	                        <span style='padding-left: 3em'> Creation Date : ".$requestRow['created_time']." </span></a>
		                  <a  class='list-group-item'> Mobile <span style='padding-left: 6em'>".$requestRow['mobile']."</span>
	                        <span style='padding-left: 3em'> Working Time : ".$requestRow['work_time']." Hours</span></a>
		                  <a  class='list-group-item'> Address <span style='padding-left: 7em'>".$requestRow['address']."</span></a>
		                  <a  class='list-group-item'> Timings <span style='padding-left: 6em'>".$requestRow['timings']."</span>
	                        <span style='padding-left: 3em'>Salary Criteria : ".$requestRow['min_salary']."-".$requestRow['max_salary']." K </span></a>
		                  <a  class='list-group-item'> Requirements <span style='padding-left: 5em'>". $requestRow['requirements']."</span>
	                        <span style='padding-left: 3em'>Gender : ".$requestRow['gender']."</a>
		                  <a  class='list-group-item'> Remarks <span style='padding-left: 7em'>".$requestRow['remarks']."</span></a>
		                  <a  class='list-group-item'> Worker Area <span style='padding-left: 5em'>".$requestRow['worker_area']."</span></a>
		                  <a  class='list-group-item'> Picked Date <span style='padding-left: 7em'>".$requestRow['last_updated']."</span></a>       
		                  <a  class='list-group-item'> Skills <span style='padding-left: 7em'>";
	        while($skillrow = mysqli_fetch_array($skill)){ 
	            $data = $data.$skillrow['name'].", ";
	        }
	            $data = $data."</span>
	                      </a>"; 
	        if($cem_id != 0){
	        	$cem = mysqli_query($db_handle, "SELECT * FROM user WHERE id = '$cem_id' ; ") ;
               	$cemRow = mysqli_fetch_array($cem) ;
               	$pickDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'picked' 
                                                      AND user_id = '$cem_id' ORDER BY update_time DESC LIMIT 0 , 1 ;");
               	$pickDateRow = mysqli_fetch_array($pickDate) ;
               	$data = $data."
               			  <a  class='list-group-item ''> Picked By CEM <span style='padding-left: 5em'>".strtoupper($cemRow['first_name'])." ".strtoupper($cemRow['last_name'])."</span></a>
                     	  <a  class='list-group-item '> Mobile  <span style='padding-left: 8em'>".$cemRow['phone']."</span></a>
               	 		  <a  class='list-group-item'>Picked Date <span style='margin-left: 5em;''>".$pickDateRow['update_time']."</span></a>" ;
            } 
            if($me_id != 0){
	        	$me = mysqli_query($db_handle, "SELECT * FROM user WHERE id = '$me_id' ; ") ;
               	$meRow = mysqli_fetch_array($me) ;
               	$mepickDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'picked' 
                                                      AND user_id = '$me_id' ORDER BY update_time DESC LIMIT 0 , 1 ;");
               	$mepickDateRow = mysqli_fetch_array($mepickDate) ;
               	$data = $data."
               			  <a  class='list-group-item ''> Picked By ME <span style='padding-left: 5em'>".strtoupper($meRow['first_name'])." ".strtoupper($meRow['last_name'])."</span></a>
                     	  <a  class='list-group-item '> Mobile  <span style='padding-left: 8em'>".$meRow['phone']."</span></a>
               	 		  <a  class='list-group-item'>Picked Date <span style='margin-left: 5em;''>".$mepickDateRow['update_time']."</span></a>" ;
            } 
	        $meeting = mysqli_query($db_handle, "SELECT * FROM meetings WHERE match_id = '$id' ORDER BY meeting_time DESC LIMIT 0 , 1; ") ;
	        $meetingRow = mysqli_fetch_array($meeting);
	        if(mysqli_num_rows($meeting) != 0){
	        	$data = $data."                
	                      <a  class='list-group-item'> Meeting Time <span style='padding-left: 5em'>".$meetingRow['meeting_time']."</span></a>
	                      <a  class='list-group-item'> Remarks <span style='padding-left: 7em'>".$meetingRow['remarks']."</span></a>";
	        }
	        if($requestRow['done_worker_id'] != 0){
	            $worker = mysqli_query($db_handle, "SELECT b.* FROM service_request as a join workers as b WHERE a.id = '$id' AND a.done_worker_id = b.id ;");
	            $workerrow = mysqli_fetch_array($worker);
	            $data = $data."                
	                      <a  class='list-group-item'> Done with worker <span style='padding-left: 4em'>".strtoupper($workerrow['first_name'])." ".
	                      	strtoupper($workerrow['last_name'])."</span></a>
	                      <a  class='list-group-item'> Mobile No. <span style='padding-left: 7em'>".$workerrow['phone']."</span></a>
	                      <a  class='list-group-item'> Fixed Salary <span style='padding-left: 7em'>".$requestRow['fixed_salary']."</span></a>";
	            $doneDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'done' AND user_id = '$user_id'
	            															ORDER BY update_time DESC LIMIT 0 , 1 ;");
	            $doneDaterow = mysqli_fetch_array($doneDate);
	            $data = $data."
	            		  <a  class='list-group-item'> Done Date <span style='padding-left: 7em'>".$doneDaterow['update_time']."</span></a>";
	        }
	        else {
	        	if($requestRow['match_id'] != 0){
	        		$worker1 = mysqli_query($db_handle, "SELECT b.* FROM service_request as a join workers as b 
	        															WHERE a.id = '$id' AND a.match_id = b.id ;");
	        		$worker1row = mysqli_fetch_array($worker1);
	           		$data = $data."                
	                      <a  class='list-group-item'> Match 1 worker <span style='padding-left: 4em'>".strtoupper($worker1row['first_name'])." ".
	                      	strtoupper($worker1row['last_name'])."</span></a>
	                      <a  class='list-group-item'> Mobile No. <span style='padding-left: 7em'>".$worker1row['phone']."</span></a>";
	        	}
	        	if($requestRow['match2_id'] != 0){
	        		$worker2 = mysqli_query($db_handle, "SELECT b.* FROM service_request as a join workers as b 
	        															WHERE a.id = '$id' AND a.match2_id = b.id ;");
	        		$worker2row = mysqli_fetch_array($worker2);
	           		$data = $data."                
	                      <a  class='list-group-item'> Match 2 worker <span style='padding-left: 4em'>".strtoupper($worker2row['first_name'])." ".
	                      	strtoupper($worker2row['last_name'])."</span></a>
	                      <a  class='list-group-item'> Mobile No. <span style='padding-left: 7em'>".$worker2row['phone']."</span></a>";
	        	}
	        }        
	        $data = $data."
	            		</p>
	               	</div>";
		}
		else $data .= "No, Result Found. Please Try with a vilid number" ;
	}
    echo $data ;
}
$data = "";
mysqli_close($db_handle);
?>