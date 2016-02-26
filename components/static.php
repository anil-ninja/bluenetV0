<?php
   session_start();
   require_once "dbConnection.php" ; 
   $id = $_SESSION['user_id'];  
   $user = mysqli_query($db_handle, "SELECT * FROM user WHERE team_head = '$id' AND employee_type = 'cem' ; ") ;
?>
<table id="example1" class="display" cellspacing="0" >
  <thead>
   <tr>
      <th >Employee Name</th>
      <th >Mobile</th>
      <th >Email ID</th>
      <th >Reg. Date</th>
      <th >Picked Requests</th>
      <th >Meeting Requests</th>
      <th >Demo Requests</th>
      <th >Done Requests</th>
   </tr>
  </thead>
  <tbody>
  <?php 
   while ($userRow = mysqli_fetch_array($user)){ 
   $user_id = $userRow['id'];
   echo "<tr>
            <td>".strtoupper($userRow['first_name'])." ".strtoupper($userRow['last_name'])."</td>
            <td>".$userRow['phone']."</td>
            <td>".$userRow['email']."</td>
            <td>".$userRow['reg_date']."</td>
            <td onclick='viewrequests(\"picked\", \"cem\",".$user_id.");'>".countRequest('picked', 'cem', $user_id,  $db_handle)."</td>
            <td onclick='viewrequests(\"meeting\", \"cem\",".$user_id.");'>".countRequest('meeting', 'cem', $user_id,  $db_handle)."</td>
            <td onclick='viewrequests(\"demo\", \"cem\",".$user_id.");'>".countRequest('demo', 'cem', $user_id,  $db_handle)."</td>
            <td onclick='viewrequests(\"done\", \"cem\",".$user_id.");'>".countRequest('done', 'cem', $user_id,  $db_handle)."</td>
         </tr>
         <tr><span id='userDetails_".$user_id."' style='width:100%;'> </span></tr>" ;
   }
?>
  </tbody> 
</table>
<script type="text/javascript">
   $('#example1').DataTable();
</script>