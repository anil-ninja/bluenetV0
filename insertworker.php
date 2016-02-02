<?php
session_start();
require_once "dbConnection.php";

if (!isset($_SESSION['user_id'])) {  
  header('Location: index.php');
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
  <div id="wrapper">
   <!--BEGIN SIDEBAR MENU-->
    <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
      <div class="sidebar-collapse menu-scroll">
        <ul id="side-menu" class="nav">      
          <div class="clearfix"></div>
          <?php if ($_SESSION["employee_type"] ==  "me" ) { ?>
          <li ><a href="me.php?status=open">
            <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Open requests</span></a>
          </li>
          <li><a href="me.php?status=picked">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
            <span class="menu-title">Picked requests</span></a>   
          </li>
          <li><a href="me.php?status=done">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-thumbs-up"></i>
            <span class="menu-title">Done requests</span></a>   
          </li>
          <?php } 
            else if ($_SESSION["employee_type"] ==  "cem" ) { ?>
          <li><a href="cem.php?status=open">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Open requests</span></a>   
          </li>
          <li><a href="cem.php?status=match">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Match requests</span></a>   
          </li>
          <li><a href="cem.php?status=picked">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
            <span class="menu-title">Picked requests</span></a>   
          </li>
          <li><a href="cem.php?status=meeting">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-calendar"></i>
            <span class="menu-title">Meetings</span></a>   
          </li>
          <li><a href="cem.php?status=demo">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-asterisk"></i>
            <span class="menu-title">IN Demo Period</span></a>   
          </li>
          <li><a href="cem.php?status=done">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-ok"></i>
            <span class="menu-title">Done requests</span></a>   
          </li>
          <?php } 
            else if ($_SESSION["employee_type"] ==  "operator" ) { ?>

          <li><a href="operator.php?status=followback">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
            <span class="menu-title">Follow back Requests</span></a>
          </li>
          <li><a href="operator.php?status=feedback">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
            <span class="menu-title">Feedback Requests</span></a>
          </li>
          <?php }  
            else { 
                if($_SESSION["employee_type"] ==  "admin" ){   ?>
          <li><a href="insertuser.php">
            <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
            <span class="menu-title">Add New User</span></a>
          </li>
          <?php } ?>
          <li ><a href="request.php">
            <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-home"></i>
            <span class="menu-title">View All requests</span></a>
          </li>
          <li ><a href="request.php?status=open">
            <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Open requests</span></a>
          </li>
          <li><a href="request.php?status=meeting">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-calendar"></i>
            <span class="menu-title">Meetings</span></a>   
          </li>
          <li><a href="request.php?status=demo">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-asterisk"></i>
            <span class="menu-title">IN Demo Period</span></a>   
          </li>
          <li><a href="request.php?status=done">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-ok"></i>
            <span class="menu-title">Done requests</span></a>   
          </li>
          <li><a href="request.php?status=me_open">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">ME Open</span></a>   
          </li>
          <li><a href="request.php?status=cem_open">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">CEM Open</span></a>   
          </li>
          <li><a href="request.php?status=salary_issue">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-usd"></i>
            <span class="menu-title">Salary Issues</span></a>
          </li>
          <li><a href="request.php?status=delete">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-remove"></i>
            <span class="menu-title">Deleted Requests</span></a>
          </li>
          <li><a href="request.php?status=not_interested">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-exclamation-sign"></i>
            <span class="menu-title">Not Interested</span></a>
          </li>
          <li><a href="request.php?status=decay">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-trash"></i>
            <span class="menu-title">Decay Requests</span></a>
          </li>
          <li ><a href="24hour.php">
            <div class="icon-bg bg-blue"></div><i class=" glyphicon glyphicon-time"></i>
            <span class="menu-title">View 24hours Requests</span></a>
          </li>
          <li><a href="area.php">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-print"></i>
            <span class="menu-title">Print Area</span></a>
          </li>
          <?php } ?>
          <li ><a href="insert.php">
            <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
            <span class="menu-title">Insert New Service Request</span></a>
          </li>
          <li class="active"><a href="insertworker.php">
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
            <a  href="#" >Insert New Worker</a>
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
                <form class='form-horizontal' id='worker_details_form0' onsubmit='return (validateWorkerDetails(0,0));'>
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>First Name</label>
                    <div class='col-md-3'>
                      <input type='text' id ='first_name' onkeyup='nospaces(this);' class='form-control' placeholder='First Name' />
                    </div>
                    <label class='col-md-3 control-label'>Last Name</label>
                    <div class='col-md-3'>
                      <input type='text' id ='last_name' onkeyup='nospaces(this);' class='form-control' placeholder='Last Name' />
                    </div>
                  </div>
                  <!-- <div class='form-group'>
                    <label class='col-md-3 control-label'>Address Proof Name</label>
                    <div class='col-md-3'>
                      <select class='selectpicker' id='address_proof_name' data-live-search='true' data-width='100%'> 
                        <option value='Voter Id' >Voter Id </option>
                        <option value='Adhaar Card' >Adhaar Card</option>
                        <option value='Driving License' >Driving License</option>
                        <option value='Education Certificate' >Education Certificate</option>
                        <option value='Bank Account' >Bank Account</option>
                        <option value='Passport' >Passport</option>
                      </select>
                    </div>
                    <label class='col-md-3 control-label'>Address Proof No</label>
                    <div class='col-md-3'>
                      <input type='text' id ='address_proof_id' class='form-control' placeholder='Address Proof Id' />
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>Id Proof Name</label>
                    <div class='col-md-3'>
                      <select class='selectpicker' id='id_proof_name' data-live-search='true' data-width='100%'>    
                        <option value='Voter Id' >Voter Id </option>
                        <option value='Adhaar Card' >Adhaar Card</option>
                        <option value='Driving License' >Driving License</option>
                        <option value='Education Certificate' >Education Certificate</option>
                        <option value='Bank Account' >Bank Account</option>
                        <option value='Passport' >Passport</option>
                      </select>
                    </div>
                    <label class='col-md-3 control-label'>Id Proof No</label>
                    <div class='col-md-3'>
                      <input type='text' id ='id_proof_id' class='form-control' placeholder='Id Proof Id' />
                    </div>
                  </div> -->
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>Mobile No.</label>
                    <div class='col-md-3'>
                      <input type='number' id='mobile' onkeyup='nospaces(this);' class='form-control' placeholder='Enter 10 digit mobile number'>
                    </div>
                    <label class='col-md-3 control-label'>Emergancy Mobile No.</label>
                    <div class='col-md-3'>
                      <input type='number' id='emergancy_mobile' onkeyup='nospaces(this);' class='form-control' placeholder='Enter 10 digit mobile number'>
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class="col-md-3 control-label">Expected Salary</label>
                    <div class="col-md-4">
                      <select id="salary">
                        <option value="0" >Select Salary</option>
                        <?php for ($i=2; $i < 15; $i++) { 
                          echo "<option value='".$i."'>".$i."</option>";
                        }?>
                      </select>
                      To
                      <select id="salary2">
                        <option value="0" >Select Salary</option>
                        <?php for ($i=3; $i < 20; $i++) { 
                          echo "<option value='".$i."'>".$i."</option>";
                        }?>
                      </select>
                    </div>
                    <label class='col-md-2 control-label'>Age</label>
                    <div class='col-md-3'>
                      <input type='number' id='age' class='form-control' placeholder='Age in years'>
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>Current address</label>
                    <div class='col-md-3'>
                      <textarea type='text' id='current_address' class='form-control' placeholder='Full Address' rows='4'></textarea>
                    </div>
                    <label class='col-md-3 control-label'>Parmanent address</label>
                    <div class='col-md-3'>
                      <textarea type='text' id='parmanent_address' class='form-control' placeholder='Full Address' rows='4'></textarea>
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>Highest Education</label>
                    <div class='col-md-3'>
                      <input type='text' id='education' onkeyup='nospaces(this);' class='form-control' placeholder='Highest Education'>
                    </div>
                    <label for='demo-msk-date' class='col-md-3 control-label'>Experience</label>
                    <div class='col-md-3'>
                      <input type='number' id='experience' class='form-control' placeholder='Experience in Years'>
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class='col-lg-3 control-label'>Gender</label>
                    <div class='col-lg-3'>
                      <select class='selectpicker' id='gender' data-live-search='true' data-width='100%'>  
                        <option value='Male'>Male </option>
                        <option value='Female'>Female</option>
                        <option value='Other'>Other</option>
                      </select>
                    </div>
                    <label for='demo-msk-date' class='col-md-3 control-label'>Date of Birth</label>
                    <div class='col-md-3'>
                      <input type='text' id='birth_date' onkeyup='nospaces(this);' class='form-control' placeholder='Enter date of birth'>
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class="col-md-3 control-label">Working Time in Hours</label>
                    <div class="col-md-3">
                      <select id="work_time">
                        <option value="0" >Select hours</option>
                        <?php for ($i=2; $i < 25; $i++) { 
                          echo "<option value='".$i."'>".$i."</option>";
                        }?>
                      </select>
                    </div>
                    <label class="col-md-3 control-label" >Timings</label>
                    <div class="col-md-3 input-group">
                      <select id="timing">
                        <option value="0" >Select Time</option>
                        <?php for ($i=1; $i < 24; $i++) { 
                          echo "<option value='".$i."'>".$i."</option>";
                        }?>
                      </select>
                      To
                      <select id="timing2">
                        <option value="0" >Select Time</option>
                        <?php for ($i=1; $i < 24; $i++) { 
                          echo "<option value='".$i."'>".$i."</option>";
                        }?>
                      </select>
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>Remarks</label>
                    <div class='col-md-3'>
                      <textarea type='text' id='remarks' class='form-control' placeholder='Remarks' rows='4'></textarea>
                    </div>
                    <label class='col-md-3 control-label'>Police Verification</label>
                    <div class='col-md-3'>
                      <select class='selectpicker' id='police' name='police' data-live-search='true' data-width='100%'> 
                        <option value='yes'>yes </option>
                        <option value='no'>no</option>
                      </select>
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>Languages</label>
                    <div class='col-md-3'>
                      <input type='text' id='languages' onkeyup='nospaces(this);' class='form-control' placeholder='Enter atleast one language' data-role='tagsinput'>
                      <small class='help'>Enter multimple seperated by , </small>
                    </div>
                    <label class='col-md-3 control-label'>Services</label>
                    <div class='col-md-3'>       
                      <input type='text' id='services' onkeyup='nospaces(this);' class='form-control' placeholder='Enter atleast one Service' data-role='tagsinput'>
                      <small class='help'>Enter multimple seperated by , </small>
                    </div>
                  </div>
                  <div class='form-group'>
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
                    <label class='col-md-3 control-label'>Enter New Worker Area </label>
                    <div class='col-md-3'>
                      <input type='text' id='worker_area' class='form-control' placeholder='Enter Worker area' data-role='tagsinput'>
                    </div>
                    <label class="col-md-2 control-label">or select Worker Area</label>
                    <div class='col-md-2'>
                      <select class='selectpicker' id='skills' onchange="getselectedarea(0, 4);" data-live-search='true' data-width='100%' > 
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
                  <div class='form-group'>
                    <label class='col-md-3 control-label'></label>
                    <div class='col-md-7'>
                      <button type='submit' class='btn btn-success pull-right' >Submit Details</button>
                    </div>
                  </div>
                </form>
    				  </div>
    			  </div>
    		  </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once "footers.php"; ?>
  <script type="text/javascript">
    $('#birth_date').datepicker();
  </script>
</body>
</html>