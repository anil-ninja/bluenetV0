<?php
session_start();

require_once "../dbConnection.php";

if(isset($_POST['phone'])){
	$phone = $_POST['phone'];
	$srs = mysqli_query($db_handle, "SELECT * FROM workers WHERE phone = '$phone' OR emergency_phone = '$phone' 
															OR emergency_phone LIKE '%".$phone."%' OR phone LIKE '%".$phone."%';");
	
	$srsrow = mysqli_fetch_array($srs) ;
	$data .= "<table class='display' cellspacing='0'>
				<thead>
					<tr>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Name</td>
						<td>".$srsrow['first_name']." ".$srsrow['last_name']."</td>
					</tr>
					<tr>
						<td>Mobile</td>
						<td>".$srsrow['phone']."</td>
					</tr>
					<tr>
						<td>Current Address</td>
						<td>".$srsrow['current_address']."</td>
					</tr>
					<tr>
						<td>Permanent Address</td>
						<td>".$srsrow['permanent_address']."</td>
					</tr>
					<tr>
						<td>Salary Criteria</td>
						<td>".$srsrow['expected_salary']."</td>
					</tr>
					<tr>
						<td>Timings</td>
						<td>".$srsrow['timings']."</td>
					</tr>
					<tr>
						<td>Working Time </td>
						<td>".$srsrow['work_time']."</td>
					</tr>
					<tr>
						<td>Age</td>
						<td>".$srsrow['age']."</td>
					</tr>
					<tr>
						<td>Remarks</td>
						<td>".$srsrow['remarks']."</td>
					</tr>
					<tr>
						<td>Education</td>
						<td>".$srsrow['education']."</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td>".$srsrow['gender']."</td>
					</tr>
					<tr>
						<td>Experience</td>
						<td>".$srsrow['experience']."</td>
					</tr>
					<tr>
						<td>Police Varification</td>
						<td>".$srsrow['varification_status']."</td>
					</tr>
                </tbody>
            </table>";
    echo $data ;
}
$data = "";
mysqli_close($db_handle);
?>