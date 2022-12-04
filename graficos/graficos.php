<?php 
  include ('./conexion.php');
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php
            $sql = "SELECT * FROM novedades_de_guardia";
            $resultado = mysqli_query($conexion,$sql);
            while($row = mysqli_fetch_assoc($resultado) ){
              echo "['" .$row['turno']."', " .$row['motoristas']."],";
            }
          ?>
        ]);

        var options = {
          title: 'Novedades de Guardia',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('novedadesGuardia'));
        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Opening Move', 'Percentage'],
          <?php
            $sql = "SELECT * FROM novedades_de_guardia";
            $resultado = mysqli_query($conexion,$sql);
            while($row = mysqli_fetch_assoc($resultado) ){
              echo "['" .$row['turno']."', " .$row['motoristas']."],";
            }
          ?>
        ]);

        var options = {
          title: 'Novedades de Guardia',
          backgroundColor: 'black',
          width: 700,
          legend: { position: 'none' },
          chart: { title: 'Chess opening moves',
                   subtitle: 'popularity by percentage' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Percentage'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
  




  </head>
  <body>
    <div>
      <div id="novedadesGuardia" style="width: 700px; height: 500px;"></div>
      <div id="top_x_div" style="width: 700px; height: 500px;"></div>
    </div>
    
  </body>
</html>