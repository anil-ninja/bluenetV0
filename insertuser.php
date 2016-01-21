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
</head>
<body>
   <div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle">
                	<span class="sr-only">Toggle navigation</span>
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
                </button>
                <a id="logo" href="index.html" class="navbar-brand">
                	<span class="fa fa-rocket"></span>
                	<span class="logo-text">BlueNet</span>
                	<span style="display: none" class="logo-text-icon">µ</span>
                </a>
            </div>
            <div class="topbar-main">
            	<a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                <form id="topbar-search" action="" method="" class="hidden-sm hidden-xs">
                    <div class="input-icon right text-white">
                    	<a href="#"><i class="fa fa-search"></i></a>
                    	<input type="text" placeholder="Search here..." class="form-control text-white"/>
                    </div>
                </form>
                <div class="news-update-box hidden-xs">
                	<span class="text-uppercase mrm pull-left text-white">News:</span>
                    <ul id="news-update" class="ticker list-unstyled">
                        <li>Welcome to KAdmin - Responsive Multi-Style Admin Template</li>
                        <li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</li>
                    </ul>
                </div>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <li class="dropdown">
                      <a data-hover="dropdown" href="#" class="dropdown-toggle">
                        <i class="fa fa-bell fa-fw"></i><span class="badge badge-green">3</span>
                      </a>  
                    </li>
                    <li class="dropdown">
                      <a data-hover="dropdown" href="#" class="dropdown-toggle">
                        <i class="fa fa-envelope fa-fw"></i><span class="badge badge-orange">7</span>
                      </a>  
                    </li>
                    <li class="dropdown">
                      <a data-hover="dropdown" href="#" class="dropdown-toggle">
                        <i class="fa fa-tasks fa-fw"></i><span class="badge badge-yellow">8</span>
                      </a>  
                    </li>
                    <li class="dropdown topbar-user">
                      <a data-hover="dropdown" href="#" class="dropdown-toggle">
                        <img src="images/avatar/48.jpg" alt="" class="img-responsive img-circle"/>&nbsp;
                        <span class="hidden-xs">Robert John</span>&nbsp;<span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu dropdown-user pull-right">
                        <li><a href="#"><i class="fa fa-user"></i>My Profile</a></li>
                        <li><a href="#"><i class="fa fa-calendar"></i>My Calendar</a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i>My Inbox<span class="badge badge-danger">3</span></a></li>
                        <li><a href="#"><i class="fa fa-tasks"></i>My Tasks<span class="badge badge-success">7</span></a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-lock"></i>Lock Screen</a></li>
                        <li><a href="Login.html"><i class="fa fa-key"></i>Log Out</a></li>
                      </ul>
                    </li>
                    <li id="topbar-chat" class="hidden-xs">
                      <a href="javascript:void(0)" data-step="4" data-intro="&lt;b&gt;Form chat&lt;/b&gt; keep you connecting with other coworker" data-position="left" class="btn-chat">
                        <i class="fa fa-comments"></i><span class="badge badge-info">3</span>
                      </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
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
                  if($_SESSION["employee_type"] ==  "admin" ){
              ?>
                <li class="active"><a href="insertuser.php">
                  <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
                  <span class="menu-title">Add New User</span></a>
                </li>
            <?php } ?>
                <li ><a href="home.php">
                  <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-home"></i>
                  <span class="menu-title">View All requests</span></a>
                </li>
                <li ><a href="home.php?status=open">
                  <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-search"></i>
                  <span class="menu-title">Open requests</span></a>
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
        			  <li><a href="24hour.php">
          				<div class="icon-bg bg-blue"></div><i class=" glyphicon glyphicon-time"></i>
          				<span class="menu-title">View 24hours Requests</span></a>
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
            <!--END SIDEBAR MENU-->
            <!--BEGIN PAGE WRAPPER-->
	 <div id="page-wrapper">
		<!--BEGIN TITLE & BREADCRUMB PAGE-->
		<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
			<div class="page-header pull-left">
				<div class="page-title">BlueNet Hack</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a id="menu-toggle" href="#" class="hidden-xs"><i class="glyphicon glyphicon-th-list"></i></a>
			</div>
			<ol class="breadcrumb page-breadcrumb pull-right">
         <li><a href="logout.php">Logout</a></li>
         <li></li>
         <li><?= strtoupper($_SESSION['first_name']) ?></li>
      </ol>
			<div class="clearfix "></div>
		</div>
		<div class="page-content">
		   <div id="tab-general">
		      <div class="row mbl">
		         <div class="col-lg-11">
		            <div class="panel-primary">
            		<form class="form-horizontal" id="user_details_form" onsubmit='return (validateUserDetails());'>
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>First Name</label>
                    <div class='col-md-3'>
                      <input type='text' id ='first_name' class='form-control' placeholder='First Name' />
                    </div>
                    <label class='col-md-3 control-label'>Last Name</label>
                    <div class='col-md-3'>
                      <input type='text' id ='last_name' class='form-control' placeholder='Last Name' />
                    </div>
                  </div> 
                  <div class='form-group'>
                    <label class='col-md-3 control-label'>Email</label>
                    <div class='col-md-3'>
                      <input type='text' id ='email' class='form-control' placeholder='Email' />
                    </div>
                    <label class='col-md-3 control-label'>Phone No.</label>
                    <div class='col-md-3'>
                      <input type='text' id ='phone' class='form-control' placeholder='Mobile Number' />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Designation</label>
                    <div class="col-md-3">
                      <select id="employee_type">
                        <option value='operator' >Operator</option>
                        <option value='me' >Marketing Executive</option>
                        <option value='cem' >Customer Engagement Manager</option>
                        <option value='admin' >Admin</option>
                        <option value='accountant' >Accountant</option>
                        <option value='ba' >Business Analyst</option>
                        <option value='dev' >Developer</option>
                      </select>
                    </div>
                    <label class="col-md-3 control-label">Base salary</label>
                    <div class="col-md-3">
                      <input type="number" id ="salary" class="form-control" placeholder="Base salar" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Password</label>
                    <div class="col-md-3">
                      <input type="password" id ="password" class="form-control" placeholder="password" />
                    </div>
                    <label class="col-md-3 control-label">Re-enter password</label>
                    <div class="col-md-3">
                      <input type="password" id ="password2" class="form-control" placeholder="Re-enter password" />
                    </div>               
                  </div>
      				    <div class="form-group">
      					    <label class="col-md-3 control-label"></label>
      					    <div class="col-md-7">
      					        <button type="submit" class="btn btn-success pull-right">Insert</button>
      					    </div>
      				    </div> <!-- /.form-group -->
      				</form>
    				</div>
    			</div>
    		</div>
      </div>
    </div>
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
   
    <!--CORE JAVASCRIPT-->
    <script src="script/main.js"></script>
    
</body>
</html>
