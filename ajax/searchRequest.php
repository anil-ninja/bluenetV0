<?php
session_start();

require_once "../components/dbConnection.php";

if(isset($_POST['skill'])){
  $skill = $_POST['skill'];
  $gender = $_POST['gender'];
  $work_time = $_POST['work_time'];
  $salary = $_POST['salary'];
  $area = $_POST['area'];
  $condition = "";
  if($skill != 0) {
	  if($area != null && $area != "" && $area != " "){
	  	if($salary != null && $salary != "" && $salary != " "){
	  	  if($work_time != 0){
	  	  	if($gender != 'any'){
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND gender = '$gender' AND work_time >= '$work_time' 
	  	  	  					AND min_salary >= '$salary' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND work_time >= '$work_time' AND min_salary >= '$salary' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  }
	  	  else {
	  	  	if($gender != 'any'){
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND gender = '$gender' AND min_salary >= '$salary' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND min_salary >= '$salary' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  }
	  	}
	  	else{
	  	  if($work_time != 0){
	  	  	if($gender != 'any'){
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND gender = '$gender' AND work_time >= '$work_time' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND work_time >= '$work_time' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  }
	  	  else {
	  	  	if($gender != 'any'){
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND gender = '$gender' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  }
	  	}
	  }
	  else {
	  	if($salary != null && $salary != "" && $salary != " "){
	  	  if($work_time != 0){
	  	  	if($gender != 'any'){
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND gender = '$gender' AND work_time >= '$work_time' AND min_salary >= '$salary' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND work_time >= '$work_time' AND min_salary >= '$salary' ";
	  	  	}
	  	  }
	  	  else {
	  	  	if($gender != 'any'){
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND gender = '$gender' ANDmin_salary >= '$salary' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND min_salary >= '$salary' ";
	  	  	}
	  	  }
	  	}
	  	else{
	  	  if($work_time != 0){
	  	  	if($gender != 'any'){
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND gender = '$gender' AND work_time >= '$work_time' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND work_time >= '$work_time' ";
	  	  	}
	  	  }
	  	  else {
	  	  	if($gender != 'any'){
	  	  	  $condition = " requirements LIKE '%".$skill."%' AND gender = '$gender' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " requirements LIKE '%".$skill."%' ";
	  	  	}
	  	  }
	  	}
	  }
  }
  else{
  	if($area != null && $area != "" && $area != " "){
	  	if($salary != null && $salary != "" && $salary != " "){
	  	  if($work_time != 0){
	  	  	if($gender != 'any'){
	  	  	  $condition = " gender = '$gender' AND work_time >= '$work_time' AND min_salary >= '$salary' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " work_time >= '$work_time' AND min_salary >= '$salary' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  }
	  	  else {
	  	  	if($gender != 'any'){
	  	  	  $condition = " gender = '$gender' AND min_salary >= '$salary' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " min_salary >= '$salary' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  }
	  	}
	  	else{
	  	  if($work_time != 0){
	  	  	if($gender != 'any'){
	  	  	  $condition = " gender = '$gender' AND work_time >= '$work_time' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " work_time >= '$work_time' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  }
	  	  else {
	  	  	if($gender != 'any'){
	  	  	  $condition = " gender = '$gender' AND area LIKE '%".$area."%' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " area LIKE '%".$area."%' ";
	  	  	}
	  	  }
	  	}
	  }
	  else {
	  	if($salary != null && $salary != "" && $salary != " "){
	  	  if($work_time != 0){
	  	  	if($gender != 'any'){
	  	  	  $condition = " gender = '$gender' AND work_time >= '$work_time' AND min_salary >= '$salary' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " work_time >= '$work_time' AND min_salary >= '$salary' ";
	  	  	}
	  	  }
	  	  else {
	  	  	if($gender != 'any'){
	  	  	  $condition = " gender = '$gender' ANDmin_salary >= '$salary' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " min_salary >= '$salary' ";
	  	  	}
	  	  }
	  	}
	  	else{
	  	  if($work_time != 0){
	  	  	if($gender != 'any'){
	  	  	  $condition = " gender = '$gender' AND work_time >= '$work_time' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " work_time >= '$work_time' ";
	  	  	}
	  	  }
	  	  else {
	  	  	if($gender != 'any'){
	  	  	  $condition = " gender = '$gender' ";
	  	  	}
	  	  	else {
	  	  	  $condition = " work_time = 0 ";
	  	  	}
	  	  }
	  	}
	  }
  }
	
  $request = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition." ;");
  if(mysqli_num_rows($request) != 0){
	while($requestRow = mysqli_fetch_array($request)){
		$id = $requestRow['id'];
		$cem_id = $requestRow['cem_id'];
		$me_id = $requestRow['me_id'];
       	$skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                                      AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
       	$data.= "<div class='list-group'>
	       	        <p style='font-size:16px;padding-left: 2em;'>
	                  <a  class='list-group-item active'> Client Name  <span style='padding-left: 5em'>".strtoupper($requestRow['name'])."</span>
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
  }
  else $data .= "No, Result Found. Please Try again" ;
  echo $data ;
}
$data = "";
mysqli_close($db_handle);
?>