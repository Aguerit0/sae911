<?php
  include 'conexion.php';
  session_start();
  // PREGUNTA SI HAY UN USUARIO REGISTRADO
  if(!isset($_SESSION['usuario'])){
    header('Location: index.php');
  }



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SAE 911</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<br>
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  
    <link href="assets/css/style.css" rel="stylesheet">

      <!-- Css Mapa -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>


</head>

<body>

  <!-- ======= Header ======= -->
  <?php include("./template/dashboard.php")?>

  <!-- ======= Sidebar ======= -->
  <?php  if($_SESSION['rol'] == 1){
      include ("./template/admin.php");
    }else{
      include ("./template/usuario.php");
    }
  ?>

  <main id="main" class="main">

   

    

    <section class="section dashboard">

            <li class="list-group-item fw-bold">
            <div id="map" style="height:75vh; width: 70vw; margin: 0 auto; border-radius: 10px;"></div>
          </li>
    </section>

  </main><!-- End #main -->>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Script de mapa -->
  <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>

  <script>
    // Coordenadas iniciales

    var lat = -28.47326;
    var lon = -65.78756;
    
    //inicializa mapa con centro del mapa con coordenadas iniciales y zoom de 17 en DIV mapid

    var map = L.map('map').setView([lat, lon], 20);
    //Indica que Tile se utilizará
    /* L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    }).addTo(map); */


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'

    }).addTo(map);

    <?php

    $sql_rel = "SELECT * FROM novedades_de_relevancia";
    $resultado2 = mysqli_query($conexion,$sql_rel);

    while ($row2 = $resultado2->fetch_assoc()) 
    {
        ?>
            L.marker([<?php echo $row2['latitud'] ?>,<?php echo $row2['longitud'] ?>]).addTo(map).bindPopup(`
            <p>ID: <?php echo $row2['id'] ?></p>
            <p>Fecha: <?php echo $row2['fecha_reg'] ?></p>
            <p>Hora: <?php echo $row2['hora_reg'] ?></p>
            <p>Tipo: <?php echo $row2['tipo'] ?></p>
            <p>Subtipo: <?php echo $row2['subtipo'] ?></p>
            `);
        <?php
    }
    ?>

    </script>



</body>

</html>