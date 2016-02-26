<?php
session_start();

require_once "components/dbConnection.php";

$status = $_GET["status"];
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
          <?php include_once "components/sidenav.php"; ?>
        </ul>
      </div>
    </nav>
    <div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
      <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
          <div class="page-title">BlueNet&nbsp;/
            <a  href="request.php" ><?= $_SESSION['employee_type'] ?></a>&nbsp;/
            <a  class="selectedStatus" ></a>
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
                <?php require_once "components/page_contect.php"; ?>
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
  <script type="text/javascript">
  	$(document).ready(function() {
  	  getRequestData(<?= $_SESSION['employee_type'] ?>, 0);
  	});   
	</script>
</body>
</html>
