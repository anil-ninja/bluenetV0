<?php
  if(!isset($_GET['status'])) $status = "main";
  else $status = $_GET['status'];
  $user_id = $_SESSION['user_id'];
  switch ($status) {
    case 'monthlyandondemand':
        include_once "monthlyandondemand.php" ; 
      break;
    
    case 'typeRequest':
        include_once "typeRequest.php" ;
      break;

    case 'collectionRate':
        include_once "collectionRate.php" ;
      break;

    case 'finencial':
        include_once "finencial.php" ;
      break;

    case 'users':
        include_once "users.php" ;
      break;

    default:
        include_once "mnaingraph.php" ;
      break;     
  }
?>