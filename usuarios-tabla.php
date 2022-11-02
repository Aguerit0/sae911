<?php
include 'conexion.php';


//*******************************************************************************
//SI APRETA EL BOTON AGREGAR
if (isset($_POST['agregarPersona'])) {
    $nombrePersona = $_POST['nombrePersona'];
    $apellidoPersona = $_POST['apellidoPersona'];
    $correoPersona = $_POST['correoPersona'];
    $telefonoPersona = $_POST['telefonoPersona'];
    $sexoPersona = $_POST['sexoPersona'];
    $dniPersona = $_POST['dniPersona'];
    $fecharegistroPersona = $_POST['fecharegistroPersona'];
    $habilitadoPersona = $_POST['habilitadoPersona'];
    $eliminadoPersona = $_POST['eliminadoPersona'];


    //CONSULTA INSERTAR EN SQL
    $insertarPersona = "INSERT INTO personas (nombre, apellido, correo, telefono, sexo, dni, fechaRegistro, habilitado, eliminado) VALUES ('$nombrePersona', '$apellidoPersona', '$correoPersona', '$telefonoPersona', '$sexoPersona', '$dniPersona', '$fechaRegistroPersona', '$habilitadoPersona', '$eliminadoPersona')";

    $insertarUsuario = "INSERT INTO usuarios(usuario, contraseña, idPersona) VALUES ('$usuario','$contraseña','$idPersona')";

    $resultado = mysqli_query($conexion, $insertarUsuario);

    if (!$resultado) {
        echo "ERROR2";
    } else {
        $resultado = mysqli_query($conexion, $insertarPersona);
        if ($row = $resultado->fetch_assoc()) {
            $idPersona = $row['idPersona'];
        }
    }

    //EJECUTAR CONSULTA DE INSERTAR
    $ejecutarInsertarUsuario = mysqli_query($conexion, $insertarUsuario);
    if (!$ejecutarInsertarUsuario) {
        echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
    } else {
        header('location:usuarios-tabla.php');
    }
}
//****************************************************************************************************************




//CONSULTA TABLAS PARA MOSTRAR DATOS DE USUARIO
$consultaDatosTabla = "SELECT * FROM usuarios u INNER JOIN personas p WHERE u.idPersona=p.idPersona";
//RESULTAOD DE LA CONSULTA
$resultado4 = mysqli_query($conexion, $consultaDatosTabla);
if (!$resultado4) {
    echo "<script>alert('ERROR AL CONSULTAR INFORMACIÓN 4');</script>";
} else {
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
                        <a href="comisarias-tabla.php">
                            <i class="bi bi-circle"></i><span>Comisarias</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
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
                <a class="nav-link collapsed" href="registrarse.php">
                    <i class="bi bi-card-list"></i>
                    <span>Registrarse</span>
                </a>
            </li><!-- End Register Page Nav -->
</ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Registro de Usuarios</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-plus-circle-fill"></i>
            Agregar
        </button>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <!-- FORMULARIO PARA AGREGAR USUARIO -->

                                <form class="row g-3 needs-validation" method="POST" action="registrar_log.php">
                                    <div class="col-12">
                                    <label for="yourName" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" id="yourName" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su nombre!
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourName" class="form-label">Apellido</label>
                                    <input type="text" name="apellido" class="form-control" id="yourName" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su Apellido!
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourName" class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control" id="dni" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su DNI!
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourEmail" class="form-label">Correo</label>
                                    <input type="email" name="correo" class="form-control" id="yourEmail" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su Gmail!</div>
                                    </div>

                                    <div class="col-12">
                                    <select name="sexo" class="form-select form-select-sm" aria-label="Ejemplo de .form-select-sm">
                                    <option selected value="">Sexo</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                    <option value="3">Otro</option>
                                    </select>
                                    </div>
                                    <div class="col-12">
                                    <label for="yourName" class="form-label">Telefono</label>
                                    <input type="text" name="telefono" class="form-control" id="yourName" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su Telefono!
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourUsername" class="form-label">Nombre de Usuario</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                                        <div class="invalid-feedback">¡Por favor, escriba su nombre de usuario</div>
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourPassword" class="form-label">Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    <div class="invalid-feedback">¡Por favor, escriba una Contraseña!</div>
                                    </div>

                                    <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">Acepto todos los <a href="#">terminos y condiciones</a></label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                    </div>
                                    <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit" name="Bregistrar">Crear Cuenta</button>
                                    </div>
                                    <div class="col-12">
                                    <p class="small mb-0 text-center">¿Ya tienes una cuenta? <a href="pages-login.html">Iniciar sesión</a></p>
                                    </div>
                                </form>

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
        <section class="section">
            <table class="table table-sm table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Fecha de Registro</th>
                        <th scope="col">Habilitado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = $resultado4->fetch_assoc()) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $row['usuario'] ?></th>
                            <td scope="row"><?php echo $row['nombre'] ?></td>
                            <td scope="row"><?php echo $row['correo'] ?></td>
                            <td scope="row"><?php echo $row['fechaRegistro'] ?></td>
                            <td scope="row"><?php echo $row['habilitado'] ?></td>
                            <?php $idUsuario = $row['idUsuario'] ?>
                            <td scope="row">
                                <!-- BOTON VER MAS / EDITAR / ELIMINAR -->
                                <a class="btn btn-primary" href="usuarios-ver-mas.php?id=<?php echo $idUsuario?>">Ver más</a>
                            </td>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>

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