<div class="page-content">
   <div id="tab-general">
      <div class="row mbl">
         <div class="col-lg-8">
            <div class="panel-primary">
               <?php 
                  $condition = "";
                  if ($status == "picked") $condition = " me_id = " .$user_id." AND (match_id = 0 OR match2_id = 0) AND (status='open' OR status='me_open')" ;
                  else if ($status == "done") $condition = " me_id = " .$user_id." AND match_id != 0 AND match2_id != 0 " ;
                  else $condition = " (status='open' OR status='me_open') and me_id = 0" ;
                  $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition."; ") ;
                  while ($srsrow = mysqli_fetch_array($srs)){
               ?>
               <div class="list-group">
                  <p style="font-size:20px;padding-left: 2em;">
                     <a  class="list-group-item active"> Worker Area  <span style="padding-left: 5em"><?= $srsrow['worker_area'] ?></span></a>
                     <a  class="list-group-item "> Area  <span style="padding-left: 9em"><?= $srsrow['area'] ?></span></a>
                     <a  class="list-group-item">Requirements <span style="padding-left: 5em"><?= $srsrow['requirements'] ?>, <?= strtoupper($srsrow['gender']) ?></span></a>
                     <a  class="list-group-item">Timings <span style="padding-left: 8em"><?= $srsrow['timings'] ?></span></a>
                     <a  class="list-group-item">Working Time <span style="padding-left: 5em"><?= $srsrow['work_time'] ?></span></a>
                     <a  class="list-group-item">Salary Criteria <span style="padding-left: 5em"><?= $srsrow['expected_salary'] ?></span></a>
                     <a  class="list-group-item">Remarks <span style="margin-left: 7em;"><?= $srsrow['remarks'] ?></span></a>
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