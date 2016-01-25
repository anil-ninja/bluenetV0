<?php
session_start();

require_once "dbConnection.php";

$status = $_GET["status"];

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
if($_SESSION['employee_type'] == 'cem') ;
else header('Location: index.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>BlueNet </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/icons/favicon.ico">
  <link rel="apple-touch-icon" href="images/icons/favicon.png">
 <!--Loading bootstrap css-->
  <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
  <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
  <link type="text/css" rel="stylesheet" href="styles/jquery-ui-1.10.4.custom.min.css">
  <link type="text/css" rel="stylesheet" href="styles/font-awesome.min.css">
  <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="styles/animate.css">
  <link type="text/css" rel="stylesheet" href="styles/all.css">
  <link type="text/css" rel="stylesheet" href="styles/main.css">
  <link type="text/css" rel="stylesheet" href="styles/style-responsive.css">
  <link type="text/css" rel="stylesheet" href="styles/zabuto_calendar.min.css">
  <link type="text/css" rel="stylesheet" href="styles/pace.css">
  <link type="text/css" rel="stylesheet" href="styles/jquery.news-ticker.css">
  <link type="text/css" rel="stylesheet" href="styles/datepicker.css">
<body>
  <?php require_once "navbar.php"; ?>
  <div id="wrapper">
   <!--BEGIN SIDEBAR MENU-->
    <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
      <div class="sidebar-collapse menu-scroll">
        <ul id="side-menu" class="nav">      
          <div class="clearfix"></div>
          <li <?php if (($_GET['status']=='open') OR !isset($_GET['status'])) echo "class='active'";?>><a href="cem.php?status=open">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Open requests</span></a>   
          </li>
          <li <?php if ($_GET['status']=='match') echo "class='active'";?>><a href="cem.php?status=match">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Match requests</span></a>   
          </li>
          <li <?php if ($_GET['status']=='picked') echo "class='active'";?>><a href="cem.php?status=picked">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
            <span class="menu-title">Picked requests</span></a>   
          </li>
          <li <?php if ($_GET['status']=='meeting') echo "class='active'";?>><a href="cem.php?status=meeting">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-calendar"></i>
            <span class="menu-title">Meetings</span></a>   
          </li>
          <li <?php if ($_GET['status']=='demo') echo "class='active'";?>><a href="cem.php?status=demo">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-asterisk"></i>
            <span class="menu-title">IN Demo Period</span></a>   
          </li>
          <li <?php if ($_GET['status']=='done') echo "class='active'";?>><a href="cem.php?status=done">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-ok"></i>
            <span class="menu-title">Done requests</span></a>   
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
            <a  href="cem.php?status=open" ><?= $_SESSION['employee_type'] ?></a>&nbsp;/
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
                <!--END TITLE & BREADCRUMB PAGE-->
       <?php require_once "cem_inc.php"; ?>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="script/jquery-1.10.2.min.js"></script>
  <script src="script/jquery-migrate-1.2.1.min.js"></script>
  <script src="script/jquery-ui.js"></script>
  <script src="script/bootstrap.min.js"></script>
  <script src="script/bootstrap-hover-dropdown.js"></script>
  <script src="script/html5shiv.js"></script>
  <script src="script/respond.min.js"></script>
  <script src="script/jquery.metisMenu.js"></script>
  <script src="script/jquery.slimscroll.js"></script>
  <script src="script/jquery.cookie.js"></script>
  <script src="script/custom.min.js"></script>
  <script src="script/jquery.news-ticker.js"></script>
  <script src="script/jquery.menu.js"></script>
  <script src="script/pace.min.js"></script>
  <script src="script/holder.js"></script>
  <script src="script/responsive-tabs.js"></script>
  <script src="script/bootbox.js"></script>
  <script src="script/blueteam.js"></script>
  
  <script src="script/jquery-ui-timepicker-addon.js"></script>
 
  <!--CORE JAVASCRIPT-->
  <script src="script/main.js"></script>
</body>
</html>
