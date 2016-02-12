<?php

function route($type){

	if($type == 'admin') return header("Location: request.php");
	elseif($type == 'me') return header("Location: me.php");
	elseif($type == 'cem') return header("Location: cem.php");
	elseif($type == 'accountant') return header("Location: accounts.php");
	elseif($type == 'ba') return header("Location: business.php");
	elseif($type == 'dev') return header("Location: developer.php");
	elseif($type == 'operator') return header("Location: insert.php");
	else return header("Location: home.php");
}

function countRequest($status, $type, $user_id, $db_handle){
	if($type == 'cem'){
		if ($status == "picked") $condition = " cem_id = " .$user_id. " AND status = 'open'";
      	elseif ($status == "match") $condition = " cem_id = 0 AND me_id != 0 AND status = 'open' AND (match_id != 0 OR match2_id != 0)" ;
      	elseif ($status == "meeting") $condition = " status = 'meeting' AND cem_id = " .$user_id ;
      	elseif ($status == "demo") $condition = " status='demo' AND cem_id = " .$user_id ;
      	elseif ($status == "done") $condition = " status='done' AND cem_id = " .$user_id ;
      	elseif ($status == "24") $condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time = 24 " ;
      	else $condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time != 24 " ;
	}
	else if($type == 'me'){
		if ($status == "picked") $condition = " me_id = " .$user_id." AND (match_id = 0 OR match2_id = 0) AND (status='open' OR status='me_open')" ;
        else if ($status == "done") $condition = " me_id = " .$user_id." AND match_id != 0 AND match2_id != 0 " ;
        else if ($status == "24") $condition = "  (status='open' OR status='me_open') AND me_id = 0 AND work_time = 24 " ;
        else $condition = " (status='open' OR status='me_open') AND me_id = 0 AND work_time != 24 " ;
	}
	else if($type == 'operator'){
		if(!isset($status)) $condition = " status = 'followback' ";
		else $condition = " status = ".$status." ";
	}
	else if($type == 'admin'){
		if ($status == "open") $condition = " cem_id = 0 AND me_id = 0 ";
      	elseif ($status == "meeting") $condition = "status = 'meeting'" ;
      	elseif ($status == "me_open") $condition = " status = 'me_open'" ;
      	elseif ($status == "cem_open") $condition = " cem_id = 0 AND me_id != 0 AND (match_id != 0 OR match2_id != 0)" ;
      	elseif ($status == "salary_issue") $condition = "status = 'salary_issue'" ;
      	elseif ($status == "demo") $condition = "status = 'demo'";
      	elseif ($status == "done") $condition = "status = 'done'";
      	elseif ($status == "delete") $condition = "status = 'delete'";
      	elseif ($status == "not_interested") $condition = "status = 'not_interested'" ;
      	elseif ($status == "decay") $condition = "status = 'decay'";
      	elseif ($status == "just_to_know") $condition = "status = 'just_to_know'" ;
      	elseif ($status == "followback") $condition = "status = 'followback'" ;
      	elseif ($status == "feedback") $condition = "status = 'feedback'" ;
      	elseif ($status == "24") $condition = " work_time = 24 " ;
      	else $condition = " 1=1 " ;
	}
	else if($type == 'accountant'){}
	else if($type == 'ba'){}
	else if($type == 'dev'){}
	else {
		$condition = "status = ".$status ;
	}
	$count =  mysqli_query($db_handle, "SELECT COUNT(*) as count FROM service_request WHERE ".$condition." ;");
	$countRow = mysqli_fetch_array($count);
	if ($countRow['count'] != 0) $data = "<span class='badge badge-info'>".$countRow['count']."</span>";
	else $data = "";
	echo $data;
}

function headerColor($value,$name){
	switch ($value) {
		case 1:
			$data = '<a  class="list-group-item" style="background: #63f62d;border-color: #63f62d;font-size:20px;padding-left: 2em;">
						Client Name  <span style="padding-left: 5em">'.strtoupper($name).'</span></a>';
			break;
		
		case 2:
			$data = '<a  class="list-group-item" style="background: #8ef62d;border-color: #8ef62d;font-size:20px;padding-left: 2em;"> 
						Client Name  <span style="padding-left: 5em">'.strtoupper($name).'</span></a>';
			break;

		case 3:
			$data = "<a  class='list-group-item' style='background: #c7f62d;border-color: #c7f62d;font-size:20px;padding-left: 2em;'>
						Client Name  <span style='padding-left: 5em'>".strtoupper($name)."</span></a>";
			break;

		case 4:
			$data = "<a  class='list-group-item' style='background: #f6ed2d;border-color: #f6ed2d;font-size:20px;padding-left: 2em;'>
						Client Name  <span style='padding-left: 5em'>".strtoupper($name)."</span></a>";
			break;

		case 5:
			$data = "<a  class='list-group-item' style='background: #fed87d;border-color: #fed87d;font-size:20px;padding-left: 2em;'>
						Client Name  <span style='padding-left: 5em'>".strtoupper($name)."</span></a>";
			break;

		case 6:
			$data = "<a  class='list-group-item' style='background: #feb87d;border-color: #feb87d;font-size:20px;padding-left: 2em;'>
						Client Name  <span style='padding-left: 5em'>".strtoupper($name)."</span></a>";
			break;

		case 7:
			$data = "<a  class='list-group-item' style='background: #fe7d7d;border-color: #fe7d7d;font-size:20px;padding-left: 2em;'>
						Client Name  <span style='padding-left: 5em'>".strtoupper($name)."</span></a>";
			break;

		case 8:
			$data = "<a  class='list-group-item' style='background: #ff5656;border-color: #ff5656;font-size:20px;padding-left: 2em;'>
						Client Name  <span style='padding-left: 5em'>".strtoupper($name)."</span></a>";
			break;

		case 9:
			$data = "<a  class='list-group-item' style='background: #fc2c2c;border-color: #fc2c2c;font-size:20px;padding-left: 2em;'>
						Client Name  <span style='padding-left: 5em'>".strtoupper($name)."</span></a>";
			break;

		case 10:
			$data = "<a  class='list-group-item' style='background: #ff0606;border-color: #ff0606;font-size:20px;padding-left: 2em;'>
						Client Name  <span style='padding-left: 5em'>".strtoupper($name)."</span></a>";
			break;

		default:
			$data = "<a  class='list-group-item' style='background: #0cf806;border-color: #0cf806;font-size:20px;padding-left: 2em;'>
						Client Name  <span style='padding-left: 5em'>".strtoupper($name)."</span></a>";
			break;
	}
	echo $data ;
}
?>