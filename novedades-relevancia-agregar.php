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
  $idComisaria = $_SESSION['idComisaria'];
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

  <!-- Css Reloj -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="clockpicker.css">

  <!-- Css Mapa -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>

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
          <form action="novedades-relevancia-agregar-log.php" method="POST" enctype="multipart/form-data" class="row g-3 pt-3">

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Fecha de registro</label>
              <div class="col-sm-10">
                <input required type="date" id="txtFecha" name="txtFecha" class="form-control">
              </div>
            </div>

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Hora</label>
              <input type="text" id="txtHora" name="txtHora" class="form-control clockpicker" data-placement="left" data-align="top" data-autoclose="true" readonly="">
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Tipo</label>
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
              <label for="inputState" class="form-label">Subtipo</label>
              <select required id="subtipo" name="subtipo" class="form-select" disabled>
              </select>
            </div>

            <div class="col-md-6">
              <label readonly for="inputEmail5" class="form-label">Longitud</label>
              <input required type="text" name="lon" id="lon" class="form-control" readonly>
            </div>

            <div class="col-md-6">
              <label readonly for="inputEmail5" class="form-label">Latitud</label>
              <input required type="text" name="lat" id="lat" class="form-control" readonly>
            </div> 

            <!-- <label for="lat">Latitud</label>
            <input readonly type="text" name="lat" id="lat">
            
            <label for="lon">Longitud</label>
            <input readonly type="text" name="lon" id="lon"> -->

            <div class="col-md-12">
              <div id="map" style="height: 45vh; width: 60vw; margin: 0 auto; border-radius: 10px;"></div>
            </div>
          
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Descripcion Del Lugar</label>
              <input required type="text" id="txtDescr_Lugar" name="txtDescr_Lugar" class="form-control" id="inputEmail5">
            </div>

            <div class="col-md-6">
              <label for="inputtext5"  class="form-label">Sindicados (cantidad) </label>
              <input required type="number" id="txtSindicados" name="txtSindicados" class="form-control" id="inputtext5">
            </div>
            
            <div class="col-md-6">
              <label for="inputtext5"  class="form-label">Caracteristica del hecho</label>
              <input required type="text" id="txtCaractDeHecho" name="txtCaractDeHecho" class="form-control" id="inputtext5">
            </div>

            <div class="col-6">
              <label for="inputAddress5" class="form-label">Movil que asistio al lugar</label>
              <input required type="text" id="txtMovil" name="txtMovil" class="form-control" id="inputAddres5s">
            </div>
            <div class="col-6">
                <label for="inputAddress5" class="form-label">Elemento sustraido</label>
                <input required type="text" id="txtElementoSustraido" name="txtElementoSustraido" class="form-control" id="inputAddres5s">
              </div>
        
              <div class="col-md-6">
              <label for="inputState" class="form-label">Hecho consumado o intento </label>
              <select required id="inputState" id="Hecho_Con_Int" name="Hecho_Con_Int" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Consumado">Consumado</option>
                <option value="Intento">Intento</option>
            </select>
            </div>




            <div class="col-md-6">
              <label for="inputState" class="form-label">Elemento utilizado (Moto o Pie)</label>
              <select required id="ElementoUtilizado" name="ElementoUtilizado" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Motocicleta">Motocicleta</option>
                <option value="Pie">Pie</option>            
              </select>
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Tipo de motocicleta utilizada </label>
              <select required id="TipoMotocicleta" name="TipoMotocicleta" class="form-select" disabled>
            </select>
            </div>

            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Color</label>
              <input required type="text" id="txtColor" name="txtColor" class="form-control" disabled>
            </div>


            <div class="col-md-6">
              <label for="inputState" class="form-label">Emitio adelanto de circular</label>
              <select required id="inputState" id="EmitioAdelanto" name="EmitioAdelanto" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            </div>

            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Damnificado</label>
              <input required type="text" id="txtDamnificado" name="txtDamnificado" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Edad</label>
              <input required type="number" id="txtEdad" name="txtEdad" class="form-control" id="inputtext5">
            </div>
            
            <div class="col-md-6">
              <label for="inputState" class="form-label">Sexo </label>
              <select required id="inputState" id="Sexo" name="Sexo" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Hombre">Hombre</option>
                <option value="Mujer">Mujer</option>
                <option value="No Binario">No Binario</option>
            </select>
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Denuncia </label>
              <select required id="Denuncia" name="Denuncia" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            </div>

            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Denunciante</label>
              <input required type="text" id="txtDenunciante" name="txtDenunciante" class="form-control" disabled>
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Unidad judicial </label>
              <select required id="UnidadJudicial" name="UnidadJudicial" class="form-select" disabled>
              </select>
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Comision de personal policial en la investigacion</label>
              <select required id="inputState" id="ComisionPolicialInvestigacion" name="ComisionPolicialInvestigacion" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            </div>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Medida tomada </label>
              <select required id="inputState" id="MedidaTomada" name="MedidaTomada" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Fiscalia de instroduccion">Fiscalia de instroduccion</option>
                <option value="Demora">Demora</option>
                <option value="A.A.A">A.A.A</option>
                <option value="A.I.C.F">A.I.C.F</option>
                <option value="Aprehension">Aprehension</option>
                <option value="A.A echo">A.A Hecho</option>
                <option value="Detencion">Detencion</option>
                <option value="Secuestros">Secuestros</option>
                <option value="Registros">Registros</option>
                <option value="Allanamiento">Allanamiento</option>
              </select>
            </div>
            
            
            <div class="text-center">
              <button type="submit" name="BtnAgregar" class="btn btn-primary float-end">Agregar</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>
      </div>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SAE 911</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="http://institutosanmartin.edu.ar/sitio/">Instituto San Martin</a>
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

  <!-- Script de select -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="novedades-relevancia-agregar.js"></script>

  <!-- Script de reloj -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="clockpicker.js"></script>
  <script type="text/javascript">$('.clockpicker').clockpicker();</script>

  <!-- Script de mapa -->
  <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
  <script src="mapa.js"></script>
  
</body>

</html>