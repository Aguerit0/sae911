<?php
// LLAMANDO A LA BASE DE DATOS
  include('conexion.php');
  session_start();
   // PREGUNTA SI HAY UN USUARIO REGISTRADO
  if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
  }

  //INICIALIZAMOS DATOS
  $idUsuario = $_SESSION['id'];
  // $idComisaria=1;
  if (isset($_POST['agregar'])) {
    $txtFecha = $_POST['txtFecha'];
    $txtComisaria = $_POST['txtComisaria'];
    $txtTurno = $_POST['txtTurno'];
    $txtSuperiorTurno = $_POST['txtSuperiorTurno'];
    $txtOficialServicio = $_POST['txtOficialServicio'];
    $txtCantPersonalGuardia = $_POST['txtCantPersonalGuardia'];
    $txtMotoristas = $_POST['txtMotoristas'];
    $txtMovilesFuncionamiento = $_POST['txtMovilesFuncionamiento'];
    $txtMovilesFueraFuncionamiento = $_POST['txtMovilesFueraFuncionamiento'];
    $txtCantDetenidosCausaFederal = $_POST['txtCantDetenidosCausaFederal'];
    $txtCantDetenidosJusticiaOrdinaria = $_POST['txtCantDetenidosJusticiaOrdinaria'];
    $txtArrestadisAveriguacionHecho = $_POST['txtArrestadisAveriguacionHecho'];
    $txtArrestadosAveriguacionActividades = $_POST['txtArrestadosAveriguacionActividades'];
    $txtArrestadosInfCodigoFaltas = $_POST['txtArrestadosInfCodigoFaltas'];
    $txtDemorados = $_POST['txtDemorados'];
    $txtCantAprehendidos = $_POST['txtCantAprehendidos'];


    //CONSULTA INSERTAR DATOS
    $insertar = "INSERT INTO novedades_de_guardia (idUsuario, idComisaria, fecha, turno, superior_de_turno, oficial_servicio, personas_de_guardia, motoristas, mov_funcionamiento, mov_fuera_de_servicio, detenidos_causa_federal, detenidos_justicia_ordinaria, arres_averiguacion_de_hecho, aprehendidos, arres_averiguacion_actividades, arres_info_codigo_de_faltas, demorados) VALUES ('$idUsuario','$txtComisaria','$txtFecha','$txtTurno','$txtSuperiorTurno','$txtOficialServicio','$txtCantPersonalGuardia','$txtMotoristas','$txtMovilesFuncionamiento','$txtMovilesFueraFuncionamiento','$txtCantDetenidosCausaFederal','$txtCantDetenidosJusticiaOrdinaria','$txtArrestadisAveriguacionHecho','$txtCantAprehendidos','$txtArrestadosAveriguacionActividades','$txtArrestadosInfCodigoFaltas','$txtDemorados')";

    //EJECUTAR CONSULTA INSERTAR DATOS
    $ejecutarInsertar=mysqli_query($conexion,$insertar);
    if(!$ejecutarInsertar){
      echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
    }
    else{
      header('location:novedades-tabla.php');
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
  
            <div class="alert alert-success">

            </div>
    <div class="pagetitle">
        <h1>Formulario Novedades de Relevancia</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Formulario Novedades de Relevancia</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
          <!-- FORMULARIO PARA AGREGAR NOVEDADES DE RELEVANCIA -->
          <form method="POST" enctype="multipart/form-data" class="row g-3 pt-3">


         
            <div class="col-md-6">
              <label for="inputDate"  class=" col-form-label">Fecha de resgitro</label>
              <div class="col-sm-10">
                <input required type="date" id="txtFecha" name="txtFecha" class="form-control">
              </div>
            </div>

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Fecha</label>
              <input required type="text" id="txtSuperiorTurno" name="txtSuperiorTurno" class="form-control" id="inputEmail5">
            </div>

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Hora</label>
              <input required type="text" id="txtSuperiorTurno" name="txtSuperiorTurno" class="form-control" id="inputEmail5">
            </div>

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Tipo</label>
              <input required type="text" id="txtSuperiorTurno" name="txtSuperiorTurno" class="form-control" id="inputEmail5">
            </div>

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Sub Tipo</label>
              <input required type="text" id="txtSuperiorTurno" name="txtSuperiorTurno" class="form-control" id="inputEmail5">
            </div>

          
            
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Lugar</label>
              <input required type="text" id="txtSuperiorTurno" name="txtSuperiorTurno" class="form-control" id="inputEmail5">
            </div>

          
            <div class="col-md-6">
              <label for="inputtext5"  class="form-label">Sindicados (cantidad) </label>
              <input required type="text" id="txtOficialServicio" name="txtOficialServicio" class="form-control" id="inputtext5">
            </div>

            
            <div class="col-md-6">
              <label for="inputtext5"  class="form-label">Caracteristica del hecho</label>
              <input required type="text" id="txtCantPersonalGuardia" name="txtCantPersonalGuardia" class="form-control" id="inputtext5">
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Elemnto utilizado (Moto o Pie)</label>
              <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                <option value="" selected>Motocicleta</option>
                <option value="">Pie</option>
                
              </select>
            </div>

            <div class="col-6">
              <label for="inputAddress5" class="form-label">Movil que asistio al lugar</label>
              <input required type="text" id="txtMotoristas" name="txtMotoristas" class="form-control" id="inputAddres5s">
            </div>
            <div class="col-6">
                <label for="inputAddress5" class="form-label">Elemento sustraido</label>
                <input required type="text" id="txtMovilesFuncionamiento" name="txtMovilesFuncionamiento" class="form-control" id="inputAddres5s">
              </div>
            
              <div class="col-md-6">
              <label for="inputState" class="form-label">Echo consumado o intento </label>
              <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                <option value="" selected>Consumado</option>
                <option value="">Intento</option>
             </select>
            </div>
            <div class="col-md-6">
              <label for="inputState" class="form-label">Tipo de motocicleta utilizada </label>
              <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                <option value="" selected>110cc</option>
                <option value="">125/150cc</option>
                <option value="">Enduro</option>
                <option value="">No especifica</option>
             </select>
            </div>

            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Color</label>
              <input required type="text" id="txtCantDetenidosCausaFederal" name="txtCantDetenidosCausaFederal" class="form-control" id="inputtext5">
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Emitio adelanto de circular </label>
              <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                <option value="" selected>SI</option>
                <option value="">No</option>
                
             </select>
            </div>

            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Damnificado</label>
              <input required type="text" id="txtCantDetenidosJusticiaOrdinaria" name="txtCantDetenidosJusticiaOrdinaria" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Edad</label>
              <input required type="text" id="txtArrestadisAveriguacionHecho" name="txtArrestadisAveriguacionHecho" class="form-control" id="inputtext5">
            </div>
            
            <div class="col-md-6">
              <label for="inputState" class="form-label">Sexo </label>
              <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                <option value="" selected>Hombre</option>
                <option value="">Mujer</option>
                <option value="">No Binario</option>
                <option value="">Otro</option>
             </select>
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Denuncia </label>
              <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                <option value="" selected>SI</option>
                <option value="">NO</option>
             </select>
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Unidad judicial </label>
              <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                <option value="" selected>Fiscalia de instroduccion</option>
                <option value="">U.J. N° 1</option>
                <option value="">U.J. N° 2</option>
                <option value="">U.J. N° 3</option>
                <option value="">U.J. N° 4</option>
                <option value="">U.J. N° 5</option>
                <option value="">U.J. N° 6</option>
                <option value="">U.J. N° 7</option>
                <option value="">U.J. N° 8</option>
                <option value="">U.J. N° 9</option>
                <option value="">U.J. N° 10</option>
                <option value="">U.J. N° 11</option>
                <option value="">Fiscalia de instroduccion</option>
                <option value="">UNID. Violencia de genero</option>
                 </select>
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Comision de personal policial en la investigacion</label>
              <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                <option value="" selected>SI</option>
                <option value="">NO</option>
             </select>
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Medida tomada </label>
              <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                <option value="" selected>Fiscalia de instroduccion</option>
                <option value="">Demora</option>
                <option value="">A.A.A</option>
                <option value="">A.I.C.F</option>
                <option value="">Aprehension</option>
                <option value="">A.A echo</option>
                <option value="">Detencion</option>
                <option value="">Secuestros</option>
                <option value="">Registros</option>
                <option value="">Allanamiento</option>
               
                 </select>
            </div>
           
            
            
            <div class="text-center">
              <button type="submit" name="agregar" value="agregar"  class="btn btn-primary float-end">Agregar</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

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