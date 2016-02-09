<div class="panel panel-green">
  <div class="panel-heading">Search Request BY <i class="fa fa-bars pull-right" onclick='toggleform();'></i></div>
  <div class="panel-body pan searchform">
    <form class="form-horizontal" id="request_search_form" onsubmit='return (validateRequestSearch());'>
      <div class="form-group">
        <label class="col-md-3 control-label">Select Gender</label>
        <div class="col-md-3">
          <select id = "gender" > 
            <option value="male" >Male</option>
            <option value="female" selected>Female</option>
            <option value="any">Any</option>
          </select>
        </div> <!-- /.col -->
        <label class="col-md-2 control-label">Min. Salary </label>
        <div class="col-md-3">
          <input type="number" id ="salary" onkeyup='nospaces(this);' class="form-control" placeholder="Enter number" />
        </div> <!-- /.col -->
      </div> <!-- /.form-group -->
      <div class="form-group">
        <label class="col-md-3 control-label">Work Time </label>
        <div class="col-md-3">
          <select id="work_time">
            <option value="0" >Select hours</option>
            <?php for ($i=2; $i < 25; $i++) { 
              echo "<option value='".$i."'>".$i."</option>";
            }?>
          </select>
        </div>
        <label class="col-md-2 control-label" >Worker Area</label>
        <div class="col-md-3">
          <input type="text" id ="area" class="form-control" placeholder="Enter Area" />
        </div>
      </div> 
      <div class="form-group">
       	<label class="col-md-3 control-label">Requirement</label>
        <div class="col-md-3">
					<select id="skill">
						<option value="maid" selected>Maid</option>
						<option value="cook" >Cook</option>
						<option value="babysitter" >Babysitter</option>
						<option value="driver" >Driver</option>
						<option value="electrician" >Electrician</option>
						<option value="plumber" >Plumber</option>
						<option value="carpenter" >Carpenter</option>
						<option value="oldage" >Old age care</option>
						<option value="patient" >Patient care</option>
					</select>
				</div>
      </div>
			<div class="form-group">
			  <label class="col-md-3 control-label"></label>
			  <div class="col-md-7">
			    <button type="submit" class="btn btn-success pull-right">Search</button>
			  </div>
			</div> 
    </form>
  </div>
</div>