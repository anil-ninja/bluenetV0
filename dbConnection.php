<?php

	$db_handle = mysqli_connect("localhost","root","redhat@11111p","bluenethack");

//Check connection
	if (mysqli_connect_errno()) {
	  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

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

function httpGet($url)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}
?>