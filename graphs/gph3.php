<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Day');
      data.addColumn('number', 'Monthly');
      data.addColumn('number', 'On Demand');
      
      data.addRows([
        [1,  37.8, 80.8],
        [2,  30.9, 69.5],
        [3,  25.4,   57],
        [4,  11.7, 18.8],
        [5,  11.9, 17.6],
        [6,   8.8, 13.6],
        [7,   7.6, 12.3],
        [8,  12.3, 29.2],
        [9,  16.9, 42.9],
        [10, 12.8, 30.9]
      ]);

      var options = {
        chart: {
          title: 'Monthly and On-Demand Requests',
          subtitle: 'Number of Service Requests'
   
        },
        width: 900,
        height: 500
      };

      var chart = new google.charts.Line(document.getElementById('cchart'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }

    </script>
  </head>
  <body>
    <div id="cchart"></div>
  </body>
</html>




