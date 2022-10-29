<?php 
    include 'conexion.php';

    //SI APRETA EL BOTON AGREGAR
    if (isset($_POST['agregarComisaria'])) {
      $nombreComisaria=$_POST['nombreComisaria'];
      $direccionComisaria=$_POST['direccionComisaria'];
      $provinciaComisaria=$_POST['provinciaComisaria'];
      $departamentoComisaria=$_POST['departamentoComisaria'];
      $localidadComisaria=$_POST['localidadComisaria'];
      $telefonoComisaria=$_POST['telefonoComisaria'];
      $latitudComisaria=$_POST['latitudComisaria'];
      $longitudComisaria=$_POST['longitudComisaria'];
      $habilitadoComisaria=$_POST['habilitadoComisaria'];


      //CONSULTA INSERTAR EN SQL
      $insertarComisaria = "INSERT INTO comisarias (nombre, direccion, provincia, departamento, localidad, telefono, latitud, longitud, habilitado) VALUES ('$nombreComisaria','$direccionComisaria','$provinciaComisaria','$departamentoComisaria','$localidadComisaria','$telefonoComisaria','$latitudComisaria','$longitudComisaria','$habilitadoComisaria')";

      //EJECUTAR CONSULTA DE INSERTAR
      $ejecutarInsertarComisaria=mysqli_query($conexion,$insertarComisaria);
      if (!$ejecutarInsertarComisaria) {
        echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
      }else{
        header('location:tabla-comisaria.php');
      }
    }




    //CONSULTA TABLAS PARA MOSTRAR DATOS DE COMISARIA
    $consultaDatosComisaria="SELECT * FROM comisarias";
    //RESULTAOD DE LA CONSULTA
    $resultado=mysqli_query($conexion,$consultaDatosComisaria);
    if (!$resultado) {
      echo "<script>alert('ERROR AL CONSULTAR INFORMACIÓN');</script>";
      }else{
        
      }
    //CERRAMOS CONEXIÓN BD
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

          

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

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
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
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
            <a href="agregar-novedadesGuardia.html">
              <i class="bi bi-circle"></i><span>Agregar registros</span>
            </a>
          </li>
          <li>
            <a href="tabla-novedadesGuardia.html">
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
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Perfil</span>
        </a>
      </li><!-- End Profile Page Nav -->

      

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Iniciar sesion</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Registrace</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contacto</span>
        </a>
      </li><!-- End Contact Page Nav -->

     

     

     

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Tabla Comisarias</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Comisarias</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      <i class="bi bi-plus-circle-fill"></i>
      Agregar
    </button>
    <!-- Modal AGREGAR COMISARIA -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Comisaria</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body">
                <!-- FORMULARIO PARA AGREGAR COMISARIA -->
                <form class="row g-3" method="post">
                  <div class="col-md-12">
                    <label for="inputName5" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreComisaria" name="nombreComisaria">
                  </div>
                  <div class="col-md-12">
                    <label for="inputEmail5" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccionComisaria" name="direccionComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputtext5" class="form-label">Provincia</label>
                    <input type="text" class="form-control" id="provinciaComisaria" name="provinciaComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputtext5" class="form-label">Departamento</label>
                    <input type="text" class="form-control" id="departamentoComisaria" name="departamentoComisaria">
                  </div>
                  <div class="col-md-12">
                    <label for="inputtext5" class="form-label">Localidad</label>
                    <input type="text" class="form-control" id="localidadComisaria" name="localidadComisaria">
                  </div>
                  <div class="col-12">
                    <label for="inputAddress5" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoComisaria" name="telefonoComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputtext5" class="form-label">Latitud</label>
                    <input type="text" class="form-control" id="latitudComisaria" name="latitudComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputtext5" class="form-label">Longitud</label>
                    <input type="text" class="form-control" id="longitudComisaria" name="longitudComisaria">
                  </div>
                  <div class="col-md-6">
                    <label for="inputState" class="form-label">Habilitado</label>
                    <select id="habilitadoComisaria" name="habilitadoComisaria" class="form-select">
                      <option selected>Habilitado</option>
                      <option>Deshabilitado</option>
                    </select>
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" id="agregarComisaria" name="agregarComisaria" value="agregarComisaria" class="btn btn-primary">Agregar</button>
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
    </div><!--FIN MODAL AGREGEAR-->


    <!-- SEGUNDA OPCION -->
    <table class="table table-sm table-hover table-bordered text-center">
      <thead class="table-dark">
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Dirección</th>
            <th scope="col">Provincia</th>
            <th scope="col">Departamento</th>
            <th scope="col">Localidad</th>
            <th scope="col">. . .</th>
          </tr>
           
          
      </thead>

      <tbody>
          <?php 
            while ($row = $resultado->fetch_assoc()) {
           ?>   
        <tr>
              <th scope="row"><?php echo $row['nombre'] ?></th>
              <td scope="row"><?php echo $row['direccion'] ?></td>
              <td scope="row"><?php echo $row['provincia'] ?></td>
              <td scope="row"><?php echo $row['departamento'] ?></td>
              <td scope="row"><?php echo $row['localidad'] ?></td>
              <td scope="row"><!-- BOTON VER MAS / EDITAR / ELIMINAR -->
            <a class="btn btn-primary" href="verMas-comisarias.php?id=<?php echo $row['idComisaria']?>">Ver más</a></td></td>
        </tr>
        <?php 
            }
          ?>
      </tbody>
    </table>
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