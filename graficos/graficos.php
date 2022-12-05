<?php 
  include ('./conexion.php');
  $idUsuario = $_SESSION['idUsuario'];
  $idComisaria = $_SESSION['idComisaria'];
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
          //EXTRAER CANTIDAD TOTAL DE (TODAS) LAS NOVEDADES DE GUARDIA
          $sqlCantNovRel = "SELECT * FROM novedades_de_relevancia";
          $resSqlCantNovRel = mysqli_query($conexion, $sqlCantNovRel);
          $contadorCantNovRel = 0;
          while($rowCantNov = mysqli_fetch_assoc($resSqlCantNov)){
            $contadorCantNov = $contadorCantNov+1;
          }

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
          ['Move', 'Percentage'],
          ["King's pawn (e4)", 44],
          ["Queen's pawn (d4)", 31],
          ["Knight to King 3 (Nf3)", 12],
          ["Queen's bishop pawn (c4)", 10],
          ['Other', 3]
        ]);

        var options = {
          width: 800,
          legend: { position: 'none' },
          chart: {
            title: 'Chess opening moves',
            subtitle: 'popularity by percentage' },
          axes: {
            x: {
              0: { side: 'top', label: 'White to move'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>

  




  </head>
  <body>
    <div>
      <div id="novedadesGuardia" style="width: 700px; height: 500px;"></div>
      <div id="top_x_div" style="width: 700px; height: 600px;"></div>
    </div>
    
  </body>
</html>