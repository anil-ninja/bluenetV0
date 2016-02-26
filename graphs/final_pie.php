<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart1);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Service Type', 'Number of Requests'],
          ['Maid cum Cook',     11],
          ['Patient Care',      2],
          ['Maid',  25],
	  ['Cook',      20],
          ['Driver',  2],
          ['Baby Sitter', 2],
          ['Old Age Care',    7]
        ]);

        var options = {
          title: 'Monthly Request By Service Type',
	  is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

     function drawChart1() {

        var data1 = google.visualization.arrayToDataTable([
          ['Service Type', 'Number of Requests'],
          ['Carpenter',     11],
          ['Plumber',      2],
          ['Maid',  25],
	  ['Cook',      20],
          ['Driver',  2],
          ['Electrician', 2]
        ]);

        var options1 = {
          title: 'On Demand Request By Service Type',
	  is3D: true,
        };

        var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart1.draw(data1, options1);
      }

    </script>
  </head>
  <body>
    <div style="width:1200px;height:auto;float:left">
    <div id="piechart" style="width: 550px; height: 400px;float:left;"></div>
    <div id="piechart1" style="width: 550px; height: 400px;float:left;"></div>
    </div>
  </body>
</html>

