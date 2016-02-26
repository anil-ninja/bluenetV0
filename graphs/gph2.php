<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Day');
      data.addColumn('number', 'Open Requests');
      data.addColumn('number', 'Follow Back');
      data.addColumn('number', '24 Hours');
      data.addColumn('number', 'Done Requests');
      data.addColumn('number', 'Decay');
      data.addColumn('number', 'Meetings');
      data.addColumn('number', 'Salary Issue');
      data.addColumn('number', 'Demo');

      data.addRows([
        [2016-02-1,  37.8, 80.8, 41.8, 37.8, 80.8, 41.8, 37.8, 80.8],
        [2016-02-2,  30.9, 69.5, 32.4, 37.8, 80.8, 41.8, 37.8, 80.8],
        [2016-02-3,  25.4,   57, 25.7, 37.8, 80.8, 41.8, 37.8, 80.8],
        [2016-02-5,  11.7, 18.8, 10.5, 11.7, 18.8, 10.5, 11.7, 18.8],
        [2016-02-7,  11.9, 17.6, 10.4, 11.7, 18.8, 10.5, 11.7, 18.8],
        [2016-02-8,   8.8, 13.6,  7.7, 11.7, 18.8, 10.5, 11.7, 18.8],
        [2016-02-9,   7.6, 12.3,  9.6, 7.6, 12.3,  9.6, 7.6, 12.3],
        [2016-02-10,  12.3, 29.2, 10.6, 7.6, 12.3,  9.6, 7.6, 12.3],
        [2016-02-11,  16.9, 42.9, 14.8, 16.9, 42.9, 14.8, 16.9, 42.9],
        [2016-02-12, 12.8, 30.9, 11.6, 16.9, 42.9, 14.8, 16.9, 42.9],
        [2016-02-14,  5.3,  7.9,  4.7, 16.9, 42.9, 14.8, 16.9, 42.9],
        [2016-02-15,  6.6,  8.4,  5.2, 18.8, 10.5, 11.7, 18.8, 10.5],
        [2016-02-16,  4.8,  6.3,  3.6, 18.8, 10.5, 11.7, 18.8, 10.5],
        [2016-02-17,  4.2,  6.2,  3.4, 18.8, 10.5, 11.7, 18.8, 10.5]
      ]);

      var options = {
        chart: {
          title: 'Number of Service Requests',
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




