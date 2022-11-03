<?php 
    include('conexion.php');
    session_start();
    $idComisaria = $_GET['id'];
    $id = $_GET['id'];

    $idComisaria=intval($idComisaria);
    $id=intval($id);


    
  if (isset($_POST['guardar'])) {
    $sql="SELECT * FROM comisarias WHERE idComisaria='$idComisaria'";
    $resultado1=mysqli_query($conexion,$sql);
    if($row1=$resultado1->fetch_assoc()){
      $nombre=$row1['nombre'];
      $direccion=$row1['direccion'];
      $provincia=$row1['provincia'];
      $departamento=$row1['departamento'];
      $localidad=$row1['localidad'];
      $telefono=$row1['telefono'];
      $latitud='0';
      $longitud='0';
      $habilitado='0';
      $eliminado='0';

      $nombre=strval($nombre);
      $direccion=strval($direccion);
      $provincia=strval($provincia);
      $departamento=strval($departamento);
      $localidad=strval($localidad);
      $telefono=strval($telefono);
      $latitud='0';
      $longitud='0';
      $habilitado='0';
      $eliminado='0';
    }
    //CONSULTA EDITAR REGISTRO
      $consultaEditarRegistro="UPDATE comisarias SET nombre='$nombre', direccion='$direccion', provincia='$provincia', departamento='$departamento', localidad='$localidad', telefono='$telefono', habilitado='$habilitado', latitud='$latitud', longitud='$longitud', eliminado='$eliminado' WHERE idComisaria='$idComisaria' ";
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
  <?php include("./template/dashboard.php")?>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="inicio-dashboard.php">
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
            <a href="inicio-dashboard.php">
              <i class="bi bi-circle"></i><span>Admin</span>
            </a>
          </li>
          <li>
            <a href="comisarias-tabla.php">
              <i class="bi bi-circle"></i><span>Comisarias</span>
            </a>
          </li>
          <li>
            <a href="usuarios-tabla.php">
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

  <main id="main" class="main container">
    <div class="pagetitle">
        <h1>Tabla Comisarias</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="comisarias-tabla.php">Tabla Comisarias</a></li>
            <li class="breadcrumb-item active">Ver Más</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <!-- DATOS DE COMISARIA -->
    <div class="card w-75 pt-3">
      <div class="card-body">
        
        <ul class="list-group mb-3">
            <li class="list-group-item fw-bold">ID: <span class="fw-normal ms-2"></span></li>
            <li class="list-group-item fw-bold">Nombre: <span class="fw-normal ms-2"></span></li>
            <li class="list-group-item fw-bold">Direccion: <span class="fw-normal ms-2"></span></li>
            <li class="list-group-item fw-bold">Provincia: <span class="fw-normal ms-2"></span></li>
            <li class="list-group-item fw-bold">Departamento: <span class="fw-normal ms-2"></span> </li>
            <li class="list-group-item fw-bold">Localidad: <span class="fw-normal ms-2"></span> </li>
            <li class="list-group-item fw-bold">Telefono: <span class="fw-normal ms-2"></span> </li>
            <li class="list-group-item fw-bold">Latitud: <span class="fw-normal ms-2"></span></li>
            <li class="list-group-item fw-bold">Longitud: <span class="fw-normal ms-2"></span></li>
            <li class="list-group-item fw-bold">
              Habilitado: <span class="fw-normal ms-2"></span> 
            </li>
            <li class="list-group-item fw-bold">Eliminado: <span class="fw-normal ms-2"></span></li>
        </ul>

         <!-- BOTON MODAL ELIMINAR -->
         <button type="button" class="btn btn-danger float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalEliminar" value="eliminarRegistro">
          Eliminar
          </button>
          <!-- Modal ELIMINAR -->
          <form method="post">
          <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel" data-bs-dismiss="modal">Eliminar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>¿Esta seguro que desea eliminar este archivo?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <input type="submit" class="btn btn-danger" name="confirmarEliminarRegistro" value="Eliminar">
                </div>
              </div>
            </div>
          </div>  

          </form>
          
          
          <!-- BOTON MODAL DESHABILITAR -->
          <button type="button" class="btn btn-secondary float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalDeshabilitar">
            Deshabilitar
          </button>
          <!-- Modal DEHABILITAR -->
          <div class="modal fade" id="modalDeshabilitar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

          <!-- BOTON MODAL EDITAR -->
          <button type="button" class="btn btn-warning float-end mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-pencil-square"></i>
            Editar
          </button>
          <!-- MODAL EDITAR -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Comisaria</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      
                      <!-- FORMULARIO PARA EDITAR COMISARIA -->
                      <form class="row g-3" method="POST" action="comisarias-ver-mas.php">
                        <div class="col-md-12">
                          <label for="inputName5" class="form-label">Nombre</label>
                          <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="col-md-12">
                          <label for="inputEmail5" class="form-label">Dirección</label>
                          <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                        <div class="col-md-6">
                          <label for="inputEmail5" class="form-label">Provincia</label>
                          <input type="text" class="form-control" id="provincia" name="provincia">
                        </div>
                        <div class="col-md-6">
                          <label for="inputPassword5" class="form-label">Departamento</label>
                          <input type="text" class="form-control" id="departamento" name="departamento">
                        </div>
                        <div class="col-md-12">
                          <label for="inputPassword5" class="form-label">Localidad</label>
                          <input type="text" class="form-control" id="localidad" name="localidad">
                        </div>
                        <div class="col-12">
                          <label for="inputAddress5" class="form-label">Teléfono</label>
                          <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                        <div class="col-md-6">
                          <label for="inputState" class="form-label">Habilitado</label>
                          <select id="inputState" class="form-select" name="habilitado" >
                            <option >Habilitado</option>
                            <option>Deshabilitado</option>
                          </select>
                        </div>
                        
                        <div class="text-center">
                          <!--
                          <button type="submit" class="btn btn-primary float-end">Guardar</button>
                          -->
                          <input type="submit" class="btn btn-primary float-end" name="guardar" value="Guardar">

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
    <div class="d-flex justify-content-between">
      <a class="btn btn-primary " href="comisarias-tabla.php">Volver</a>
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