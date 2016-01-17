 <div class="page-content">
          <div id="tab-general">
            <div class="row mbl">
                        <div class="col-lg-10">
                              <div class="panel-primary">
                        
                        <?php if ($_SESSION["employee_type"] ==  "me" && $status == "open" ) { 
                              $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE status = '$status' AND work_time !='24'; ") ;
                              while ($srsrow = mysqli_fetch_array($srs)){
                              ?>
				<div class="note note-success">
                        	<p style="font-size:20px;padding-left: 2em;">
                              Worker Area  <span style="padding-left: 9em"><?= $srsrow['worker_area'] ?></span><br/>
                        	Area  <span style="padding-left: 9em"><?= $srsrow['area'] ?></span><br/>
                        	Requirements <span style="padding-left: 5em">$srsrow['requirements']</span><br/>
                        	Timings <span style="padding-left: 8em"><?= $srsrow['timings'] ?></span><br/>
                        	Working Time <span style="padding-left: 5em"><?= $srsrow['work_time'] ?> hours</span><br/>
                        	Salary Criteria <span style="padding-left: 5em"><?= $srsrow['expected_salary'] ?></span> <br/>
                        	Remarks <span style="padding-left: 7em"><?= $srsrow['remarks'] ?></span><br/>
                        	Skills <span style="padding-left: 9em">Ironing, pet care, helping</span> 
                        	
                        		<input type="submit" class="btn btn-primary pull-right" name="action" value="Pick" onclick="ChangeServiceRequestStatus(<?= $srsrow['id'] ?>, 'open', 'me_picked')">
                        	 <br/></p>
                        </div>

                        <?php }} ?>

                        <div class="note note-success">
                        	<p style="font-size:20px;padding-left: 2em;">
                        	Area  <span style="padding-left: 9em">Chakkarpur</span><br/>
                        	Requirements <span style="padding-left: 5em">Maid</span><br/>
                        	Timings <span style="padding-left: 8em">7am to 7pm</span><br/>
                        	Working Time <span style="padding-left: 5em">12 hours</span><br/>
                        	Salary Criteria <span style="padding-left: 5em">7k to 9k</span> <br/>
                        	Remarks <span style="padding-left: 7em">Female, age between 35 to 45</span><br/>
                        	Skills <span style="padding-left: 9em">Ironing, pet care, helping</span> 
                        	<form method="post">
                        		<input type="submit" class="btn btn-primary pull-right" value="Pick">
                        	</form>  <br/></p>
                        </div>
                        <div class="note note-success">
                        	<p style="font-size:20px;padding-left: 2em;">
                        	Area  <span style="padding-left: 9em">Chakkarpur</span><br/>
                        	Requirements <span style="padding-left: 5em">Maid</span><br/>
                        	Timings <span style="padding-left: 8em">7am to 7pm</span><br/>
                        	Working Time <span style="padding-left: 5em">12 hours</span><br/>
                        	Salary Criteria <span style="padding-left: 5em">7k to 9k</span> <br/>
                        	Remarks <span style="padding-left: 7em">Female, age between 35 to 45</span><br/>
                        	Skills <span style="padding-left: 9em">Ironing, pet care, helping</span> 
                        	<form method="post">
                        		<input type="submit" class="btn btn-primary pull-right" value="Pick">
                        	</form>  <br/></p>
                        </div>
                        <div class="note note-success">
                        	<p style="font-size:20px;padding-left: 2em;">
                        	Area  <span style="padding-left: 9em">Chakkarpur</span><br/>
                        	Requirements <span style="padding-left: 5em">Maid</span><br/>
                        	Timings <span style="padding-left: 8em">7am to 7pm</span><br/>
                        	Working Time <span style="padding-left: 5em">12 hours</span><br/>
                        	Salary Criteria <span style="padding-left: 5em">7k to 9k</span> <br/>
                        	Remarks <span style="padding-left: 7em">Female, age between 35 to 45</span><br/>
                        	Skills <span style="padding-left: 9em">Ironing, pet care, helping</span> 
                        	<form method="post">
                        		<input type="submit" class="btn btn-primary pull-right" value="Pick">
                        	</form>  <br/></p>
                        </div>
                        <div class="note note-success">
                        	<p style="font-size:20px;padding-left: 2em;">
                        	Area  <span style="padding-left: 9em">Chakkarpur</span><br/>
                        	Requirements <span style="padding-left: 5em">Maid</span><br/>
                        	Timings <span style="padding-left: 8em">7am to 7pm</span><br/>
                        	Working Time <span style="padding-left: 5em">12 hours</span><br/>
                        	Salary Criteria <span style="padding-left: 5em">7k to 9k</span> <br/>
                        	Remarks <span style="padding-left: 7em">Female, age between 35 to 45</span><br/>
                        	Skills <span style="padding-left: 9em">Ironing, pet care, helping</span> 
                        	<form method="post">
                        		<input type="submit" class="btn btn-primary pull-right" value="Pick">
                        	</form>  <br/></p>
                        </div>
                        <div class="note note-success">
                        	<p style="font-size:20px;padding-left: 2em;">
                        	Area  <span style="padding-left: 9em">Chakkarpur</span><br/>
                        	Requirements <span style="padding-left: 5em">Maid</span><br/>
                        	Timings <span style="padding-left: 8em">7am to 7pm</span><br/>
                        	Working Time <span style="padding-left: 5em">12 hours</span><br/>
                        	Salary Criteria <span style="padding-left: 5em">7k to 9k</span> <br/>
                        	Remarks <span style="padding-left: 7em">Female, age between 35 to 45</span><br/>
                        	Skills <span style="padding-left: 9em">Ironing, pet care, helping</span> 
                        	<form method="post">
                        		<input type="submit" class="btn btn-primary pull-right" value="Pick">
                        	</form>  <br/></p>
                        </div>
                    </div>
				</div>
			</div>
		 </div>
      </div>
