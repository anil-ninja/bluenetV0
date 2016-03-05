<?php
  require_once "dbConnection.php" ;
  $data = "";
  $user_id = $_SESSION['user_id'];
  $user = mysqli_query($db_handle, "SELECT * FROM user WHERE id != '$user_id' AND (employee_type = 'cem' OR employee_type = 'me') ; ") ;
  $data .= "<table id='example1' class='display' cellspacing='0' >
          <thead>
           <tr>
              <th >Employee Name</th>
              <th >Mobile</th>
              <th >Email ID</th>
              <th >Reg. Date</th>
              <th >Report Card</th>
           </tr>
          </thead>
          <tbody>";
  while ($userRow = mysqli_fetch_array($user)){ 
    $uid = $userRow['id'];
    $type = $userRow['employee_type'];
    $data = $data ."<tr>
            <td>".strtoupper($userRow['first_name'])." ".strtoupper($userRow['last_name'])."</td>
            <td>".$userRow['phone']."</td>
            <td>".$userRow['email']."</td>
            <td>".$userRow['reg_date']."</td>
            <td onclick='reportcard(\'".$type."\',".$uid.");'>View Report Card</td>
          </tr>
          <tr><span id='reportcard_".$user_id."' style='width:100%;'> </span></tr>" ;
  }
  $data = $data ."</tbody> 
      </table>";
  echo $data;
?>