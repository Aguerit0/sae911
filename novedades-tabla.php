<?php
 include 'conexion.php';

   //INICIALIZAMOS DATOS
  $idUsuario = 1;
  $idComisaria=1;
  $nombreComisaria = "Comisaria Ejemplo";
  if (isset($_POST['agregar'])) {
    $txtFecha = $_POST['txtFecha'];
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
    $insertar = "INSERT INTO novedades_de_guardia (idUsuario, idComisaria, fecha, turno, superior_de_turno, oficial_servicio, personas_de_guardia, motoristas, mov_funcionamiento, mov_fuera_de_servicio, detenidos_causa_federal, detenidos_justicia_ordinaria, arres_averiguacion_de_hecho, aprehendidos, arres_averiguacion_actividades, arres_info_codigo_de_faltas, demorados) VALUES ('$idUsuario','$idComisaria','$txtFecha','$txtTurno','$txtSuperiorTurno','$txtOficialServicio','$txtCantPersonalGuardia','$txtMotoristas','$txtMovilesFuncionamiento','$txtMovilesFueraFuncionamiento','$txtCantDetenidosCausaFederal','$txtCantDetenidosJusticiaOrdinaria','$txtArrestadisAveriguacionHecho','$txtCantAprehendidos','$txtArrestadosAveriguacionActividades','$txtArrestadosInfCodigoFaltas','$txtDemorados')";

    //EJECUTAR CONSULTA INSERTAR DATOS
    $ejecutarInsertar=mysqli_query($conexion,$insertar);
    if(!$ejecutarInsertar){
      echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
    }
    else{
      header('location:novedades-tabla.php');
    }
  }

  //CONSULTA TABLAS PARA MOSTRAR DATOS DE NOVEDADES DE GUARDIA
  $consultaDatosNovedadesDeGuardia="SELECT * FROM novedades_de_guardia";
  //RESULTAOD DE LA CONSULTA
  $resultado=mysqli_query($conexion,$consultaDatosNovedadesDeGuardia);
  if (!$resultado) {
    echo "<script>alert('ERROR AL CONSULTAR INFORMACIÓN');</script>";
    }else{
      
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
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">SAE 911</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          
        </li><!-- End Notification Nav -->

      

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="usuarios-perfil.php">
                <i class="bi bi-person"></i>
                <span>Mi Perfil</span>
              </a>
            </li>
           
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Salir</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Admin</span>
            </a>
          </li>
          <li>
            <a href="tabla-comisaria.php">
              <i class="bi bi-circle"></i><span>Comisarias</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Usuarios</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Novedades de Guardia</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         
          <li>
            <a href="novedades-agregar.php">
              <i class="bi bi-circle"></i><span>Agregar registros</span>
            </a>
          </li>
          <li>
            <a href="novedades-tabla.php">
              <i class="bi bi-circle"></i><span>Ver registros</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Novedades de Relevancia</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Agregar registros</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Ver registros</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Ingreso Personas</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Agregar registros</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Ver registros</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Registro Secuestros</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        
         
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Agregar registros</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Ver registros</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

     
      <li class="nav-heading">Paginas</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="usuarios-perfil.php">
          <i class="bi bi-person"></i>
          <span>Perfil</span>
        </a>
      </li><!-- End Profile Page Nav -->

      
      <li class="nav-item">
        <a class="nav-link collapsed" href="registrarse.php">
          <i class="bi bi-card-list"></i>
          <span>Registrase</span>
        </a>
      </li><!-- End Register Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Tabla Novedades de Guardia</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio-dashboard.html">Home</a></li>
            <li class="breadcrumb-item active">Novedades de Comisaria</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <!-- Boton del modal Agregar -->
    <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      <i class="bi bi-plus-circle-fill"></i>
      Agregar
    </button>
    <!-- Modal Agregar -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Novedades de Guardia</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body">
                <!-- FORMULARIO PARA AGREGAR COMISARIA -->
          <form method="POST" enctype="multipart/form-data" class="row g-3 pt-3">
            <div class="col-md-6">
                <label for="inputDate"  class="col-sm-2 col-form-label">Fecha</label>
                <div class="col-sm-10">
                  <input required type="date" id="txtFecha" name="txtFecha" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <label for="inputState" class="form-label">Turno</label>
                <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                  <option value="MATUTINO (06:00 - 14:00)" selected>MATUTINO (06:00 - 14:00)</option>
                  <option value="VESPERTINO (14:00 - 22:00)">VESPERTINO (14:00 - 22:00)</option>
                  <option value="NOCTURNO (22:00 - 06:00)">NOCTURNO (22:00 - 06:00)</option>
                </select>
              </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Superior de Turno</label>
              <input required type="text" id="txtSuperiorTurno" name="txtSuperiorTurno" class="form-control" id="inputEmail5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5"  class="form-label">Oficial en Servicio</label>
              <input required type="text" id="txtOficialServicio" name="txtOficialServicio" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5"  class="form-label">Cantidad de personal en guardia</label>
              <input required type="text" id="txtCantPersonalGuardia" name="txtCantPersonalGuardia" class="form-control" id="inputtext5">
            </div>
            <div class="col-6">
              <label for="inputAddress5" class="form-label">Motoristas</label>
              <input required type="text" id="txtMotoristas" name="txtMotoristas" class="form-control" id="inputAddres5s">
            </div>
            <div class="col-6">
                <label for="inputAddress5" class="form-label">Moviles en funcionamiento</label>
                <input required type="text" id="txtMovilesFuncionamiento" name="txtMovilesFuncionamiento" class="form-control" id="inputAddres5s">
              </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Moviles fuera de servicio</label>
              <input required type="text" id="txtMovilesFueraFuncionamiento" name="txtMovilesFueraFuncionamiento" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Cantidad de detenidos Causa Federal</label>
              <input required type="text" id="txtCantDetenidosCausaFederal" name="txtCantDetenidosCausaFederal" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Cantidad de detenidos Justicia Ordinaria</label>
              <input required type="text" id="txtCantDetenidosJusticiaOrdinaria" name="txtCantDetenidosJusticiaOrdinaria" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Arrestados averiguacion del hecho</label>
              <input required type="text" id="txtArrestadisAveriguacionHecho" name="txtArrestadisAveriguacionHecho" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Cantidad de Aprehendidos</label>
              <input required type="text" id="txtCantAprehendidos" name="txtCantAprehendidos" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Arrestados averiguacion de activiades</label>
              <input required type="text" id="txtArrestadosAveriguacionActividades" name="txtArrestadosAveriguacionActividades" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Arrestados Inf. código de faltas</label>
              <input required type="text" id="txtArrestadosInfCodigoFaltas" name="txtArrestadosInfCodigoFaltas" class="form-control" id="inputtext5">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Demorados</label>
              <input required type="text" id="txtDemorados" name="txtDemorados" class="form-control" id="inputtext5">
            </div>
            <div class="text-center">
              <button type="submit" name="agregar" value="agregar"  class="btn btn-primary float-end">Agregar</button>
            </div>
          </form><!-- End Multi Columns Form -->
  
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- R -->
    <table class="table table-sm table-hover table-bordered text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">Comisaria</th>
          <th scope="col">Fecha</th>
          <th scope="col">Turno</th>
          <th scope="col">Superior de turno</th>
          <th scope="col">Oficial servicio</th>
          <th scope="col">. . .</th>
        </tr>
      </thead>

      <tbody>
          <?php 
            while ($row = $resultado->fetch_assoc()) {
          ?>  
        <tr>
          <th scope="row"><?php echo $nombreComisaria;?></th>
          <td><?php echo $row['fecha'] ?></td>
          <td><?php echo $row['turno'] ?></td>
          <td><?php echo $row['superior_de_turno'] ?></td>
          <td><?php echo $row['oficial_servicio'] ?></td>
          <td>
            <!-- BOTON VER MAS / EDITAR / ELIMINAR -->
            <a class="btn btn-primary" href="novedades-ver-mas.php?id=<?php echo $row['id']?>">Ver más</a>
          </td>
        </tr>
        <?php 
            }
          ?>
      </tbody>
    </table>
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