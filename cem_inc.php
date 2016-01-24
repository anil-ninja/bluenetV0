<div class="page-content">
   <div id="tab-general">
      <div class="row mbl">
         <div class="col-lg-8">
            <div class="panel-primary">
               <?php 
                  $condition = "";
                     if ($status == "picked") $condition = " cem_id = " .$user_id. " AND status = 'open'";
                     elseif ($status == "match") $condition = " cem_id = 0 AND me_id != 0 AND status = 'open' " ;
                     elseif ($status == "meeting") $condition = " status = 'meeting' AND cem_id = " .$user_id ;
                     elseif ($status == "demo") $condition = " status='demo' AND cem_id = " .$user_id ;
                     elseif ($status == "done") $condition = " status='done' AND cem_id = " .$user_id ;
                     else $condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0" ;
                     $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition."; ") ;
                     while ($srsrow = mysqli_fetch_array($srs)){ 
               ?>
               <div class="list-group">
                  <p style="font-size:20px;padding-left: 1em;">
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
                        elseif($status == "demo") { 
                           echo "<button class='btn btn-primary' style='margin-left: 40%;' onclick='changeStatus(".$srsrow['id'].", 'meeting', 2);'>Change Status</button>
                                 <button class='btn btn-primary' onclick='addnote(".$srsrow['id'].", client_request);'>Add Note</button>";
                        } 
                        elseif($status == "meeting") { 
                           $id =  $srsrow['id'];
                           $meeting = mysqli_query($db_handle, "SELECT * FROM meetings WHERE match_id = '$id' ORDER BY created_time DESC LIMIT 0 , 1; ") ;
                           $meetingRow = mysqli_fetch_array($meeting); 
                     ?>
                     <a href="#" class="list-group-item"> Meeting Time <span style="padding-left: 5em"><?= $meetingRow['meeting_time'] ?></span></a>
                     <a href="#" class="list-group-item "> Remarks  <span style="padding-left: 7em"><?= $meetingRow['remarks'] ?></span></a>
                     <a href="#" class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 30%" onclick="workerDetails(<?= $srsrow['id'] ?>, 3);" >Worker Details</button>
                        <button class="btn btn-primary" onclick="changeStatus(<?= $srsrow['id'] ?>, 'meeting', 2);" >Change Status</button>
                        <button class="btn btn-primary"  onclick="addmeeting(<?= $srsrow['id'] ?>);" >Reshadule Meeting</button>
                     </a>
                     <?php
                        } 
                        elseif($status == "picked") { 
                           if($srsrow['match_id'] != 0) {
                     ?>
                     <a href="#" class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 40%" onclick="workerDetails(<?= $srsrow['id'] ?>, 1);" >Worker 1 Details</button>
                        <button class="btn btn-primary"  onclick="addmeeting(<?= $srsrow['id'] ?>);" >Add Meeting</button>
                     </a>
                     <?php }
                        elseif ($srsrow['match2_id'] != 0) {
                           echo "<button class='btn btn-primary'  onclick='workerDetails(".$srsrow['id'].", 2);' >Worker 2 Details</button>";
                        }
                        else {
                     ?>
                     <a href="#" class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 30%" onclick="changeStatus(<?= $srsrow['id'] ?>, open, 2);" >Change Status</button>
                     </a>
                     <?php }
                        } 
                        else { 
                     ?>
                     <a href="#" class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 80%" onclick="mePick(<?= $srsrow['id'] ?>);" >Pick</button>
                     </a>
                     <?php } ?>
                     <a href="#" class="list-group-item" >
                        <button class="btn btn-primary" style="margin-left: 60%" onclick="Update(<?= $srsrow['id'] ?>);">Update request</button>
                        <button class="btn btn-primary"  onclick="viewNotes(<?= $srsrow['id'] ?>, 1);" >View Notes</button>
                     </a>
                     <a href="#" class="list-group-item" >
                       <span id="workerform_<?= $srsrow['id'] ?>"></span>
                     </a>
                  </p>
               </div>
               <?php }  ?>
            </div>
         </div>
      </div>
   </div>
</div> 