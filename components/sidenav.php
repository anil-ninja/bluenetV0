<?php
  $user_id = $_SESSION['user_id'];
  $type = $_SESSION['employee_type']; 
  if ($_SESSION["employee_type"] ==  "me" ) { 
?>
  <li id='1' ><a onclick="getRequestData('open');">
    <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-search"></i>
    <span class="homenu-title">Open homes</span><?php echo countRequest('open', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='2'><a onclick="getRequestData('24');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-time"></i>
    <span class="homenu-title">24 Hour homes</span><?php echo countRequest('24', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='3'><a onclick="getRequestData('picked');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
    <span class="homenu-title">Picked homes</span><?php echo countRequest('picked', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='4'><a onclick="getRequestData('done');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-thumbs-up"></i>
    <span class="homenu-title">Done homes</span><?php echo countRequest('done', $type, $user_id, $db_handle); ?></a>   
  </li>
<?php } 
  else if ($_SESSION["employee_type"] ==  "cem" ) { 
?>
  <li id='5'><a onclick="getRequestData('open');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
    <span class="menu-title">Open homes</span><?php echo countRequest('open', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='6'><a onclick="getRequestData('24');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-time"></i>
    <span class="menu-title">24 Hour open homes</span><?php echo countRequest('24', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='7'><a onclick="getRequestData('match');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
    <span class="menu-title">Match homes</span><?php echo countRequest('match', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='8'><a onclick="getRequestData('picked');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-user"></i>
    <span class="menu-title">Picked homes</span><?php echo countRequest('picked', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='9'><a onclick="getRequestData('meeting');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-calendar"></i>
    <span class="menu-title">Meetings</span><?php echo countRequest('meeting', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='10'><a onclick="getRequestData('demo');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-asterisk"></i>
    <span class="menu-title">IN Demo Period</span><?php echo countRequest('demo', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='11'><a onclick="getRequestData('done');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-ok"></i>
    <span class="menu-title">Done homes</span><?php echo countRequest('done', $type, $user_id, $db_handle); ?></a>   
  </li>
<?php } 
  else if ($_SESSION["employee_type"] ==  "operator" ) { 
?>
  <li id='12'><a onclick="getRequestData('followback');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
    <span class="menu-title">Follow back Requests</span><?php echo countRequest('followback', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='13'><a onclick="getRequestData('feedback');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
    <span class="menu-title">Feedback Requests</span><?php echo countRequest('feedback', $type, $user_id, $db_handle); ?></a>
  </li>
<?php }
  else if ($_SESSION["employee_type"] ==  "ba" ) { 
?>
  <li id='12'><a onclick="getRequestData('followback');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
    <span class="menu-title">Follow back Requests</span><?php echo countRequest('followback', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='13'><a onclick="getRequestData('feedback');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
    <span class="menu-title">Feedback Requests</span><?php echo countRequest('feedback', $type, $user_id, $db_handle); ?></a>
  </li>
<?php }  
  else { 
    if($_SESSION["employee_type"] ==  "admin" ){   
?>
    <li id='14'><a onclick="getRequestData('addUser');">
      <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
      <span class="homenu-title">Add New User</span></a>
    </li>
<?php } ?>
  <li id='15'><a onclick="getRequestData('statics');">
    <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-cog"></i>
    <span class="menu-title">Reports</span></a>
  </li>
  <li id='16'><a onclick="getRequestData('all');">
    <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-home"></i>
    <span class="homenu-title">View All Requests</span><?php echo countRequest('all', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='17'><a onclick="getRequestData('open');">
    <div class="icon-bg bg-orange"></div><i class="glyphicon glyphicon-search"></i>
    <span class="homenu-title">Open Requests</span><?php echo countRequest('open', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='18'><a onclick="getRequestData('meeting');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-calendar"></i>
    <span class="homenu-title">Meetings</span><?php echo countRequest('meeting', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='19'><a onclick="getRequestData('demo');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-asterisk"></i>
    <span class="homenu-title">IN Demo Period</span><?php echo countRequest('demo', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='20'><a onclick="getRequestData('done');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-ok"></i>
    <span class="homenu-title">Done homes</span><?php echo countRequest('done', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='21'><a onclick="getRequestData('me_open');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
    <span class="homenu-title">ME Open</span><?php echo countRequest('home_open', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='22'><a onclick="getRequestData('cem_open');">
    <div class="icon-bg bg-pink"></div><i class="glyphicon glyphicon-search"></i>
    <span class="homenu-title">CEM Open</span><?php echo countRequest('home_open', $type, $user_id, $db_handle); ?></a>   
  </li>
  <li id='23'><a onclick="getRequestData('cem_open');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-usd"></i>
    <span class="homenu-title">Salary Issues</span><?php echo countRequest('salary_issue', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='24'><a onclick="getRequestData('delete');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-remove"></i>
    <span class="homenu-title">Deleted Requests</span><?php echo countRequest('delete', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='25'><a onclick="getRequestData('just_to_know');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-pencil"></i>
    <span class="homenu-title">Only Information Purpose</span><?php echo countRequest('just_to_know', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='26'><a onclick="getRequestData('decay');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-trash"></i>
    <span class="homenu-title">Decay Requests</span><?php echo countRequest('decay', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='27'><a onclick="getRequestData('not_interested');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-exclamation-sign"></i>
    <span class="homenu-title">Not Interested</span><?php echo countRequest('not_interested', $type, $user_id, $db_handle); ?></a>
  </li>
  <li  id='28'><a onclick="getRequestData('followback');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
    <span class="homenu-title">Follow back Requests</span><?php echo countRequest('followback', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='29'><a onclick="getRequestData('feedback');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-repeat"></i>
    <span class="homenu-title">Feedback Requests</span><?php echo countRequest('feedback', $type, $user_id, $db_handle); ?></a>
  </li>
  <li  id='30'><a onclick="getRequestData('24');">
    <div class="icon-bg bg-blue"></div><i class=" glyphicon glyphicon-time"></i>
    <span class="homenu-title">View 24hours Requests</span><?php echo countRequest('24', $type, $user_id, $db_handle); ?></a>
  </li>
  <li id='31'><a onclick="getRequestData('printArea');">
    <div class="icon-bg bg-blue"></div><i class="glyphicon glyphicon-print"></i>
    <span class="homenu-title">Print Area</span></a>
  </li>
<?php } ?>
  <li  id='32'><a onclick="getRequestData('addRequest');">
    <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
    <span class="homenu-title">Insert New Service Request</span></a>
  </li>
  <li  id='33'><a onclick="getRequestData('addWorker');">
    <div class="icon-bg bg-red"></div><i class="glyphicon glyphicon-plus"></i>
    <span class="homenu-title">Insert New Worker</span></a>
  </li>