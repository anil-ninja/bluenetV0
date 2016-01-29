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

function validateEmail(fld) {
  var error="";
  var tfld = trim(fld);                        // value of field with whitespace trimmed off
  var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
  if (!emailFilter.test(tfld)) {              //test email for illegal characters
    return false;
  } 
  else {
    return true;
  }
}

function validatePhone(fld) {    
  var res = fld.split(",");
  var filter = /^[0-9-+]+$/;
  var result = "" ;
  for(var i = 0; i < res.length; i++) {
    var stripped = res[i];
    if (stripped.value == "") {
      result = false;
    } 
    else if (!(filter.test(stripped))) {
      result = false ;
    } 
    else if (!(stripped.length == 10)) {
      result = false;
    }
    else result = true ;
  }
  return result;
}

function nospaces(t){
  if(t.value.match(/\s/g)){
    alert('Sorry, you are not allowed to enter any spaces');
    t.value=t.value.replace(/\s/g,'');
  }
}

function trim(s){
  return s.replace(/^\s+|\s+$/, '');
}

function postWorkerDetails(fields, languagesArray, skillsArray, request_id, id, police, gender, servicesArray, newskill) {
  alert("hi");
  var dataString = "";
  dataString = "first_name=" + $('#'+fields[0]).val() + "&last_name=" + $('#'+fields[1]).val() +
      "&mobile=" +  $('#'+fields[2]).val() + "&emergancy_mobile=" +  $('#'+fields[3]).val() + 
      "&age=" +  $('#'+fields[4]).val() + "&expected_salary=" + $('#'+fields[5]).val() +
      "&current_address=" + $('#'+fields[6]).val() + "&parmanent_address=" +  $('#'+fields[6]).val() + 
      "&education=" + $('#'+fields[8]).val() + "&experience=" + $('#'+fields[9]).val()+ 
      "&birth_date=" + $('#'+fields[10]).val() + "&timings=" + $('#'+fields[11]).val() + "&work_time=" + $('#'+fields[12]).val() +
      "&remarks=" + $('#'+fields[13]).val() + "&police=" + police + "&languages=" + languagesArray + "&skills=" + skillsArray + 
      "&request_id=" + request_id + "&type=" + id +"&gender=" + gender + "&services=" + servicesArray + "&newskill=" + newskill;
      /*"&address_proof_name=" + $('#'+fields[2]).val() + "&address_proof_id=" + $('#'+fields[3]).val() + 
      "&id_proof_name=" + $('#'+fields[4]).val() + "&id_proof_id=" +  $('#'+fields[5]).val() + */
  console.log(dataString);
  $.ajax({
    type: "POST",
    url: "ajax/addWorker.php",
    data: dataString,
    cache: false,
    success: function(result){
      alert("Added Successfully ");
      $(fields).each(function(i, idVal){ 
        $("#"+idVal).val(""); 
      });
      $('#languages').val("");
      $('#skills').val("");
      //alert("Added Successfully");
    },
    error: function(result){
      alert(result);
      return false;
    }
  });
}

function validateWorkerDetails(request_id, id){
  if(id == 1) {
    fields = ["first_name"+request_id,"last_name"+request_id, "mobile"+request_id, "emergancy_mobile"+request_id, "age"+request_id,  
            "expected_salary"+request_id, "current_address"+request_id, "parmanent_address"+request_id, "education"+request_id, 
            "experience"+request_id, "birth_date"+request_id, "timings"+request_id, "work_time"+request_id, "remarks"+request_id];
            //"address_proof_name"+request_id, "address_proof_id"+request_id, "id_proof_name"+request_id, "id_proof_id"+request_id,
    var languagesArray = []; 
    $('#languages'+request_id).each(function(i, selected){ 
      languagesArray[i] = $(selected).val(); 
    });
    var servicesArray = []; 
    $('#services'+request_id).each(function(i, selected){ 
      servicesArray[i] = $(selected).val(); 
    });
    var skillsArray = [];
    $(".values").each(function(i){
        skillsArray[i] = $(this).data('value');
    });
    var newskill = $('#newskill'+request_id).val();
    var gender = $('#gender'+request_id).val();
    var police = $('#police'+request_id).val();
  }
  else if(id == 2){
    fields = ["2first_name"+request_id,"2last_name"+request_id, "2mobile"+request_id, "2emergancy_mobile"+request_id, "2age"+request_id,  
            "2expected_salary"+request_id, "2current_address"+request_id, "2parmanent_address"+request_id, "2education"+request_id, 
            "2experience"+request_id, "2birth_date"+request_id, "2timings"+request_id, "2work_time"+request_id, "2remarks"+request_id];
            //"2address_proof_name"+request_id, "2address_proof_id"+request_id,"2id_proof_name"+request_id, "2id_proof_id"+request_id,
    var languagesArray = []; 
    $('#2languages'+request_id).each(function(i, selected){ 
      languagesArray[i] = $(selected).val(); 
    });
    var servicesArray = []; 
    $('#2services'+request_id).each(function(i, selected){ 
      servicesArray[i] = $(selected).val(); 
    });
    var skillsArray = [];
    $(".values").each(function(i){
        skillsArray[i] = $(this).data('value');
    });
    var newskill = $('#2newskill'+request_id).val();
    
    var gender = $('#2gender'+request_id).val();
    var police = $('#2police'+request_id).val();
  }
  else {
    fields = ["first_name","last_name", "mobile", "emergancy_mobile", "age", "expected_salary", "current_address", "parmanent_address", "education", 
            "experience", "birth_date", "timings", "work_time", "remarks"];
            //"address_proof_name", "address_proof_id", "id_proof_name", "id_proof_id",
    var languagesArray = []; 
    $('#languages').each(function(i, selected){ 
      languagesArray[i] = $(selected).val(); 
    });
    var servicesArray = []; 
    $('#services').each(function(i, selected){ 
      servicesArray[i] = $(selected).val(); 
    });
    var skillsArray = [];
    $(".values").each(function(i){
        skillsArray[i] = $(this).data('value');
    });
    var newskill = $('#newskill').val();
    
    var police = $('#police').val();
    var gender = $('#gender').val();
  }
  if(genericEmptyFieldValidator(newskill)){
    alert(x);
    if(genericEmptyFieldValidator(fields)){
      postWorkerDetails(fields, languagesArray, skillsArray, request_id, id, police, gender, servicesArray, newskill);   
    }
    return false;
  }
  else {
    var x = document.getElementsByClassName("values").length;
    alert(x);
    if(x == 0){
      alert('Please enter or select a Skill');
    }
    else {
      if(genericEmptyFieldValidator(fields)){
        postWorkerDetails(fields, languagesArray, skillsArray, request_id, id, police, gender, servicesArray, newskill);   
      }
      return false;
    }
  }
}

function postRequestDeatils(fields, skills, areas, status, servicesArray, newskill, time,time2, salary,salary2, work_time, gender) {
  var dataString = "";
  var d = $('#'+fields[4]).val().split('/');   
  var date = d[2] +'-'+ d[1] +'-'+ d[0];
  dataString = "name=" + $('#'+fields[0]).val() + "&mobile=" + $('#'+fields[1]).val() + "&address=" + $('#'+fields[2]).val() + 
      "&area=" +  $('#'+fields[3]).val() + "&created_time=" + date + "&remarks=" + $('#'+fields[5]).val() +
      "&timing=" + time + "&new_status=" + status + "&gender=" +  gender + "&salary=" +  salary + "&work_time=" +  work_time + 
      "&salary2=" +  salary2 + "&worker_area=" +  areas + "&services=" + servicesArray + "&skills=" + skills + 
      "&newskill=" + newskill + "&timing2=" + time2 ; 
  if(validatePhone($('#'+fields[1]).val()) == false){
    alert('Enter valid Phone Number');
  }
  else {
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
        var checkboxes = document.getElementsByTagName('input');
        for (var i = 0; i < checkboxes.length; i++) {
          checkboxes[i].checked = false;
        };
        alert("Added Successfully");
      },
      error: function(result){
        alert(result);
        return false;
      }
    });
  }
}

function validateRequestDetails(){
  
  fields = ["name","mobile","address","area","created_time","remarks","worker_area"];
  var areasArray = []; 
  $('#worker_area').each(function(i, selected){ 
    areasArray[i] = $(selected).val(); 
  });
  var servicesArray = []; 
  $('input[name=skill]:checked').each(function(i, checked){ 
    servicesArray[i] = $(checked).val(); 
  });
  var skillsArray = [];
  $(".values").each(function(i){
      skillsArray[i] = $(this).data('value');
  });
  var newskill = $('#newskill').val();
  var status = $("#new_status").val();
  var time = $('#timing').val();
  var time2 = $('#timing2').val();
  var salary = $('#salary').val();
  var salary2 = $('#salary2').val();
  var work_time = $('#work_time').val();
  var gender = $('#gender').val();
  if(genericEmptyFieldValidator(fields)){
    if(time == 0 || time2 == 0 || parseInt(time2) < parseInt(time)){
      alert('Enter valid work timing');
    }
    else if(salary == 0 || salary2 == 0 || parseInt(salary2) < parseInt(salary)){
      alert('Enter valid salary');
    }
    else if(work_time == 0){
      alert('Enter valid working time');
    }
    else {
      postRequestDeatils(fields, skillsArray, areasArray, status, servicesArray, newskill, time,time2, salary,salary2, work_time, gender);
    }
  }
  return false;
}

function postUserDeatils(fields, type){
  var dataString = "";
  dataString = "first_name=" + $('#'+fields[0]).val() + "&last_name=" + $('#'+fields[1]).val() + "&email=" + $('#'+fields[2]).val() + 
      "&phone=" + $('#'+fields[3]).val() + "&employee_type=" + type + "&salary=" +  $('#'+fields[4]).val() + 
      "&password=" +  $('#'+fields[5]).val() ;
  if($('#'+fields[0]).val().length < 3){
    alert("First Name is too short");
  }
  else if($('#'+fields[1]).val().length < 3){
    alert("Last Name is too short");
  }
  else if(validateEmail($('#'+fields[2]).val()) == false){
    alert("Enter valid email");
  }
  else if(validatePhone($('#'+fields[3]).val()) == false){
    alert("Enter valid phone number");
  }
  else if($('#'+fields[4]).val().length < 3){
    alert("Enter valid Base salary");
  }
  else if($('#'+fields[5]).val().length < 6){
    alert("Password length should be more than 6 chars");
  }
  else if($('#'+fields[5]).val() == $('#'+fields[6]).val()){ 
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
  fields = ["first_name","last_name","email","phone", "salary", "password","password2"];
  var type = $('#employee_type').val();
  if(genericEmptyFieldValidator(fields)){
    postUserDeatils(fields, type);
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

function validateNote(id, type){
  var dataString = "";
  var note = $("#note"+id).val() ;
  if(genericEmptyFieldValidator(note)){
    dataString = "id=" + id + "&type=" + type + "&note=" + note;
    $.ajax({
      type: "POST",
      url: "ajax/addnote.php",
      data: dataString,
      cache: false,
      success: function(result){
        alert("Added Successfully");
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

function addnote (id, type) {
  var status = "<form class='form-horizontal' id='note_form"+id+"' onsubmit='return(validateNote("+id+", \""+type+"\"));'>" +   
                  "<div class='form-group'>"+
                    "<label class='col-md-2 control-label'>Note</label>"+
                    "<div class='col-md-8'>"+
                      "<textarea type='text' id='note"+id+"' class='form-control' placeholder='Note' rows='3'></textarea>"+
                    "</div>"+
                  "</div>"+
                  "<div class='form-group'>"+
                    "<label class='col-md-3 control-label'></label>"+
                    "<div class='col-md-7'>"+
                      "<button type='submit' class='btn btn-success pull-right' >Submit</button>"+
                    "</div>"+
                  "</div>"+
                "</form>";
  $("#workerform_"+id).show().html(status);
}

function validateFeedback(id, type){
  var dataString = "";
  var feedback = $("#feedback"+id).val() ;
  if(genericEmptyFieldValidator(feedback)){
    dataString = "id=" + id + "&type=" + type + "&feedback=" + feedback;
    $.ajax({
      type: "POST",
      url: "ajax/addfeedback.php",
      data: dataString,
      cache: false,
      success: function(result){
        alert("Added Successfully");
      },
      error: function(result){
        alert(result);
        return false;
      }
    });
    return false;
  }
  return false;
}

function feedback(id, type){
  var feedback = "<form class='form-horizontal' id='feedback_form"+id+"' onsubmit='return(validateFeedback("+id+", \""+type+"\"));'>" +   
                    "<div class='form-group'>"+
                      "<label class='col-md-2 control-label'>Feedback</label>"+
                      "<div class='col-md-8'>"+
                        "<textarea type='text' id='feedback"+id+"' class='form-control' placeholder='Feedback' rows='4'></textarea>"+
                      "</div>"+
                    "</div>"+
                    "<div class='form-group'>"+
                      "<label class='col-md-3 control-label'></label>"+
                      "<div class='col-md-7'>"+
                        "<button type='submit' class='btn btn-success pull-right' >Submit</button>"+
                      "</div>"+
                    "</div>"+
                  "</form>";
  $("#workerform_"+id).show().html(feedback);
}

function validateStatus(id, oldStatus) {
  var dataString = "";
  var newStatus = $("#new_status"+id).val() ;
  //if(genericEmptyFieldValidator(newStatus)){
  dataString = "sr_id=" + id + "&old_status=" + oldStatus + "&new_status=" + newStatus;
  $.ajax({
    type: "POST",
    url: "ajax/ChangeStatus.php",
    data: dataString,
    cache: false,
    success: function(result){
      alert("Changed Successfully");
      location.reload();
    },
    error: function(result){
      alert(result);
      return false;
    }
  });
  //}
  //return false;
}

function getselectedskill(id, type) {
  if(type == 1) var skills = $('#skills'+id).val();
  else if(type == 2) var skills = $('#2skills'+id).val();
  else var skills = $('#skills').val();
  $.ajax({
    type: "POST",
    url: "ajax/skill.php",
    data: "skills="+skills ,
    cache: false,
    success: function(result){
      if(type == 1) $("#selectedskills"+id).append(result);
      else if(type == 2) $("#2selectedskills"+id).append(result);
      else $("#selectedskills").append(result);
    },
    error: function(result){
      return false;
    }
  }); 
}

function changeStatus(id, oldStatus, type){
  if(type == 1){
    var status = "<form class='form-horizontal' id='status_form"+id+"' onsubmit='return(validateStatus("+id+", \""+oldStatus+"\"));'>" +   
                    "<div class='form-group'>"+
                      "<label class='col-md-3 control-label'>Status</label>"+
                      "<div class='col-md-3'>"+
                        "<select class='selectpicker' id='new_status"+id+"' data-live-search='true' data-width='100%'>" +   
                          "<option value='open'>Open </option>"+
                          "<option value='salary_issue'>Salary Issues</option>"+
                          "<option value='not_interested'>Not Interested</option>"+
                          "<option value='just_to_know'>For information Purpose</option>"+
                          "<option value='decay'>Decay</option>"+
                        "</select>"+
                      "</div>"+
                    "</div>"+
                    "<div class='form-group'>"+
                      "<label class='col-md-3 control-label'></label>"+
                      "<div class='col-md-7'>"+
                        "<button type='submit' class='btn btn-success pull-right' >Submit</button>"+
                      "</div>"+
                    "</div>"+
                  "</form>";
    $("#workerform_"+id).show().html(status);
  }
  else if(type == 2) {
    var status = "<form class='form-horizontal' id='status_form"+id+"' onsubmit='return(validateStatus("+id+", \""+oldStatus+"\"));'>" +   
                    "<div class='form-group'>"+
                      "<label class='col-md-3 control-label'>Status</label>"+
                      "<div class='col-md-3'>"+
                        "<select class='selectpicker' id='new_status"+id+"' data-live-search='true' data-width='100%'>" +   
                          "<option value='open'>Open </option>"+
                          "<option value='salary_issue'>Salary Issues</option>"+
                          "<option value='not_interested'>Not Interested</option>"+
                          "<option value='just_to_know'>For information Purpose</option>"+
                          "<option value='me_open'>Search Worker</option>"+
                          "<option value='decay'>Decay</option>"+
                        "</select>"+
                      "</div>"+
                    "</div>"+
                    "<div class='form-group'>"+
                      "<label class='col-md-3 control-label'></label>"+
                      "<div class='col-md-7'>"+
                        "<button type='submit' class='btn btn-success pull-right' >Submit</button>"+
                      "</div>"+
                    "</div>"+
                  "</form>";
    $("#workerform_"+id).show().html(status);
  }
  else if(type == 3) {
    var status = "<form class='form-horizontal' id='status_form"+id+"' onsubmit='return(validateStatus("+id+", \""+oldStatus+"\"));'>" +   
                    "<div class='form-group'>"+
                      "<label class='col-md-3 control-label'>Status</label>"+
                      "<div class='col-md-3'>"+
                        "<select class='selectpicker' id='new_status"+id+"' data-live-search='true' data-width='100%'>" +   
                          "<option value='open'>Open </option>"+
                          "<option value='salary_issue'>Salary Issues</option>"+
                          "<option value='not_interested'>Not Interested</option>"+
                          "<option value='just_to_know'>For information Purpose</option>"+
                          "<option value='me_open'>Search Worker</option>"+
                          "<option value='decay'>Decay</option>"+
                          "<option value='demo'>Demo</option>"+
                          "<option value='done'>Done</option>"+
                          "<option value='delete'>Delete</option>"+
                          "<option value='followback'>Followback</option>"+
                          "<option value='feedback'>Feedback</option>"+
                        "</select>"+
                      "</div>"+
                    "</div>"+
                    "<div class='form-group'>"+
                      "<label class='col-md-3 control-label'></label>"+
                      "<div class='col-md-7'>"+
                        "<button type='submit' class='btn btn-success pull-right' >Submit</button>"+
                      "</div>"+
                    "</div>"+
                  "</form>";
    $("#workerform_"+id).show().html(status);
  }
  else {}
}

function postDeatils(fields, skillsArray, areasArray, id){
  var dataString = "";
  dataString = "name=" + $('#'+fields[0]).val() + "&mobile=" + $('#'+fields[1]).val() + "&address=" + $('#'+fields[2]).val() + 
      "&timing=" + $('#'+fields[3]).val() + "&remarks=" + $('#'+fields[4]).val() + "&gender=" +  $('#'+fields[5]).val() + 
      "&salary=" +  $('#'+fields[6]).val() + "&area=" +  $('#'+fields[7]).val() + "&work_time=" +  $('#'+fields[8]).val() + 
      "&created_time=" + $('#'+fields[9]).val() + "&worker_area=" +  areasArray + "&skills=" + skillsArray + "&sr_id=" + id ; 
  if(validatePhone($('#'+fields[1]).val()) == false){
    alert("Enter valid phone number");
  }
  else {
    $.ajax({
      type: "POST",
      url: "ajax/update.php",
      data: dataString,
      cache: false,
      success: function(result){
        alert("Updated Successfully");
        //location.reload();
      },
      error: function(result){
        alert(result);
        return false;
      }
    });
  }
}

function validateUpdateDetails(id){
  fields = ["name","mobile","address","timing","remarks","gender","salary","area","work_time","created_time",];
  var areasArray = []; 
  $('#worker_area').each(function(i, selected){ 
    areasArray[i] = $(selected).val(); 
  });
  var skillsArray = []; 
  $('input[name=skill]:checked').each(function(i, checked){ 
    skillsArray[i] = $(checked).val(); 
  });
  if(genericEmptyFieldValidator(fields)){
    postDeatils(fields, skillsArray, areasArray, id);
  }
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
  $('#date'+id).datepicker();
  $('#time'+id).datetimepicker();
}

function mePick(id) {
  bootbox.confirm("Ready for new challange !!!", function(result) {
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

function removeskill(id) {
  $('#'+id).remove();
}

function viewNotes (Id, type) {
  $.ajax({
    type: "POST",
    url: "ajax/notesDetails.php",
    data: "sr_id="+ Id + "&type=" + type,
    cache: false,
    success: function(result){
      //alert(result);
      $("#workerform_"+Id).show().html(result); 
    },
    error: function(result){
      alert("Error Occured");
      return false;
    }
  });
}

function Update (id) {
  location="update.php?sr_id="+id;
}

function addworker(request_id, id){
  if (id == 1){
    var worker_modal = "<form class='form-horizontal' id='worker_details_form"+request_id+"' onsubmit='return (validateWorkerDetails("+request_id+","+ id+"));'>" +
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>First Name</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='first_name"+request_id+"' onkeyup='nospaces(this);' class='form-control' placeholder='First Name' />"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Last Name</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='last_name"+request_id+"' onkeyup='nospaces(this);' class='form-control' placeholder='Last Name' />"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Mobile No.</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='mobile"+request_id+"' class='form-control' onkeyup='nospaces(this);' placeholder='Enter 10 digit mobile number'>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Emergancy Mobile No.</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='emergancy_mobile"+request_id+"' onkeyup='nospaces(this);' class='form-control' placeholder='Enter 10 digit mobile number'>"+
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
                          "<input type='text' id='education"+request_id+"' class='form-control' onkeyup='nospaces(this);' placeholder='Highest Education'>"+
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
                          "<input type='text' id='languages"+request_id+"' class='form-control' onkeyup='nospaces(this);' placeholder='Enter atleast one language' data-role='tagsinput'>" +
                          "<small class='help'>Enter multimple seperated by , </small>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Services</label>"+
                        "<div class='col-md-3'>"+       
                          "<input type='text' id='services"+request_id+"'  class='form-control' onkeyup='nospaces(this);' placeholder='Enter atleast one Service' data-role='tagsinput'>"+
                          "<small class='help'>Enter multimple seperated by , </small>"+
                        "</div>"+
                      "</div>"+ 
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Enter New Skill or select Skills</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='newskill"+request_id+"' onkeyup='nospaces(this);' class='form-control' placeholder='Enter Skill' data-role='tagsinput'>"+
                        "</div>"+
                        "<div class='col-md-4'>"+
                          "<select class='selectpicker"+request_id+"' id='skills"+request_id+"' onchange='getselectedskill("+request_id+", 1);' data-live-search='true' data-width='100%' >"+ 
                          "</select>"+
                          "<div id='selectedskills"+request_id+"'></div>"+
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
    $.ajax({
      type: "POST",
      url: "ajax/getskill.php",
      data: "type="+id ,
      cache: false,
      success: function(result){
        $('.selectpicker'+request_id).append(result);
      }
    }); 
    //document.getElementById("addworker").innerHTML = worker_modal;
    //$("#addworker").innerhtml(worker_modal);
  }
  else {
    var worker_modal = "<form class='form-horizontal' id='worker_details_form"+request_id+"' onsubmit='return (validateWorkerDetails("+request_id+","+ id+"));'>" +
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>First Name</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='2first_name"+request_id+"' onkeyup='nospaces(this);' class='form-control' placeholder='First Name' />"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Last Name</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id ='2last_name"+request_id+"' onkeyup='nospaces(this);' class='form-control' placeholder='Last Name' />"+
                        "</div>"+
                      "</div>"+
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Mobile No.</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='2mobile"+request_id+"' onkeyup='nospaces(this);' class='form-control' placeholder='Enter 10 digit mobile number'>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Emergancy Mobile No.</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='number' id='2emergancy_mobile"+request_id+"' onkeyup='nospaces(this);' class='form-control' placeholder='Enter 10 digit mobile number'>"+
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
                          "<input type='text' id='2education"+request_id+"' class='form-control' onkeyup='nospaces(this);' placeholder='Highest Education'>"+
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
                          "<input type='text' id='2languages"+request_id+"' class='form-control' onkeyup='nospaces(this);' placeholder='Enter atleast one language' data-role='tagsinput'>" +
                          "<small class='help'>Enter multimple seperated by , or Enter</small>"+
                        "</div>"+
                        "<label class='col-md-3 control-label'>Services</label>"+
                        "<div class='col-md-3'>"+       
                          "<input type='text' id='2services"+request_id+"'  class='form-control' onkeyup='nospaces(this);' placeholder='Enter atleast one Service' data-role='tagsinput'>"+
                          "<small class='help'>Enter multimple seperated by , </small>"+
                        "</div>"+
                      "</div>"+ 
                      "<div class='form-group'>"+
                        "<label class='col-md-3 control-label'>Enter New Skill or select Skills</label>"+
                        "<div class='col-md-3'>"+
                          "<input type='text' id='2newskill"+request_id+"' onkeyup='nospaces(this);' class='form-control' placeholder='Enter Skill' data-role='tagsinput'>"+
                        "</div>"+
                        "<div class='col-md-4'>"+
                          "<select class='2selectpicker"+request_id+"' id='2skills"+request_id+"' onchange='getselectedskill("+request_id+", 2);' data-live-search='true' data-width='100%' >"+ 
                          "</select>"+
                          "<div id='2selectedskills"+request_id+"'></div>"+
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
    $.ajax({
      type: "POST",
      url: "ajax/getskill.php",
      data: "type="+id ,
      cache: false,
      success: function(result){
        $('.2selectpicker'+request_id).append(result);
      }
    }); 
  }                  
}
                      /*"<div class='form-group'>"+
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
                      "</div>"+*/

                      /*"<div class='form-group'>"+
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
                      "</div>"+*/