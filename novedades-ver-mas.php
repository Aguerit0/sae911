<?php 
    include('conexion.php');
    session_start();
    // PREGUNTA SI HAY UN USUARIO REGISTRADO
    if(!isset($_SESSION['usuario'])){
      header('Location: index.php');
    }

    $idNovedades=$_GET['id'];
    //CONSULTA TABLA NOVEDADES_DE_GUARDIA
    $consultaSQL = $bd_conex->prepare("SELECT * FROM novedades_de_guardia WHERE id=:id");
    $consultaSQL->bindParam(':id', $idNovedades);
    $consultaSQL->execute();
    $novedades = $consultaSQL->fetch(PDO::FETCH_LAZY);

    
      $idUsuario = $novedades['idUsuario'];
      $idComisaria=$novedades['idComisaria'];
      // LLAMADA PARA SACAR EL NOMBRE DE LA COMISARIA
      $consultaSQL = $bd_conex->prepare("SELECT nombre FROM comisarias WHERE idComisaria=:id");
      $consultaSQL->bindParam(':id', $idComisaria);
      $consultaSQL->execute();
      $comisaria = $consultaSQL->fetch(PDO::FETCH_LAZY);
      $nombreComisaria=$comisaria['nombre'];
      
      $fecha = $novedades['fecha'];
      $turno = $novedades['turno'];
      $superior_de_turno = $novedades['superior_de_turno'];
      $oficial_servicio = $novedades['oficial_servicio'];
      $personas_de_guardia = $novedades['personas_de_guardia'];
      $motoristas = $novedades['motoristas'];
      $mov_funcionamiento = $novedades['mov_funcionamiento'];
      $mov_fuera_de_servicio = $novedades['mov_fuera_de_servicio'];
      $detenidos_causa_federal = $novedades['detenidos_causa_federal'];
      $detenidos_justicia_ordinaria = $novedades['detenidos_justicia_ordinaria'];
      $arres_averiguacion_de_hecho = $novedades['arres_averiguacion_de_hecho'];
      $aprehendidos = $novedades['aprehendidos'];
      $arres_averiguacion_actividades = $novedades['arres_averiguacion_actividades'];
      $arres_info_codigo_de_faltas = $novedades['arres_info_codigo_de_faltas'];
      $demorados = $novedades['demorados'];
      $eliminado= $novedades['eliminado'];


    



  //ELIMINAR UN REGISTRO
  if (isset($_POST['confirmarEliminarRegistro'])){
    $eliminado = 1;
    $sentenciaSQL=$bd_conex->prepare('UPDATE novedades_de_guardia SET eliminado=:eliminado WHERE id=:id');
    $sentenciaSQL->bindParam(':id', $idNovedades);
    $sentenciaSQL->bindParam(':eliminado', $eliminado);
    $sentenciaSQL->execute();
    
    header('Location: novedades-tabla.php?mensaje=eliminado');
  }
    mysqli_close($conexion);
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

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
    <div class="pagetitle">
        <h1>Tabla Novedades de Guardia</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="novedades-tabla.php">Tabla Novedades de Guardia</a></li>
            <li class="breadcrumb-item active">Ver Más</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card w-75 pt-3">
      <div class="card-body">

          <!-- CODIGO DE ALERTAS -->
          <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado')
            {
          ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Editado!</strong> Los datos fueron actualizados.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php
              }
          ?>
          <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error')
            {
          ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong> Error</strong> No se pudo editar la infomación.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php
              }
          ?>
          <ul class="list-group">
          <li class="list-group-item fw-bold">Comisaria: <span class="fw-normal ms-2"><?php echo $nombreComisaria ?></span></li>
          <li class="list-group-item fw-bold">Fecha: <span class="fw-normal ms-2"><?php echo $fecha ?></span></li></li>
          <li class="list-group-item fw-bold">Turno: <span class="fw-normal ms-2"><?php echo $turno ?></span></li>
          <li class="list-group-item fw-bold">Superior de turno: <span class="fw-normal ms-2"><?php echo $superior_de_turno ?></span></li>
          <li class="list-group-item fw-bold">Oficial servicio: <span class="fw-normal ms-2"><?php echo $oficial_servicio ?></span></li>
          <li class="list-group-item fw-bold">Cant. de personal de guardia: <span class="fw-normal ms-2"><?php echo $personas_de_guardia ?></span></li>
          <li class="list-group-item fw-bold">Motoristas: <span class="fw-normal ms-2"><?php echo $motoristas ?></span></li>
          <li class="list-group-item fw-bold">Mov. en funcionamiento: <span class="fw-normal ms-2"><?php echo $mov_funcionamiento ?></span></li>
          <li class="list-group-item fw-bold">Mov. fuera de servicio: <span class="fw-normal ms-2"><?php echo $mov_fuera_de_servicio ?></span></li>
          <li class="list-group-item fw-bold">Cant. detenidos causa federal: <span class="fw-normal ms-2"><?php echo $detenidos_causa_federal ?></span></li>
          <li class="list-group-item fw-bold">Cant. detenidos justicia ordinaria: <span class="fw-normal ms-2"><?php echo $detenidos_justicia_ordinaria ?></span></li>
          <li class="list-group-item fw-bold">Arrestados averiguacion del hecho: <span class="fw-normal ms-2"><?php echo $arres_averiguacion_de_hecho ?></span></li>
          <li class="list-group-item fw-bold">Cant. aprehendidos: <span class="fw-normal ms-2"><?php echo $aprehendidos ?></span></li>
          <li class="list-group-item fw-bold">Arrestados averiguacion actividades: <span class="fw-normal ms-2"><?php echo $arres_averiguacion_actividades ?></span></li>
          <li class="list-group-item fw-bold">Arrestados inf. codigo de faltas: <span class="fw-normal ms-2"><?php echo $arres_info_codigo_de_faltas ?></span></li>
          <li class="list-group-item fw-bold">Demorados: <span class="fw-normal ms-2"><?php echo $demorados ?></span></li>
        </ul>  
        
        <?php  if($_SESSION['rol'] == 1){
           include ("./template/botonera-novedadesDeGuardia.php");
          }
        ?>
      </div>
    </div>
    <a class="btn btn-primary" href="novedades-tabla.php">Volver</a>
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

</body>

</html>