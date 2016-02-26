<?php
session_start();

require_once "components/dbConnection.php";

$status = $_GET["status"];

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {  
    header('Location: index.php');
}
$type = $_SESSION['employee_type'];
if($type == 'me') ;
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
  <?php include_once "components/headers.php"; ?>>
<body>
  <?php require_once "components/navbar.php"; ?>
  <div id="wrapper">
   <!--BEGIN SIDEBAR MENU-->
    <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
      <div class="sidebar-collapse menu-scroll">
        <ul id="side-menu" class="nav">      
          <div class="clearfix"></div>
          <li <?php if (($_GET['status']=='open') OR !isset($_GET['status'])) echo "class='active'";?>><a href="me.php?status=open">
            <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-search"></i>
            <span class="menu-title">Open requests</span><?php echo countRequest('open', $type, $user_id, $db_handle); ?></a>
          </li>
          <li <?php if ($_GET['status']=='24') echo "class='active'";?>><a href="me.php?status=24">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-time"></i>
            <span class="menu-title">24 Hour open requests</span><?php echo countRequest('24', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li <?php if ($_GET['status']=='picked') echo "class='active'";?>><a href="me.php?status=picked">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
            <span class="menu-title">Picked requests</span><?php echo countRequest('picked', $type, $user_id, $db_handle); ?></a>   
          </li>
          <li <?php if ($_GET['status']=='done') echo "class='active'";?>><a href="me.php?status=done">
            <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-thumbs-up"></i>
            <span class="menu-title">Done requests</span><?php echo countRequest('done', $type, $user_id, $db_handle); ?></a>   
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
            <a  href="me.php?status=open" ><?= $_SESSION['employee_type'] ?></a>&nbsp;/
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
      <div class="page-content">
        <div id="tab-general">
          <div class="row">
            <div class="col-lg-9">
              <div class="searchresult"></div>
              <div class="panel-primary middlePanel">
                <?php require_once "components/me_inc.php"; ?>
              </div>
            </div>
            <div class="col-lg-3">
              <?php if($_SESSION['employee_type'] != 'ba' OR $_SESSION['employee_type'] != 'operator') require_once "components/requestsearchform.php"; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once "components/footers.php"; ?>
</body>
</html>
