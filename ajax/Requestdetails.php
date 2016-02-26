<?php
session_start();

require_once "../components/dbConnection.php";

if(isset($_POST['sr_id'])){
	$sr_id = $_POST['sr_id'];
	$srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE id = '$sr_id' ; ") ;
    while ($srsrow = mysqli_fetch_array($srs)){
    	$id = $srsrow['id'];
      $skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                                   AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
      $color = headerColor($srsrow['priority']);
      $data.= "<div class='list-group'>
	                <p style='font-size:16px;padding-left: 2em;'>
	                  <a  class='list-group-item' style='background-color:".$color.";border-color:".$color.";'> 
                      Client Name  <span style='padding-left: 5em'>".strtoupper($srsrow['name'])."</span>
                      <span style='padding-left: 3em'> ID : ".$id." </span>
                      <span style='padding-left: 3em'> Creation Date : ".$srsrow['created_time']." </span></a>
	                  <a  class='list-group-item'> Mobile <span style='padding-left: 6em'>".$srsrow['mobile']."</span>
                      <span style='padding-left: 3em'> Working Time : ".$srsrow['work_time']." Hours</span></a>
	                  <a  class='list-group-item'> Address <span style='padding-left: 7em'>".$srsrow['address']."</span></a>
	                  <a  class='list-group-item'> Timings <span style='padding-left: 6em'>".$srsrow['timings']."</span>
                      <span style='padding-left: 3em'>Salary Criteria : ".$srsrow['min_salary']."-".$srsrow['max_salary']." K </span></a>
	                  <a  class='list-group-item'> Requirements <span style='padding-left: 5em'>". $srsrow['requirements']."</span>
                      <span style='padding-left: 3em'>Gender : ".$srsrow['gender']."</a>
	                  <a  class='list-group-item'> Remarks <span style='padding-left: 7em'>".$srsrow['remarks']."</span></a>
	                  <a  class='list-group-item'> Worker Area <span style='padding-left: 5em'>".$srsrow['worker_area']."</span></a>
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