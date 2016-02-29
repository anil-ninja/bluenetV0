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
	switch ($type) {
		/*case 'admin':
			return header("Location: request.php");
			break;
		case 'me':
			return header("Location: me.php");
			break;
		case 'cem':
			return header("Location: cem.php");
			break;
		case 'accountant':
			return header("Location: accounts.php");
			break;
		case 'cem_manager':
			return header("Location: statics.php");
			break;*/
		case 'ba':
			return header("Location: business.php");
			break;
		/*case 'dev':
			return header("Location: developer.php");
			break;
		case 'operator':
			return header("Location: insert.php");
			break;*/
		default:
			return header("Location: home.php");
			break;
	}
}

function countRequest($status, $type, $user_id, $db_handle){
	switch ($type) {
		case 'admin':
			switch ($status) {
				case 'open':
					$condition = " cem_id = 0 AND me_id = 0 ";
					break;
				case 'cem_open':
					$condition = " cem_id = 0 AND me_id != 0 AND (match_id != 0 OR match2_id != 0)" ;
					break;
				case '24':
					$condition = " work_time = 24 " ;
					break;
				case 'all':
					 $condition = " 1 " ;
					break;
				default:
					$condition = " status = '$status' " ;
					break;
			}
			break;
		case 'me':
			switch ($status) {
				case 'picked':
					$condition = " me_id = " .$user_id." AND (match_id = 0 OR match2_id = 0) AND (status='open' OR status='me_open')" ;
					break;
				case 'done':
					$condition = " me_id = " .$user_id." AND match_id != 0 AND match2_id != 0 " ;
					break;
				case '24':
					$condition = "  (status='open' OR status='me_open') AND me_id = 0 AND work_time = 24 " ;
					break;
				default:
					$condition = " (status='open' OR status='me_open') AND me_id = 0 AND work_time != 24 " ;
					break;
			}
			break;
		case 'cem':
			switch ($status) {
				case 'picked':
					$condition = " cem_id = " .$user_id. " AND status = 'open'";
					break;
				case 'match':
					$condition = " cem_id = 0 AND me_id != 0 AND status = 'open' AND (match_id != 0 OR match2_id != 0)" ;
					break;
				case 'meeting':
					$condition = " status = 'meeting' AND cem_id = " .$user_id ;
					break;
				case 'demo':
					 $condition = " status='demo' AND cem_id = " .$user_id ;
					break;
				case 'done':
					$condition = " status='done' AND cem_id = " .$user_id ;
					break;
				case '24':
					$condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time = 24 " ;
					break;
				default:
					$condition = " cem_id = 0 AND match_id = 0 AND match2_id = 0 AND status = 'open' AND work_time != 24 " ;
					break;
			}
			break;
		case 'accountant':
			return header("Location: accounts.php");
			break;
		case 'cem_manager':
			switch ($status) {
				case 'open':
					$condition = " cem_id = 0 AND me_id = 0 ";
					break;
				case 'cem_open':
					$condition = " cem_id = 0 AND me_id != 0 AND (match_id != 0 OR match2_id != 0)" ;
					break;
				case '24':
					$condition = " work_time = 24 " ;
					break;
				case 'all':
					 $condition = " 1 " ;
					break;
				default:
					$condition = " status = '$status' " ;
					break;
			}
			break;
		case 'ba':
			return header("Location: business.php");
			break;
		case 'dev':
			return header("Location: developer.php");
			break;
		case 'operator':
			if($status == 'followback') $condition = " status = 'followback' ";
			else if($status == 'feedback') $condition = " status = 'feedback' ";
			else $condition = " status = 'feedback' ";
			break;
		default:
			$condition = "status = '$status' " ;
			break;
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