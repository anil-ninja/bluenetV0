<canvas id="cchart" width="900" height="500"></canvas>
<?php
  $data = array();
  $user_id = $_SESSION['user_id'];
  $sql = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(id) AS cnt FROM 
                                                      service_request WHERE remarks LIKE '%demand%' GROUP BY DATE(date);");
  while ($sqlRow = mysqli_fetch_array($sql)) {
    $date = $sqlRow['date'];
  	$OnDemand = $sqlRow['cnt'];
    $data[$date] = isset($data[$date])?array_merge($data[$date],array('demand' => $OnDemand)):array('demand' => $OnDemand);
  }
  $sql2 = mysqli_query($db_handle, "SELECT DISTINCT DATE(date) as date , count(id) AS cnt FROM service_request WHERE id NOT IN 
  														(SELECT id FROM service_request WHERE remarks LIKE '%demand%') GROUP BY DATE(date);");
  while ($sql2Row = mysqli_fetch_array($sql2)) {
    $date2 = $sql2Row['date'];
    $monthly = $sql2Row['cnt'];
    foreach($data as $key => $value){
      if($key == $date2){
        $data[$key] = isset($data[$date2])?array_merge($data[$key],array('monthly' => $monthly)):array('monthly' => $monthly);
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
  $graphDatademand = "";
  $graphDatamonthly = "";
  $graphDates = "";
  foreach($data as $key => $value){
    //$date = explode('-', $key);
    //$newdate = $date[0].",".($date[1]-1).",".$date[2];
    $graphDates .= "\"".$key."\",";
    if(!isset($value['demand']))$value['demand'] = 0;
    if(!isset($value['monthly']))$value['monthly'] = 0;
    $graphDatademand .= $value['demand'].",";
    $graphDatamonthly .= $value['monthly'].",";
  }
  $graphDatademand = $graphDatademand.$value['demand'];
  $graphDatamonthly = $graphDatamonthly.$value['monthly'];
  $graphDates = $graphDates ."\"".$endingDate."\"";
?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
<script type="text/javascript"> 
  var data = {
    labels: [<?= $graphDates ;?>],
    datasets: [
        {
            label: "Monthly Requests",
            fillColor: "rgba(237,  242, 15,0.2)",
            strokeColor: "#EDF20F",
            pointColor: "#EDF20F",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?= $graphDatamonthly ;?>]
        },
        {
            label: "On-Demand Requests",
            fillColor: "rgba(114,  182, 98,0.1)",
            strokeColor: "#72B662",
            pointColor: "#72B662",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?= $graphDatademand ;?>]
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