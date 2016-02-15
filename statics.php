<?php
session_start();

require_once "components/dbConnection.php";
$type = $_SESSION['employee_type'];
if($type == 'admin') ;
else header('Location: index.php');

$user_id = $_SESSION['user_id'];

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
  <?php include_once "components/headers.php"; ?>
</head>
<body>
  <?php require_once "components/navbar.php"; ?>
  <div id="wrapper">
   <!--BEGIN SIDEBAR MENU-->
    <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
      <div class="sidebar-collapse menu-scroll">
        <ul id="side-menu" class="nav">      
          <div class="clearfix"></div>
          <li><a href="insertuser.php">
            <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
            <span class="menu-title">Add New User</span></a>
          </li>
          <li class='active'><a href="statics.php">
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
          <li ><a href="request.php?status=meeting">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-calendar"></i>
            <span class="menu-title">Meetings</span><?php countRequest('meeting', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li ><a href="request.php?status=demo">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-asterisk"></i>
            <span class="menu-title">IN Demo Period</span><?php countRequest('demo', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li ><a href="request.php?status=done">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-ok"></i>
            <span class="menu-title">Done requests</span><?php countRequest('done', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li ><a href="request.php?status=me_open">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">ME Open</span><?php countRequest('me_open', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li ><a href="request.php?status=cem_open">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">CEM Open</span><?php countRequest('cem_open', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li ><a href="request.php?status=salary_issue">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-usd"></i>
            <span class="menu-title">Salary Issues</span><?php countRequest('salary_issue', $type, $user_id, $db_handle); ?></a>
          </li>
          <li ><a href="request.php?status=delete">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-remove"></i>
            <span class="menu-title">Deleted Requests</span><?php countRequest('delete', $type, $user_id, $db_handle); ?></a>
          </li>
          <li ><a href="request.php?status=just_to_know">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-pencil"></i>
            <span class="menu-title">Only Information Purpose</span><?php countRequest('just_to_know', $type, $user_id, $db_handle); ?></a>
          </li>
          <li ><a href="request.php?status=decay">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-trash"></i>
            <span class="menu-title">Decay Requests</span><?php countRequest('decay', $type, $user_id, $db_handle); ?></a>
          </li>
          <li ><a href="request.php?status=not_interested">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-exclamation-sign"></i>
            <span class="menu-title">Not Interested</span><?php countRequest('not_interested', $type, $user_id, $db_handle); ?></a>
          </li>
          <li><a href="request.php?status=followback">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
            <span class="menu-title">Follow back Requests</span><?php countRequest('followback', $type, $user_id, $db_handle); ?></a>
          </li>
          <li ><a href="request.php?status=feedback">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
            <span class="menu-title">Feedback Requests</span><?php countRequest('feedback', $type, $user_id, $db_handle); ?></a>
          </li>
          <li ><a href="request.php?status=24">
            <div class="icon-bg bg-blue"></div><i class=" glyphicon glyphicon-time"></i>
            <span class="menu-title">View 24hours Requests</span><?php countRequest('24', $type, $user_id, $db_handle); ?></a>
          </li>
          <li><a href="area.php">
            <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-print"></i>
            <span class="menu-title">Print Area</span></a>
          </li>
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
          <div class="page-title">BlueNet&nbsp;/
            <a  href="request.php" ><?= $_SESSION['employee_type'] ?></a>&nbsp;/
            <a  href="#" ><?= $_GET['status'] ?></a>
          </div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li></li>
          <li></li>
          <li></li>
        </ol>
        <div class="clearfix"></div>
      </div>
      <?php require_once "components/requestsearchform.php"; ?>
      <div class="searchresult"></div>
       <?php require_once "components/static_inc.php"; ?>
    </div>
  </div>
  <?php include_once "components/footers.php"; ?>
</body>
</html>
