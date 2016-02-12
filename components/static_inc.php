<div class="page-content">
   <div id="tab-general">
      <div class="row mbl">
         <div class="col-lg-8">
            <div class="panel-primary">
               <?php 
                  if(!isset($_GET['status'])) $status = "followback";
                  $user = mysqli_query($db_handle, "SELECT * FROM user WHERE employee_type != 'admin' ; ") ;
                  while ($userRow = mysqli_fetch_array($user)){ 
                     $user_id = $userRow['id'];
               ?>
               <div class="list-group countRequest">
                  <p style="font-size:20px;padding-left: 2em;">
                     <a  class="list-group-item active"> Employee Name <span style="padding-left: 4em"><?php echo strtoupper($userRow['first_name'])." ".strtoupper($userRow['last_name']); ?></span></a>
                     <a  class="list-group-item "> Mobile  <span style="padding-left: 9em"><?= $userRow['phone'] ?></span></a>
                     <a  class="list-group-item"> Email ID <span style="padding-left: 8em"><?= $userRow['email'] ?></span></a>
                     <a  class="list-group-item"> Employee Type <span style="padding-left: 5em"><?= $userRow['employee_type'] ?></span></a>
                     <a  class="list-group-item"> Reg. Date <span style="padding-left: 8em"><?= $userRow['reg_date'] ?></span></a>
                     <a  class="list-group-item ">
                        <button class="btn btn-primary" style="margin-left: 70%" onclick="viewDetails(<?= $user_id ?>, '<?= $userRow['employee_type'] ?>');">View Details</button>
                     </a>
                     <a  class="list-group-item" >
                       <span id="userDetails_<?= $user_id ?>"></span>
                     </a>
                  </p>
               </div>
               <?php }  ?>
            </div>
         </div>
      </div>
   </div>
</div> 