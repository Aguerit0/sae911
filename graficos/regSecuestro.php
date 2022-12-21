<?php
  include('././conexion.php');
  
  //CONSULTA PARA GRÁFICOS DE COMISARIAS GENERALES
  $sql = "SELECT COUNT(id) AS idRegistroSecuestro, fecha_reg_tabla, hecho FROM registro_secuestro GROUP BY hecho ORDER BY id ASC";
  $r = mysqli_query($conexion, $sql);
?>
<html>
  <head>
  <style>#grafico4{float: left;}</style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(graficaa);

    function graficaa() {
      var data = google.visualization.arrayToDataTable([
        ["hecho","cantReg"],
          <?php
            $i = 0;
            $n = mysqli_num_rows($r);
            while($row=mysqli_fetch_assoc($r)){

              print "['".$row["hecho"]."', ".$row["idRegistroSecuestro"]."]";
              $i++;
              if($i<$n) print ",";
            }
          ?>
        ]);
      //
      var opciones = {
        title: 'Cantidad de Registros de Secuestros',
        colors:['orange'],
        fontSize:25,
        fontName:"Times",
        hAxis: {
          title: 'Hechos',
          titleTextStyle: {color: 'blue', fontSize:30},
          textPosition: "out",
          textStyle: {color:"blue", fontSize:20, fontName:"Times",bold:true, italic: true}
        },
        vAxis: {
          title: 'Cantidad',
          titleTextStyle: {color: '#0000FF', bold:true, fontSize:30, fontName: "Arial"},
          textStyle: {color: '#0000FF', bold:true, fontSize:20, fontName: "Arial"},
          gridlines: {color: 'gray'}
        },
        legend: { position: 'none'},
        titleTextStyle: { 
          color: "gray",
          fontSize: 40,
          italic: true 
        },
        bar:{groupWidth: "100%"},
        width:600,
        height: 600
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico4"));
      chart.draw(data, opciones);
  }
  </script>
  </head>
  <body>
      <div id="grafico4" >
        
      </div>
  </body>
</html>