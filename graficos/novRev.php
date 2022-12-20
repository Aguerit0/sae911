<?php
  include('././conexion.php');
  
  //CONSULTA PARA GRÁFICOS DE COMISARIAS GENERALES
  $sql = "SELECT COUNT(n.idComisaria) AS idComisariaContador, n.tipo, COUNT(n.id) AS contId FROM novedades_de_relevancia AS n INNER JOIN comisarias AS c ON n.idComisaria=c.idComisaria GROUP BY n.tipo ORDER BY idComisariaContador ASC";
  $r = mysqli_query($conexion, $sql);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(grafica);

    function grafica() {
      var data = google.visualization.arrayToDataTable([
        ["Navegador","Participación"],
          <?php
            $i = 0;
            $n = mysqli_num_rows($r);
            while($row=mysqli_fetch_assoc($r)){

              print "['".$row["tipo"]."', ".$row["idComisariaContador"]."]";
              $i++;
              if($i<$n) print ",";
            }

          ?>

        ]);
      //
      var opciones = {
        title: 'Tipo de Novedad de Relevancia',
        colors:['pink'],
        fontSize:25,
        fontName:"Times",
        hAxis: {
          title: 'Novedades',
          titleTextStyle: {color: 'green', fontSize:30},
          textPosition: "out",
          textStyle: {color:"green", fontSize:20, fontName:"Times",bold:true, italic: true}
        },
        vAxis: {
          title: 'Participación',
          titleTextStyle: {color: 'green', bold:true, fontSize:30, fontName: "Arial"},
          textStyle: {color: 'green', bold:true, fontSize:20, fontName: "Arial"},
          gridlines: {color: 'green'}
        },
        legend: { position: 'none'},
        titleTextStyle: { 
          color: "green",
          fontSize: 40,
          italic: true 
        },
        bar:{groupWidth: "80%"},
        height: 600
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafica2"));
      chart.draw(data, opciones);
  }
  </script>
  </head>
  <body>
      <div id="grafica2" ></div>
  </body>
</html>