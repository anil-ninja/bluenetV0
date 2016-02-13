<div class="page-content">
   <div id="tab-general">
      <div class="row mbl">
         <div class="col-lg-8">
            <div class="panel-primary">
               <?php 
                  $condition = "";
                  if ($status == "picked") $condition = " cem_id = " .$user_id. " AND status = 'open'";
                  elseif ($status == "match") $condition = " cem_id = 0 AND me_id != 0 AND status = 'open' AND (match_id != 0 OR match2_id != 0)" ;
                  elseif ($status == "meeting") $condition = " status = 'meeting' AND cem_id = " .$user_id ;
                  elseif ($status == "demo") $condition = " status='demo' AND cem_id = " .$user_id ;
                  elseif ($status == "done") $condition = " status='done' AND cem_id = " .$user_id ;
                  elseif ($status == "24") $condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time = 24 " ;
                  else $condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time != 24 " ;
                  $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition." ; ") ;
                  while ($srsrow = mysqli_fetch_array($srs)){ 
                     $id = $srsrow['id'];
                     $me_id = $srsrow['me_id'];
                     $skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                                         AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
               ?>
               <div class="list-group countRequest">
                  <p style="font-size:16px;padding-left: 1em;">
                     <a  class="list-group-item active"> Client Name  <span style="padding-left: 5em"><?= $srsrow['name'] ?></span>
                       <span style="padding-left: 3em">ID : <?= $srsrow['id'] ?></span>
                       <span style="padding-left: 3em">Creation Date : <?= $srsrow['created_time'] ?></span></a>
                     <a  class="list-group-item "> Mobile  <span style="padding-left: 6em"><?= $srsrow['mobile'] ?></span>
                        <span style="padding-left: 4em">Working Time : <?= $srsrow['work_time'] ?></span></a>
                     <a  class="list-group-item">Address <span style="padding-left: 7em"><?= $srsrow['address'] ?></span></a>
                     <a  class="list-group-item">Timings <span style="padding-left: 6em"><?= $srsrow['timings'] ?></span>
                        <span style="padding-left: 5em">Salary Criteria : <?php echo $srsrow['min_salary']."-".$srsrow['max_salary']." K "; ?></span></a>
                     <a  class="list-group-item"> Requirements<span style="padding-left: 5em"><?= $srsrow['requirements'] ?></span>
                        <span style="padding-left: 3em">Gender : <?= $srsrow['gender'] ?></a>
                     <a  class="list-group-item">Remarks <span style="padding-left: 7em"><?= $srsrow['remarks'] ?></span></a>
                     <a  class="list-group-item">Worker Area <span style="padding-left: 5em"><?= $srsrow['worker_area'] ?></span></a> 
                     <a  class="list-group-item "> Skills  <span style="padding-left: 7em">
                        <?php 
                           while($skillrow = mysqli_fetch_array($skill)){ 
                              echo $skillrow['name'].", ";
                           }
                        ?>
                        </span>
                     </a>
                     <?php 
                        if($srsrow['cem_id'] != 0){
                           $pickDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'picked' 
                                                                  AND user_id = '$user_id' ORDER BY update_time DESC LIMIT 0 , 1 ;");
                           $pickDateRow = mysqli_fetch_array($pickDate) ;
                           echo "<a  class='list-group-item'>Picked Date <span style='margin-left: 5em;''>".$pickDateRow['update_time']."</span></a>" ;
                        } 
                        if($me_id != 0){
                           $cem = mysqli_query($db_handle, "SELECT * FROM user WHERE id = '$me_id' ; ") ;
                           $cemRow = mysqli_fetch_array($cem) ;
                           echo "<a  class='list-group-item ''> Picked By ME <span style='padding-left: 5em'>".strtoupper($cemRow['first_name'])." ".strtoupper($cemRow['last_name'])."</span></a>
                                 <a  class='list-group-item '> Mobile  <span style='padding-left: 8em'>".$cemRow['phone']."</span></a>";
                        }     
                     
                        if($status == "done") { 
                           $doneDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'done' 
                                                                  AND user_id = '$user_id' ORDER BY update_time DESC LIMIT 0 , 1 ;");
                           $doneDateRow = mysqli_fetch_array($doneDate) ;
                           echo "<a  class='list-group-item'>Done Date <span style='margin-left: 5em;''>".$doneDateRow['update_time']."</span></a>" ;
                        } 
                        elseif($status == "demo") { 
                     ?>
                     <a  class='list-group-item'>
                        <button class='btn btn-primary' style='margin-left: 70%;' onclick="changeStatus(<?= $srsrow['id'] ?>, 'meeting', 2);">Change Status</button>
                     </a>
                     <?php
                        } 
                        elseif($status == "meeting") { 
                           $id =  $srsrow['id'];
                           $meeting = mysqli_query($db_handle, "SELECT * FROM meetings WHERE match_id = '$id' ORDER BY created_time DESC LIMIT 0 , 1; ") ;
                           $meetingRow = mysqli_fetch_array($meeting); 
                     ?>
                     <a  class="list-group-item"> Meeting Time <span style="padding-left: 5em"><?= $meetingRow['meeting_time'] ?></span></a>
                     <a  class="list-group-item "> Remarks  <span style="padding-left: 7em"><?= $meetingRow['remarks'] ?></span></a>
                     <a  class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 30%" onclick="workerDetails(<?= $srsrow['id'] ?>, 3);" >Worker Details</button>
                        <button class="btn btn-primary" onclick="changeStatus(<?= $srsrow['id'] ?>, 'meeting', 2);" >Change Status</button>
                        <button class="btn btn-primary"  onclick="addmeeting(<?= $srsrow['id'] ?>, 3);" >Reshadule Meeting</button>
                     </a>
                     <?php
                        } 
                        elseif($status == "picked") { 
                           if($srsrow['match_id'] != 0) {
                     ?>
                     <a  class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 40%" onclick="workerDetails(<?= $srsrow['id'] ?>, 1);" >Worker 1 Details</button>
                        <button class="btn btn-primary"  onclick="addmeeting(<?= $srsrow['id'] ?>, 1);" >Add Meeting</button>
                     </a>
                     <?php }
                        elseif ($srsrow['match2_id'] != 0) {
                           echo "<button class='btn btn-primary'  onclick='workerDetails(".$srsrow['id'].", 2);' >Worker 2 Details</button>";
                        }
                        else {
                     ?>
                     <a  class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 30%" onclick="changeStatus(<?= $srsrow['id'] ?>, 'open', 2);" >Change Status</button>
                        <button class="btn btn-primary"  onclick="addmeeting(<?= $srsrow['id'] ?>, 2);" >Add Meeting</button>
                     </a>
                     <?php }
                        } 
                        else { 
                     ?>
                     <a  class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 80%" onclick="mePick(<?= $srsrow['id'] ?>);" >Pick</button>
                     </a>
                     <?php } ?>
                     <a  class="list-group-item" >
                        <button class="btn btn-primary" style="margin-left: 40%" onclick="Update(<?= $srsrow['id'] ?>);">Update request</button>
                        <button class="btn btn-primary"  onclick="viewNotes(<?= $srsrow['id'] ?>, 1);" >View Notes</button>
                        <button class='btn btn-primary' onclick="addnote(<?= $srsrow['id'] ?>, 'client_request');">Add Note</button>
                     </a>
                     <a  class="list-group-item" >
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