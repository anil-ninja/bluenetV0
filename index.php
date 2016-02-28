<?php
session_start();

require_once "components/dbConnection.php";
if (isset($_SESSION['user_id'])) {  
	route($_SESSION['employee_type']);
}

if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($db_handle, $_POST['username']); 
	$password = md5(mysqli_real_escape_string($db_handle, $_POST['passwordlogin']));
	$response = mysqli_query($db_handle,"select * from user where email = '$email' AND password = '$password';") ;
	$num_rows = mysqli_num_rows($response);
	if ( $num_rows > 0){
		$responseRow = mysqli_fetch_array($response);
		$_SESSION['first_name'] = $responseRow['first_name'] ;
		$_SESSION['email'] = $responseRow['email'];
        $_SESSION['user_id'] = $responseRow['id'];
		$_SESSION['employee_type'] = $responseRow['employee_type'];
        header("Location: home.php");
	}
	else {
		echo "<center ><b>Sorry! Invalid username or password!</b></center>";      
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bluenet</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <!--Loading bootstrap css-->
    <?php include_once "components/headers.php"; ?>
	
</head>
<body>
    <div class="row" >
        <div class = "col-xs-2 col-ls-2"></div>
        <div class = "col-xs-4 col-ls-4">
            <img src="images/logo.png" width="420" style=" margin-top:85px; "  alt="BlueTeam"><div class="pull-right"> to give you Relief...</div>
            
        </div>
        <div class = "col-xs-2 col-ls-4" style="width:350px; margin-top:85px; background-color: #F8F8F8 ;">
            <ul class="nav nav-tabs" role="tablist" style="font-size:14px; margin-bottom: 0px; margin-top: 12px;">
                <li role="presentation" class="active" id="signup_modal">
                    <a href="#tabSignup" role="tab" data-toggle="tab"> SignIn </a>
                </li>  
            </ul>
            <div class="tab-content" style="margin-bottom: 12px">         
                <div role="tabpanel" class="row tab-pane active" id="tabSignup" style="line-height: 2;" >
                    <p align="center"><font size="5" >BlueNet</font></p></br>
                    <form method="post">
                        <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input type="text" class="form-control" name="username" placeholder="Email ">
                        </div>
                        <br/>
                        <div class="input-group">
                            <span class="input-group-addon">Password&nbsp;</span>
                            <input type="password" class="form-control" name="passwordlogin" placeholder="Password">
                        </div><br/>
                        <input type="submit" class="btn btn-success btn-lg" name = "login" value = "Log in" >
                    </form>
                    powered by Shatkon Labs Pvt. Ltd.
                </div>  
            </div>  
        </div>	<?php /*
        <div class = "col-xs-1 col-ls-1"></div>
        <div class = "col-xs-2 col-ls-4" style="width:350px; margin-top:85px; background-color: #F8F8F8 ;">
<!-- signin signup nav tabs starts ---->            
            <ul class="nav nav-tabs" role="tablist" style="font-size:14px; margin-bottom: 0px; margin-top: 12px;">
                <li role="presentation" class="active" id="signup_modal">
                    <a href="#tabSignup" role="tab" data-toggle="tab">
                        SignUp 
                    </a>
                </li>
                
            </ul>

            <div class="tab-content" style="margin-bottom: 12px">
                <div role="tabpanel" class="row tab-pane active" id="tabSignup" style="line-height: 2;">  
                    <p align="center"><font size="5" >Let's Collaborate!!</font></p><br>
                    <form method="post">                    
                    <div>
                        <div class="col-md-6" style="padding-left: 0px;">                  
                            <input type="text" class="form-control" style="width: 100%" name="firstname" placeholder="First name" />  
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;">
                            <input type="text" class="form-control" style="width: 100%" name="lastname" placeholder="Last name" />                    
                        </div>
                    </div><br/><br> 
                    <input type="text" class="form-control" style="width: 98%" name="email" placeholder="Email" /><br/>                   
                    <input type="text" class="form-control" style="width: 98%" name="phone" placeholder="Mobile Number" /><br/>
                    <label>&nbsp;&nbsp;&nbsp;Designation</label> 
                    <select name="employee_type" data-live-search="true" data-width="100%">    
                        <option value='operator' >Operator</option>
                        <option value='me' >Marketing Executive</option>
                        <option value='cem' >Customer Engagement Manager</option>
                        <option value='admin' >Admin</option>
                        <option value='accountant' >Accountant</option>
                        <option value='ba' >Business Analyst</option>
                        <option value='dev' >Developer</option>
                    </select><br/> <br/>                 
                    <div>
                        <div class="col-md-6" style="padding-left: 0px;">
                            <input type="password" class="form-control" style="width: 100%" name="password" placeholder="password"/>
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;">
                            <input type="password" class="form-control" style="width: 100%" name="password2" placeholder="Re-enter password"/><br/><br/>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-lg" name = "request" value = "Sign up" >
                    </form>
                </div>     
                
                      
            </div>
        </div>  */ ?>
    </div>
	<?php include_once "components/footers.php"; ?>
</body>
</html>
