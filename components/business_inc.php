<div id="cchart"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
 
  if(!isset($_GET['status'])) $status = "main";
  else $status = $_GET['status'];
  $user_id = $_SESSION['user_id'];
  switch ($status) {
    case 'monthlyandondemand':
        $sql = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(id) AS cnt FROM 
                                                      service_request WHERE remarks LIKE '%demand%' GROUP BY DATE(date);");
        while ($sqlRow = mysqli_fetch_array($sql)) {
          $date = $sqlRow['date'];
          $OnDemand = $sqlRow['cnt'];
        }
        $sql2 = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(id) AS cnt FROM 
                                                      service_request WHERE id NOT IN (SELECT id FROM service_request WHERE remarks LIKE '%demand%') 
                                                      GROUP BY DATE(date);");
        while ($sql2Row = mysqli_fetch_array($sql2)) {
          $date2 = $sql2Row['date'];
          $monthly = $sql2Row['cnt'];
        }
      break;
    
    case 'typeRequest':
        $sql = mysqli_query($db_handle, "SELECT count( * ) AS cnt, requirements FROM service_request
                                                    WHERE remarks LIKE '%demand%' GROUP BY requirements ;");
        while ($sqlRow = mysqli_fetch_array($sql)) {
          $requirements = $sqlRow['requirements'];
          $cnt = $sqlRow['cnt'];
        }
        $sql2 = mysqli_query($db_handle, "SELECT count( * ) AS cnt, requirements FROM service_request WHERE id NOT IN 
                                                    (SELECT id FROM service_request WHERE remarks LIKE '%demand%') GROUP BY requirements;");
        while ($sql2Row = mysqli_fetch_array($sql2)) {
          $requirements2 = $sql2Row['requirements'];
          $cnt = $sql2Row['cnt'];
        }
      break;

    case 'collectionRate':
        echo "Currently not available";
      break;

    case 'finencial':
        echo "Currently not available";
      break;

    case 'users':
        $user = mysqli_query($db_handle, "SELECT * FROM user WHERE id != '$user_id' AND (employee_type = 'cem' OR employee_type = 'me') ; ") ;
        echo "<table id='example1' class='display' cellspacing='0' >
                <thead>
                 <tr>
                    <th >Employee Name</th>
                    <th >Mobile</th>
                    <th >Email ID</th>
                    <th >Reg. Date</th>
                    <th >Report Card</th>
                 </tr>
                </thead>
                <tbody>";
        while ($userRow = mysqli_fetch_array($user)){ 
          $uid = $userRow['id'];
          $type = $userRow['employee_type'];
          echo "<tr>
                  <td>".strtoupper($userRow['first_name'])." ".strtoupper($userRow['last_name'])."</td>
                  <td>".$userRow['phone']."</td>
                  <td>".$userRow['email']."</td>
                  <td>".$userRow['reg_date']."</td>
                  <td onclick='reportcard(\"".$type."\",".$uid.");'>View Report Card</td>
                </tr>
                <tr><span id='reportcard_".$user_id."' style='width:100%;'> </span></tr>" ;
        }
        echo "</tbody> 
            </table>";
      break;

    default:
      $sql = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , SUM( DISTINCT (status) ) AS cnt, status 
                                                  FROM service_request WHERE work_time != 24 AND status != '' GROUP BY date ORDER BY date ASC;");
      $data = array();
      while ($sqlRow = mysqli_fetch_array($sql)) {
        $date = $sqlRow['date'];
        $data[$date] = isset($data[$date])?array_merge($data[$date],array($sqlRow['status'] => $sqlRow['cnt'])):array($sqlRow['status'] => $sqlRow['cnt']);  
        
      }

      $oldKey = null;
      $i = 0;
      /*function getDatesFromRange($start, $end){
        $dates = array($start);
        while(end($dates) < $end){
            $dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
        }
        return $dates;
      }*/
      $startDate = "";
      $resultDate = array();
      foreach ($data as $date => $statusArr) {
        if($i == 0){
          $i++;
          $startDate = $date;
          $oldKey = $date;
        }
        else {
          if(!isset($statusArr['open'])) $statusArr['open'] = 0;
          if(!isset($statusArr['followback'])) $statusArr['followback'] = 0;
          if(!isset($statusArr['demo'])) $statusArr['demo'] = 0;
          if(!isset($statusArr['feedback'])) $statusArr['feedback'] = 0;
          if(!isset($statusArr['done'])) $statusArr['done'] = 0;
          if(!isset($statusArr['delete'])) $statusArr['delete'] = 0;
          if(!isset($statusArr['just_to_know'])) $statusArr['just_to_know'] = 0;
          if(!isset($statusArr['not_interested'])) $statusArr['not_interested'] = 0;
          if(!isset($statusArr['decay'])) $statusArr['decay'] = 0;
          if(!isset($statusArr['meeting'])) $statusArr['meeting'] = 0;
          if(!isset($statusArr['salary_issue'])) $statusArr['salary_issue'] = 0;
        
          foreach ($statusArr as $status => $cnt) {
            $data[$date][$status] = $data[$oldKey][$status] + $cnt;
            
          } 
          $oldKey = $date;
        }
        $resultDate[] = $date ;
      }
      /*end($data);         // move the internal pointer to the end of the array
      $endingDate = key($data);  // fetches the key of the element pointed to by the internal pointer
      $Alldates = getDatesFromRange($startDate, $endingDate);
      $remainingDates = array_diff($Alldates, $resultDate);*/
      //print_r($data);

      $sql2 =  mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(id) AS cnt 
                                                                    FROM service_request WHERE work_time = 24 GROUP BY DATE(date);");
      while ($sql2Row = mysqli_fetch_array($sql2)) {
        $date2 = $sql2Row['date'];
        $hourcnt = $sql2Row['cnt'];
        /*foreach($data as $key => $value){
          if($key == $date2){
            $data[$key] = isset($data[$date2])?array_merge($data[$key],array('24 hour' => $hourcnt)):array('24 hour' => $hourcnt);
          }
        }*/
        //$data[$date] = isset($data[$date2])?array_merge($data[$date2],array('24 hour' => $hourcnt)):array('24 hour' => $hourcnt);
      }
      $graphData = "";
      foreach($data as $key => $value){
        $date = explode('-', $key);
        $newdate = $date[0].",".$date[1].",".$date[2];
        if(!isset($value['open']))$value['open'] = 0;
        if(!isset($value['followback']))$value['followback'] = 0;
        if(!isset($value['demo']))$value['demo'] = 0;
        if(!isset($value['feedback']))$value['feedback'] = 0;
        if(!isset($value['done']))$value['done'] = 0;
        if(!isset($value['delete']))$value['delete'] = 0;
        if(!isset($value['just_to_know']))$value['just_to_know'] = 0;
        if(!isset($value['not_interested']))$value['not_interested'] = 0;
        if(!isset($value['decay']))$value['decay'] = 0;
        if(!isset($value['meeting']))$value['meeting'] = 0;
        if(!isset($value['salary_issue']))$value['salary_issue'] = 0;
        //if(!isset($value['24 hour']))$value['24 hour'] = 0;
        //$opencnt += $value['open']);
        /*$followcnt += $value['followback']);
        $democnt += $value['demo']);
        $feedcnt += $value['feedback']);
        $donecnt += $value['done']);
        $deletecnt += $value['delete']);*/
        //$informationcnt += $value['just_to_know']);
        /*$NIcnt += $value['not_interested']);
        $decaycnt += $value['decay']);
        $meetingcnt += $value['meeting']);
        $salarycnt += $value['salary_issue']);
        $hourcnt += $value['24 hour']);*/
        //echo $opencnt.",".$informationcnt ;
        $graphData .= "[new Date($newdate),".$value['open'].",".$value['followback'].",".$value['demo'].",".$value['feedback'].",".$value['done'].",".$value['delete']
        .",".$value['just_to_know'].",".$value['not_interested'].",".$value['decay'].",".$value['meeting'].",".$value['salary_issue']."],";
      }
      $graphData = $graphData ."[new Date($newdate),".$value['open'].",".$value['followback'].",".$value['demo'].",".$value['feedback'].",".$value['done'].",".$value['delete']
        .",".$value['just_to_know'].",".$value['not_interested'].",".$value['decay'].",".$value['meeting'].",".$value['salary_issue']."]";
      
      break;
      
  }
?>
<script type="text/javascript">
  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('date', 'Date');
    data.addColumn('number', 'Open ');
    data.addColumn('number', 'Follow Back');
    data.addColumn('number', 'Demo');
    data.addColumn('number', 'Feed back ');
    data.addColumn('number', 'Done ');
    data.addColumn('number', 'Deleted ');
    data.addColumn('number', 'For Information ');
    data.addColumn('number', 'Not Interested ');
    data.addColumn('number', 'Decay');
    data.addColumn('number', 'Meetings');
    data.addColumn('number', 'Salary Issue');
    //data.addColumn('number', '24 Hours');
    data.addRows([
      <?= $graphData ;?>
    ]);
    
    var options = {
      chart: {
        title: 'Number of Service Requests \n',
        hAxis: {
          title: 'Date'
        },
        vAxis: {
          title: 'No. of requests'
        }
      },
      width: 750,
      height: 500
    };
    var formatter_medium = new google.visualization.DateFormat({formatType: 'medium'});
    formatter_medium.format(data,2);

    var chart = new google.charts.Line(document.getElementById('cchart'));
    chart.draw(data, google.charts.Line.convertOptions(options));
  }
</script>