<?php
session_start();

require_once "../dbConnection.php";
if (isset($_POST['first_name'])) {
	
	$firstname = mysqli_real_escape_string($db_handle, $_POST['first_name']);
	$lastname = mysqli_real_escape_string($db_handle, $_POST['last_name']);
	$email = mysqli_real_escape_string($db_handle, $_POST['email']);
	$phone = mysqli_real_escape_string($db_handle, $_POST['phone']);
    $employee_type = mysqli_real_escape_string($db_handle, $_POST['employee_type']);
    $salary = mysqli_real_escape_string($db_handle, $_POST['salary']);
	$pas = mysqli_real_escape_string($db_handle, $_POST['password']) ;
	$awe = mysqli_real_escape_string($db_handle, $_POST['password2']) ;
    if((strlen($firstname)< 3) OR (strlen($lastname)< 3) OR (strlen($email)< 8) OR (strlen($phone)< 10) OR (strlen($pas)< 4)) {
        echo "Something went wrong, Try again";
    }
    else {
		if ( $pas == $awe ) {
			$pas = md5($pas);
			mysqli_query($db_handle,"INSERT INTO user(first_name, last_name, email, phone, password, employee_type, base_salary) 
									   VALUES ('$firstname', '$lastname', '$email', '$phone', '$pas', '$employee_type', '$salary') ; ") ;		
			
            if(mysqli_error($db_handle)) return false ;
            else return true ;
		}
		else {  
			echo "Password do not match, Try again";
		}
    }
}
mysqli_close($db_handle);
?>