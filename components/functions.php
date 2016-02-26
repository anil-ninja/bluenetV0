<?php

function sendSMS($to, $message){
	$username = "shatkonlabs";
	$password = "blueteam@11111p";
	$senderid = "";

	return httpGet("http://www.smsjust.com/blank/sms/user/urlsms.php?".
						"username=".$username.
						"&pass=".$password.
						"&senderid=".$senderid.
						"&message=".$message.
						"&dest_mobileno=".$to.
						"&msgtype=TXT");
}

function httpGet($url){
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}

function route($type){

	if($type == 'admin') return header("Location: request.php");
	elseif($type == 'me') return header("Location: me.php");
	elseif($type == 'cem') return header("Location: cem.php");
	elseif($type == 'accountant') return header("Location: accounts.php");
	elseif($type == 'cem_manager') return header("Location: statics.php");
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
	return $data;
}

function headerColor($value){
	switch ($value) {
		case 1:
			$data = '#63f62d';
			break;
		
		case 2:
			$data = '#8ef62d';
			break;

		case 3:
			$data = "#c7f62d";
			break;

		case 4:
			$data = "#f6ed2d";
			break;

		case 5:
			$data = "#fed87d";
			break;

		case 6:
			$data = "#feb87d";
			break;

		case 7:
			$data = "#fe7d7d";
			break;

		case 8:
			$data = "#ff5656";
			break;

		case 9:
			$data = "#fc2c2c";
			break;

		case 10:
			$data = "#ff0606";
			break;

		default:
			$data = "#0cf806";
			break;
	}
	return $data ;
}
?>