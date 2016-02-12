<div class="page-content">
   <div id="tab-general">  
      <div class="row mbl">
         <div class="col-lg-8">
            <div class="panel-primary">
               <?php 
                  $condition = "";
                  if ($status == "picked") $condition = " me_id = " .$user_id." AND (match_id = 0 OR match2_id = 0) AND (status='open' OR status='me_open')" ;
                  else if ($status == "done") $condition = " me_id = " .$user_id." AND match_id != 0 AND match2_id != 0 " ;
                  else if ($status == "24") $condition = "  (status='open' OR status='me_open') AND me_id = 0 AND work_time = 24 " ;
                  else $condition = " (status='open' OR status='me_open') AND me_id = 0 AND work_time != 24 " ;
                  $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition." ;") ;
                  while ($srsrow = mysqli_fetch_array($srs)){
                     $id = $srsrow['id'];
                     $cem_id = $srsrow['cem_id'];
                     $skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                                            AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
               ?>
               <div class="list-group">
                  <p style="font-size:20px;padding-left: 2em;">
                     <a  class="list-group-item active"> Worker Area  <span style="padding-left: 5em"><?= $srsrow['worker_area'] ?></span>
                        <span style="padding-left: 5em">ID : <?= $srsrow['id'] ?></span></a>
                     <a  class="list-group-item "> Area  <span style="padding-left: 9em"><?= $srsrow['area'] ?></span></a>
                     <a  class="list-group-item">Requirements <span style="padding-left: 5em"><?= $srsrow['requirements'] ?>, <?= strtoupper($srsrow['gender']) ?></span></a>
                     <a  class="list-group-item">Timings <span style="padding-left: 8em"><?= $srsrow['timings'] ?></span></a>
                     <a  class="list-group-item">Working Time <span style="padding-left: 5em"><?= $srsrow['work_time'] ?></span></a>
                     <a  class="list-group-item">Salary Criteria <span style="padding-left: 5em"><?php echo $srsrow['min_salary']."-".$srsrow['max_salary']." K "; ?></span></a>
                     <a  class="list-group-item">Remarks <span style="margin-left: 7em;"><?= $srsrow['remarks'] ?></span></a>
                     <a  class="list-group-item">Creation Date <span style="margin-left: 5em;"><?= $srsrow['created_time'] ?></span></a>
                     <?php
                        if($srsrow['me_id'] != 0){
                           $pickDate = mysqli_query($db_handle, "SELECT * FROM updates WHERE request_id = '$id' AND new_status = 'picked' 
                                                                  AND user_id = '$user_id' ORDER BY update_time DESC LIMIT 0 , 1 ;");
                           $pickDateRow = mysqli_fetch_array($pickDate) ;
                           echo "<a  class='list-group-item'>Picked Date <span style='margin-left: 5em;''>".$pickDateRow['update_time']."</span></a>" ;
                        } 
                        if($cem_id != 0){
                           $cem = mysqli_query($db_handle, "SELECT * FROM user WHERE id = '$cem_id' ; ") ;
                           $cemRow = mysqli_fetch_array($cem) ;
                           echo "<a  class='list-group-item ''> Picked By CEM <span style='padding-left: 5em'>".strtoupper($cemRow['first_name'])." ".strtoupper($cemRow['last_name'])."</span></a>
                                 <a  class='list-group-item '> Mobile  <span style='padding-left: 8em'>".$cemRow['phone']."</span></a>";
                        }
                        if($status == "done") {
                           $doneDate =  mysqli_query($db_handle, "SELECT b.creation_date FROM service_request as a join workers as b 
                                                                     WHERE a.match2_id=b.id ;");
                           $doneDateRow = mysqli_fetch_array($doneDate) ;
                           echo "<a  class='list-group-item'>Done Date <span style='margin-left: 5em;''>".$doneDateRow['creation_date']."</span></a>" ;
                        } 
                     ?>
                     <a  class="list-group-item "> Skills  <span style="padding-left: 7em">
                     <?php 
                        while($skillrow = mysqli_fetch_array($skill)){ 
                           echo $skillrow['name'].", ";
                        }
                     ?>
                        </span>
                     </a>
                     <a  class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 60%" onclick="viewNotes(<?= $srsrow['id'] ?>, 1);" >View Notes</button>
                        <button class="btn btn-primary"  onclick="addnote(<?= $srsrow['id'] ?>, 'client_request');">Add Note</button>
                     </a>
                     <a  class="list-group-item">
                     <?php 
                        if($status == "done") { 
                     ?>
                        <button class="btn btn-primary" style="margin-left: 40%" onclick="workerDetails(<?= $srsrow['id'] ?>, 1);" >Worker 1 Details</button>
                        <button class="btn btn-primary"  onclick="workerDetails(<?= $srsrow['id'] ?>, 2);" >Worker 2 Details</button>
                     <?php  } 
                        elseif($status == "picked") { 
                           if($srsrow['match_id'] == 0 ){ 
                     ?>
                        <button class="btn btn-primary" style="margin-left: 60%" onclick="addworker(<?= $srsrow['id'] ?>, 1);">Add Worker1</button>
                     <?php } 
                        if($srsrow['match2_id'] == 0 ){ 
                           if($srsrow['match_id'] != 0 ){
                     ?>
                        <button class="btn btn-primary" style="margin-left: 40%" onclick="workerDetails(<?= $srsrow['id'] ?>, 1);" >Worker 1 Details</button>
                     <?php } ?>
                        <button class="btn btn-primary" onclick="addworker(<?= $srsrow['id'] ?>, 2);">Add Worker2</button>
                     <?php }
                        } 
                        else { 
                     ?>
                        <button class="btn btn-primary" style="margin-left: 80%" onclick="mePick(<?= $srsrow['id'] ?>);" >Pick</button>
                     <?php }?>
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