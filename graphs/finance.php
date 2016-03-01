<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Day');
      data.addColumn('number', 'Rent & Salary');
      data.addColumn('number', 'Cash Collection');
      data.addColumn('number', 'Marketing');
      
      data.addRows([
        [1,  37.8, 80.8, 12.8],
        [2,  30.9, 69.5, 12.8],
        [3,  25.4,   57, 12.8],
        [4,  11.7, 18.8, 12.8],
        [5,  11.9, 17.6, 12.8],
        [6,   8.8, 13.6, 12.8],
        [7,   7.6, 12.3, 12.8],
        [8,  12.3, 29.2, 12.8],
        [9,  16.9, 42.9, 12.8],
        [10, 12.8, 30.9, 12.8]
      ]);

      var options = {
        chart: {
          title: 'Financial Chart',
          subtitle: 'Money'
   
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