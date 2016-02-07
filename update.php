<?php
session_start();
require_once "dbConnection.php";

if (!isset($_SESSION['user_id'])) {  
	header('Location: index.php');
}
$sr_id = $_GET['sr_id'];
if(!isset($sr_id)){
	header("Location: index.php"); 
}
$user_id = $_SESSION['user_id'];  
$type = $_SESSION['employee_type'];	
if (isset($_POST['add_note'])) {
	$note = $_POST['noteVal'];
	$sr_id = $_GET['sr_id'];
	$user_id = $_SESSION['user_id'];
	$sql = mysqli_query ($db_handle, "INSERT INTO notes (sr_id, note, cem_id) VALUES ('$sr_id', '$note', '$user_id') ;") ;
	if(mysqli_connect_errno()){		
	}
	else { 
		//header("Location: index.php"); 
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>BlueNet | Fill Details</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/icons/favicon.ico">
  <link rel="apple-touch-icon" href="images/icons/favicon.png">
 <!--Loading bootstrap css-->
 <?php include_once "headers.php"; ?>
</head>
<body>
	<?php require_once "navbar.php"; ?>
    <!--BEGIN MODAL CONFIG PORTLET-->
  <div id="addNote" class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 class="modal-title">Add Note</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="" method="post">
  					<div class="form-group">
  					  <label class="control-label">Note</label>
  						<textarea class="form-control" name='noteVal' placeholder="Add Note"></textarea>
  					</div> <!-- /.form-group -->
            <button type="submit" name="add_note" class="btn btn-primary pull-right">Add</button><br/>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
        </div>
      </div>
    </div>
  </div>
          <!--END MODAL CONFIG PORTLET-->
      
  <div id="wrapper">
   <!--BEGIN SIDEBAR MENU-->
    <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
      <div class="sidebar-collapse menu-scroll">
        <ul id="side-menu" class="nav">      
          <div class="clearfix"></div>
          <?php if ($_SESSION["employee_type"] ==  "me" ) { ?>
          <li ><a href="me.php?status=open">
            <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Open requests</span><?php countRequest('open', $type, $user_id, $db_handle); ?></a>
          </li>
          <li><a href="me.php?status=picked">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
            <span class="menu-title">Picked requests</span><?php countRequest('picked', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="me.php?status=done">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-thumbs-up"></i>
            <span class="menu-title">Done requests</span><?php countRequest('done', $type, $user_id, $db_handle); ?></a>   
          </li>
          <?php } 
            else if ($_SESSION["employee_type"] ==  "cem" ) { ?>
          <li><a href="cem.php?status=open">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Open requests</span><?php countRequest('open', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="cem.php?status=match">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Match requests</span><?php countRequest('match', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="cem.php?status=picked">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
            <span class="menu-title">Picked requests</span><?php countRequest('picked', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="cem.php?status=meeting">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-calendar"></i>
            <span class="menu-title">Meetings</span><?php countRequest('meeting', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="cem.php?status=demo">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-asterisk"></i>
            <span class="menu-title">IN Demo Period</span><?php countRequest('demo', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="cem.php?status=done">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-ok"></i>
            <span class="menu-title">Done requests</span><?php countRequest('done', $type, $user_id, $db_handle); ?></a>   
          </li>
          <?php } 
            else if ($_SESSION["employee_type"] ==  "operator" ) { ?>

          <li><a href="operator.php?status=followback">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
            <span class="menu-title">Follow back Requests</span><?php countRequest('followback', $type, $user_id, $db_handle); ?></a>
          </li>
          <li><a href="operator.php?status=feedback">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
            <span class="menu-title">Feedback Requests</span><?php countRequest('feedback', $type, $user_id, $db_handle); ?></a>
          </li>
          <?php }  
            else { 
                if($_SESSION["employee_type"] ==  "admin" ){   ?>
          <li><a href="insertuser.php">
            <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
            <span class="menu-title">Add New User</span></a>
          </li>
          <?php } ?>
          <li ><a href="statics.php">
            <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-cog"></i>
            <span class="menu-title">Reports</span></a>
          </li>
          <li ><a href="request.php">
            <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-home"></i>
            <span class="menu-title">View All requests</span><?php countRequest('all', $type, $user_id, $db_handle); ?></a>
          </li>
          <li ><a href="request.php?status=open">
            <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Open requests</span><?php countRequest('open', $type, $user_id, $db_handle); ?></a>
          </li>
          <li><a href="request.php?status=meeting">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-calendar"></i>
            <span class="menu-title">Meetings</span><?php countRequest('meeting', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="request.php?status=demo">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-asterisk"></i>
            <span class="menu-title">IN Demo Period</span><?php countRequest('demo', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="request.php?status=done">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-ok"></i>
            <span class="menu-title">Done requests</span><?php countRequest('done', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="request.php?status=me_open">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">ME Open</span><?php countRequest('me_open', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="request.php?status=cem_open">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">CEM Open</span><?php countRequest('cem_open', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li><a href="request.php?status=salary_issue">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-usd"></i>
            <span class="menu-title">Salary Issues</span><?php countRequest('salary_issue', $type, $user_id, $db_handle); ?></a>
          </li>
          <li><a href="request.php?status=delete">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-remove"></i>
            <span class="menu-title">Deleted Requests</span><?php countRequest('delete', $type, $user_id, $db_handle); ?></a>
          </li>
          <li><a href="request.php?status=not_interested">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-exclamation-sign"></i>
            <span class="menu-title">Not Interested</span><?php countRequest('not_interested', $type, $user_id, $db_handle); ?></a>
          </li>
          <li><a href="request.php?status=decay">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-trash"></i>
            <span class="menu-title">Decay Requests</span><?php countRequest('decay', $type, $user_id, $db_handle); ?></a>
          </li>
          <li ><a href="request.php?status=24">
            <div class="icon-bg bg-blue"></div><i class=" glyphicon glyphicon-time"></i>
            <span class="menu-title">View 24hours Requests</span><?php countRequest('24', $type, $user_id, $db_handle); ?></a>
          </li>
          <li><a href="area.php">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-print"></i>
            <span class="menu-title">Print Area</span></a>
          </li>
          <?php } ?>
          <li class="active"><a href="insert.php">
            <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
            <span class="menu-title">Insert New Service Request</span></a>
          </li>
          <li ><a href="insertworker.php">
            <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
            <span class="menu-title">Insert New Worker</span></a>
          </li>
        </ul>
      </div>
    </nav>
    <div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
      <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
          <div class="page-title">BlueNet&nbsp;/
            <a  href="index.php" ><?= $_SESSION['employee_type'] ?></a>&nbsp;/
            <a  href="#" >Update service request</a>
          </div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li></li>
          <li></li>
          <li></li>
        </ol>
        <div class="clearfix"></div>
      </div>		
      <div class="searchresult"></div>
      <div class="page-content">
    		<div id="tab-general">
    		  <div class="row mbl">
    		    <div class="col-lg-11">
    		      <div class="panel-primary">
      		      <?php
        					$sr_id = $_GET['sr_id'];
        					$srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE id = '$sr_id'; ") ;
        					$srsrow = mysqli_fetch_array($srs);
        					$reqirements = $srsrow['requirements'];
        					$reqire = explode("/,", $reqirements);
      		      ?>
                  
                <form class="form-horizontal" id="update_details_form" onsubmit="return (validateUpdateDetails(<?= $sr_id  ?>));">
        				  <div class="form-group">
        				    <label class="col-md-3 control-label">Name</label>
        				    <div class="col-md-3">
        				      <input type="text" id ="name" class="form-control" onkeyup='nospaces(this);' placeholder="Name" value="<?= $srsrow['name'] ?>"/>
        				    </div> <!-- /.col -->
        				    <label class="col-md-2 control-label">Mobile No.</label>
        				    <div class="col-md-3">
        				      <input type="number" id ="mobile" class="form-control" onkeyup='nospaces(this);' placeholder="Enter 10 digit mobile number" value="<?= $srsrow['mobile'] ?>"/>
        				    </div> <!-- /.col -->
        				  </div> <!-- /.form-group -->
        				  <div class="form-group">
        				   	<label class="col-md-3 control-label">address</label>
        					  <div class="col-md-3">
        				   	  <input type="text" id ="address" class="form-control" placeholder="address" value="<?= $srsrow['address'] ?>"/>
        				    </div> <!-- /.col -->
                    <?php 
                      $timing = $srsrow['timings'];
                      $time1 = preg_split( '/(\s|:|-)/',$timing);//explode("-", $timing);
                      
                      if($time1[0] < 12 && $time1[2] == 'am') $time4 = $time1[0].":".$time1[1];
                      else {
                        if($time1[0] < 12 && $time1[2] == 'pm') $time4 = ($time1[0] + 12).":".$time1[1];
                        else $time4 = $time1[0].":".$time1[1];
                      }
                      if($time1[3] < 12 && $time1[5] == 'am') $time5 = $time1[3].":".$time1[4];
                      else {
                        if($time1[3] < 12 && $time1[5] == 'pm') $time5 = ($time1[3] + 12).":".$time1[4];
                        else $time5 = $time1[3].":".$time1[4];
                      }
                    ?>
                    <label class="col-md-2 control-label" >Worker timings</label>
                    <div class="col-md-4 input-group">
                      <input type="text" id ="timing" class="form-control" value="<?= $time4 ?>" />
                      <div class="input-group-addon">To</div>
                      <input type="text" id ="timing2" class="form-control" value="<?= $time5 ?>"  />
                    </div>
        				  </div> <!-- /.form-group -->
        				  <div class="form-group">
        				  	<label class="col-md-3 control-label">Remarks</label>
      					    <div class="col-md-3">
      			        	<input type="text" id ="remarks" class="form-control" placeholder="remarks" value="<?= $srsrow['remarks'] ?>"/>
      			      	</div>
        				   	<label class="col-md-2 control-label">Gender</label>
        				   	<div class="col-md-3">
        				   	  <select id = "gender" >
            					  <?php 
            						$gender = $srsrow['gender'];
            						if($gender == "male") {
            					  ?> 
            						<option value="male" selected >Male</option>
            						<option value="female">Female</option>
            						<option value="any">Any</option>
            					  <?php }
            						else if($gender == "female") {
            					  ?>
            						<option value="male"  >Male</option>
            						<option value="female" selected >Female</option>
            						<option value="any">Any</option>
            					  <?php } 
            					    else { 	
            					  ?>
            						<option value="male"  >Male</option>
            						<option value="female"  >Female</option>
            						<option value="any" selected >Any</option>
            					  <?php } ?>
        					    </select>
        				    </div>
        				  </div>
        				  <div class="form-group">
                    <?php 
                      $salary = $srsrow['expected_salary'];
                      $salary1 = explode("-", $salary);
                      $salary2 = explode(" ",$salary1[1]);
                    ?>
                    <label class="col-md-3 control-label">Expected Salary</label>
                    <div class="col-md-4 input-group">
                      <input type="number" id ="salary" class="form-control" value="<?= $salary1[0] ?>" />
                      <div class="input-group-addon">To</div>
                      <input type="number" id ="salary2" class="form-control" value="<?= $salary2[0] ?>" />
                    </div>
        				  </div>
      				    <div class="form-group">
                    <label class="col-md-3 control-label">Working Time in Hours</label>
                    <div class="col-md-3">
                      <select id="work_time">
                        <option value="0" >Select hours</option>
                        <?php 
                          $work_time = $srsrow['work_time'];
                          for ($i=2; $i < 25; $i++) { 
                            if($i == $work_time) echo "<option value='".$i."' selected>".$i."</option>";
                            else echo "<option value='".$i."'>".$i."</option>";
                          }
                          $created_time = $srsrow['created_time'];
                          $Created = explode("-", $created_time);
                          $newTime = $Created[2]."/".$Created[1]."/".$Created[0] ;
                        ?>
                      </select>
                    </div>
    				      	<label class="col-md-2 control-label">Created Date</label>
    				      	<div class="col-md-3">
    				        	<input type="text" id ="created_time" class="form-control" placeholder="Created Date" value="<?= $newTime ?>"/>
    				      	</div>
      				    </div>
      				    <div class="form-group">
                    <label class='col-md-3 control-label'>Enter New Skill </label>
                    <div class='col-md-3'>
                      <input type='text' id='newskill' onkeyup='nospaces(this);' class='form-control' placeholder='Enter Skill' data-role='tagsinput'>
                    </div>
                    <label class="col-md-2 control-label">or select Skills</label>
                    <div class='col-md-2'>
                      <select class='selectpicker' id='skills' onchange="getselectedskill(0, 3);" data-live-search='true' data-width='100%' > 
                        <option value='0'>Select Skills </option>
                        <?php 
                          $skill = mysqli_query($db_handle, "SELECT * FROM skill_name ;");
                           while($skillrow = mysqli_fetch_array($skill)){ 
                            echo "<option value=".$skillrow['id'].">".$skillrow['name']."</option>";
                          }
                        ?>
                      </select>
                      <div id="selectedskills"></div>
                    </div>
      					  </div>
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>Enter New Area </label>
                    <div class='col-md-3'>
                      <input type='text' id='newarea' class='form-control' placeholder='Enter Area' data-role='tagsinput'>
                    </div>
                    <label class="col-md-2 control-label">or select Areas</label>
                    <div class='col-md-2'>
                      <select class='selectpicker' id='areas' onchange="getselectedarea(0, 3);" data-live-search='true' data-width='100%' > 
                        <option value='0'>Select Area </option>
                        <?php 
                          $area = mysqli_query($db_handle, "SELECT * FROM area ;");
                           while($arearow = mysqli_fetch_array($area)){ 
                            echo "<option value=".$arearow['id'].">".$arearow['name']."</option>";
                          }
                        ?>
                      </select>
                      <div id="selectedareas"></div>
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>Enter New Worker Area </label>
                    <div class='col-md-3'>
                      <input type='text' id='worker_area' class='form-control' placeholder='Enter Worker area' data-role='tagsinput'>
                    </div>
                    <label class="col-md-2 control-label">or select Worker Area</label>
                    <div class='col-md-2'>
                      <select class='selectpicker' id='workerareas' onchange="getselectedarea(0, 4);" data-live-search='true' data-width='100%' > 
                        <option value='0'>Select Worker Area </option>
                        <?php 
                          $area = mysqli_query($db_handle, "SELECT * FROM area ;");
                           while($arearow = mysqli_fetch_array($area)){ 
                            echo "<option value=".$arearow['id'].">".$arearow['name']."</option>";
                          }
                        ?>
                      </select>
                      <div id="selectedworkerareas"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Requierments</label>
                    <div class="col-md-3">
                    <?php 
                      $abd = array();
                      foreach ($reqire as $donereqire){
                        array_push($abd , "$donereqire");
                        echo '<input type="checkbox" name = "skill" value ='.$donereqire.' checked/>&nbsp;&nbsp;&nbsp;'.$donereqire.'<br/>';
                      }
                      $allreqirements = array("maid","cook","driver","electrician","plumber","carpenter","babysitter","oldage","patient");
                      $nawreqire = array_diff($allreqirements, $abd);
                      foreach ($nawreqire as $val)
                         echo '<input type="checkbox" name = "skill" value ='.$val.'/>&nbsp;&nbsp;&nbsp;'.$val.'<br/>';
                    ?>          
                    </div>
                  </div>
      				    <div class="form-group">
      					    <label class="col-md-3 control-label"></label>
      					    <div class="col-md-7">
      					        <button type="submit" class="btn btn-success pull-right">Update</button>
      					    </div>
      				    </div> <!-- /.form-group -->
  				      </form>
      				  <ul>
        				<?php
        					$notes = mysqli_query($db_handle, "SELECT * FROM notes WHERE sr_id = '$sr_id'; ") ;	
        					while($notesrow = mysqli_fetch_array($notes)){
        						$note_val = $notesrow['note'] ;
        						echo "<li>".$note_val."</li>" ;
        					}
        				?>
      				  </ul>
    				    <a class='btn btn-success active' data-toggle='modal' data-target='#addNote'>Add Note</a>
              </div>
      		  </div>
      		</div>
      	</div>
      </div>
    </div>
  </div>
  <?php include_once "footers.php"; ?>
  <script type="text/javascript">
    $('#created_time').datepicker();
    $('#timing').timepicker();
    $('#timing2').timepicker();
    getSkills(<?= $_GET['sr_id'] ?>, "client");
    getAreas(<?= $_GET['sr_id'] ?>);
    getWorkerAreas(<?= $_GET['sr_id'] ?>);
  </script>
</body>
</html>