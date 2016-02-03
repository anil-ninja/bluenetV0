<div class="page-content">
   <div id="tab-general">
      <div class="row mbl">
         <div class="col-lg-8">
            <div class="panel-primary">
               <?php 
                  if(!isset($_GET['status'])) $status = "followback";
                  $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE status = '$status' ORDER BY 'id' DESC; ") ;
                  while ($srsrow = mysqli_fetch_array($srs)){ 
               ?>
               <div class="list-group countRequest">
                  <p style="font-size:20px;padding-left: 2em;">
                     <a  class="list-group-item active"> Client Name  <span style="padding-left: 5em"><?= $srsrow['name'] ?></span></a>
                     <a  class="list-group-item "> Mobile  <span style="padding-left: 8em"><?= $srsrow['mobile'] ?></span></a>
                     <a  class="list-group-item"> Requirements<span style="padding-left: 5em"><?= $srsrow['requirements'] ?></span></a>
                     <?php 
                        if($status == 'feedback'){
                           $sr_id = $srsrow['id'];
                           $worker = mysqli_query($db_handle, "SELECT b.* FROM service_request as a join workers as b 
                                                                  WHERE a.id = $sr_id AND a.done_worker_id = b.id ;");
                           $workerDetails = mysqli_fetch_array($worker);
                     ?>
                     <a  class="list-group-item "> Worker Name  <span style="padding-left: 5em"><?= $workerDetails['first_name'] ?></span></a>
                     <a  class="list-group-item "> Mobile  <span style="padding-left: 8em"><?= $srsrow['phone'] ?></span></a>
                     <a  class="list-group-item ">
                        <button class="btn btn-primary" style="margin-left: 40%" onclick="feedback(<?= $srsrow['id'] ?>, 'client');">Client Feedback</button>
                        <button class="btn btn-primary" onclick="feedback(<?= $srsrow['id'] ?>, 'worker');">Worker Feedback</button>
                     </a>
                     <?php } 
                        else {
                     ?>
                     <a  class="list-group-item ">
                        <button class="btn btn-primary" style="margin-left: 60%" onclick="addnote(<?= $srsrow['id'] ?>, 'client_request');">Add Note</button>
                        <button class="btn btn-primary" onclick="changeStatus(<?= $srsrow['id'] ?>, 'feedback', 1);">Change Status</button>
                     </a>
                     <?php } ?>
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