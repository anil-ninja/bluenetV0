<div id="piechart" style="width: 900px; height: 400px;"></div>
<div id="piechart2" style="width: 900px; height: 400px;"></div>
<?php
  $user_id = $_SESSION['user_id'];
  $ondemandmaid = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request
                                                    WHERE requirements LIKE '%maid%' and remarks LIKE '%demand%' ;");
  $ondemandmaidRow = mysqli_fetch_array($ondemandmaid);
  $ondemandmaidcnt = $ondemandmaidRow['cnt'];

  $ondemandcook = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request
                                                    WHERE requirements LIKE '%cook%' and remarks LIKE '%demand%' ;");
  $ondemandcookRow = mysqli_fetch_array($ondemandcook);
  $ondemandcookcnt = $ondemandcookRow['cnt'];
  
  $ondemandbabysitter = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request
                                                    WHERE requirements LIKE '%babysitter%' and remarks LIKE '%demand%' ;");
  $ondemandbabysitterRow = mysqli_fetch_array($ondemandbabysitter);
  $ondemandbabysittercnt = $ondemandbabysitterRow['cnt'];
  
  $ondemanddriver = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request
                                                    WHERE requirements LIKE '%driver%' and remarks LIKE '%demand%' ;");
  $ondemanddriverRow = mysqli_fetch_array($ondemanddriver) ;
  $ondemanddrivercnt = $ondemanddriverRow['cnt'];
  
  $ondemandcarpenter = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request
                                                    WHERE requirements LIKE '%carpenter%' and remarks LIKE '%demand%' ;");
  $ondemandcarpenterRow = mysqli_fetch_array($ondemandcarpenter);
  $ondemandcarpentercnt = $ondemandcarpenterRow['cnt'];
  
  $ondemandelectrician = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request
                                                    WHERE requirements LIKE '%electrician%' and remarks LIKE '%demand%' ;");
  $ondemandelectricianRow = mysqli_fetch_array($ondemandelectrician);
  $ondemandelectriciancnt = $ondemandelectricianRow['cnt'];
  
  $ondemandplumber= mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request
                                                    WHERE requirements LIKE '%plumber%' and remarks LIKE '%demand%' ;");
  $ondemandplumberRow = mysqli_fetch_array($ondemandplumber);
  $ondemandplumbercnt = $ondemandplumberRow['cnt'];
  
  $ondemandoldage = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request
                                                    WHERE requirements LIKE '%oldage%' and remarks LIKE '%demand%' ;");
  $ondemandoldageRow = mysqli_fetch_array($ondemandoldage) ;
  $ondemandoldagecnt = $ondemandoldageRow['cnt'];
  
  

  $monthlymaid = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') and requirements LIKE '%maid%' ;");
  $monthlymaidRow = mysqli_fetch_array($monthlymaid) ;
  $monthlymaidcnt = $monthlymaidRow['cnt'];

  $monthlycook = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') and requirements LIKE '%cook%' ;");
  $monthlycookRow = mysqli_fetch_array($monthlycook) ;
  $monthlycookcnt = $monthlycookRow['cnt'];

  $monthlydriver = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') and requirements LIKE '%driver%' ;");
  $monthlydriverRow = mysqli_fetch_array($monthlydriver) ;
  $monthlydrivercnt = $monthlydriverRow['cnt'];

  $monthlybabysitter = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') and requirements LIKE '%babysitter%' ;");
  $monthlybabysitterRow = mysqli_fetch_array($monthlybabysitter) ;
  $monthlybabysittercnt = $monthlybabysitterRow['cnt'];

  $monthlyoldage = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') and requirements LIKE '%oldage%' ;");
  $monthlyoldageRow = mysqli_fetch_array($monthlyoldage) ;
  $monthlyoldagecnt = $monthlyoldageRow['cnt'];

  $monthlypatient = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') and requirements LIKE '%patient%' ;");
  $monthlypatientRow = mysqli_fetch_array($monthlypatient) ;
  $monthlypatientcnt = $monthlypatientRow['cnt'];

  $monthlymaidcumcook = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%')
                                              and (requirements LIKE '%aid,co%' or requirements LIKE '%ook,ma%') ;");
  $monthlymaidcumcookRow = mysqli_fetch_array($monthlymaidcumcook) ;
  $monthlymaidcumcookcnt = $monthlymaidcumcookRow['cnt'];

  $monthlymaidcumbaby = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') 
                                              and (requirements LIKE '%aid,bab%' or requirements LIKE '%ter,ma%') ;");
  $monthlymaidcumbabyRow = mysqli_fetch_array($monthlymaidcumbaby) ;
  $monthlymaidcumbabycnt = $monthlymaidcumbabyRow['cnt'];

  $monthlymaidcumoldage = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') 
                                              and (requirements LIKE '%aid,old%' or requirements LIKE '%aid,pat%') ;");
  $monthlymaidcumoldageRow = mysqli_fetch_array($monthlymaidcumoldage) ;
  $monthlymaidcumoldagecnt = $monthlymaidcumoldageRow['cnt'];

  $monthlycookcumbaby = mysqli_query($db_handle, "SELECT count( * ) AS cnt FROM service_request WHERE id NOT IN 
                                              (SELECT id FROM service_request WHERE remarks LIKE '%demand%') 
                                              and (requirements LIKE '%ook,baby%' or requirements LIKE '%ter,cook%') ;");
  $monthlycookcumbabyRow = mysqli_fetch_array($monthlycookcumbaby) ;
  $monthlycookcumbabycnt = $monthlycookcumbabyRow['cnt'];
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Service Type', 'Number of Requests'],
          ['Cook',<?= $monthlycookcnt;?>],
          ['Maid',<?= $monthlymaidcnt;?>],
          ['Driver',<?= $monthlydrivercnt;?>],
          ['Baby Sitter',<?= $monthlybabysittercnt;?>],
          ['Old Age Care',<?= $monthlyoldagecnt;?>],
          ['Patient Care',<?= $monthlypatientcnt;?>],
          ['Maid cum Cook',<?= $monthlymaidcumcookcnt;?>],
          ['Maid cum Babysitter',<?= $monthlymaidcumbabycnt;?>],
          ['Maid cum Patient Care',<?= $monthlymaidcumoldagecnt;?>],
          ['Cook cum Babysitter',<?= $monthlycookcumbabycnt;?>]
        ]);

        var options = {
          title: 'Monthly Request By Service Type',
    is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Service Type', 'Number of Requests'],
          ['Cook',<?= $ondemandcookcnt;?>],
          ['Maid',<?= $monthlymaidcnt;?>],
          ['Driver',<?= $ondemanddrivercnt;?>],
          ['Baby Sitter',<?= $ondemandbabysittercnt;?>],
          ['Carpenter',<?= $ondemandcarpentercnt;?>],
          ['Electrician',<?= $ondemandelectriciancnt;?>],
          ['Plumber',<?= $ondemandplumbercnt;?>],
          ['Old Age Care',<?= $ondemandoldagecnt;?>]
        ]);

        var options = {
          title: 'On Demand Request By Service Type',
    is3D: true,
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data, options);
      }
    </script>