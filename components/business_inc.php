<canvas id="cchart" width="800" height="500"></canvas>
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
      $data = array();
      $sql = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , SUM( DISTINCT (status) ) AS cnt, status 
                                                  FROM service_request WHERE work_time != 24 AND status != '' GROUP BY date ORDER BY date ASC;");
      while ($sqlRow = mysqli_fetch_array($sql)) {
        $date = $sqlRow['date'];
        $data[$date] = isset($data[$date])?array_merge($data[$date],array($sqlRow['status'] => $sqlRow['cnt'])):array($sqlRow['status'] => $sqlRow['cnt']);  
      }
      $totalreq = mysqli_query($db_handle, "SELECT Date( date ) AS dt, count( id ) AS cnt FROM service_request GROUP BY dt ;"); 
      while ($totalreqRow = mysqli_fetch_array($totalreq)) {
        $date2 = $totalreqRow['dt'];
        $cnt = $totalreqRow['cnt'];
        foreach($data as $key => $value){
          if($key == $date2){
            $data[$key] = isset($data[$date2])?array_merge($data[$key],array('Toatal' => $cnt)):array('Total' => $cnt);
          }
        }
      }
      $sql2 =  mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(id) AS cnt 
                                                                    FROM service_request WHERE work_time = 24 GROUP BY DATE(date);");
      while ($sql2Row = mysqli_fetch_array($sql2)) {
        $date2 = $sql2Row['date'];
        $hourcnt = $sql2Row['cnt'];
        foreach($data as $key => $value){
          if($key == $date2){
            $data[$key] = isset($data[$date2])?array_merge($data[$key],array('24 hour' => $hourcnt)):array('24 hour' => $hourcnt);
          }
        }
      }

      $oldKey = null;
      $i = 0;
      function getDatesFromRange($start, $end){
        $dates = array($start);
        while(end($dates) < $end){
            $dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
        }
        return $dates;
      }
      reset($data);
      $startDate = key($data);
      end($data);         // move the internal pointer to the end of the array
      $endingDate = key($data);  // fetches the key of the element pointed to by the internal pointer
      $Alldates = getDatesFromRange($startDate, $endingDate);
      $remainingDates = array_diff($Alldates, array_keys($data));
      foreach ($remainingDates as $key => $value) {
        $data[$value]=array();
      }

      ksort($data);
      
      foreach ($data as $date => $statusArr) {
        if($i == 0){
          $i++;
          $oldKey = $date;
        }
        else {
          if(!isset($statusArr['Toatal'])) $statusArr['Toatal'] = 0;
          if(!isset($statusArr['24 hour'])) $statusArr['24 hour'] = 0;
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
        
      }
      /*$data2015[] = null;

      foreach ($data as $key => $value) {
        if(date('Y', strtotime($key)) == "2015"){
          $data2015[] = $data[$key];
          unset($data[$key]);
        }
      }      
      $graphData2015 = "";
      foreach($data2015 as $key => $value){
        $date = explode('-', $key);
        $newdate = $date[0].",".$date[1].",".$date[2];
        if(!isset($value['Toatal']))$value['Toatal'] = 0;
        if(!isset($value['followback']))$value['followback'] = 0;
        if(!isset($value['done']))$value['done'] = 0;
        if(!isset($value['just_to_know']))$value['just_to_know'] = 0;
        if(!isset($value['not_interested']))$value['not_interested'] = 0;
        if(!isset($value['decay']))$value['decay'] = 0;
        if(!isset($value['salary_issue']))$value['salary_issue'] = 0;
        if(!isset($value['24 hour']))$value['24 hour'] = 0;

        $graphData2015 .= "[new Date($newdate),".$value['Toatal'].",".$value['followback'].",".$value['done'].",".$value['just_to_know'].",".
                                    $value['not_interested'].",".$value['decay'].",".$value['salary_issue'].",".$value['24 hour']."],";
      }
      $graphData2015 = $graphData2015 ."[new Date($newdate),".$value['Toatal'].",".$value['followback'].",".$value['done'].",".$value['just_to_know'].",".
                                    $value['not_interested'].",".$value['decay'].",".$value['salary_issue'].",".$value['24 hour']."]";
      */

      $graphDataTotal = "";
      $graphDatafollowback = "";
      $graphDatadone = "";
      $graphDataknow = "";
      $graphDataNotInte = "";
      $graphDatadecay = "";
      $graphDataSallary = "";
      $graphData24 = "";
      $graphDates = "";
      foreach($data as $key => $value){
        //$date = explode('-', $key);
        //$newdate = $date[0].",".($date[1]-1).",".$date[2];
        $graphDates .= "\"".$key."\",";
        if(!isset($value['Toatal']))$value['Toatal'] = 0;
        if(!isset($value['followback']))$value['followback'] = 0;
        if(!isset($value['done']))$value['done'] = 0;
        if(!isset($value['just_to_know']))$value['just_to_know'] = 0;
        if(!isset($value['not_interested']))$value['not_interested'] = 0;
        if(!isset($value['decay']))$value['decay'] = 0;
        if(!isset($value['salary_issue']))$value['salary_issue'] = 0;
        if(!isset($value['24 hour']))$value['24 hour'] = 0;
        $graphDataTotal .= $value['Toatal'].",";
        $graphDatafollowback .= $value['followback'].",";
        $graphDatadone .= $value['done'].",";
        $graphDataknow .= $value['just_to_know'].",";
        $graphDataNotInte .= $value['not_interested'].",";
        $graphDatadecay .= $value['decay'].",";
        $graphDataSallary .= $value['salary_issue'].",";
        $graphData24 .= $value['24 hour'].",";
        /*$graphData .= "[new Date($newdate),".$value['Toatal'].",".$value['followback'].",".$value['done'].",".$value['just_to_know'].",".
                                    $value['not_interested'].",".$value['decay'].",".$value['salary_issue'].",".$value['24 hour']."],";*/
      }
      $graphDataTotal = $graphDataTotal.$value['Toatal'];
      $graphDatafollowback = $graphDatafollowback.$value['followback'];
      $graphDatadone = $graphDatadone.$value['done'];
      $graphDataknow = $graphDataknow.$value['just_to_know'];
      $graphDataNotInte = $graphDataNotInte.$value['not_interested'];
      $graphDatadecay = $graphDatadecay.$value['decay'];
      $graphDataSallary = $graphDataSallary.$value['salary_issue'];
      $graphData24 = $graphData24.$value['24 hour'];
      $graphDates = $graphDates ."\"".$endingDate."\"";
      
      break;
        
  }

?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
<script type="text/javascript">
  var data = {
    labels: [<?= $graphDates ;?>],
    datasets: [
        /*{
            label: "Total Requests",
            fillColor: "rgba(20,40,40,0.2)",
            strokeColor: "#1CF20F",
            pointColor: "#1CF20F",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [<?= $graphDataTotal ;?>]
        },*/
        {
            label: "Follow Back",
            fillColor: "rgba(237,  242, 15,0.2)",
            strokeColor: "#EDF20F",
            pointColor: "#EDF20F",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?= $graphDatafollowback ;?>]
        },
        {
            label: "Done",
            fillColor: "rgba(15, 58,  242,0.2)",
            strokeColor: "#0F3AF2",
            pointColor: "#0F3AF2",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?= $graphDatadone ;?>]
        },
        {
            label: "For Information",
            fillColor: "rgba(15, 242, 234, ,0.2)",
            strokeColor: "#0FF2EA",
            pointColor: "#0FF2EA",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?= $graphDataknow ;?>]
        },
        {
            label: "Not Interested",
            fillColor: "rgba(242,15,231,0.2)",
            strokeColor: "#F20FE7",
            pointColor: "#F20FE7",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?= $graphDataNotInte ;?>]
        },
        {
            label: "decay",
            fillColor: "rgba(242,  15,  79,0.2)",
            strokeColor: "#F20F4F",
            pointColor: "#F20F4F",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?= $graphDatadecay ;?>]
        },
        {
            label: "Salary Issues",
            fillColor: "rgba(242,  77,  77,0.2)",
            strokeColor: "#F24D4D",
            pointColor: "#F24D4D",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?= $graphDataSallary ;?>]
        },
        {
            label: "24 Hours",
            fillColor: "rgba(114,  182, 98,0.1)",
            strokeColor: "#72B662",
            pointColor: "#72B662",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?= $graphData24 ;?>]
        }
    ]
};

Chart.defaults.global = {
    // Boolean - Whether to animate the chart
    animation: true,

    // Number - Number of animation steps
    animationSteps: 60,

    // String - Animation easing effect
    // Possible effects are:
    // [easeInOutQuart, linear, easeOutBounce, easeInBack, easeInOutQuad,
    //  easeOutQuart, easeOutQuad, easeInOutBounce, easeOutSine, easeInOutCubic,
    //  easeInExpo, easeInOutBack, easeInCirc, easeInOutElastic, easeOutBack,
    //  easeInQuad, easeInOutExpo, easeInQuart, easeOutQuint, easeInOutCirc,
    //  easeInSine, easeOutExpo, easeOutCirc, easeOutCubic, easeInQuint,
    //  easeInElastic, easeInOutSine, easeInOutQuint, easeInBounce,
    //  easeOutElastic, easeInCubic]
    animationEasing: "easeOutQuart",

    // Boolean - If we should show the scale at all
    showScale: true,

    // Boolean - If we want to override with a hard coded scale
    scaleOverride: false,

    // ** Required if scaleOverride is true **
    // Number - The number of steps in a hard coded scale
    scaleSteps: null,
    // Number - The value jump in the hard coded scale
    scaleStepWidth: null,
    // Number - The scale starting value
    scaleStartValue: null,

    // String - Colour of the scale line
    scaleLineColor: "rgba(0,0,0,.1)",

    // Number - Pixel width of the scale line
    scaleLineWidth: 1,

    // Boolean - Whether to show labels on the scale
    scaleShowLabels: true,

    // Interpolated JS string - can access value
    scaleLabel: "<%=value%>",

    // Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
    scaleIntegersOnly: true,

    // Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero: false,

    // String - Scale label font declaration for the scale label
    scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

    // Number - Scale label font size in pixels
    scaleFontSize: 12,

    // String - Scale label font weight style
    scaleFontStyle: "normal",

    // String - Scale label font colour
    scaleFontColor: "#666",

    // Boolean - whether or not the chart should be responsive and resize when the browser does.
    responsive: false,

    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,

    // Boolean - Determines whether to draw tooltips on the canvas or not
    showTooltips: true,

    // Function - Determines whether to execute the customTooltips function instead of drawing the built in tooltips (See [Advanced - External Tooltips](#advanced-usage-custom-tooltips))
    customTooltips: false,

    // Array - Array of string names to attach tooltip events
    tooltipEvents: ["mousemove", "touchstart", "touchmove"],

    // String - Tooltip background colour
    tooltipFillColor: "rgba(0,0,0,0.8)",

    // String - Tooltip label font declaration for the scale label
    tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

    // Number - Tooltip label font size in pixels
    tooltipFontSize: 14,

    // String - Tooltip font weight style
    tooltipFontStyle: "normal",

    // String - Tooltip label font colour
    tooltipFontColor: "#fff",

    // String - Tooltip title font declaration for the scale label
    tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

    // Number - Tooltip title font size in pixels
    tooltipTitleFontSize: 14,

    // String - Tooltip title font weight style
    tooltipTitleFontStyle: "bold",

    // String - Tooltip title font colour
    tooltipTitleFontColor: "#fff",

    // Number - pixel width of padding around tooltip text
    tooltipYPadding: 6,

    // Number - pixel width of padding around tooltip text
    tooltipXPadding: 6,

    // Number - Size of the caret on the tooltip
    tooltipCaretSize: 8,

    // Number - Pixel radius of the tooltip border
    tooltipCornerRadius: 6,

    // Number - Pixel offset from point x to tooltip edge
    tooltipXOffset: 10,

    // String - Template string for single tooltips
    tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",

    // String - Template string for multiple tooltips
    multiTooltipTemplate: "<%= value %>",

    // Function - Will fire on animation progression.
    onAnimationProgress: function(){},

    // Function - Will fire on animation completion.
    onAnimationComplete: function(){}
};

Chart.defaults.global.responsive = true;



var options = {

    ///Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : true,

    //String - Colour of the grid lines
    scaleGridLineColor : "rgba(0,0,0,.05)",

    //Number - Width of the grid lines
    scaleGridLineWidth : 1,

    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,

    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,

    //Boolean - Whether the line is curved between points
    bezierCurve : true,

    //Number - Tension of the bezier curve between points
    bezierCurveTension : 0.4,

    //Boolean - Whether to show a dot for each point
    pointDot : true,

    //Number - Radius of each point dot in pixels
    pointDotRadius : 4,

    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth : 1,

    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,

    //Boolean - Whether to show a stroke for datasets
    datasetStroke : true,

    //Number - Pixel width of dataset stroke
    datasetStrokeWidth : 2,

    //Boolean - Whether to fill the dataset with a colour
    datasetFill : false,

    multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>",

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasetets[i].label%><%}%></li><%}%></ul>"

};



var ctx = document.getElementById("cchart").getContext("2d");
var myLineChart = new Chart(ctx).Line(data, options);
</script>