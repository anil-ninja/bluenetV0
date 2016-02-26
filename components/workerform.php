<?php require_once "dbConnection.php" ;?>
<form class='form-horizontal' id='worker_details_form0' onsubmit='return (validateWorkerDetails(0,0));'>
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
  <!-- <div class='form-group'>
    <label class='col-md-3 control-label'>Address Proof Name</label>
    <div class='col-md-3'>
      <select class='selectpicker' id='address_proof_name' data-live-search='true' data-width='100%'> 
        <option value='Voter Id' >Voter Id </option>
        <option value='Adhaar Card' >Adhaar Card</option>
        <option value='Driving License' >Driving License</option>
        <option value='Education Certificate' >Education Certificate</option>
        <option value='Bank Account' >Bank Account</option>
        <option value='Passport' >Passport</option>
      </select>
    </div>
    <label class='col-md-3 control-label'>Address Proof No</label>
    <div class='col-md-3'>
      <input type='text' id ='address_proof_id' class='form-control' placeholder='Address Proof Id' />
    </div>
  </div>
  <div class='form-group'>
    <label class='col-md-3 control-label'>Id Proof Name</label>
    <div class='col-md-3'>
      <select class='selectpicker' id='id_proof_name' data-live-search='true' data-width='100%'>    
        <option value='Voter Id' >Voter Id </option>
        <option value='Adhaar Card' >Adhaar Card</option>
        <option value='Driving License' >Driving License</option>
        <option value='Education Certificate' >Education Certificate</option>
        <option value='Bank Account' >Bank Account</option>
        <option value='Passport' >Passport</option>
      </select>
    </div>
    <label class='col-md-3 control-label'>Id Proof No</label>
    <div class='col-md-3'>
      <input type='text' id ='id_proof_id' class='form-control' placeholder='Id Proof Id' />
    </div>
  </div> -->
  <div class='form-group'>
    <label class='col-md-3 control-label'>Mobile No.</label>
    <div class='col-md-3'>
      <input type='text' id='mobile' onkeyup='nospaces(this);' class='form-control' placeholder='Enter 10 digit mobile number'>
    </div>
    <label class='col-md-3 control-label'>Emergancy Mobile No.</label>
    <div class='col-md-3'>
      <input type='text' id='emergancy_mobile' onkeyup='nospaces(this);' class='form-control' placeholder='Enter 10 digit mobile number'>
    </div>
  </div>
  <div class='form-group'>
    <label class="col-md-3 control-label">Expected Salary</label>
    <div class="col-md-4 input-group">
      <input type="number" id ="salary" class="form-control" placeholder="Enter Salary" />
      <div class="input-group-addon">To</div>
      <input type="number" id ="salary2" class="form-control" placeholder="Enter Salary" />
    </div>
  </div>
  <div class='form-group'>
    <label class='col-md-3 control-label'>Age</label>
    <div class='col-md-3'>
      <input type='number' id='age' class='form-control' placeholder='Age in years'>
    </div>
  </div>
  <div class='form-group'>
    <label class='col-md-3 control-label'>Current address</label>
    <div class='col-md-3'>
      <textarea type='text' id='current_address' class='form-control' placeholder='Full Address' rows='4'></textarea>
    </div>
    <label class='col-md-3 control-label'>Parmanent address</label>
    <div class='col-md-3'>
      <textarea type='text' id='parmanent_address' class='form-control' placeholder='Full Address' rows='4'></textarea>
    </div>
  </div>
  <div class='form-group'>
    <label class='col-md-3 control-label'>Highest Education</label>
    <div class='col-md-3'>
      <input type='text' id='education' onkeyup='nospaces(this);' class='form-control' placeholder='Highest Education'>
    </div>
    <label for='demo-msk-date' class='col-md-3 control-label'>Experience</label>
    <div class='col-md-3'>
      <input type='number' id='experience' class='form-control' placeholder='Experience in Years'>
    </div>
  </div>
  <div class='form-group'>
    <label class='col-lg-3 control-label'>Gender</label>
    <div class='col-lg-3'>
      <select class='selectpicker' id='gender' data-live-search='true' data-width='100%'>  
        <option value='Male'>Male </option>
        <option value='Female'>Female</option>
        <option value='Other'>Other</option>
      </select>
    </div>
    <label for='demo-msk-date' class='col-md-3 control-label'>Date of Birth</label>
    <div class='col-md-3'>
      <input type='text' id='birth_date' onkeyup='nospaces(this);' class='form-control' placeholder='Enter date of birth'>
    </div>
  </div>
  <div class='form-group'>
    <label class="col-md-3 control-label">Working Time in Hours</label>
    <div class="col-md-3">
      <select id="work_time">
        <option value="0" >Select hours</option>
        <?php for ($i=2; $i < 25; $i++) { 
          echo "<option value='".$i."'>".$i."</option>";
        }?>
      </select>
    </div>
    <label class="col-md-2 control-label" >Work timings</label>
    <div class="col-md-4 input-group">
      <input type="text" id ="timing" class="form-control" placeholder="Enter Time" />
      <div class="input-group-addon">To</div>
      <input type="text" id ="timing2" class="form-control" placeholder="Enter Time" />
    </div>
  </div>
  <div class='form-group'>
    <label class='col-md-3 control-label'>Remarks</label>
    <div class='col-md-3'>
      <textarea type='text' id='remarks' class='form-control' placeholder='Remarks' rows='4'></textarea>
    </div>
    <label class='col-md-3 control-label'>Police Verification</label>
    <div class='col-md-3'>
      <select class='selectpicker' id='police' name='police' data-live-search='true' data-width='100%'> 
        <option value='yes'>yes </option>
        <option value='no'>no</option>
      </select>
    </div>
  </div>
  <div class='form-group'>
    <label class='col-md-3 control-label'>Languages</label>
    <div class='col-md-3'>
      <input type='text' id='languages' onkeyup='nospaces(this);' class='form-control' placeholder='Enter atleast one language' data-role='tagsinput'>
      <small class='help'>Enter multimple seperated by , </small>
    </div>
    <label class='col-md-3 control-label'>Services</label>
    <div class='col-md-3'>       
      <input type='text' id='services' onkeyup='nospaces(this);' class='form-control' placeholder='Enter atleast one Service' data-role='tagsinput'>
      <small class='help'>Enter multimple seperated by , </small>
    </div>
  </div>
  <div class='form-group'>
    <label class='col-md-3 control-label'>Enter New Skill </label>
    <div class='col-md-3'>
      <input type='text' id='newskill' onkeyup='nospaces(this);' class='form-control' placeholder='Enter Skill' data-role='tagsinput'>
    </div>
    <label class="col-md-2 control-label">or select Skills</label>
    <div class='col-md-2'>
      <select class='selectpicker' id='skills' onchange="getselectedskill(0, 3);" data-live-search='true' data-width='100%' > 
        <option value='0'>Select Skills </option>
        <?php 
          $skill = mysqli_query($db_handle, "SELECT * FROM skill_name ;");
           while($skillrow = mysqli_fetch_array($skill)){ 
            echo "<option value=".$skillrow['id'].">".$skillrow['name']."</option>";
          }
        ?>
      </select>
      <div id="selectedskills"></div>
    </div>
  </div>
  <div class='form-group'>
    <label class='col-md-3 control-label'>Enter New Worker Area </label>
    <div class='col-md-3'>
      <input type='text' id='worker_area' class='form-control' placeholder='Enter Worker area' data-role='tagsinput'>
    </div>
    <label class="col-md-2 control-label">or select Worker Area</label>
    <div class='col-md-2'>
      <select class='selectpicker' id='workerareas' onchange="getselectedarea(0, 4);" data-live-search='true' data-width='100%' > 
        <option value='0'>Select Worker Area </option>
        <?php 
          $area = mysqli_query($db_handle, "SELECT * FROM area ;");
           while($arearow = mysqli_fetch_array($area)){ 
            echo "<option value=".$arearow['id'].">".$arearow['name']."</option>";
          }
        ?>
      </select>
      <div id="selectedworkerareas"></div>
    </div>
  </div>
  <div class='form-group'>
    <label class='col-md-3 control-label'></label>
    <div class='col-md-7'>
      <button type='submit' class='btn btn-success pull-right' >Submit Details</button>
    </div>
  </div>
</form>