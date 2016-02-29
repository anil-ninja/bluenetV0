<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart1() {

        var data = google.visualization.arrayToDataTable([
          ['Service Type', 'Number of Requests'],
          ['Carpenter',     11],
          ['Plumber',      2],
          ['Maid',  25],
	  ['Cook',      20],
          ['Driver',  2],
          ['Electrician', 2]
        ]);

        var options = {
          title: 'On Demand Request By Service Type',
	  is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart1" style="width: 900px; height: 500px;"></div>
  </body>
</html>