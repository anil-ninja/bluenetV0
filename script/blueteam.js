function genericEmptyFieldValidator(fields){
  returnBool = true;
  $.each(fields, function( index, value ) {
    console.log(value);
    if($('#'+value).val() == "" || $('#'+value).val() == null){
      $('#'+value).keypress(function() {
        genericEmptyFieldValidator([value]);
      });
      $('#'+value).css("border-color", "red");
      returnBool = false;
    }
    else {
      $('#'+value).css("border-color", "blue");
    }
  });
  return returnBool;
}

function postWorkerDetails(fields, languagesArray, skillsArray, request_id, id) {
  var dataString = "";
  dataString = "first_name=" + $('#'+fields[0]).val() + "&last_name=" + $('#'+fields[1]).val() +
      "&address_proof_name=" + $('#'+fields[2]).val() + "&address_proof_id=" + $('#'+fields[3]).val() + 
      "&id_proof_name=" + $('#'+fields[4]).val() + "&id_proof_id=" +  $('#'+fields[5]).val() + 
      "&mobile=" +  $('#'+fields[6]).val() + "&emergancy_mobile=" +  $('#'+fields[7]).val() + 
      "&age=" +  $('#'+fields[8]).val() + "&expected_salary=" + $('#'+fields[9]).val() +
      "&current_address=" + $('#'+fields[10]).val() + "&parmanent_address=" +  $('#'+fields[11]).val() + 
      "&education=" + $('#'+fields[12]).val() + "&experience=" + $('#'+fields[13]).val()+ 
      "&gender=" +  $('#'+fields[14]).val() + "&birth_date=" + $('#'+fields[15]).val() +
      "&timings=" + $('#'+fields[16]).val() + "&work_time=" + $('#'+fields[17]).val() +
      "&remarks=" + $('#'+fields[18]).val() + "&police=" + $('#'+fields[19]).val() +
      "&languages=" + languagesArray + "&skills=" + skillsArray + "&request_id=" + request_id + 
      "&id=" + id ;/*+"&police=" + $("input[name='police']:checked").val()*/ 
  console.log(dataString);
  $.ajax({
    type: "POST",
    url: "ajax/addWorker.php",
    data: dataString,
    cache: false,
    success: function(result){
      console.log(result);
      $(fields).each(function(i, idVal){ 
        $("#"+idVal).val(""); 
      });
      $('#languages').val("");
      $('#skills').val("");
      //alert("Added Successfully");
      location.reload();
    },
    error: function(result){
      //alert(result);
      return false;
    }
  });
}

function validateWorkerDetails(request_id, id){
  if(id == 1) {
    fields = ["first_name"+request_id,"last_name"+request_id,"address_proof_name"+request_id, "address_proof_id"+request_id, 
            "id_proof_name"+request_id, "id_proof_id"+request_id, "mobile"+request_id, "emergancy_mobile"+request_id, "age"+request_id,  
            "expected_salary"+request_id, "current_address"+request_id, "parmanent_address"+request_id, "education"+request_id, 
            "experience"+request_id, "gender"+request_id,"birth_date"+request_id, "timings"+request_id, "work_time"+request_id, "remarks"+request_id,
            "police"+request_id];
    var languagesArray = []; 
    $('#languages'+request_id).each(function(i, selected){ 
      languagesArray[i] = $(selected).val(); 
    });
    var skillsArray = []; 
    $('#skills'+request_id).each(function(i, selected){ 
      skillsArray[i] = $(selected).val(); 
    });
  }
  else if(id == 2){
    fields = ["2first_name"+request_id,"2last_name"+request_id,"2address_proof_name"+request_id, "2address_proof_id"+request_id, 
            "2id_proof_name"+request_id, "2id_proof_id"+request_id, "2mobile"+request_id, "2emergancy_mobile"+request_id, "2age"+request_id,  
            "2expected_salary"+request_id, "2current_address"+request_id, "2parmanent_address"+request_id, "2education"+request_id, 
            "2experience"+request_id, "2gender"+request_id,"2birth_date"+request_id, "2timings"+request_id, "2work_time"+request_id, "2remarks"+request_id,
            "2police"+request_id];
    var languagesArray = []; 
    $('#2languages'+request_id).each(function(i, selected){ 
      languagesArray[i] = $(selected).val(); 
    });
    var skillsArray = []; 
    $('#2skills'+request_id).each(function(i, selected){ 
      skillsArray[i] = $(selected).val(); 
    });
  }
  else {
    fields = ["first_name","last_name","address_proof_name", "address_proof_id", 
            "id_proof_name", "id_proof_id", "mobile", "emergancy_mobile", "age",  
            "expected_salary", "current_address", "parmanent_address", "education", 
            "experience", "gender","birth_date", "timings", "work_time", "remarks",
            "police"];
    var languagesArray = []; 
    $('#2languages').each(function(i, selected){ 
      languagesArray[i] = $(selected).val(); 
    });
    var skillsArray = []; 
    $('#2skills').each(function(i, selected){ 
      skillsArray[i] = $(selected).val(); 
    });
  }
  if(genericEmptyFieldValidator(fields)){
    postWorkerDetails(fields, languagesArray, skillsArray, request_id, id);
  }
 return false;
}

function postRequestDeatils(fields, skills, areas) {

  var dataString = "";
  dataString = "name=" + $('#'+fields[0]).val() + "&mobile=" + $('#'+fields[1]).val() + "&address=" + $('#'+fields[2]).val() + 
      "&timing=" + $('#'+fields[3]).val() + "&new_status=" + $('#'+fields[4]).val() + "&gender=" +  $('#'+fields[5]).val() + 
      "&salary=" +  $('#'+fields[6]).val() + "&area=" +  $('#'+fields[7]).val() + "&work_time=" +  $('#'+fields[8]).val() + 
      "&created_time=" + $('#'+fields[9]).val() + "&remarks=" + $('#'+fields[10]).val() + "&worker_area=" +  areas + "&skills=" + skills ; 
  $.ajax({
    type: "POST",
    url: "ajax/addRequest.php",
    data: dataString,
    cache: false,
    success: function(result){
      
      $(fields).each(function(i, idVal){ 
        $("#"+idVal).val(""); 
      });
      $('#worker_area').val("");
      
      alert("Added Successfully");
      location.reload();
    },
    error: function(result){
      alert(result);
      return false;
    }
  });
}

function validateRequestDetails(){
  
  fields = ["name","mobile","address","timing","new_status","gender","salary","area","work_time","created_time","remarks"];
  var areasArray = []; 
  $('#worker_area').each(function(i, selected){ 
    areasArray[i] = $(selected).val(); 
  });
  var skillsArray = []; 
  $('input[name=skill]:checked').each(function(i, checked){ 
    skillsArray[i] = $(checked).val(); 
  });
  if(genericEmptyFieldValidator(fields)){
    postRequestDeatils(fields, skillsArray, areasArray);
  }
  return false;
}

function postUserDeatils(fields){
  var dataString = "";
  dataString = "first_name=" + $('#'+fields[0]).val() + "&last_name=" + $('#'+fields[1]).val() + "&email=" + $('#'+fields[2]).val() + 
      "&phone=" + $('#'+fields[3]).val() + "&employee_type=" + $('#'+fields[4]).val() + "&salary=" +  $('#'+fields[5]).val() + 
      "&password=" +  $('#'+fields[6]).val() ;
  if($('#'+fields[0]).val().length < 3){
    alert("First Name is too short");
  }
  else if($('#'+fields[1]).val().length < 3){
    alert("Last Name is too short");
  }
  else if($('#'+fields[2]).val().length < 8){
    alert("Enter valid email");
  }
  else if($('#'+fields[3]).val().length < 10){
    alert("Enter valid phone number");
  }
  else if($('#'+fields[5]).val().length < 3){
    alert("Enter valid Base salary");
  }
  else if($('#'+fields[6]).val().length < 6){
    alert("Password length should be more than 6 chars");
  }
  else if($('#'+fields[6]).val() == $('#'+fields[7]).val()){ 
    $.ajax({
      type: "POST",
      url: "ajax/addUser.php",
      data: dataString,
      cache: false,
      success: function(result){
        
        $(fields).each(function(i, idVal){ 
          $("#"+idVal).val(""); 
        });
        alert("Added Successfully");
        location.reload();
      },
      error: function(result){
        alert(result);
        return false;
      }
    });
  }
  else {
    alert("Password do not match");
  }
}

function validateUserDetails(){
  fields = ["first_name","last_name","email","phone","employee_type", "salary", "password","password2"];
  if(genericEmptyFieldValidator(fields)){
    postUserDeatils(fields);
  }
  return false;
}

function postMeetingDeatils(fields, id) {

  var dataString = "";
  dataString = "remark=" + $('#'+fields[2]).val() + "&date=" + $('#'+fields[0]).val()+" "+$('#'+fields[1]).val() + ":00" 
                + "&worker=" + $('#'+fields[3]).val() + "&id=" + id ; 
  $.ajax({
    type: "POST",
    url: "ajax/addMeeting.php",
    data: dataString,
    cache: false,
    success: function(result){
      
      $(fields).each(function(i, idVal){ 
        $("#"+idVal).val(""); 
      });      
      alert("Added Successfully");
      location.reload();
    },
    error: function(result){
      alert(result);
      return false;
    }
  });
}

function validateMeetingDetails(id){
  
  fields = ["date"+id,"time"+id,"remark"+id, "worker"+id];
  
  if(genericEmptyFieldValidator(fields)){
    postMeetingDeatils(fields, id);
  }
  return false;
}

function workerDetails(id, type){
  $.ajax({
    type: "POST",
    url: "ajax/workerDetails.php",
    data: "id="+ id + "&type=" + type,
    cache: false,
    success: function(result){
      //alert(result);
      $("#workerform_"+id).show().html(result); 
    },
    error: function(result){
      alert("Error Occured");
      return false;
    }
  });
}

function addnote(id, type){
  var dataString = "";
  var note = $("#note").val() ;
  if(genericEmptyFieldValidator(note)){
    dataString = "id=" + id + "&type=" + type + "&note=" + note;
    $.ajax({
      type: "POST",
      url: "ajax/addnote.php",
      data: dataString,
      cache: false,
      success: function(result){
      },
      error: function(result){
        console.log("inside error");
        console.log(result);
        return false;
      }
    });
    return false;
  }
  return false;
}

function ChangeServiceRequestStatus(id, oldStatus, newStatus) {
  var dataString = "";
  dataString = "sr_id=" + id + "&old_status=" + oldStatus + "&new_status=" + newStatus;
  $.ajax({
    type: "POST",
    url: "ajax/ChangeServiceRequestStatus.php",
    data: dataString,
    cache: false,
    success: function(result){
    },
    error: function(result){
      console.log("inside error");
      console.log(result);
      return false;
    }
  });
  return false;
}

function addmeeting(id){
  var meeting = "<form class='form-horizontal' id='meeting_details_form"+id+"' onsubmit='return (validateMeetingDetails("+id+"));'>" +
                  "<div class='form-group'>"+
                    "<label class='col-md-2 control-label'>Date</label>"+
                    "<div class='col-md-4'>"+
                      "<input type='text' id ='date"+id+"' class='form-control' placeholder='Enter Date in yyyy-mm-dd' />"+
                    "</div>"+
                    "<label class='col-md-2 control-label'>Time</label>"+
                    "<div class='col-md-4'>"+
                      "<input type='text' id ='time"+id+"' class='form-control' placeholder='Enter Time in hh:mm' />"+
                    "</div>"+
                  "</div>"+
                  "<div class='form-group'>"+
                    "<label class='col-md-3 control-label'>Remarks</label>"+
                    "<div class='col-md-3'>"+
                      "<input type='text' id ='remark"+id+"' class='form-control' placeholder='Enter remarks' />"+
                    "</div>"+
                    "<label class='col-md-3 control-label'>Worker</label>"+
                    "<div class='col-md-3'>"+
                      "<select id='worker"+id+"'>"+
                        "<option value='1' >Worker 1</option>"+
                        "<option value='2' >Worker 2</option>"+
                      "</select>"+
                    "</div>"+
                  "</div>"+
                  "<div class='form-group'>"+
                    "<label class='col-md-3 control-label'></label>"+
                    "<div class='col-md-7'>"+
                      "<button type='submit' class='btn btn-success pull-right' >Submit Details</button>"+
                    "</div>"+
                  "</div>"+
                "</form>";
  $("#workerform_"+id).show().html(meeting);
}

function mePick(id) {
  bootbox.confirm("Ready to work !!!", function(result) {
    if(result){
      $.ajax({
        type: "POST",
        url: "ajax/pick.php",
        data: "request_id="+id,
        cache: false,
        success: function(result){
          location.reload();
        },
        error: function(result){
          console.log("inside error");
          console.log(result);
          return false;
        }
      });
    }
  });
}

function addworker(request_id, id){
  if (id == 1){
    var worker_modal = "<form class='form-horizontal' id='worker_details_form"+request_id+"' onsubmit='return (validateWorkerDetails("+request_id+","+ id+"));'>" +
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>First Name</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='first_name"+request_id+"' class='form-control' placeholder='First Name' />"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Last Name</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='last_name"+request_id+"' class='form-control' placeholder='Last Name' />"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Address Proof Name</label>"+
                        "<div class='col-md-3'>"+
                          "<select class='selectpicker' id='address_proof_name"+request_id+"' data-live-search='true' data-width='100%'>"+ 
                            "<option value='Voter Id' >Voter Id </option>"+
                            "<option value='Adhaar Card' >Adhaar Card</option>"+
                            "<option value='Driving License' >Driving License</option>"+
                            "<option value='Education Certificate' >Education Certificate</option>"+
                            "<option value='Bank Account' >Bank Account</option>"+
                            "<option value='Passport' >Passport</option>"+
                          "</select>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Address Proof No</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='address_proof_id"+request_id+"' class='form-control' placeholder='Address Proof Id' />"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Id Proof Name</label>"+
                        "<div class='col-md-3'>"+
                          "<select class='selectpicker' id='id_proof_name"+request_id+"' data-live-search='true' data-width='100%'>"+    
                            "<option value='Voter Id' >Voter Id </option>"+
                            "<option value='Adhaar Card' >Adhaar Card</option>"+
                            "<option value='Driving License' >Driving License</option>"+
                            "<option value='Education Certificate' >Education Certificate</option>"+
                            "<option value='Bank Account' >Bank Account</option>"+
                            "<option value='Passport' >Passport</option>"+
                          "</select>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Id Proof No</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='id_proof_id"+request_id+"' class='form-control' placeholder='Id Proof Id' />"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Mobile No.</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='mobile"+request_id+"' class='form-control' placeholder='Enter 10 digit mobile number'>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Emergancy Mobile No.</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='emergancy_mobile"+request_id+"' class='form-control' placeholder='Enter 10 digit mobile number'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Age</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='age"+request_id+"' class='form-control' placeholder='Age in years'>"+
                        "</div>"+
                        "<label for='demo-msk-date' class='col-md-3 control-label'>Expected Salary</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='expected_salary"+request_id+"' class='form-control' placeholder='Expected Salary'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Current address</label>"+
                        "<div class='col-md-3'>"+
                          "<textarea type='text' id='current_address"+request_id+"' class='form-control' placeholder='Full Address' rows='4'></textarea>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Parmanent address</label>"+
                        "<div class='col-md-3'>"+
                          "<textarea type='text' id='parmanent_address"+request_id+"' class='form-control' placeholder='Full Address' rows='4'></textarea>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Highest Education</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='education"+request_id+"' class='form-control' placeholder='Highest Education'>"+
                        "</div>"+
                        "<label for='demo-msk-date' class='col-md-3 control-label'>Experience</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='experience"+request_id+"' class='form-control' placeholder='Experience in Years'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-lg-3 control-label'>Gender</label>"+
                        "<div class='col-lg-3'>"+
                          "<select class='selectpicker' id='gender"+request_id+"' data-live-search='true' data-width='100%'>" +   
                            "<option value='Male'>Male </option>"+
                            "<option value='Female'>Female</option>"+
                            "<option value='Other'>Other</option>"+
                          "</select>"+
                        "</div>"+
                        "<label for='demo-msk-date' class='col-md-3 control-label'>Date of Birth</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='birth_date"+request_id+"' class='form-control' placeholder='dd/mm/yyyy'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Timings</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='timings"+request_id+"' class='form-control' placeholder='Timings'>"+
                        "</div>"+
                        "<label for='demo-msk-date' class='col-md-3 control-label'>Working Hours</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='work_time"+request_id+"' class='form-control' placeholder='Working time in hours'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Remarks</label>"+
                        "<div class='col-md-3'>"+
                          "<textarea type='text' id='remarks"+request_id+"' class='form-control' placeholder='Remarks' rows='4'></textarea>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Police Verification</label>"+
                        "<div class='col-md-3'>"+
                          "<select class='selectpicker' id='police"+request_id+"' name='police' data-live-search='true' data-width='100%'>" +   
                            "<option value='yes'>yes </option>"+
                            "<option value='no'>no</option>"+
                          "</select>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Languages</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='languages"+request_id+"' class='form-control' placeholder='Enter atleast one language' data-role='tagsinput'>" +
                          "<small class='help'>Enter multimple seperated by , or Enter</small>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Skills</label>"+
                        "<div class='col-md-3'>"+       
                          "<input type='text' id='skills"+request_id+"'  class='form-control' placeholder='Enter atleast one skill' data-role='tagsinput'>"+
                          "<small class='help'>Enter multimple seperated by , or Enter</small>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'></label>"+
                        "<div class='col-md-7'>"+
                          "<button type='submit' class='btn btn-success pull-right' >Submit Details</button>"+
                        "</div>"+
                      "</div>"+
                      "</form>";
    $("#workerform_"+request_id).show().html(worker_modal);

    //document.getElementById("addworker").innerHTML = worker_modal;
    //$("#addworker").innerhtml(worker_modal);
  }
  else {
    var worker_modal = "<form class='form-horizontal' id='worker_details_form"+request_id+"' onsubmit='return (validateWorkerDetails("+request_id+","+ id+"));'>" +
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>First Name</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='2first_name"+request_id+"' class='form-control' placeholder='First Name' />"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Last Name</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='2last_name"+request_id+"' class='form-control' placeholder='Last Name' />"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Address Proof Name</label>"+
                        "<div class='col-md-3'>"+
                          "<select  id='2address_proof_name"+request_id+"' >"+ 
                            "<option value='Voter Id' >Voter Id </option>"+
                            "<option value='Adhaar Card' >Adhaar Card</option>"+
                            "<option value='Driving License' >Driving License</option>"+
                            "<option value='Education Certificate' >Education Certificate</option>"+
                            "<option value='Bank Account' >Bank Account</option>"+
                            "<option value='Passport' >Passport</option>"+
                          "</select>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Address Proof No</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='2address_proof_id"+request_id+"' class='form-control' placeholder='Address Proof Id' />"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Id Proof Name</label>"+
                        "<div class='col-md-3'>"+
                          "<select  id='2id_proof_name"+request_id+"' >"+    
                            "<option value='Voter Id' >Voter Id </option>"+
                            "<option value='Adhaar Card' >Adhaar Card</option>"+
                            "<option value='Driving License' >Driving License</option>"+
                            "<option value='Education Certificate' >Education Certificate</option>"+
                            "<option value='Bank Account' >Bank Account</option>"+
                            "<option value='Passport' >Passport</option>"+
                          "</select>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Id Proof No</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='2id_proof_id"+request_id+"' class='form-control' placeholder='Id Proof Id' />"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Mobile No.</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='2mobile"+request_id+"' class='form-control' placeholder='Enter 10 digit mobile number'>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Emergancy Mobile No.</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='2emergancy_mobile"+request_id+"' class='form-control' placeholder='Enter 10 digit mobile number'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Age</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='2age"+request_id+"' class='form-control' placeholder='Age in years'>"+
                        "</div>"+
                        "<label for='demo-msk-date' class='col-md-3 control-label'>Expected Salary</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='2expected_salary"+request_id+"' class='form-control' placeholder='Expected Salary'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Current address</label>"+
                        "<div class='col-md-3'>"+
                          "<textarea type='text' id='2current_address"+request_id+"' class='form-control' placeholder='Full Address' rows='4'></textarea>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Parmanent address</label>"+
                        "<div class='col-md-3'>"+
                          "<textarea type='text' id='2parmanent_address"+request_id+"' class='form-control' placeholder='Full Address' rows='4'></textarea>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Highest Education</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='2education"+request_id+"' class='form-control' placeholder='Highest Education'>"+
                        "</div>"+
                        "<label for='demo-msk-date' class='col-md-3 control-label'>Experience</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='2experience"+request_id+"' class='form-control' placeholder='Experience in Years'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-lg-3 control-label'>Gender</label>"+
                        "<div class='col-lg-3'>"+
                          "<select class='selectpicker' id='2gender"+request_id+"' data-live-search='true' data-width='100%'>" +   
                            "<option value='Male'>Male </option>"+
                            "<option value='Female'>Female</option>"+
                            "<option value='Other'>Other</option>"+
                          "</select>"+
                        "</div>"+
                        "<label for='demo-msk-date' class='col-md-3 control-label'>Date of Birth</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='2birth_date"+request_id+"' class='form-control' placeholder='dd/mm/yyyy'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Timings</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='2timings"+request_id+"' class='form-control' placeholder='Timings'>"+
                        "</div>"+
                        "<label for='demo-msk-date' class='col-md-3 control-label'>Working Hours</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='2work_time"+request_id+"' class='form-control' placeholder='Working time in hours'>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Remarks</label>"+
                        "<div class='col-md-3'>"+
                          "<textarea type='text' id='2remarks"+request_id+"' class='form-control' placeholder='Remarks' rows='4'></textarea>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Police Verification</label>"+
                        "<div class='col-md-3'>"+
                          "<select class='selectpicker' id='2police"+request_id+"' name='police' data-live-search='true' data-width='100%'>" +   
                            "<option value='yes'>yes </option>"+
                            "<option value='no'>no</option>"+
                          "</select>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Languages</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='2languages"+request_id+"' class='form-control' placeholder='Enter atleast one language' data-role='tagsinput'>" +
                          "<small class='help'>Enter multimple seperated by , or Enter</small>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Skills</label>"+
                        "<div class='col-md-3'>"+       
                          "<input type='text' id='2skills"+request_id+"'  class='form-control' placeholder='Enter atleast one skill' data-role='tagsinput'>"+
                          "<small class='help'>Enter multimple seperated by , or Enter</small>"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'></label>"+
                        "<div class='col-md-7'>"+
                          "<button type='submit' class='btn btn-success pull-right'>Submit Details</button>"+
                        "</div>"+
                      "</div>"+
                    "</form>";
    $("#workerform_"+request_id).show().html(worker_modal);
    //$("#workerform").innerhtml(worker_modal);
  }                  
}