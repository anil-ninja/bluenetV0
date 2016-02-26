<?php require_once "dbConnection.php" ;?>
<form class="form-horizontal" id="user_details_form" onsubmit='return (validateUserDetails());'>
  <div class='form-group'>
    <label class='col-md-3 control-label'>First Name</label>
    <div class='col-md-3'>
      <input type='text' id ='first_name' onkeyup='nospaces(this);' class='form-control' placeholder='First Name' />
    </div>
    <label class='col-md-3 control-label'>Last Name</label>
    <div class='col-md-3'>
      <input type='text' id ='last_name' onkeyup='nospaces(this);' class='form-control' placeholder='Last Name' />
    </div>
  </div> 
  <div class='form-group'>
    <label class='col-md-3 control-label'>Email</label>
    <div class='col-md-3'>
      <input type='text' id ='email' onkeyup='nospaces(this);' class='form-control' placeholder='Email' />
    </div>
    <label class='col-md-3 control-label'>Phone No.</label>
    <div class='col-md-3'>
      <input type='text' id ='phone' onkeyup='nospaces(this);' class='form-control' placeholder='Mobile Number' />
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label">Designation</label>
    <div class="col-md-3">
      <select id="employee_type">
        <option value='operator' >Operator</option>
        <option value='me' >Marketing Executive</option>
        <option value='cem' >Customer Engagement Manager</option>
        <option value='admin' >Admin</option>
        <option value='cem_manager' >Manager</option>
        <option value='accountant' >Accountant</option>
        <option value='ba' >Business Analyst</option>
        <option value='dev' >Developer</option>
      </select>
    </div>
    <label class="col-md-3 control-label">Base salary</label>
    <div class="col-md-3">
      <input type="number" id ="salary" onkeyup='nospaces(this);' class="form-control" placeholder="Base salary" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label">Password</label>
    <div class="col-md-3">
      <input type="password" id ="password" onkeyup='nospaces(this);' class="form-control" placeholder="password" />
    </div>
    <label class="col-md-3 control-label">Re-enter password</label>
    <div class="col-md-3">
      <input type="password" id ="password2" class="form-control" placeholder="Re-enter password" />
    </div>               
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label">Select Team Head</label>
    <div class="col-md-4">
      <select id="teamHead">
        <option value='0' SELECTED>Select Team Head </option>
        <?php 
        $data = mysqli_query($db_handle, "SELECT * from user where employee_type = 'cem_manager' ;");
        while($dataRow = mysqli_fetch_array($data)){
          echo "<option value=".$dataRow['id'].">".$dataRow['first_name']." ".$dataRow['last_name']."</option>";
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-7">
        <button type="submit" class="btn btn-success pull-right">Insert</button>
    </div>
  </div> <!-- /.form-group -->
</form>