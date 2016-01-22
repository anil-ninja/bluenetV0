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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"/>
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
            <li> Education is the key to unlock the golden door of freedom.</li>
            <li>Education is the most powerful weapon which you can use to change the world.</li>
            <li>The roots of education are bitter, but the fruit is sweet.</li>
            <li>Education is not preparation for life; education is life itself.</li>
            <li>The whole purpose of education is to turn mirrors into windows.</li>
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
            <a data-hover="dropdown" href="#" class="dropdown-toggle">&nbsp;
              <span class="hidden-xs"><?= strtoupper($_SESSION['first_name']) ?></span>&nbsp;<span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-user pull-right">
              <li><a href="logout.php"><i class="fa fa-key"></i>Log Out</a></li>
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
      <div class="page-content">
        <div id="tab-general">
          <div class="row mbl">
			<div class="col-lg-12">
			  <div class="panel" >
				<div class="panel-body">
			 	  <table id="example" class="display" cellspacing="0" >
					<thead>
					  <tr>
						<th class="row_style">Name</th>
						<th class="row_style">Mobile</th>
						<th class="row_style">Requirement</th>
						<th class="row_style">Gender</th>
						<th class="row_style">Timing</th>
						<th class="row_style">Salary</th>
						<th class="row_style">Address</th>
						<th class="row_style">Remarks</th>
						<th class="row_style">Work Time</th>
						<th class="row_style">Created Date</th>
						<th class="row_style">Date</th>
						<th class="row_style">Match 1</th>
						<th class="row_style">Match 2</th>	
						<th class="row_style">Status</th>
						<th class="row_style">Edit</th>
					  </tr>
					</thead>
					<tbody>				
				<?php
					$srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE work_time ='24'; ") ;
					while ($srsrow = mysqli_fetch_array($srs)){
				?>
					  <tr>					
						<td class="row_style"><?= $srsrow['name'] ?> </td>
						<td class="row_style"><?= $srsrow['mobile'] ?> </td>
						<td class="row_style"><?= $srsrow['requirements'] ?> </td>
						<td class="row_style"><?= $srsrow['gender'] ?> </td>
						<td class="row_style"><?= $srsrow['timings'] ?> </td>
						<td class="row_style"><?= $srsrow['expected_salary'] ?> </td>
						<td class="row_style"><?= $srsrow['address'] ?> </td>
						<td class="row_style"><?= $srsrow['remarks'] ?> </td>
						<td class="row_style"><?= $srsrow['work_time'] ?> </td>
						<td class="row_style"><?= $srsrow['created_time'] ?> </td>
						<td class="row_style"><?= $srsrow['date'] ?> </td>
						<td class="row_style"><?= $srsrow['match_name'] ?> <?= $srsrow['match_mobile'] ?> </td>
						<td class="row_style"><?= $srsrow['match2_name'] ?> <?= $srsrow['match2_mobile'] ?> </td>
						<td class="row_style">
						  <form method="POST" action="">
							<select name="new_status">
							  <option value="<?= $srsrow['status'] ?>" selected><?= $srsrow['status'] ?></option>
							  <option value="open">Open</option>
							  <option value="followback">Followback</option>
							  <option value="cem_open" >CEM - Open</option>
							  <option value="salary_issue" >Salary Issues</option>
							  <option value="not_interested" >Not Interested</option>
							  <option value="done" >Done</option>
							  <option value="decay" >Decay</option>
							  <option value="delete" >Delete</option>
							</select>
							<input type="hidden" name="sr_id" value="<?= $srsrow['id'] ?>">
							<input type="hidden" name="old_status" value="<?= $srsrow['status'] ?>">
							<button type="submit" name="update_status" class="btn btn-primary"> Update </button>
						  </form>
						</td>
						<td class="row_style">
						  <form method="post" action="update.php?sr_id=<?= $srsrow['id'] ?>">
							<button type="submit" name="update_sr" class="btn btn-primary"> Edit </button>
						  </form>
						</td>
					  </tr>
					<?php   }   ?>
					</tbody>
				  </table>
				</div>
			  </div>
			</div>
		  </div>
		</div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="script/jquery-1.10.2.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function() {
  	  $('#example1').DataTable({
        "iDisplayLength": 50
      });
  	});
    $(".addworker").hide();
    function toggle() {
      $(".addworker").toggle();
    }
	</script>
  <script src="script/jquery-migrate-1.2.1.min.js"></script>
  <script src="script/jquery-ui.js"></script>
  <script src="script/bootstrap.min.js"></script>
  <script src="script/bootstrap-hover-dropdown.js"></script>
  <script src="script/html5shiv.js"></script>
  <script src="script/respond.min.js"></script>
  <script src="script/jquery.metisMenu.js"></script>
  <script src="script/jquery.slimscroll.js"></script>
  <script src="script/jquery.cookie.js"></script>
  <script src="script/icheck.min.js"></script>
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
  <script type="text/javascript" src="https://cdn.datatables.net/s/dt/dt-1.10.10/datatables.min.js"></script>
</body>
</html>