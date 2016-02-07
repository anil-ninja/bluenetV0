<?php
session_start();

require_once "../dbConnection.php";

if(isset($_POST['status'])){
	$user_id = $_POST['user_id'];
	$type = $_POST['type'];
	$status = $_POST['status'];
	$data = "";
	if($type == 'cem'){
		if ($status == "picked") $condition = " cem_id = " .$user_id. " AND status = 'open'";
      	elseif ($status == "meeting") $condition = " status = 'meeting' AND cem_id = " .$user_id ;
      	elseif ($status == "demo") $condition = " status='demo' AND cem_id = " .$user_id ;
      	else $condition = " status='done' AND cem_id = " .$user_id ;
	}
	else if($type == 'me'){
		if($status == 'picked') $condition = " me_id = " .$user_id." AND (match_id = 0 OR match2_id = 0) AND (status='open' OR status='me_open')" ;
		else $condition = " me_id = " .$user_id." AND match_id != 0 AND match2_id != 0 " ;
	}
	else if($type == 'operator'){}
	else if($type == 'admin'){}
	else if($type == 'accountant'){}
	else if($type == 'ba'){}
	else if($type == 'dev'){}
	else {}
	$srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition." ; ") ;
    while ($srsrow = mysqli_fetch_array($srs)){
    	$id = $srsrow['id'];
        $skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                                      AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
        $data.= "<div class='list-group'>
	                <p style='font-size:20px;padding-left: 2em;'>
	                  <a  class='list-group-item active'> Client Name  <span style='padding-left: 5em>".strtoupper($srsrow['name'])."</span></a>
	                  <a  class='list-group-item'> Mobile  <span style='padding-left: 8em'>".$srsrow['mobile']."</span></a>
	                  <a  class='list-group-item'> Address <span style='padding-left: 7em'>".$srsrow['address']."</span></a>
	                  <a  class='list-group-item'> Salary Criteria <span style='padding-left: 5em'>".$srsrow['expected_salary']."</span></a>
	                  <a  class='list-group-item'> Timings <span style='padding-left: 8em'>".$srsrow['timings']."</span></a>
	                  <a  class='list-group-item'> Working Time <span style='padding-left: 5em'>".$srsrow['work_time']." Hours</span></a>
	                  <a  class='list-group-item'> Requirements <span style='padding-left: 5em'>". $srsrow['requirements']."</span></a>
	                  <a  class='list-group-item'> Remarks <span style='padding-left: 7em'>".$srsrow['remarks']."</span></a>
	                  <a  class='list-group-item'> Worker Area <span style='padding-left: 5em'>".$srsrow['worker_area']."</span></a>
	                  <a  class='list-group-item'> Gender <span style='padding-left: 7em'>".$srsrow['gender']."</span></a>       
	                  <a  class='list-group-item'> Creation Date <span style='padding-left: 7em'>".$srsrow['created_time']."</span></a>       
	                  <a  class='list-group-item'> Picked Date <span style='padding-left: 7em'>".$srsrow['last_updated']."</span></a>       
	                  <a  class='list-group-item'> Skills <span style='padding-left: 7em'>";
        while($skillrow = mysqli_fetch_array($skill)){ 
            $data = $data.$skillrow['name'].", ";
        }
            $data = $data."</span>
                      </a>";       
        $meeting = mysqli_query($db_handle, "SELECT * FROM meetings WHERE match_id = '$id' ORDER BY meeting_time DESC LIMIT 0 , 1; ") ;
        $meetingRow = mysqli_fetch_array($meeting);
        if(mysqli_num_rows($meeting) != 0){
        	$data = $data."                
                      <a  class='list-group-item'> Meeting Time <span style='padding-left: 5em'>".$meetingRow['meeting_time']."</span></a>
                      <a  class='list-group-item'> Remarks <span style='padding-left: 7em'>".$meetingRow['remarks']."</span></a>";
        }
        if($srsrow['done_worker_id'] != 0){
           $worker = mysqli_query($db_handle, "SELECT b.* FROM service_request as a join workers as b WHERE a.id = '$id' AND a.done_worker_id = b.id ;");
           $workerrow = mysqli_fetch_array($worker);
           $data = $data."                
                      <a  class='list-group-item'> Done with worker <span style='padding-left: 4em'>".strtoupper($workerrow['first_name'])." ".
                      	strtoupper($workerrow['last_name'])."</span></a>
                      <a  class='list-group-item'> Mobile No. <span style='padding-left: 7em'>".$workerrow['phone']."</span></a>
                      <a  class='list-group-item'> Fixed Salary <span style='padding-left: 7em'>".$srsrow['fixed_salary']."</span></a>";
            $doneDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'done' AND user_id = '$user_id'
            															ORDER BY update_time DESC LIMIT 0 , 1 ;");
            $doneDaterow = mysqli_fetch_array($doneDate);
            $data = $data."
            		  <a  class='list-group-item'> Done Date <span style='padding-left: 7em'>".$doneDaterow['update_time']."</span></a>";
        }
        else {
        	if($srsrow['match_id'] != 0){
        		$worker1 = mysqli_query($db_handle, "SELECT b.* FROM service_request as a join workers as b 
        															WHERE a.id = '$id' AND a.match_id = b.id ;");
        		$worker1row = mysqli_fetch_array($worker1);
           		$data = $data."                
                      <a  class='list-group-item'> Match 1 worker <span style='padding-left: 4em'>".strtoupper($worker1row['first_name'])." ".
                      	strtoupper($worker1row['last_name'])."</span></a>
                      <a  class='list-group-item'> Mobile No. <span style='padding-left: 7em'>".$worker1row['phone']."</span></a>";
        	}
        	if($srsrow['match2_id'] != 0){
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
    echo $data ;
}
$data = "";
mysqli_close($db_handle);
?>