<?php
session_start();
if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
require_once "../components/dbConnection.php";
if (isset($_POST['status'])) {
  $status = $_POST['status'];
  $user_id = $_SESSION['user_id'];
  $type = $_SESSION['employee_type'];
  $condition = "";
  switch($type){
  	case 'me':
  		switch ($status) {
  			case 'picked':
  				$condition = " me_id = " .$user_id." AND (match_id = 0 OR match2_id = 0) AND (status='open' OR status='me_open' OR status='meeting')" ;
  				break;

  			case 'done':
  				$condition = " me_id = " .$user_id." AND status !='open' AND status!='me_open' And status!='meeting' AND done_worker_id != 0" ;
  				break;

  			case '24':
  				$condition = "  (status='open' OR status='me_open') AND me_id = 0 AND work_time = 24 " ;
  				break;
  			
  			default:
  				$condition = " (status='open' OR status='me_open') AND me_id = 0 AND work_time != 24 " ;
  				break;
  		}
      $data = "";
      $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition." ;") ;
      while ($srsrow = mysqli_fetch_array($srs)){
        $id = $srsrow['id'];
        $cem_id = $srsrow['cem_id'];
        $color = headerColor($srsrow['priority']);
        $skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                             AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
        $data .= "<div class='list-group'>
                    <p style='font-size:16px;padding-left: 2em;'>
                      <a  class='list-group-item' style='background-color:".$color.";border-color:".$color.";'> 
                        Worker Area  <span style='padding-left: 5em'>".$srsrow['worker_area']."</span>
                        <span style='padding-left: 3em'>ID : ".$srsrow['id']."</span>
                        <span style='padding-left: 3em'>Creation Date : ".$srsrow['created_time']."</a>
                      <a  class='list-group-item '> Area  <span style='padding-left: 7em'>".$srsrow['area']."</span>
                        <span style='padding-left: 4em'>Working Time : ".$srsrow['work_time']." hour </span></a>
                      <a  class='list-group-item'>Requirements <span style='padding-left: 5em'>".$srsrow['requirements'].", 
                        ".strtoupper($srsrow['gender'])."</span></a>
                      <a  class='list-group-item'>Timings <span style='padding-left: 6em'>".$srsrow['timings']."</span>
                        <span style='padding-left: 5em'>Salary Criteria : ".$srsrow['min_salary']."-".$srsrow['max_salary']." K </span></a>
                      <a  class='list-group-item'>Remarks <span style='margin-left: 7em;'>".$srsrow['remarks']."</span></a>";
        if($srsrow['me_id'] != 0){
          $pickDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'picked' 
                                                 AND user_id = '$user_id' ORDER BY update_time DESC LIMIT 0 , 1 ;");
          $pickDateRow = mysqli_fetch_array($pickDate) ;
          $data = $data ."<a  class='list-group-item'>Picked Date <span style='margin-left: 5em;'>".$pickDateRow['update_time']."</span></a>" ;
        } 
        if($cem_id != 0){
          $cem = mysqli_query($db_handle, "SELECT * FROM user WHERE id = '$cem_id' ; ") ;
          $cemRow = mysqli_fetch_array($cem) ;
          $data = $data ."<a  class='list-group-item'> Picked By CEM <span style='padding-left: 5em'>".strtoupper($cemRow['first_name'])." ".strtoupper($cemRow['last_name'])."</span></a>
                          <a  class='list-group-item '> Mobile  <span style='padding-left: 8em'>".$cemRow['phone']."</span></a>";
        }
        if($status == 'done') {
          $match2_id = $srsrow['match2_id'];
          $doneDate =  mysqli_query($db_handle, "SELECT creation_date FROM workers WHERE id = '$match2_id' ;");
          $doneDateRow = mysqli_fetch_array($doneDate) ;
          $data = $data ."<a  class='list-group-item'>Done Date <span style='margin-left: 5em;'>".$doneDateRow['creation_date']."</span></a>" ;
        } 
        $data = $data ."<a  class='list-group-item '> Skills  <span style='padding-left: 7em'>";
        while($skillrow = mysqli_fetch_array($skill)){ 
          $data = $data.$skillrow['name'].", ";
        }
        $data = $data ."</span>
                      </a>
                      <a  class='list-group-item'>
                         <button class='btn btn-primary' style='margin-left: 60%' onclick='viewNotes(".$id.", 1);' >View Notes</button>
                         <button class='btn btn-primary'  onclick='addnote(".$id.", \"client_request\");'>Add Note</button>
                      </a>
                      <a  class='list-group-item'>";
        if($status == 'done') { 
          $data = $data ."<button class='btn btn-primary' style='margin-left: 40%' onclick='workerDetails(".$id.", 1);' >Worker 1 Details</button>
                          <button class='btn btn-primary'  onclick='workerDetails(".$id.", 2);' >Worker 2 Details</button>";
        } 
        elseif($status == 'picked') { 
          if($srsrow['match_id'] == 0 ){ 
            $data = $data ."<button class='btn btn-primary' style='margin-left: 60%' onclick='addworker(".$id.", 1);'>Add Worker1</button>";
          } 
          if($srsrow['match2_id'] == 0 ){ 
            if($srsrow['match_id'] != 0 ){
              $data = $data ."<button class='btn btn-primary' style='margin-left: 40%' onclick='workerDetails(".$id.", 1);' >Worker 1 Details</button>";
            }
            $data = $data ."<button class='btn btn-primary' onclick='addworker(".$id.", 2);'>Add Worker2</button>" ;
          }
        } 
        else { 
          $data = $data ."<button class='btn btn-primary' style='margin-left: 80%' onclick='mePick(".$id.");' >Pick</button>" ;
        }
        $data = $data ."</a>
                        <a  class='list-group-item' >
                          <span id='workerform_".$id."'></span>
                        </a>
                     </p>
                  </div>";
      }

  		break;

  	case 'cem':
  		switch ($status) {
  			case 'picked':
  				$condition = " cem_id = " .$user_id. " AND status = 'open'";
  				break;
  			
  			case 'match':
  				$condition = " cem_id = 0 AND me_id != 0 AND status = 'open' AND (match_id != 0 OR match2_id != 0)" ;
  				break;

  			case 'meeting':
  				$condition = " status = 'meeting' AND cem_id = " .$user_id ;
  				break;

  			case 'demo':
  				$condition = " status='demo' AND cem_id = " .$user_id ;
  				break;

  			case 'done':
  				$condition = " status='done' AND cem_id = " .$user_id ;
  				break;

  			case '24':
  				$condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time = 24 " ;
  				break;

  			default:
  				$condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time != 24 " ;
  				break;
  		}
      $data = "";
      $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition." ; ") ;
      while ($srsrow = mysqli_fetch_array($srs)){ 
        $id = $srsrow['id'];
        $color = headerColor($srsrow['priority']);
        $me_id = $srsrow['me_id'];
        $skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                            AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
        $data .= "<div class='list-group'>
                  <p style='font-size:16px;padding-left: 1em;'>
                    <a  class='list-group-item' style='background-color:".$color.";border-color:".$color.";'>
                      Client Name  <span style='padding-left: 5em'>".$srsrow['name']."</span>
                      <span style='padding-left: 3em'>ID : ".$srsrow['id']."</span>
                      <span style='padding-left: 3em'>Creation Date : ".$srsrow['created_time']."</span></a>
                    <a  class='list-group-item '> Mobile  <span style='padding-left: 6em'>".$srsrow['mobile']."</span>
                       <span style='padding-left: 4em'>Working Time : ".$srsrow['work_time']."</span></a>
                    <a  class='list-group-item'>Address <span style='padding-left: 7em'>".$srsrow['address']."</span></a>
                    <a  class='list-group-item'>Timings <span style='padding-left: 6em'>".$srsrow['timings']."</span>
                       <span style='padding-left: 5em'>Salary Criteria : ".$srsrow['min_salary']."-".$srsrow['max_salary']." K</span></a>
                    <a  class='list-group-item'> Requirements<span style='padding-left: 5em'>".$srsrow['requirements']."</span>
                       <span style='padding-left: 3em'>Gender : ".$srsrow['gender']."</a>
                    <a  class='list-group-item'>Remarks <span style='padding-left: 7em'>".$srsrow['remarks']."</span></a>
                    <a  class='list-group-item'>Worker Area <span style='padding-left: 5em'>".$srsrow['worker_area']."</span></a> 
                    <a  class='list-group-item '> Skills  <span style='padding-left: 7em'>";
        while($skillrow = mysqli_fetch_array($skill)){ 
          $data = $data .$skillrow['name'].", ";
        }
        $data = $data ."</span>
                    </a>";
        if($srsrow['cem_id'] != 0){
          $pickDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'picked' 
                                                   AND user_id = '$user_id' ORDER BY update_time DESC LIMIT 0 , 1 ;");
          $pickDateRow = mysqli_fetch_array($pickDate) ;
          $data = $data ."<a  class='list-group-item'>Picked Date <span style='margin-left: 5em;'>".$pickDateRow['update_time']."</span></a>" ;
        } 
        if($me_id != 0){
          $cem = mysqli_query($db_handle, "SELECT * FROM user WHERE id = '$me_id' ; ") ;
          $cemRow = mysqli_fetch_array($cem) ;
          $data = $data ."<a  class='list-group-item'> Picked By ME <span style='padding-left: 5em'>".strtoupper($cemRow['first_name'])." ".strtoupper($cemRow['last_name'])."</span></a>
                          <a  class='list-group-item '> Mobile  <span style='padding-left: 8em'>".$cemRow['phone']."</span></a>";
        }     
        if($status == "done") { 
          $doneDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'done' 
                                                   AND user_id = '$user_id' ORDER BY update_time DESC LIMIT 0 , 1 ;");
          $doneDateRow = mysqli_fetch_array($doneDate) ;
          $data = $data ."<a  class='list-group-item'>Done Date <span style='margin-left: 5em;'>".$doneDateRow['update_time']."</span></a>" ;
        } 
        elseif($status == "demo") { 
          $data = $data ."<a  class='list-group-item'>
                           <button class='btn btn-primary' style='margin-left: 40%;' onclick='changeStatus(".$id.", \"meeting\", 3);'>Change Status</button>
                           <button class='btn btn-primary' onclick='generateBill(".$id.");'>Generate Bill</button>
                        </a>";
        } 
        elseif($status == "meeting") { 
          $meeting = mysqli_query($db_handle, "SELECT * FROM meetings WHERE match_id = '$id' ORDER BY created_time DESC LIMIT 0 , 1; ") ;
          $meetingRow = mysqli_fetch_array($meeting); 
          $data = $data ."<a  class='list-group-item'> Meeting Time <span style='padding-left: 5em'>".$meetingRow['meeting_time']."</span></a>
                          <a  class='list-group-item '> Remarks <span style='padding-left: 7em'>".$meetingRow['remarks']."</span></a>
                          <a  class='list-group-item'>
                             <button class='btn btn-primary' style='margin-left: 30%' onclick='workerDetails(".$id.", 3);' >Worker Details</button>
                             <button class='btn btn-primary' onclick='changeStatus(".$id.", \"meeting\", 2);' >Change Status</button>
                             <button class='btn btn-primary'  onclick='addmeeting(".$id.", 3);' >Reshadule Meeting</button>
                          </a>";
        } 
        elseif($status == "picked") { 
          if($srsrow['match_id'] != 0) {
            $data = $data ."<a  class='list-group-item'>
                             <button class='btn btn-primary' style='margin-left: 10%' onclick='workerDetails(".$id.", 1);' >Worker 1 Details</button>
                             <button class='btn btn-primary'  onclick='addmeeting(".$id.", 1);' >Add Meeting</button>";
            if($srsrow['match2_id'] != 0) {
              $data = $data ."<button class='btn btn-primary'  onclick='workerDetails(".$id.", 2);' >Worker 2 Details</button>";
            }
            $data = $data ."<button class='btn btn-primary' onclick='changeStatus(".$id.", \"open\", 1);' >Change Status</button></a>";
          }
          else {
            $data = $data ."<a  class='list-group-item'>
                             <button class='btn btn-primary' style='margin-left: 30%' onclick='changeStatus(".$id.", \"open\", 1);' >Change Status</button>
                             <button class='btn btn-primary'  onclick='addmeeting(".$id.", 2);' >Add Meeting</button>
                          </a>";
          } 
        } 
        else { 
          $data = $data ."<a  class='list-group-item'>
                           <button class='btn btn-primary' style='margin-left: 80%' onclick='mePick(".$id.");' >Pick</button>
                        </a>";
        }
        $data = $data ."<a  class='list-group-item' >
                         <button class='btn btn-primary' style='margin-left: 40%' onclick='Update(".$id.");'>Update request</button>
                         <button class='btn btn-primary'  onclick='viewNotes(".$id.", 1);' >View Notes</button>
                         <button class='btn btn-primary' onclick='addnote(".$id.", \"client_request\");'>Add Note</button>
                      </a>
                      <a  class='list-group-item' >
                        <span id='workerform_".$id."'></span>
                      </a>
                   </p>
                </div>" ;
      }
  		break;

  	case 'admin':
  		switch ($status) {
  			case 'all':
  				$condition = " 1 ";
  				break;
  			
  			case 'open':
  				$condition = " cem_id = 0 AND me_id = 0 ";
  				break;
  			
  			case 'cem_open':
  				$condition = " cem_id = 0 AND me_id != 0 AND (match_id != 0 OR match2_id != 0)" ;
  				break;
  			
  			case '24':
  				$condition = " work_time = 24 " ;
  				break;
  			
  			default:
  				$condition = "status = '$status' " ;
  				break;
  		}
      $data = "";
      $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition." ORDER BY 'date' DESC; ") ;
      while ($srsrow = mysqli_fetch_array($srs)){ 
        $id = $srsrow['id'];
        $color = headerColor($srsrow['priority']);
        $skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                         AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
        $data .= "<div class='list-group countRequest'>
                  <p style='font-size:16px;padding-left: 2em;'>
                    <a  class='list-group-item' style='background-color:".$color.";border-color:".$color.";'>
                      Client Name  <span style='padding-left: 5em'>".$srsrow['name']."</span>
                      <span style='padding-left: 3em'>ID : ".$id."</span>
                      <span style='padding-left: 3em'>Creation Date : ".$srsrow['created_time']."</span></a>
                    <a  class='list-group-item '> Mobile  <span style='padding-left: 6em'>".$srsrow['mobile']."</span>
                       <span style='padding-left: 4em'>Working Time : ".$srsrow['work_time']."</span></a>
                    <a  class='list-group-item'>Address <span style='padding-left: 7em'>".$srsrow['address']."</span></a>
                    <a  class='list-group-item'>Timings <span style='padding-left: 6em'>".$srsrow['timings']."</span>
                       <span style='padding-left: 5em'>Salary Criteria : ".$srsrow['min_salary']."-".$srsrow['max_salary']." K </span></a>
                    <a  class='list-group-item'> Requirements<span style='padding-left: 5em'>".$srsrow['requirements']."</span>
                       <span style='padding-left: 3em'>Gender : ".$srsrow['gender']."</a>
                    <a  class='list-group-item'>Remarks <span style='padding-left: 7em'>".$srsrow['remarks']."</span></a>
                    <a  class='list-group-item'>Worker Area <span style='padding-left: 5em'>".$srsrow['worker_area']."</span></a> 
                    <a  class='list-group-item '> Skills  <span style='padding-left: 7em'>";
        while($skillrow = mysqli_fetch_array($skill)){ 
          $data = $data .$skillrow['name'].", ";
        }
        $data = $data ."</span>
                    </a>" ;       
        if($status == "demo" OR $status == "meeting" OR $status == "done" OR $status == "feedback") {                         
          $meeting = mysqli_query($db_handle, "SELECT * FROM meetings WHERE match_id = '$id' ORDER BY meeting_time DESC LIMIT 0 , 1; ") ;
          $meetingRow = mysqli_fetch_array($meeting); 
          $data = $data ."<a  class='list-group-item'>Meeting Time <span style='padding-left: 5em'>".$meetingRow['meeting_time']."</span></a>
                        <a  class='list-group-item '> Remarks  <span style='padding-left: 7em'>".$meetingRow['remarks']."</span></a>
                        <a  class='list-group-item'>
                           <button class='btn btn-primary' style='margin-left: 70%' onclick='workerDetails(".$id.", 3);' >Worker Details</button>
                        </a>";
        }
        $data = $data ."<a  class='list-group-item' >
                         <button class='btn btn-primary' style='margin-left: 40%' onclick='Update(".$id.");'>Update request</button>
                         <button class='btn btn-primary'  onclick='viewNotes(".$id.", 1);' >View Notes</button>
                         <button class='btn btn-primary'  onclick='changeStatus(".$id.", \"".$srsrow['status']."\", 3);' >Change Status</button>
                      </a>
                      <a  class='list-group-item' >
                        <span id='workerform_".$id."'></span>
                      </a>
                   </p>
                </div>";
      }
  		break;

  	case 'cem_manager':
      switch ($status) {
        case 'all':
          $condition = " 1 ";
          break;
        
        case 'open':
          $condition = " cem_id = 0 AND me_id = 0 ";
          break;
        
        case 'cem_open':
          $condition = " cem_id = 0 AND me_id != 0 AND (match_id != 0 OR match2_id != 0)" ;
          break;
        
        case '24':
          $condition = " work_time = 24 " ;
          break;
        
        default:
          $condition = "status = '$status' " ;
          break;
      }
      $data = "";
      $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition." ORDER BY 'date' DESC; ") ;
      while ($srsrow = mysqli_fetch_array($srs)){ 
        $id = $srsrow['id'];
        $color = headerColor($srsrow['priority']);
        $skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                         AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
        $data .= "<div class='list-group countRequest'>
                  <p style='font-size:16px;padding-left: 2em;'>
                    <a  class='list-group-item' style='background-color:".$color.";border-color:".$color.";'>
                      Client Name  <span style='padding-left: 5em'>".$srsrow['name']."</span>
                      <span style='padding-left: 3em'>ID : ".$id."</span>
                      <span style='padding-left: 3em'>Creation Date : ".$srsrow['created_time']."</span></a>
                    <a  class='list-group-item '> Mobile  <span style='padding-left: 6em'>".$srsrow['mobile']."</span>
                       <span style='padding-left: 4em'>Working Time : ".$srsrow['work_time']."</span></a>
                    <a  class='list-group-item'>Address <span style='padding-left: 7em'>".$srsrow['address']."</span></a>
                    <a  class='list-group-item'>Timings <span style='padding-left: 6em'>".$srsrow['timings']."</span>
                       <span style='padding-left: 5em'>Salary Criteria : ".$srsrow['min_salary']."-".$srsrow['max_salary']." K </span></a>
                    <a  class='list-group-item'> Requirements<span style='padding-left: 5em'>".$srsrow['requirements']."</span>
                       <span style='padding-left: 3em'>Gender : ".$srsrow['gender']."</a>
                    <a  class='list-group-item'>Remarks <span style='padding-left: 7em'>".$srsrow['remarks']."</span></a>
                    <a  class='list-group-item'>Worker Area <span style='padding-left: 5em'>".$srsrow['worker_area']."</span></a> 
                    <a  class='list-group-item '> Skills  <span style='padding-left: 7em'>";
        while($skillrow = mysqli_fetch_array($skill)){ 
          $data = $data .$skillrow['name'].", ";
        }
        $data = $data ."</span>
                    </a>" ;       
        if($status == "demo" OR $status == "meeting" OR $status == "done" OR $status == "feedback") {                         
          $meeting = mysqli_query($db_handle, "SELECT * FROM meetings WHERE match_id = '$id' ORDER BY meeting_time DESC LIMIT 0 , 1; ") ;
          $meetingRow = mysqli_fetch_array($meeting); 
          $data = $data ."<a  class='list-group-item'>Meeting Time <span style='padding-left: 5em'>".$meetingRow['meeting_time']."</span></a>
                        <a  class='list-group-item '> Remarks  <span style='padding-left: 7em'>".$meetingRow['remarks']."</span></a>
                        <a  class='list-group-item'>
                           <button class='btn btn-primary' style='margin-left: 70%' onclick='workerDetails(".$id.", 3);' >Worker Details</button>
                        </a>";
        }
        $data = $data ."<a  class='list-group-item' >
                         <button class='btn btn-primary' style='margin-left: 40%' onclick='Update(".$id.");'>Update request</button>
                         <button class='btn btn-primary'  onclick='viewNotes(".$id.", 1);' >View Notes</button>
                         <button class='btn btn-primary'  onclick='changeStatus(".$id.", \"".$srsrow['status']."\", 3);' >Change Status</button>
                      </a>
                      <a  class='list-group-item' >
                        <span id='workerform_".$id."'></span>
                      </a>
                   </p>
                </div>";
      }
  		break;

  	case 'accountant':
  		break;

  	case 'ba':
  		
  		break;

  	case 'dev':
  		break;

  	case 'operator':
  		switch ($status) {
  			case 'followback':
  				$condition = "status = 'followback' " ;
  				break;

  			case 'feedback':
  				$condition = "status = 'feedback' " ;
  				break;
  			
  			default:
  				$condition = "status = 'followback' " ;
  				break;
  		}
      $data = "";
      $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE status = '$status' ORDER BY 'id' DESC; ") ;
      while ($srsrow = mysqli_fetch_array($srs)){ 
        $cem_id = $srsrow['cem_id'];
        $sr_id = $srsrow['id'];
        $done_worker_id = $srsrow['done_worker_id'];
        $data .= "<div class='list-group countRequest'>
                  <p style='font-size:16px;padding-left: 2em;'>
                    <a  class='list-group-item active'> Client Name  <span style='padding-left: 5em'>".$srsrow['name']."</span>
                      <span style='padding-left: 5em'> ID : ".$sr_id."</span></a>
                    <a  class='list-group-item '> Mobile  <span style='padding-left: 8em'>".$srsrow['mobile']."</span></a>
                    <a  class='list-group-item'> Requirements<span style='padding-left: 5em'>".$srsrow['requirements']."</span></a>" ;
        if($status == 'feedback'){
          $worker = mysqli_query($db_handle, "SELECT * FROM workers WHERE id = '$done_worker_id' ;");
          $workerDetails = mysqli_fetch_array($worker);
          $cem = mysqli_query($db_handle, "SELECT * FROM user WHERE id = '$cem_id' ; ") ;
          $cemRow = mysqli_fetch_array($cem) ;
          $data = $data ."<a  class='list-group-item '> Worker Name  <span style='padding-left: 5em'>".$workerDetails['first_name']."</span></a>
                        <a  class='list-group-item '> Mobile  <span style='padding-left: 8em'>".$workerDetails['phone']."</span></a>
                        <a  class='list-group-item '> Meeting Done By  <span style='padding-left: 4em'>".$cemRow['first_name']." ".$cemRow['last_name']."</span></a>
                        <a  class='list-group-item '> Mobile  <span style='padding-left: 8em'>".$cemRow['phone']."</span></a>
                        <a  class='list-group-item '>
                          <button class='btn btn-primary' style='margin-left: 40%' onclick='feedback(".$sr_id.", \"client\");'>Client Feedback</button>
                          <button class='btn btn-primary' onclick='feedback(".$sr_id.", \"worker\");'>Worker Feedback</button>
                        </a>" ;
        } 
        else {
          $data = $data ."<a  class='list-group-item '>
                           <button class='btn btn-primary' style='margin-left: 60%' onclick='addnote(".$sr_id.", \"client_request\");'>Add Note</button>
                           <button class='btn btn-primary' onclick='changeStatus(".$sr_id.", \"feedback\", 1);'>Change Status</button>
                        </a>" ;
        }
        $data = $data ."<a  class='list-group-item' >
                          <span id='workerform_".$sr_id."'></span>
                        </a>
                     </p>
                  </div>" ;
      }
  		break;
  }
  echo $data;
}
mysqli_close($db_handle);
?>