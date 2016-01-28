<div class="page-content">
   <div id="tab-general">
      <div class="row mbl">
         <div class="col-lg-8">
            <div class="panel-primary">
            <?php 
               $condition = "";
               $status = $_GET['status'];
               if ($status == "open") $condition = " cem_id = 0 AND me_id = 0 ";
               elseif ($status == "meeting") $condition = "status = 'meeting'" ;
               elseif ($status == "me_open") $condition = " status = 'me_open'" ;
               elseif ($status == "cem_open") $condition = " cem_id = 0 AND me_id != 0 AND (match_id != 0 OR match2_id != 0)" ;
               elseif ($status == "salary_issue") $condition = "status = 'salary_issue'" ;
               elseif ($status == "demo") $condition = "status = 'demo'";
               elseif ($status == "done") $condition = "status = 'done'";
               elseif ($status == "delete") $condition = "status = 'delete'";
               elseif ($status == "not_interested") $condition = "status = 'not_interested'" ;
               elseif ($status == "decay") $condition = "status = 'decay'";
               elseif ($status == "just_to_know") $condition = "status = 'just_to_know'" ;
               elseif ($status == "followback") $condition = "status = 'followback'" ;
               elseif ($status == "feedback") $condition = "status = 'feedback'" ;
               elseif (!isset($_GET['status']))$condition = " 1 = 1 " ;
               else $condition = "status = ".$status ;
               $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE ".$condition."; ") ;
               while ($srsrow = mysqli_fetch_array($srs)){ 
                  $id = $srsrow['id'];
                  $skill = mysqli_query($db_handle, "SELECT a.name, a.id FROM skill_name AS a JOIN skills AS b WHERE b.user_id = '$id'
                                                      AND b.status = 'open' AND b.type = 'client' AND a.id = b.skill_id ;");
            ?>
               <div class="list-group">
                  <p style="font-size:20px;padding-left: 2em;">
                     <a  class="list-group-item active"> Client Name  <span style="padding-left: 5em"><?= $srsrow['name'] ?></span></a>
                     <a  class="list-group-item "> Mobile  <span style="padding-left: 8em"><?= $srsrow['mobile'] ?></span></a>
                     <a  class="list-group-item">Address <span style="padding-left: 7em"><?= $srsrow['address'] ?></span></a>
                     <a  class="list-group-item">Salary Criteria <span style="padding-left: 5em"><?= $srsrow['expected_salary'] ?></span></a>
                     <a  class="list-group-item">Timings <span style="padding-left: 8em"><?= $srsrow['timings'] ?></span></a>
                     <a  class="list-group-item">Working Time <span style="padding-left: 5em"><?= $srsrow['work_time'] ?></span></a>
                     <a  class="list-group-item"> Requirements<span style="padding-left: 5em"><?= $srsrow['requirements'] ?></span></a>
                     <a  class="list-group-item">Remarks <span style="padding-left: 7em"><?= $srsrow['remarks'] ?></span></a>
                     <a  class="list-group-item">Worker Area <span style="padding-left: 5em"><?= $srsrow['worker_area'] ?></span></a>
                     <a  class="list-group-item "> Gender  <span style="padding-left: 7em"><?= $srsrow['gender'] ?></span></a>       
                     <a  class="list-group-item "> Skills  <span style="padding-left: 7em">
                        <?php 
                           while($skillrow = mysqli_fetch_array($skill)){ 
                              echo $skillrow['name'].", ";
                           }
                        ?>
                        </span>
                     </a>       
                     <?php 
                        if($status == "demo" OR $status == "meeting" OR $status == "done" OR $status == "feedback") {                         
                           $id =  $srsrow['id'];
                           $meeting = mysqli_query($db_handle, "SELECT * FROM meetings WHERE match_id = '$id' ORDER BY meeting_time DESC LIMIT 0 , 1; ") ;
                           $meetingRow = mysqli_fetch_array($meeting); 
                     ?>
                     <a  class="list-group-item">Meeting Time <span style="padding-left: 5em"><?= $meetingRow['meeting_time'] ?></span></a>
                     <a  class="list-group-item "> Remarks  <span style="padding-left: 7em"><?= $meetingRow['remarks'] ?></span></a>
                     <a  class="list-group-item">
                        <button class="btn btn-primary" style="margin-left: 70%" onclick="workerDetails(<?= $srsrow['id'] ?>, 3);" >Worker Details</button>
                     </a>
                     <?php } ?>
                     <a  class="list-group-item" >
                        <button class="btn btn-primary" style="margin-left: 40%" onclick="Update(<?= $srsrow['id'] ?>);">Update request</button>
                        <button class="btn btn-primary"  onclick="viewNotes(<?= $srsrow['id'] ?>, 1);" >View Notes</button>
                        <button class="btn btn-primary"  onclick="changeStatus(<?= $srsrow['id'] ?>, <?= $srsrow['status'] ?>, 3);" >Change Status</button>
                     </a>
                     <a  class="list-group-item" >
                       <span id="workerform_<?= $srsrow['id'] ?>"></span>
                     </a>
                  </p>
               </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
