<?php
session_start();

require_once "dbConnection.php";

$status = $_GET["status"];
if(!isset($status)) $status == "open" ;

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
          <div class="page-title">BlueNet Hack</div><!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a id="menu-toggle" href="#" class="hidden-xs"><i class="glyphicon glyphicon-th-list"></i></a> -->
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
          <li></li>
          <li></li>
          <li></li>
        </ol>
        <div class="clearfix"></div>
      </div>
                <!--END TITLE & BREADCRUMB PAGE-->
       <?php require_once "page-contect.php"; ?>
    </div>
  </div>
  <?php include_once "footers.php"; ?>
  <script type="text/javascript">
  	$(document).ready(function() {
  	  $('#example1').DataTable({
        "iDisplayLength": 50
      });
  	});
   
	</script>
</body>
</html>
