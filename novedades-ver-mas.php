<?php 
    include('conexion.php');

    $idNovedades=$_GET['id'];
    //CONSULTA TABLA NOVEDADES_DE_GUARDIA
    $consultaSelectNovedades="SELECT * FROM novedades_de_guardia WHERE id=$idNovedades";
    $resultadoSelectNovedades=mysqli_query($conexion,$consultaSelectNovedades);
    if (!$resultadoSelectNovedades) {
      echo '<script>alert("ERROR AL ENCONTRAR INFORMACIÓN")</script>';
    }
    //OBTENCION DE DATOS TABLA NOVEDADES_DE_GUARDIA
    if ($row = $resultadoSelectNovedades->fetch_assoc()) {
      $idUsuario = $row['idUsuario'];
      $idComisaria=$row['idComisaria'];
      $fecha = $row['fecha'];
      $turno = $row['turno'];
      $superior_de_turno = $row['superior_de_turno'];
      $oficial_servicio = $row['oficial_servicio'];
      $personas_de_guardia = $row['personas_de_guardia'];
      $motoristas = $row['motoristas'];
      $mov_funcionamiento = $row['mov_funcionamiento'];
      $mov_fuera_de_servicio = $row['mov_fuera_de_servicio'];
      $detenidos_causa_federal = $row['detenidos_causa_federal'];
      $detenidos_justicia_ordinaria = $row['detenidos_justicia_ordinaria'];
      $arres_averiguacion_de_hecho = $row['arres_averiguacion_de_hecho'];
      $aprehendidos = $row['aprehendidos'];
      $arres_averiguacion_actividades = $row['arres_averiguacion_actividades'];
      $arres_info_codigo_de_faltas = $row['arres_info_codigo_de_faltas'];
      $demorados = $row['demorados'];

    }

    //OBTENCION DE DATOS DE TABLA COMISARIAS POR: IDCOMISARIAS
    //CONSULTAMOS BD
    $consultaSelectComisarias="SELECT * FROM comisarias WHERE idComisaria=$idComisaria";
    $resultadoSelectComisarias=mysqli_query($conexion,$consultaSelectComisarias);
    if (!$consultaSelectComisarias) {
      echo '<script>alert("ERROR AL ENCONTRAR INFORMACIÓN")</script>';
    }
    if ($row2=$resultadoSelectComisarias->fetch_assoc()) {
      $nombreComisaria=$row2['nombre'];
    }


    //BOTON GUARDAR->VERMASNOVEDADES->
    if (isset($_POST['guardarNovedad'])) {
      $fecha=$_POST['fecha'];
      $turno=$_POST['turno'];
      $superior_de_turno=$_POST['superior_de_turno'];
      $oficial_servicio=$_POST['oficial_servicio'];
      $personas_de_guardia=$_POST['personas_de_guardia'];
      $motoristas=$_POST['motoristas'];
      $mov_funcionamiento=$_POST['mov_funcionamiento'];
      $mov_fuera_de_servicio=$_POST['mov_fuera_de_servicio'];
      $detenidos_causa_federal=$_POST['detenidos_causa_federal'];
      $detenidos_justicia_ordinaria=$_POST['detenidos_justicia_ordinaria'];
      $arres_averiguacion_de_hecho=$_POST['arres_averiguacion_de_hecho'];
      $aprehendidos=$_POST['aprehendidos'];
      $arres_averiguacion_actividades=$_POST['arres_averiguacion_actividades'];
      $arres_info_codigo_de_faltas=$_POST['arres_info_codigo_de_faltas'];
      $demorados=$_POST['demorados'];

      //CONSULTA PARA ACTUALIZAR VALORES EN BASE DE DATOS
      $consultaUpdateNovedades = "UPDATE novedades_de_guardia SET fecha='$fecha', turno='$turno', superior_de_turno='$superior_de_turno', oficial_servicio='$oficial_servicio', personas_de_guardia='$personas_de_guardia', motoristas='$motoristas', mov_funcionamiento='$mov_funcionamiento', mov_fuera_de_servicio='$mov_fuera_de_servicio', detenidos_causa_federal='$detenidos_causa_federal', detenidos_justicia_ordinaria='$detenidos_justicia_ordinaria', arres_averiguacion_de_hecho='$arres_averiguacion_de_hecho', arres_averiguacion_actividades='$arres_averiguacion_actividades', arres_info_codigo_de_faltas='$arres_info_codigo_de_faltas', demorados='demorados' WHERE $idNovedades ";
      $resultadoUpdateNovedades=mysqli_query($conexion,$consultaUpdateNovedades);
      if (!$resultadoUpdateNovedades) {
        echo '<script>alert("ERROR AL ENCONTRAR INFORMACIÓN")</script>';
      }

    }




  //ELIMINAR UN REGISTRO
  //CONSULTA ELIMINAR REGISTRO
    if (isset($_POST['confirmarEliminarRegistro'])) {
      $consultaEliminarRegistro="DELETE FROM comisarias WHERE idComisaria=$idComisaria";
      $resultadoConsularEliminarRegistro=mysqli_query($conexion,$consultaEliminarRegistro);
      if (!$resultadoConsularEliminarRegistro) {
      echo '<script>alert("ERROR AL ELIMINAR COMISARIA")</script>';
      }else{
      header('location:comisarias-tabla.php');
      }
    }

    //EDITAR UN REGISTRO
    //CONSULTAR VALORES NUEVOS DE LOS INPUTS
    if (isset($_POST['guardarRegistro'])) {
    $consultaSelectRegistro="SELECT * FROM comisarias WHERE idComisaria=$idComisaria";
    $resultadoSelectRegistro=mysqli_query($conexion,$consultaSelectRegistro);
    if (!$resultadoSelectRegistro) {
      echo '<script>alert("ERROR INF")</script>';
    }
    //OBTENCION DE DATOS TABLA COMISARIA
    if ($row1 = $resultadoSelectRegistro->fetch_assoc()) {

  }
    //CONSULTA EDITAR REGISTRO
  $consultaEditarRegistro="UPDATE comisarias SET idComisaria='$idComisaria', nombre='$nombre', direccion='$direccion', provincia='$provincia', departamento='$departamento', localidad='$localidad', telefono='$telefono',habilitado='$habilitado', latitud='$latitud', longitud='$longitud', eliminado='$eliminado' WHERE idComisaria='$idComisaria' ";
    
      
      $resultadoEditarRegistro = mysqli_query($conexion,$consultaEditarRegistro);
      if (!$resultadoEditarRegistro) {
        echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
      }else{
        header('location:comisarias-tabla.php');
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
            <a href="/tabla-comisaria.html">
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
          <span>Registrace</span>
        </a>
      </li><!-- End Register Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Tabla Novedades de Guardia</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="novedades-tabla.html">Tabla Novedades de Guardia</a></li>
            <li class="breadcrumb-item active">Ver Más</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card w-75 pt-3">
      <div class="card-body">
          <ul class="list-group">
          <li class="list-group-item fw-bold">ID Novedades: <span><?php echo $idNovedades ?></span></li>
            <li class="list-group-item fw-bold">Comisaria: <span><?php echo $nombreComisaria ?></span></li>
            <li class="list-group-item fw-bold">Fecha: <span><?php echo $fecha ?></span></li></li>
            <li class="list-group-item fw-bold">Turno: <span><?php echo $turno ?></span></li>
            <li class="list-group-item fw-bold">Superior de turno: <span><?php echo $superior_de_turno ?></span></li>
            <li class="list-group-item fw-bold">Oficial servicio: <span><?php echo $oficial_servicio ?></span></li>
            <li class="list-group-item fw-bold">Cant. de personal de guardia: <span><?php echo $personas_de_guardia ?></span></li>
            <li class="list-group-item fw-bold">Motoristas: <span><?php echo $motoristas ?></span></li>
            <li class="list-group-item fw-bold">Mov. en funcionamiento: <span><?php echo $mov_funcionamiento ?></span></li>
            <li class="list-group-item fw-bold">Mov. fuera de servicio: <span><?php echo $mov_fuera_de_servicio ?></span></li>
            <li class="list-group-item fw-bold">Cant. detenidos causa federal: <span><?php echo $detenidos_causa_federal ?></span></li>
            <li class="list-group-item fw-bold">Cant. detenidos justicia ordinaria: <span><?php echo $detenidos_justicia_ordinaria ?></span></li>
            <li class="list-group-item fw-bold">Arrestados averiguacion del hecho: <span><?php echo $arres_averiguacion_de_hecho ?></span></li>
            <li class="list-group-item fw-bold">Cant. aprehendidos: <span><?php echo $aprehendidos ?></span></li>
            <li class="list-group-item fw-bold">Arrestados averiguacion actividades: <span><?php echo $arres_averiguacion_actividades ?></span></li>
            <li class="list-group-item fw-bold">Arrestados inf. codigo de faltas: <span><?php echo $arres_info_codigo_de_faltas ?></span></li>
            <li class="list-group-item fw-bold">Demorados: <span><?php echo $demorados ?></span></li>
        </ul>  
        
        <!-- BOTON MODAL ELIMINAR -->
        <button type="button" class="btn btn-danger float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#eliminarNovedadesGuardia">
          Eliminar
        </button>
        <!-- Modal ELIMINAR -->
        <div class="modal fade" id="eliminarNovedadesGuardia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>¿Esta seguro que desea eliminar este archivo?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Eliminar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- BOTON MODAL DESHABILITAR -->
        <button type="button" class="btn btn-secondary float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#deshabilitarNovedadesGuardia">
          Deshabilitar
        </button>
        <!-- Modal DEHABILITAR -->
        <div class="modal fade" id="deshabilitarNovedadesGuardia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Deshabilitar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>¿Esta seguro que desea deshabilitar este archivo?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Deshabilitar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal EDITAR -->
        <button type="button" class="btn btn-warning float-end mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <i class="bi bi-pencil-square"></i>
          Editar
        </button>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Novedades de Guardia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-body">    
                    <!-- FORMULARIO PARA EDITAR NOVEDADES DE GUARDIA -->
                    <form class="row g-4 pt-3" method="post">
                      <div class="col-md-6">
                          <label for="inputDate" class="col-sm-2 col-form-label">Fecha</label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" value="<?php echo $fecha?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="inputState" class="form-label">Turno</label>
                          <select id="inputState" class="form-select" value="turno">
                            <option value="<?php echo $turno?>"><?php echo $turno?></option>
                            <option >MATUTINO (06:00 - 14:00)</option>
                            <option>VESPERTINO (14:00 - 22:00)</option>
                            <option>NOCTURNO (22:00 - 06:00)</option>
                          </select>
                        </div>
                      <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Superior de Turno</label>
                        <input type="text" class="form-control" id="inputEmail5" value="<?php echo $superior_de_turno?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Oficial Servicio</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $oficial_servicio?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Cantidad de personal en guardia</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $personas_de_guardia?>">
                      </div>
                      <div class="col-6">
                        <label for="inputAddress5" class="form-label">Motoristas</label>
                        <input type="text" class="form-control" id="inputAddres5s" value="<?php echo $motoristas?>">
                      </div>
                      <div class="col-6">
                          <label for="inputAddress5" class="form-label">Moviles en funcionamiento</label>
                          <input type="text" class="form-control" id="inputAddres5s" value="<?php echo $mov_funcionamiento?>">
                        </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Moviles fuera de servicio</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $mov_fuera_de_servicio?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Cantidad de detenidos Causa Federal</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $detenidos_causa_federal?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Cantidad de detenidos Justicia Ordinaria</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $detenidos_justicia_ordinaria?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Arrestados averiguacion del hecho</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $arres_averiguacion_de_hecho?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Cantidad de Aprehendidos</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $aprehendidos?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Arrestados averiguacion de activiades</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $arres_averiguacion_actividades?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Arrestados Inf. código de faltas</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $arres_info_codigo_de_faltas?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Demorados</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $demorados?>">
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary float-end" value="guardarNovedad">Guardar</button>
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
      </div>
    </div>
    <br>
    <a class="btn btn-primary" href="novedades-tabla.html">Volver</a>
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