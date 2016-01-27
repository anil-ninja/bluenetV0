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
            <li ><a href="24hour.php">
              <div class="icon-bg bg-blue"></div><i class=" glyphicon glyphicon-time"></i>
              <span class="menu-title">View 24hours Requests</span></a>
            </li>
            <li class="active"><a href="area.php">
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
            <a  href="#" >Areas</a>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li></li>
          <li></li>
          <li></li>
        </ol>
        <div class="clearfix"></div>
      </div>
      <div class="page-content">
        <div id="tab-general">
          <div class="row mbl">
            <div class="col-lg-11">
              <div class="panel-primary">
          	   	<ul>
      					<?php
      						$srs = mysqli_query($db_handle, "SELECT name FROM area; ") ;
      						while ($srsrow = mysqli_fetch_array($srs)){
      							$allarea = $srsrow['name'];
      								echo "<li><a href=\"findAreaRequests.php?area=".$allarea."\">".$allarea."</a></li>" ;	
      						} 
      					?>
          			</ul>
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