<div class="page-content">
   <div id="tab-general">
      <div class="row mbl">
         <div class="col-lg-8">
            <div class="panel-primary">
            <?php 
               if ($_SESSION["employee_type"] ==  "me"  ) {
                  $condition = "";
                  //if ($status == "open") $condition = " status='open' OR status='me_open' ";
                  if ($status == "picked") $condition = " me_id = " .$user_id." AND (match_id = 0 OR match2_id = 0)" ;
                  else if ($status == "done") $condition = " me_id = " .$user_id." AND match_id != 0 and match2_id != 0" ;
                  else $condition = " (status='open' OR status='me_open') and me_id = 0" ;
                  $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition."; ") ;
                  while ($srsrow = mysqli_fetch_array($srs)){
            ?>
               <div class="list-group">
                  <p style="font-size:20px;padding-left: 2em;">
                     <a href="#" class="list-group-item active"> Worker Area  <span style="padding-left: 5em"><?= $srsrow['worker_area'] ?></span></a>
                     <a href="#" class="list-group-item "> Area  <span style="padding-left: 9em"><?= $srsrow['area'] ?></span></a>
                     <a href="#" class="list-group-item">Requirements <span style="padding-left: 5em"><?= $srsrow['requirements'] ?></span></a>
                     <a href="#" class="list-group-item">Timings <span style="padding-left: 8em"><?= $srsrow['timings'] ?></span></a>
                     <a href="#" class="list-group-item">Working Time <span style="padding-left: 5em"><?= $srsrow['work_time'] ?></span></a>
                     <a href="#" class="list-group-item">Salary Criteria <span style="padding-left: 5em"><?= $srsrow['expected_salary'] ?></span></a>
                     <a href="#" class="list-group-item">Remarks <span style="padding-left: 7em"><?= $srsrow['remarks'] ?></span></a>
                     <a href="#" class="list-group-item">
                     <?php 
                        if($status == "done") {  } 
                        elseif($status == "picked") { 
                           if($srsrow['match_id'] == 0 ){ 
                     ?>
                        <button class="btn btn-primary" style="margin-left: 60%" onclick="addworker(<?= $srsrow['id'] ?>, 1);">Add Worker1</button>
                     <?php } 
                        if($srsrow['match2_id'] == 0 ){ 
                     ?>
                        <button class="btn btn-primary" onclick="addworker(<?= $srsrow['id'] ?>, 2);">Add Worker2</button>
                     <?php }
                        } 
                        else { 
                     ?>
                        <button class="btn btn-primary" style="margin-left: 80%" onclick="mePick(<?= $srsrow['id'] ?>);" >Pick</button>
                     <?php }?>
                     </a>
                     <a href="#" class="list-group-item" >
                       <span id="workerform_<?= $srsrow['id'] ?>"></span>
                     </a>
                  </p>
               </div>
               <?php  }
                  } 
                  elseif ($_SESSION["employee_type"] ==  "cem"){
                     $condition = "";
                     if ($status == "picked") $condition = " cem_id = " .$user_id. " AND status = 'open'";
                     elseif ($status == "match") $condition = " cem_id = 0 AND me_id != 0 " ;
                     elseif ($status == "meeting") $condition = " status = 'meeting' AND cem_id = " .$user_id ;
                     elseif ($status == "demo") $condition = " status='demo' AND cem_id = " .$user_id ;
                     elseif ($status == "done") $condition = " status='done' AND cem_id = " .$user_id ;
                     else $condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0" ;
                     $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition."; ") ;
                     while ($srsrow = mysqli_fetch_array($srs)){ 
               ?>
               <div class="list-group">
                  <p style="font-size:20px;padding-left: 2em;">
                     <a href="#" class="list-group-item active"> Client Name  <span style="padding-left: 5em"><?= $srsrow['name'] ?></span></a>
                     <a href="#" class="list-group-item "> Mobile  <span style="padding-left: 8em"><?= $srsrow['mobile'] ?></span></a>
                     <a href="#" class="list-group-item">Address <span style="padding-left: 7em"><?= $srsrow['address'] ?></span></a>
                     <a href="#" class="list-group-item">Salary Criteria <span style="padding-left: 5em"><?= $srsrow['expected_salary'] ?></span></a>
                     <a href="#" class="list-group-item">Timings <span style="padding-left: 8em"><?= $srsrow['timings'] ?></span></a>
                     <a href="#" class="list-group-item">Working Time <span style="padding-left: 5em"><?= $srsrow['work_time'] ?></span></a>
                     <a href="#" class="list-group-item"> Requirements<span style="padding-left: 5em"><?= $srsrow['requirements'] ?></span></a>
                     <a href="#" class="list-group-item">Remarks <span style="padding-left: 7em"><?= $srsrow['remarks'] ?></span></a>
                     <a href="#" class="list-group-item">Worker Area <span style="padding-left: 5em"><?= $srsrow['worker_area'] ?></span></a>
                     <a href="#" class="list-group-item "> Gender  <span style="padding-left: 7em"><?= $srsrow['gender'] ?></span></a>       
                     <?php 
                        if($status == "done") {  } 
                        elseif($status == "demo") { } 
                        elseif($status == "meeting") { 
                           $id =  $srsrow['id'];
                           $meeting = mysqli_query($db_handle, "SELECT * FROM meetings WHERE match_id = '$id' ORDER BY meeting_time DESC LIMIT 0 , 1; ") ;
                           $meetingRow = mysqli_fetch_array($meeting); 
                     ?>
                     <a href="#" class="list-group-item">Meeting Time <span style="padding-left: 5em"><?= $meetingRow['meeting_time'] ?></span></a>
                     <a href="#" class="list-group-item "> Remarks  <span style="padding-left: 7em"><?= $meetingRow['remarks'] ?></span></a>
                     <a href="#" class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 10%" onclick="workerDetails(<?= $srsrow['id'] ?>, 3);" >Worker Details</button>
                        <button class="btn btn-primary" onclick="ChangeServiceRequestStatus(<?= $srsrow['id'] ?>, meeting, demo);" >Done</button>
                        <button class="btn btn-primary"  onclick="ChangeServiceRequestStatus(<?= $srsrow['id'] ?>, meeting, me_open);" >Search Worker</button>
                        <button class="btn btn-primary"  onclick="addmeeting(<?= $srsrow['id'] ?>);" >Reshadule Meeting</button>
                     </a>
                     <?php
                        } 
                        elseif($status == "picked") { 
                           if($srsrow['match_id'] != 0 AND $srsrow['match2_id'] != 0) {
                     ?>
                     <a href="#" class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 40%" onclick="workerDetails(<?= $srsrow['id'] ?>, 1);" >Worker 1 Details</button>
                        <button class="btn btn-primary"  onclick="workerDetails(<?= $srsrow['id'] ?>, 2);" >Worker 2 Details</button>
                        <button class="btn btn-primary"  onclick="addmeeting(<?= $srsrow['id'] ?>);" >Add Meeting</button>
                     </a>
                     <?php }
                        else {
                     ?>
                     <a href="#" class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 30%" onclick="ChangeServiceRequestStatus(<?= $srsrow['id'] ?>, open, me_open);" >Change Status</button>
                     </a>
                     <?php }
                        } 
                        else { 
                     ?>
                     <a href="#" class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 80%" onclick="mePick(<?= $srsrow['id'] ?>);" >Pick</button>
                     </a>
                     <?php } ?>
                     <a href="#" class="list-group-item" ><span style="padding-left: 15em">Update request</span></a>
                     <a href="#" class="list-group-item" >
                        <button class="btn btn-primary"  onclick="viewNotes(<?= $srsrow['id'] ?>, 1);" >View Notes</button>
                     </a>
                     <a href="#" class="list-group-item" >
                       <span id="workerform_<?= $srsrow['id'] ?>"></span>
                     </a>
                  </p>
               </div>
               <?php } 
                  }
                  elseif ($_SESSION["employee_type"] ==  "operator"){
                  
                     $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE status = '$status'; ") ;
                     while ($srsrow = mysqli_fetch_array($srs)){ 
               ?>
               <div class="list-group">
                  <p style="font-size:20px;padding-left: 2em;">
                     <a href="#" class="list-group-item active"> Client Name  <span style="padding-left: 5em"><?= $srsrow['name'] ?></span></a>
                     <a href="#" class="list-group-item "> Mobile  <span style="padding-left: 8em"><?= $srsrow['mobile'] ?></span></a>
                     <a href="#" class="list-group-item"> Requirements<span style="padding-left: 5em"><?= $srsrow['requirements'] ?></span></a>
                     <?php 
                        if($status == 'feedback'){
                           $sr_id = $srsrow['id'];
                           $worker = mysqli_query($db_handle, "SELECT b.* FROM service_request as a join workers as b 
                                                               WHERE a.id = $sr_id AND a.done_worker_id = b.id ;");
                           $workerDetails = mysqli_fetch_array($worker);
                     ?>
                     <a href="#" class="list-group-item active"> Worker Name  <span style="padding-left: 5em"><?= $workerDetails['first_name'] ?></span></a>
                     <a href="#" class="list-group-item "> Mobile  <span style="padding-left: 8em"><?= $srsrow['phone'] ?></span></a>
                     <?php } ?>
                  </p>
               </div>
               <?php }
                  } 
                  else { }
               ?>
            </div>
         </div>
      </div>
   </div>
</div>
