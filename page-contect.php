 <div class="page-content">
  <div id="tab-general">
      <div class="row mbl">
            <div class="col-lg-10">
                  <div class="panel-primary">

                        <?php if ($_SESSION["employee_type"] ==  "me"  ) {

                              $condition = "";
                              if ($status == "me_picked") $condition = "AND match_id == null AND me_id = " . $user_id;
                              if ($status != "cem_open") $condition = "AND match_id != null" . "AND me_id = " . $user_id ;
                              //echo "SELECT * FROM service_request WHERE status = '$status' AND work_time !='24' ".$condition."; ";
                              $srs = mysqli_query($db_handle, "SELECT * FROM service_request WHERE status = '$status' AND work_time !='24' ".$condition."; ") ;
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

                                          <?php if($status == "open") { ?>
                                          <input type="submit" class="btn btn-primary pull-right" name="action" value="Pick" onclick="ChangeServiceRequestStatus(<?= $srsrow['id'] ?>, 'open', 'me_picked')">
                                          <?php } else { ?>
                                          <input type="submit" class="btn btn-primary pull-right" name="action" value="Add Worker1" onclick="ChangeServiceRequestStatus(<?= $srsrow['id'] ?>, 'open', 'me_picked')">

                                          <form class="form-horizontal" id="worker_details_form" onsubmit="return (validateWorkerDetails());">

                                            <div class="form-group">

                                                <label class="col-md-3 control-label">First Name</label>

                                                <div class="col-md-3">
                                                    <input type="text" id ="first_name" class="form-control" placeholder="First Name" />
                                              </div> <!-- /.col -->

                                              <label class="col-md-1 control-label">Last Name</label>

                                              <div class="col-md-3">
                                                    <input type="text" id ="last_name" class="form-control" placeholder="Last Name" />
                                              </div> <!-- /.col -->


                                        </div> <!-- /.form-group -->

                                        <div class="form-group">

                                          <label class="col-md-3 control-label">Address Proof</label>

                                          <div class="col-md-3">

                                                <select class="selectpicker" id="address_proof_name" name="address_proof_name" data-live-search="true" data-width="100%">    
                                                  <option value='Voter Id' >Voter Id </option>
                                                  <option value='Adhaar Card' >Adhaar Card</option>
                                                  <option value='Driving License' >Driving License</option>
                                                  <option value='Driving License' >Education Certificate</option>
                                                  <option value='Driving License' >Bank Account</option>
                                            </select>

                                      </div> <!-- /.col -->

                                      <label class="col-md-1 control-label">Address Proof No</label>

                                      <div class="col-md-3">
                                          <input type="text" id ="address_proof_id" class="form-control" placeholder="Address Proof Id" />
                                    </div> <!-- /.col -->

                              </div> <!-- /.form-group -->

                              <div class="form-group">

                                    <label class="col-md-3 control-label">Id Proof</label>

                                    <div class="col-md-3">

                                          <select class="selectpicker" id="id_proof_name" name="id_proof_name" data-live-search="true" data-width="100%">    
                                            <option value='Voter Id' >Voter Id </option>
                                            <option value='Adhaar Card' >Adhaar Card</option>
                                            <option value='Driving License' >Driving License</option>
                                            <option value='Driving License' >Education Certificate</option>
                                            <option value='Driving License' >Bank Account</option>
                                      </select>

                                </div> <!-- /.col -->
                                <label class="col-md-1 control-label">Id Proof No</label>
                                <div class="col-md-3">
                                    <input type="text" id ="id_proof_id" class="form-control" placeholder="Id Proof Id" />
                              </div> <!-- /.col -->

                        </div> <!-- /.form-group -->

                        <div class="form-group">
                              <label class="col-md-3 control-label">Mobile No.</label>
                              <div class="col-md-3">
                                    <input type="text" id="mobile" class="form-control" placeholder="Enter 10 digit mobile number">
                              </div>
                              
                              <label class="col-md-1 control-label">Emergancy Mobile No.</label>
                              <div class="col-md-3">
                                    <input type="text" id="emergancy_mobile" class="form-control" placeholder="Enter 10 digit mobile number">
                              </div>
                        </div>

                        <div class="form-group">
                              <label class="col-md-3 control-label">Address</label>
                              <div class="col-md-3">
                                    <textarea type="text" id="address" class="form-control" placeholder="Full Address" rows="4"></textarea>
                              </div>

                              <label class="col-lg-1 control-label">Gender</label>
                              <div class="col-lg-3">
                                    <div class="radio">
                                          <label class="form-radio form-icon">
                                                <input type="radio" name="gender" value="Male"> Male
                                          </label>

                                          <label class="form-radio form-icon">
                                                <input type="radio" name="gender" value="Female"> Female
                                          </label>

                                          <label class="form-radio form-icon">
                                                <input type="radio" name="gender" value="Other"> Other
                                          </label>
                                    </div>
                              </div>



                        </div>

                        <div class="form-group">
                              <label class="col-md-3 control-label">Highest Education</label>
                              <div class="col-md-3">
                                    <input type="text" id="education" class="form-control" placeholder="Highest Education ">
                              </div>

                              <label class="col-md-1 control-label">Experience</label>
                              <div class="col-md-3">
                                    <input type="text" id="experience" class="form-control" placeholder="Experience in Years 2">
                                    <small class="help">Enter only digit like 2 for 2 years</small>
                              </div>

                        </div>

                        <div class="form-group">
                              <label class="col-md-3 control-label">Languages Known</label>
                              <div class="col-md-3">
                                    <input type="text" id="languages" class="form-control" placeholder="Enter atleast one language" data-role="tagsinput">
                                    <small class="help">Enter multimple seperated by , or Enter</small>
                              </div>
                              
                              <label class="col-md-1 control-label">Skills</label>
                              <div class="col-md-3">
                                    <input type="text" id="skills"  class="form-control" placeholder="Enter atleast one skill" data-role="tagsinput">
                                    <small class="help">Enter multimple seperated by , or Enter</small>
                              </div>
                        </div>

                        <div class="form-group">

                              <label class="col-md-3 control-label">Current Working City</label>

                              <div class="col-md-3">
                                    <input type="text" id ="current_working_city" class="form-control" placeholder="Current Working City" />       
                              </div> <!-- /.col -->

                              <label class="col-md-1 control-label">Area</label>

                              <div class="col-md-3">
                                    <input type="text" id ="current_working_area" class="form-control" placeholder="Current Working Area" />
                              </div> <!-- /.col -->

                        </div> <!-- /.form-group -->

                        <div class="form-group">

                              <label class="col-md-3 control-label">Preferred Working City</label>

                              <div class="col-md-3">
                                    <input type="text" id ="preferred_working_city" class="form-control" placeholder="Preferred Working City" />       
                              </div> <!-- /.col -->

                              <label class="col-md-1 control-label">Area</label>

                              <div class="col-md-3">
                                    <input type="text" id ="preferred_working_area" class="form-control" placeholder="Preferred Working Area" />
                              </div> <!-- /.col -->

                        </div> <!-- /.form-group -->

                        <div class="form-group">
                              <label class="col-md-3 control-label">Working Domain</label>
                              <div class="col-md-3">
                                    <input type="text" id="working_domain" class="form-control" placeholder="Field of work">
                                    <small class="help"></small>
                              </div>

                              <label for="demo-msk-date" class="col-md-1 control-label">Date of Birth</label>
                              <div class="col-md-3">
                                    <input type="text" id="birth_date" class="form-control" placeholder="dd/mm/yyyy">
                              </div>

                        </div>

                        <div class="form-group">
                              <label class="col-md-3 control-label">Timings</label>
                              <div class="col-md-3">
                                    <input type="text" id="timings" class="form-control" placeholder="Timings">
                                    <small class="help"></small>
                              </div>

                              <label for="demo-msk-date" class="col-md-1 control-label">Home Town/state</label>
                              <div class="col-md-3">
                                    <input type="text" id="home_town" class="form-control" placeholder="hometown/state">
                              </div>

                        </div>

                        <div class="form-group">
                              <label class="col-md-3 control-label">Remarks</label>
                              <div class="col-md-3">
                                    <textarea type="text" id="remarks" class="form-control" placeholder="Remarks" rows="4"></textarea>
                              </div>

                              <label class="col-lg-1 control-label">Police Verification</label>
                              <div class="col-lg-3">
                                    <div class="radio">
                                          <label class="form-radio form-icon">
                                                <input type="radio" name="police" value="yes"> yes
                                          </label>

                                          <label class="form-radio form-icon">
                                                <input type="radio" name="police" value="no"> no
                                          </label>
                                    </div>
                              </div>



                        </div>
                              <!-- <div class="form-group">
                                    <label class="col-md-3 control-label">Working Time Slots</label>

                                    <div class="col-md-7 input-group date">
                                          <input id="working_slot1_from" type="text" class="form-control"> To 
                                          <input id="working_slot1_to" type="text" class="form-control">
                                          <span class="input-group-addon"><i class="fa fa-clock-o fa-lg"></i></span>
                                    </div>
                              </div>

                              <div class="form-group">
                                    <label class="col-md-3 control-label">Free Time Slots</label>

                                    <div class="col-md-7 input-group date">
                                          <input id="free_slot1_from" type="text" class="form-control"> To
                                          <input id="free_slot1_to" type="text" class="form-control">
                                          <span class="input-group-addon"><i class="fa fa-clock-o fa-lg"></i></span>
                                    </div>
                              </div> -->

                              <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-7">
                                  <button type="submit" class="btn btn-success">Submit Details</button>
                            </div>
                      </div> <!-- /.form-group -->

                </form>



                <input type="submit" class="btn btn-primary pull-right" name="action" value="Add Worker2" onclick="ChangeServiceRequestStatus(<?= $srsrow['id'] ?>, 'open', 'me_picked')">
                <?php } ?>
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
