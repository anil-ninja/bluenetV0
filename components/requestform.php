<?php require_once "dbConnection.php" ;?>
<form class="form-horizontal" id="request_details_form" onsubmit='return (validateRequestDetails());'>
  <div class="form-group">
    <label class="col-md-3 control-label">Name</label>
    <div class="col-md-3">
      <input type="text" id ="name"  class="form-control" placeholder="Name" />
    </div> <!-- /.col -->
    <label class="col-md-2 control-label">Mobile No.</label>
    <div class="col-md-3">
      <input type="text" id ="mobile" onkeyup='nospaces(this);' class="form-control" placeholder="Enter 10 digit mobile number" />
    </div> <!-- /.col -->
  </div> <!-- /.form-group -->
  <div class="form-group">
    <label class="col-md-3 control-label">address</label>
    <div class="col-md-3">
	    <input type="text" id ="address" class="form-control" placeholder="address" />
    </div>
    <label class="col-md-2 control-label" >Worker timings</label>
    <div class="col-md-4 input-group">
      <input type="text" id ="timing" class="form-control" placeholder="Enter Time" />
      <div class="input-group-addon">To</div>
      <input type="text" id ="timing2" class="form-control" placeholder="Enter Time" />
    </div>
    <!-- <label class="col-md-1 control-label">Worker timings</label>
    <div class="col-md-3">
	    <input type="text" id ="timing" class="form-control" placeholder="Working Hours" />
    </div>  --><!-- /.col -->
  </div> <!-- /.form-group -->
	<div class="form-group">
	 	<label class="col-md-3 control-label">Status</label>
		<div class="col-md-3">
			<select id="new_status">
				<option value="open" selected>Open</option>
				<option value="salary_issue" >Salary Issues</option>
				<option value="not_interested" >Not Interested</option>
				<option value="done" >Done</option>
				<option value="decay" >Decay</option>
				<option value="delete" >Delete</option>
				<option value="just_to_know" >For information Purpose</option>
				<option value="feedback" >Feedback</option>
				<option value="followback" >Follow back</option>
			</select>
		</div>
   	<label class="col-md-2 control-label">Gender</label>
   	<div class="col-md-3">
     	<select id = "gender" > 
				<option value="male" >Male</option>
				<option value="female" selected>Female</option>
				<option value="any">Any</option>
			</select>
	 	</div>
	</div>
	<div class="form-group">
    <label class="col-md-3 control-label">Remarks</label>
    <div class="col-md-3 input-group">
      <input type="text" id ="remarks" class="form-control" placeholder="remarks" />
    </div>
  </div>
  <div class="form-group">
	 	<label class="col-md-3 control-label">Expected Salary</label>
    <div class="col-md-4 input-group">
      <input type="number" id ="salary" class="form-control" placeholder="Enter Salary" />
      <div class="input-group-addon">To</div>
      <input type="number" id ="salary2" class="form-control" placeholder="Enter Salary" />
    </div>
	</div>
	<div class="form-group">
		<label class="col-md-3 control-label">Working Time in Hours</label>
	 	<div class="col-md-3">
      <select id="work_time">
        <option value="0" >Select hours</option>
        <?php for ($i=2; $i < 25; $i++) { 
          echo "<option value='".$i."'>".$i."</option>";
        }?>
      </select>
	 	</div>
	 	<label class="col-md-2 control-label">Created Date</label>
	 	<div class="col-md-3">
	   	<input type="text" id ="created_time" onkeyup='nospaces(this);' class="form-control" placeholder="Enter Date" />
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
    <label class='col-md-3 control-label'>Enter New Area </label>
    <div class='col-md-3'>
      <input type='text' id='newarea' class='form-control' placeholder='Enter Area' data-role='tagsinput'>
    </div>
    <label class="col-md-2 control-label">or select Areas</label>
    <div class='col-md-2'>
      <select class='selectpicker' id='areas' onchange="getselectedarea(0, 3);" data-live-search='true' data-width='100%' > 
        <option value='0'>Select Area </option>
        <?php 
          $area = mysqli_query($db_handle, "SELECT * FROM area ;");
           while($arearow = mysqli_fetch_array($area)){ 
            echo "<option value=".$arearow['id'].">".$arearow['name']."</option>";
          }
        ?>
      </select>
      <div id="selectedareas"></div>
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
  <div class="form-group">
    <label class="col-md-3 control-label">Priority</label>
    <div class="col-md-3">
      <select id="priority">
          <option value="0" >Set Priority</option>
          <?php for ($i=1; $i < 11; $i++) { 
            echo "<option value='".$i."'>".$i."</option>";
          }?>
      </select>
    </div>
  </div>
	<div class="form-group">
	 	<label class="col-md-3 control-label">Requierment</label>
	 	<div class="col-md-6 ">
	   	<input type="checkbox" name = "skill" value ='maid' /> Maid &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name = "skill" value ='cook' /> Cook &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name = "skill" value ='cook,maid' /> Maid + Cook &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name = "skill" value ='cook,babysitter' /> Cook + Babysitter &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name = "skill" value ='maid,babysitter' /> Maid  + Babysitter &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" name = "skill" value ='driver' /> driver &nbsp;&nbsp;&nbsp;&nbsp;         
			<input type="checkbox" name = "skill" value ='electrician' /> electrician &nbsp;&nbsp;&nbsp;&nbsp;           
			<input type="checkbox" name = "skill" value ='plumber' /> Plumber &nbsp;&nbsp;&nbsp;&nbsp;        
			<input type="checkbox" name = "skill" value ='carpenter' /> Carpenter &nbsp;&nbsp;&nbsp;&nbsp;     
			<input type="checkbox" name = "skill" value ='babysitter' /> Babysitter &nbsp;&nbsp;&nbsp;&nbsp;           
			<input type="checkbox" name = "skill" value ='oldage' /> Old age care &nbsp;&nbsp;&nbsp;&nbsp;          
			<input type="checkbox" name = "skill" value ='patient' />  Patient care &nbsp;&nbsp;&nbsp;
	 	</div> 
	</div>
	<div class="form-group">
	  <label class="col-md-3 control-label"></label>
	  <div class="col-md-7">
	    <button type="submit" class="btn btn-success pull-right">Insert</button>
	  </div>
	</div> <!-- /.form-group -->
</form>