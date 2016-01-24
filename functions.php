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

?>