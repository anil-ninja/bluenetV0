<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
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
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>

