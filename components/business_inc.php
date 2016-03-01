<canvas id="cchart" width="800" height="500"></canvas>
<?php
  if(!isset($_GET['status'])) $status = "main";
  else $status = $_GET['status'];
  $user_id = $_SESSION['user_id'];
  switch ($status) {
    case 'monthlyandondemand':
        require_once "monthlyandondemand.php" ; 
      break;
    
    case 'typeRequest':
        require_once "typeRequest.php" ;
      break;

    case 'collectionRate':
        require_once "collectionRate.php" ;
      break;

    case 'finencial':
        require_once "finencial.php" ;
      break;

    case 'users':
        require_once "users.php" ;
      break;

    default:
        require_once "mnaingraph.php" ;
      break;     
  }
?>