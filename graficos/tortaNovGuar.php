
<?php
//GRAFICO DE TORTA CANTIDAD DE presos por comisaria
  include("././conexion.php");
  //
  $sql = "SELECT SUM(n.aprehendidos) AS arrestos,(c.nombre) AS nombreComisaria FROM novedades_de_guardia n INNER JOIN comisarias c WHERE n.idComisaria=c.idComisaria GROUP BY c.nombre ORDER BY n.aprehendidos";
  //
  $r = mysqli_query($conexion, $sql);
?>
<html>
  <head>
  <style>#tortaNovGuar{float:left;}</style>
    <!--Cargar AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Carga el API de visualización y el paquete corechart
      google.charts.load('current', {'packages':['corechart']});

      // Define la función callback para crear la gráfica
      google.charts.setOnLoadCallback(grafica);

      // Función para poblar la gráfica
      // iniciar el gráfico, pasa los datos y los dibuja
      function grafica() {

        // Crea la gráfica
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'nombreComisaria');
        data.addColumn('number', 'arrestos');
        data.addRows([
          
        <?php
          $i = 0;
          $n = mysqli_num_rows($r);
          while($row=mysqli_fetch_assoc($r)){
            print "['".$row["nombreComisaria"]."', ".$row["arrestos"]."]";
            $i++;
            if($i<$n) print ",";
          }
        ?>
         
        ]);

        // Opciones de la gráfica
        var opciones = {
          title:'Cantidad de Presos por Comisaria',
          is3D:true,
          width:500,
          height:600,
          pieHole: .4
        };

        // Inicia la gráfica
        var chart = new google.visualization.PieChart(document.getElementById('tortaNovGuar'));
        chart.draw(data, opciones);
      }
    </script>
  </head>

  <body>
    <!--División para la grafica-->
    <div id="tortaNovGuar"></div>
  </body>
</html>