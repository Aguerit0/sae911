<?php 
$id=$_GET['id'];
    include('conexion.php');
    session_start();
    // PREGUNTA SI HAY UN USUARIO REGISTRADO
    if(!isset($_SESSION['usuario'])){
      header('Location: index.php');
    }

    $idNovedades=$_GET['id'];
    //CONSULTA TABLA NOVEDADES_DE_GUARDIA
    $consultaSQL = $bd_conex->prepare("SELECT * FROM novedades_de_relevancia WHERE id=:id");
    $consultaSQL->bindParam(':id', $id);
    $consultaSQL->execute();
    $novedades = $consultaSQL->fetch(PDO::FETCH_LAZY);


    // $consultaSelectNovedades="SELECT * FROM novedades_de_guardia WHERE id=$idNovedades";
    // $resultadoSelectNovedades=mysqli_query($conexion,$consultaSelectNovedades);
    // if (!$resultadoSelectNovedades) {
    //   echo '<script>alert("ERROR AL ENCONTRAR INFORMACIÓN")</script>';
    // }
    //OBTENCION DE DATOS TABLA NOVEDADES_DE_GUARDIA
    

      $fecha_reg = $novedades['fecha_reg'];
      $fecha_reg_tabla = $novedades['fecha_reg_tabla'];
      $hora_tabla = $novedades['hora_tabla'];
      $lugar = $novedades['lugar'];
      $sindicatos = $novedades['sindicatos'];
      $caracteristicas_hecho = $novedades['caracteristicas_hecho'];
      $elento_utlizado = $novedades['elento_utlizado'];
      $movil = $novedades['movil'];
      $elemento_sustraido = $novedades['elemento_sustraido'];
      $hecho_consumado = $novedades['hecho_consumado'];
      $tipo_motocicleta = $novedades['tipo_motocicleta'];
      $color = $novedades['color'];
      $adelanto_circulacion = $novedades['adelanto_circulacion'];
      $damnificado = $novedades['damnificado'];
      $edad = $novedades['edad'];
      $sexo= $novedades['sexo'];
      $denunciante= $novedades['denunciante'];
      $denuncia= $novedades['denuncia'];
      $unidad_judicial= $novedades['unidad_judicial'];
      $comision_personal= $novedades['comision_personal'];
      $medida_tomada= $novedades['medida_tomada'];
      $id_tipo= $novedades['id_tipo'];
      $id_subtipo= $novedades['id_subtipo'];
      $idComisaria= $novedades['idComisaria'];




    //OBTENCION DE DATOS DE TABLA COMISARIAS POR: IDCOMISARIAS
    //CONSULTAMOS BD
    // $consultaSelectComisarias="SELECT * FROM comisarias WHERE idComisaria=$idComisaria";
    // $resultadoSelectComisarias=mysqli_query($conexion,$consultaSelectComisarias);
    // if (!$consultaSelectComisarias) {
    //   echo '<script>alert("ERROR AL ENCONTRAR INFORMACIÓN")</script>';
    // }
    // if ($row2=$resultadoSelectComisarias->fetch_assoc()) {
    //   $nombreComisaria=$row2['nombre'];
    // }


    // //BOTON GUARDAR->VERMASNOVEDADES->
    // if (isset($_POST['guardarNovedad'])) {
    //   $fecha=$_POST['fecha'];
    //   $turno=$_POST['turno'];
    //   $superior_de_turno=$_POST['superior_de_turno'];
    //   $oficial_servicio=$_POST['oficial_servicio'];
    //   $personas_de_guardia=$_POST['personas_de_guardia'];
    //   $motoristas=$_POST['motoristas'];
    //   $mov_funcionamiento=$_POST['mov_funcionamiento'];
    //   $mov_fuera_de_servicio=$_POST['mov_fuera_de_servicio'];
    //   $detenidos_causa_federal=$_POST['detenidos_causa_federal'];
    //   $detenidos_justicia_ordinaria=$_POST['detenidos_justicia_ordinaria'];
    //   $arres_averiguacion_de_hecho=$_POST['arres_averiguacion_de_hecho'];
    //   $aprehendidos=$_POST['aprehendidos'];
    //   $arres_averiguacion_actividades=$_POST['arres_averiguacion_actividades'];
    //   $arres_info_codigo_de_faltas=$_POST['arres_info_codigo_de_faltas'];
    //   $demorados=$_POST['demorados'];

    //   //CONSULTA PARA ACTUALIZAR VALORES EN BASE DE DATOS
    //   $consultaUpdateNovedades = "UPDATE novedades_de_guardia SET fecha='$fecha', turno='$turno', superior_de_turno='$superior_de_turno', oficial_servicio='$oficial_servicio', personas_de_guardia='$personas_de_guardia', motoristas='$motoristas', mov_funcionamiento='$mov_funcionamiento', mov_fuera_de_servicio='$mov_fuera_de_servicio', detenidos_causa_federal='$detenidos_causa_federal', detenidos_justicia_ordinaria='$detenidos_justicia_ordinaria', arres_averiguacion_de_hecho='$arres_averiguacion_de_hecho', arres_averiguacion_actividades='$arres_averiguacion_actividades', arres_info_codigo_de_faltas='$arres_info_codigo_de_faltas', demorados='demorados' WHERE $idNovedades ";
    //   $resultadoUpdateNovedades=mysqli_query($conexion,$consultaUpdateNovedades);
    //   if (!$resultadoUpdateNovedades) {
    //     echo '<script>alert("ERROR AL ENCONTRAR INFORMACIÓN")</script>';
    //   }

    // }




  //ELIMINAR UN REGISTRO
  if (isset($_POST['confirmarEliminarRegistro'])){
    $eliminado = 1;
    $sentenciaSQL=$bd_conex->prepare('UPDATE novedades_de_guardia SET eliminado=:eliminado WHERE id=:id');
    $sentenciaSQL->bindParam(':id', $idNovedades);
    $sentenciaSQL->bindParam(':eliminado', $eliminado);
    $sentenciaSQL->execute();
    
    header('Location: novedades-tabla.php');
  }

  //   //EDITAR UN REGISTRO
  //   //CONSULTAR VALORES NUEVOS DE LOS INPUTS
  //   if (isset($_POST['guardarRegistro'])) {
  //   $consultaSelectRegistro="SELECT * FROM comisarias WHERE idComisaria=$idComisaria";
  //   $resultadoSelectRegistro=mysqli_query($conexion,$consultaSelectRegistro);
  //   if (!$resultadoSelectRegistro) {
  //     echo '<script>alert("ERROR INF")</script>';
  //   }
  //   //OBTENCION DE DATOS TABLA COMISARIA
  //   if ($row1 = $resultadoSelectRegistro->fetch_assoc()) {

  // }
    // mysqli_close($conexion);
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
          <ul class="list-group">
          <li class="list-group-item fw-bold">Fecha Registro: <span class="fw-normal ms-2"><?php echo $fecha_reg ?></span></li></li>
          <li class="list-group-item fw-bold">Fecha Registro: <span class="fw-normal ms-2"><?php echo $fecha_reg_tabla ?></span></li>
          <li class="list-group-item fw-bold">Hora: <span class="fw-normal ms-2"><?php echo $hora_tabla ?></span></li>
          <li class="list-group-item fw-bold"> Lugar: <span class="fw-normal ms-2"><?php echo $lugar ?></span></li>
          <li class="list-group-item fw-bold">Sindicatos: <span class="fw-normal ms-2"><?php echo $sindicatos ?></span></li>
          <li class="list-group-item fw-bold">Catacteristicas de Hecho: <span class="fw-normal ms-2"><?php echo $caracteristicas_hecho ?></span></li>
          <li class="list-group-item fw-bold">Elemnto Utilizado: <span class="fw-normal ms-2"><?php echo $elento_utlizado ?></span></li>
          <li class="list-group-item fw-bold">Movil: <span class="fw-normal ms-2"><?php echo $movil ?></span></li>
          <li class="list-group-item fw-bold">Elemento Sustraido: <span class="fw-normal ms-2"><?php echo $elemento_sustraido ?></span></li>
          <li class="list-group-item fw-bold">Hecho Consumado: <span class="fw-normal ms-2"><?php echo $hecho_consumado ?></span></li>
          <li class="list-group-item fw-bold">Tipo de Motocicleta: <span class="fw-normal ms-2"><?php echo $tipo_motocicleta ?></span></li>
          <li class="list-group-item fw-bold">Color: <span class="fw-normal ms-2"><?php echo $color ?></span></li>
          <li class="list-group-item fw-bold">Adelanto Circulacion: <span class="fw-normal ms-2"><?php echo $adelanto_circulacion ?></span></li>
          <li class="list-group-item fw-bold">Damificado: <span class="fw-normal ms-2"><?php echo $damnificado ?></span></li>
          <li class="list-group-item fw-bold">Edad: <span class="fw-normal ms-2"><?php echo $edad ?></span></li>
          <li class="list-group-item fw-bold">Sexo: <span class="fw-normal ms-2"><?php echo $sexo ?></span></li>
          <li class="list-group-item fw-bold">Denunciante: <span class="fw-normal ms-2"><?php echo $denunciante ?></span></li>

          <li class="list-group-item fw-bold">Unidad Judicial: <span class="fw-normal ms-2"><?php echo $unidad_judicial ?></span></li>

          <li class="list-group-item fw-bold">Comision Personal: <span class="fw-normal ms-2"><?php echo $comision_personal ?></span></li>

          <li class="list-group-item fw-bold">Medida Tomada: <span class="fw-normal ms-2"><?php echo $medida_tomada ?></span></li>
          <li class="list-group-item fw-bold">Tipo: <span class="fw-normal ms-2"><?php echo $id_tipo ?></span></li>
         <li class="list-group-item fw-bold">Sub Tipo: <span class="fw-normal ms-2"><?php echo $id_subtipo ?></span></li>
         <li class="list-group-item fw-bold">Comisaria: <span class="fw-normal ms-2"><?php echo $id_Comisaria ?></span></li>



        </ul>  
        
        <?php  if($_SESSION['rol'] == 1){
           include ("./template/botonera-novedadesDeRelevancia.php.php");
          }
        ?>
      </div>
    </div>
    <br>
    <a class="btn btn-primary" href="novedades-relevancia-tabla.php">Volver</a>
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