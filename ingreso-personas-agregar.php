<?php
// LLAMANDO A LA BASE DE DATOS
include('conexion.php');
session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}

//INICIALIZAMOS DATOS
$idUsuario = $_SESSION['id'];

if (isset($_POST['agregar'])) {
  $comisaria = $_POST['txtComisaria'];
  $tipo = $_POST['tipo'];
  $subtipo = $_POST['subtipo'];
  $dispuestoPor = $_POST['dispuesto_por'];
  $fechaHoraIngreso = $_POST['fecha_hora_ingreso'];
  $secuestro = $_POST['secuestro'];
  $elementoSecuestrado = $_POST['elem_secuestrado'];


  //CONSULTA INSERTAR DATOS
  $insertar = "INSERT INTO ingreso_persona (fecha_hora_reg, tipo, subtipo, dispuesto_por, fecha_hora_ingreso, secuestro, elem_secuestrado, idComisaria, idUsuario) VALUES (NOW(),'$tipo','$subtipo','$dispuestoPor','$fechaHoraIngreso','$secuestro','$elementoSecuestrado','$comisaria','$idUsuario')";

  //EJECUTAR CONSULTA INSERTAR DATOS
  $ejecutarInsertar = mysqli_query($conexion, $insertar);
  if (!$ejecutarInsertar) {
    echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
  } else {
    header('location:ingreso-personas-tabla.php?mensaje=agregado');
  }
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
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include("./template/dashboard.php") ?>

  <!-- ======= Sidebar ======= -->
  <?php if ($_SESSION['rol'] == 1) {
    include("./template/admin.php");
  } else {
    include("./template/usuario.php");
  }
  ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Formulario Ingreso de Personas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Formulario Ingreso de Personas</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card">
      <div class="card-body">

        <!-- FORMULARIO PARA INGRESO DE PERSONAS -->
        <form method="POST" enctype="multipart/form-data" class="row g-3 pt-3">


          <div class="col-md-6">
            <label for="inputState" class="form-label">Comisaria</label>
            <select required id="txtComisaria" name="txtComisaria" class="form-select">
              <option value="">Seleccionar</option>
              <?php
              include('conexion.php');
              if ($_SESSION['rol'] == 1) {
                $tabla_comisaria = "SELECT idComisaria, nombre FROM comisarias WHERE (eliminado<1) AND habilitado = 1 ORDER BY idComisaria ASC;";
                $resultado4 = mysqli_query($conexion, $tabla_comisaria);
              } else {
                $tabla_comisaria = "SELECT idUsuario, u.idComisaria, nombre FROM `usuario-comisaria` u INNER JOIN comisarias c WHERE (c.eliminado<1) AND c.habilitado = 1 AND u.idUsuario = $idUsuario AND c.idComisaria = u.idComisaria ORDER BY u.idComisaria ASC;";
                $resultado4 = mysqli_query($conexion, $tabla_comisaria);
              }

              while ($row = mysqli_fetch_assoc($resultado4)) {

                $idComisaria = $row['idComisaria'];
                $nombre = $row['nombre'];
              ?>

                <option value="<?php echo $idComisaria; ?>"><?php echo $nombre; ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="tipo" class="form-label">Tipo</label>
            <select required id="tipo" name="tipo" class="form-select">
              <option value="">Seleccionar</option>
              <option value="SUSTRACCION DE MOTOCICLETA">SUSTRACCION DE MOTOCICLETA</option>
              <option value="SUSTRACCION DE AUTOMOVIL">SUSTRACCION DE AUTOMOVIL</option>
              <option value="ILICITO CONTRA LA PROPIEDAD">ILICITO CONTRA LA PROPIEDAD</option>
              <option value="ARREBATO">ARREBATO</option>
              <option value="ILICITO EN LA VIA PUBLICA">ILICITO EN LA VIA PUBLICA</option>
              <option value="DESORDEN">DESORDEN</option>
              <option value="ABUSO SEXUAL">ABUSO SEXUAL</option>
              <option value="ACOSO SEXUAL">ACOSO SEXUAL</option>
              <option value="AMENAZAS">AMENAZAS</option>
              <option value="ARMAS">ARMAS</option>
              <option value="EXHIBICIONES OBSENAS">EXHIBICIONES OBSENAS</option>
              <option value="VIOLENCIA FAMILIAR Y DE GENERO">VIOLENCIA FAMILIAR Y DE GENERO</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="subtipo" class="form-label">Subtipo</label>
            <select required id="subtipo" name="subtipo" class="form-select" disabled>
            </select>
          </div>

          <div class="col-md-6">
            <label readonly for="dispuesto_por" class="form-label">Dispuesto por</label>
            <input required type="text" name="dispuesto_por" id="dispuesto_por" class="form-control">
          </div>

          <div class="col-md-6">
            <label readonly for="fecha_hora_ingreso" class="form-label">Fecha y Hora de Ingreso</label>
            <input required type="datetime-local" name="fecha_hora_ingreso" id="fecha_hora_ingreso" class="form-control">
          </div>

          <div class="col-md-6">
            <label readonly for="secuestro" class="form-label">Secuestro</label>
            <select required name="secuestro" id="secuestro" class="form-select">
              <option value="">Seleccionar</option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
          </div>

          <div class="col-md-6">
            <label readonly for="elem_secuestrado" class="form-label">Elemento Secuestrado</label>
            <input required type="text" name="elem_secuestrado" id="elem_secuestrado" class="form-control">
          </div>

          <div class="text-center">
            <button type="submit" name="agregar" value="agregar" class="btn btn-primary float-end">Agregar</button>
          </div>
        </form><!-- End Multi Columns Form -->

      </div>
    </div>
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
  <!-- Script de select -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="novedades-relevancia-agregar.js"></script>


</body>

</html>