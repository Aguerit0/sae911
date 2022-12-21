<?php
$id = $_GET['id'];
include('conexion.php');
session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}

$idRegistroSecuestro = $_GET['id'];
//CONSULTA TABLA registrosecuestro_DE_GUARDIA
$consultaSQL = $bd_conex->prepare("SELECT * FROM registro_secuestro WHERE id=:id");
$consultaSQL->bindParam(':id', $id);
$consultaSQL->execute();
$registrosecuestro = $consultaSQL->fetch(PDO::FETCH_LAZY);



$idRegistroSecuestroRelevancia = $registrosecuestro['id'];
$fecha_reg_tabla = $registrosecuestro['fecha_reg_tabla'];
$fecha_reg = $registrosecuestro['fecha_reg'];
$hora_reg = $registrosecuestro['hora_reg'];
$hecho = $registrosecuestro['hecho'];
$elemento_secuestrado = $registrosecuestro['elemento_secuestrado'];

//ELIMINAR UN REGISTRO
if (isset($_POST['confirmarEliminarRegistro'])) {
  $eliminado = 1;
  $sentenciaSQL = $bd_conex->prepare('UPDATE registro_secuestro SET eliminado=:eliminado WHERE id=:id');
  $sentenciaSQL->bindParam(':id', $idRegistroSecuestro);
  $sentenciaSQL->bindParam(':eliminado', $eliminado);
  $sentenciaSQL->execute();

  header('Location: registro-secuestros-tabla.php');
}

// //   //EDITAR UN REGISTRO
// //   //CONSULTAR VALORES NUEVOS DE LOS INPUTS
// //   if (isset($_POST['guardarRegistro'])) {
// //   $consultaSelectRegistro="SELECT * FROM comisarias WHERE idComisaria=$idComisaria";
// //   $resultadoSelectRegistro=mysqli_query($conexion,$consultaSelectRegistro);
// //   if (!$resultadoSelectRegistro) {
// //     echo '<script>alert("ERROR INF")</script>';
// //   }
// //   //OBTENCION DE DATOS TABLA COMISARIA
// //   if ($row1 = $resultadoSelectRegistro->fetch_assoc()) {

// // }
// // mysqli_close($conexion);
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Css Mapa -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include("template/dashboard.php") ?>

  <!-- ======= Sidebar ======= -->
  <?php if ($_SESSION['rol'] == 1) {
    include("template/admin.php");
  } else {
    include("template/usuario.php");
  }
  ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Tabla Registro de Secuestro</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="registrosecuestro-tabla.php">Registro de Secuestro</a></li>
          <li class="breadcrumb-item active">Ver más</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card w-75 pt-3">
      <div class="card-body">
        <ul class="list-group">
          <li class="list-group-item fw-bold">Fecha y Hora de Registro: <span class="fw-normal ms-2"><?php echo date("d/m/Y H:i:s", strtotime($fecha_reg_tabla)) ?></span></li>
          </li>
          <li class="list-group-item fw-bold">Fecha Registro: <span class="fw-normal ms-2"><?php $newDate = date("d/m/Y", strtotime($fecha_reg));
                                                                                            echo $newDate ?></span></li>
          <li class="list-group-item fw-bold">Hora Hecho: <span class="fw-normal ms-2"><?php echo $hora_reg ?></span></li>
          <li class="list-group-item fw-bold">Hecho: <span class="fw-normal ms-2"><?php echo $hecho ?></span></li>
          <li class="list-group-item fw-bold">Elemento Secuestrado: <span class="fw-normal ms-2"><?php echo $elemento_secuestrado ?></span>
          </li>
        </ul>

        <?php if ($_SESSION['rol'] == 1) {
          include("./template/botonera-registro-secuestros.php");
        }
        ?>
      </div>
    </div>
    <a class="btn btn-primary" href="registro-secuestros-tabla.php">Volver</a>
  </main><!-- End #main -->

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
    var lat = <?php echo $latitud ?>;
    var lon = <?php echo $longitud ?>;

    //inicializa mapa con centro del mapa con coordenadas iniciales y zoom de 17 en DIV mapid
    var map = L.map('map').setView([lat, lon], 17);
    //Indica que Tile se utilizará
    /* L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    }).addTo(map); */


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'

    }).addTo(map);

    L.marker([<?php echo $latitud ?>, <?php echo $longitud ?>]).addTo(map);
  </script>
</body>

</html>