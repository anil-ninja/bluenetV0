<?php
session_start();
require_once "dbConnection.php";

if (!isset($_SESSION['user_id'])) {  
	header('Location: index.php');
}

if (isset($_POST['update_status'])) {
	$newStatus = $_POST['new_status'];
	$sr_id = $_POST['sr_id'];
	$oldStatus = $_POST['old_status'];
	$user_id = $_SESSION['user_id'];
	$sql = mysqli_query ($db_handle, "UPDATE service_request SET status= '$newStatus' WHERE id = '$sr_id' ;");
	$sql = mysqli_query ($db_handle, "INSERT INTO updates( user_id, request_id, old_status, new_status) 
														VALUES ('$user_id', '$sr_id', '$oldStatus', '$newStatus') ;");
	if(mysqli_connect_errno()){		
	}
	else { 
		//header("Location: request.php"); 
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
  <div id="wrapper">
   <!--BEGIN SIDEBAR MENU-->
    <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
      <div class="sidebar-collapse menu-scroll">
        <ul id="side-menu" class="nav">      
          <div class="clearfix"></div>
            <?php if ($_SESSION["employee_type"] ==  "me" ) { ?>
            <li ><a href="home.php?status=open">
              <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-search"></i>
              <span class="menu-title">Open requests</span></a>
            </li>
            <li><a href="home.php?status=picked">
              <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
              <span class="menu-title">Picked requests</span></a>   
            </li>
            <li><a href="home.php?status=done">
              <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-thumbs-up"></i>
              <span class="menu-title">Done requests</span></a>   
            </li>
            <?php } 
              else if ($_SESSION["employee_type"] ==  "cem" ) { ?>
            <li><a href="home.php?status=open">
              <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
              <span class="menu-title">Open requests</span></a>   
            </li>
            <li><a href="home.php?status=match">
              <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
              <span class="menu-title">Match requests</span></a>   
            </li>
            <li><a href="home.php?status=picked">
              <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
              <span class="menu-title">Picked requests</span></a>   
            </li>
            <li><a href="home.php?status=meeting">
              <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-calendar"></i>
              <span class="menu-title">Meetings</span></a>   
            </li>
            <li><a href="home.php?status=demo">
              <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-asterisk"></i>
              <span class="menu-title">IN Demo Period</span></a>   
            </li>
            <li><a href="home.php?status=done">
              <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-ok"></i>
              <span class="menu-title">Done requests</span></a>   
            </li>
            <?php } 
              else if ($_SESSION["employee_type"] ==  "operator" ) { ?>

            <li><a href="home.php?status=followback">
              <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
              <span class="menu-title">Follow back Requests</span></a>
            </li>
            <li><a href="home.php?status=feedback">
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
            <li><a href="request.php?status=followback">
              <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
              <span class="menu-title">Follow back Requests</span></a>
            </li>
            <li><a href="request.php?status=feedback">
              <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
              <span class="menu-title">Feedback Requests</span></a>
            </li>
            <li class="active"><a href="24hour.php">
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
          <div class="page-title">BlueNet Hack&nbsp;/
            <a  href="cem.php?status=open" ><?= $_SESSION['employee_type'] ?></a>&nbsp;/
            <a  href="#" >24 hours Requests</a>
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
            <div class="col-lg-8">
              <div class="panel-primary">
              <?php 
                $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE work_time ='24' ;") ;
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
    </div>  
  </div>
  <?php include_once "footers.php"; ?>
</body>
</html>