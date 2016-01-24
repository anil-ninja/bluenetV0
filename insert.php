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
        <a id="logo" href="index.php" class="navbar-brand">
          <span class="fa fa-rocket"></span>
          <span class="logo-text">BlueNet</span>
          <span class="logo-text-icon">µ</span>
        </a>
      </div>
      <div class="topbar-main">
        <a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
        <!-- <form id="topbar-search" action="" method="" class="hidden-sm hidden-xs">
          <div class="input-icon right text-white">
            <a href="#"><i class="fa fa-search"></i></a>
            <input type="text" placeholder="Search here..." class="form-control text-white"/>
          </div>
        </form> -->
        <div class="news-update-box hidden-xs">
          <span class="text-uppercase mrm pull-left text-white">News:</span>
          <ul id="news-update" class="ticker list-unstyled">
            <li> Education is the key to unlock the golden door of freedom.</li>
            <li>Education is the most powerful weapon which you can use to change the world.</li>
            <li>The roots of education are bitter, but the fruit is sweet.</li>
            <li>Education is not preparation for life; education is life itself.</li>
            <li>The whole purpose of education is to turn mirrors into windows.</li>
          </ul>
        </div>
        <ul class="nav navbar navbar-top-links navbar-right mbn">
          <!-- <li class="dropdown">
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
          </li> -->
          <li class="dropdown topbar-user">
            <a data-hover="dropdown" href="#" class="dropdown-toggle">&nbsp;
              <span class="hidden-xs"><?= strtoupper($_SESSION['first_name']) ?></span>&nbsp;<span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-user pull-right">
              <li><a href="logout.php"><i class="fa fa-key"></i>Log Out</a></li>
            </ul>
          </li>
          <!-- <li id="topbar-chat" class="hidden-xs">
            <a href="javascript:void(0)" data-step="4" data-intro="&lt;b&gt;Form chat&lt;/b&gt; keep you connecting with other coworker" data-position="left" class="btn-chat">
              <i class="fa fa-comments"></i><span class="badge badge-info">3</span>
            </a>
          </li> -->
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
          <div class="page-title">BlueNet<!-- </div>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
          <a href="#" ></a> -->
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
            		<form class="form-horizontal" id="request_details_form" onsubmit='return (validateRequestDetails());'>
      				    <div class="form-group">
      				      <label class="col-md-3 control-label">Name</label>
      				      <div class="col-md-3">
      				        <input type="text" id ="name" class="form-control" placeholder="Name" />
      				      </div> <!-- /.col -->
      				      <label class="col-md-1 control-label">Mobile No.</label>
      				      <div class="col-md-3">
      				        <input type="number" id ="mobile" class="form-control" placeholder="Enter 10 digit mobile number" />
      				      </div> <!-- /.col -->
      				    </div> <!-- /.form-group -->
				          <div class="form-group">
				      	    <label class="col-md-3 control-label">address</label>
						        <div class="col-md-3">
				        	    <input type="text" id ="address" class="form-control" placeholder="address" />
				      	    </div> <!-- /.col -->
				      	    <label class="col-md-1 control-label">Worker timings</label>
				      	    <div class="col-md-3">
				        	    <input type="text" id ="timing" class="form-control" placeholder="Working Hours" />
				      	    </div> <!-- /.col -->
				          </div> <!-- /.form-group -->
            			<div class="form-group">
            			 	<label class="col-md-3 control-label">Status</label>
            				<div class="col-md-3">
            					<select id="new_status">
            						<option value="open" selected>Open</option>
            						<option value="me_open">ME Open</option>
            						<option value="demo" >Demo</option>
            						<option value="salary_issue" >Salary Issues</option>
            						<option value="not_interested" >Not Interested</option>
            						<option value="done" >Done</option>
            						<option value="decay" >Decay</option>
            						<option value="delete" >Delete</option>
            						<option value="just_to_know" >For information Purpose</option>
            						<option value="feedback" >Feedback</option>
            						<option value="followback" >Follow back</option>
            					</select>
            				</div>
            		   	<label class="col-md-1 control-label">Other Specifications</label>
            		   	<div class="col-md-3">
            		     	<select id = "gender" > 
            						<option value="male" selected >Male</option>
            						<option value="female">Female</option>
            						<option value="any">Any</option>
            					</select>
            			 	</div>
            			</div>
            			<div class="form-group">
            			 	<label class="col-md-3 control-label">Expected Salary</label>
            				<div class="col-md-3">
            			   	<input type="text" id ="salary" class="form-control" placeholder="Expected Salary" />
            			 	</div> <!-- /.col -->
            			 	<label class="col-md-1 control-label">Area</label>
            			 	<div class="col-md-3">
            			   	<input type="text" id ="area" class="form-control" placeholder="Area" />
            			 	</div> <!-- /.col -->
            			</div>
            			<div class="form-group">
            				<label class="col-md-3 control-label">Working Time in Hours</label>
            			 	<div class="col-md-3">
            			   	<input type="number" id ="work_time" class="form-control" placeholder="Working Time in Hours"/>
            			 	</div>
            			 	<label class="col-md-1 control-label">Created Date</label>
            			 	<div class="col-md-3">
            			   	<input type="date" id ="created_time" class="form-control" placeholder="YYYY-mm-dd" />
            			 	</div>
            			</div>
            			<div class="form-group">
            			 	<label class="col-md-3 control-label">Remarks</label>
            				<div class="col-md-3">
            			   	<input type="text" id ="remarks" class="form-control" placeholder="remarks" />
            			 	</div> <!-- /.col -->
            			 	<label class="col-md-1 control-label">Worker Area</label>
            			 	<div class="col-md-3">
            			   	<input type="text" id ="worker_area" class="form-control" placeholder="Worker Area" />
            			 	</div>
            			</div>
            			<div class="form-group">
            			 	<label class="col-md-3 control-label">Requierment</label>
            			 	<div class="col-md-6 ">
            			   	<input type="checkbox" name = "skill" value ='maid' /> Maid &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name = "skill" value ='cook' /> Cook &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name = "skill" value ='cook,maid' /> Maid + Cook &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name = "skill" value ='cook,babysitter' /> Cook + Babysitter &nbsp;&nbsp;&nbsp;&nbsp;
            					<input type="checkbox" name = "skill" value ='maid,babysitter' /> Maid  + Babysitter &nbsp;&nbsp;&nbsp;&nbsp;
            					<input type="checkbox" name = "skill" value ='driver' /> driver &nbsp;&nbsp;&nbsp;&nbsp;         
            					<input type="checkbox" name = "skill" value ='electrician' /> electrician &nbsp;&nbsp;&nbsp;&nbsp;           
            					<input type="checkbox" name = "skill" value ='plumber' /> Plumber &nbsp;&nbsp;&nbsp;&nbsp;        
            					<input type="checkbox" name = "skill" value ='carpenter' /> Carpenter &nbsp;&nbsp;&nbsp;&nbsp;     
            					<input type="checkbox" name = "skill" value ='babysitter' /> Babysitter &nbsp;&nbsp;&nbsp;&nbsp;           
            					<input type="checkbox" name = "skill" value ='oldage' /> Old age care &nbsp;&nbsp;&nbsp;&nbsp;          
            					<input type="checkbox" name = "skill" value ='patient' />  Patient care &nbsp;&nbsp;&nbsp;
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