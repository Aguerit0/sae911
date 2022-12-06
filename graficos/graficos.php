<?php 
  include('./conexion.php');
  //CONSULTAS NOVEDADES_DE_RELEVANCIA: TIPOS
  //CONTADOR --ARREBATO--
  $sql1 = "SELECT count(*) id FROM novedades_de_relevancia WHERE tipo like '%ARREBATO%'";
  $res1 = mysqli_query($conexion,$sql1);
  $row1 = mysqli_fetch_assoc($res1);
  $var1 = 'ARREBATOS';

  //CONTADOR --ILICITOS VIA PUBLICA--
  $sql2 = "SELECT count(*) id FROM novedades_de_relevancia WHERE tipo like '%ILICITO EN LA VIA PUBLICA%'";
  $res2 = mysqli_query($conexion,$sql2);
  $row2 = mysqli_fetch_assoc($res2);
  $var2 = 'ILICITO EN LA VIA PUBLICA';

  //CONTADOR --ARMAS--
  $sql3 = "SELECT count(*) id FROM novedades_de_relevancia WHERE tipo like '%ARMAS%'";
  $res3 = mysqli_query($conexion,$sql3);
  $row3 = mysqli_fetch_assoc($res3);
  $var3 = 'ARMAS';

  //CONTADOR --ILICITO CONTRA LA PROPIEDAD--
  $sql4 = "SELECT count(*) id FROM novedades_de_relevancia WHERE tipo like '%ILICITO CONTRA LA PROPIEDAD%'";
  $res4 = mysqli_query($conexion,$sql4);
  $row4 = mysqli_fetch_assoc($res4);
  $var4 = 'ILICITO CONTRA LA PROPIEDAD';

  //CONTADOR --SUSTRACCION DE AUTOMOVIL--
  $sql5 = "SELECT count(*) id FROM novedades_de_relevancia WHERE tipo like '%SUSTRACCION DE AUTOMOVIL%'";
  $res5 = mysqli_query($conexion,$sql5);
  $row5 = mysqli_fetch_assoc($res5);
  $var5 = 'SUSTRACCION DE AUTOMOVIL';

  //CONTADOR --ACOSO SEXUAL--
  $sql6 = "SELECT count(*) id FROM novedades_de_relevancia WHERE tipo like '%ACOSO SEXUAL%'";
  $res6 = mysqli_query($conexion,$sql6);
  $row6 = mysqli_fetch_assoc($res6);
  $var6 = 'ACOSO SEXUAL';

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Styles -->
<style>
#graf_nov_relev {
  width: 100%;
  height: 500px;
}
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("graf_nov_relev");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX:true
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
xRenderer.labels.template.setAll({
  rotation: -90,
  centerY: am5.p50,
  centerX: am5.p100,
  paddingRight: 15
});

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
  maxDeviation: 0.3,
  categoryField: "country",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 0.3,
  renderer: am5xy.AxisRendererY.new(root, {})
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Series 1",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  sequencedInterpolation: true,
  categoryXField: "country",
  tooltip: am5.Tooltip.new(root, {
    labelText:"{valueY}"
  })
}));

series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
series.columns.template.adapters.add("fill", function(fill, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

series.columns.template.adapters.add("stroke", function(stroke, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});


// Set data
var data = [{
  country: "<?php echo $var1?>",
  value: <?php echo $row1['id'] ?>
}, {
  country: "<?php echo $var2 ?>",
  value: <?php echo $row2['id'] ?>
}, {
  country: "<?php echo $var3 ?>",
  value: <?php echo $row3['id'] ?>
}, {
  country: "<?php echo $var4 ?>",
  value: <?php echo $row4['id'] ?>
}, {
  country: "<?php echo $var5 ?>",
  value: <?php echo $row5['id'] ?>
}, {
  country: "<?php echo $var6 ?>",
  value: <?php echo $row6['id'] ?>
}];

xAxis.data.setAll(data);
series.data.setAll(data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
</script>

</head>
<body>
    <!-- HTML -->
    <div id="graf_nov_relev"></div>    
    
</body>
</html>