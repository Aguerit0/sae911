<?php
// LLAMANDO A LA BASE DE DATOS
include('conexion.php');
session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}

//   //INICIALIZAMOS DATOS
$idUsuario = $_SESSION['id'];
$idComisaria = $_SESSION['idComisaria'];
//   // $idComisaria=1;
if (isset($_POST['agregar'])) {
    $txtFecha_reg = $_POST['txtFecha_reg'];
    $txtHora_reg = $_POST['txtHora_reg'];
    $txtHecho = $_POST['txtHecho'];
    $txtElemento_secuestrado = $_POST['txtElemento_secuestrado'];


    //     //CONSULTA INSERTAR DATOS
    $insertar = "INSERT INTO registro_secuestro (fecha_reg_tabla, fecha_reg, hora_reg, hecho, elemento_secuestrado, idUsuario, idComisaria) VALUES (NOW(),'$txtFecha_reg', '$txtHora_reg', '$txtHecho', '$txtElemento_secuestrado','$idUsuario', '$idComisaria')";

    //     //EJECUTAR CONSULTA INSERTAR DATOS
    $ejecutarInsertar = mysqli_query($conexion, $insertar);
    if (!$ejecutarInsertar) {
        echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
    } else {
        header('location:registro-secuestros-tabla.php?mensaje=agregado');
        echo "Agregado";
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

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
            <h1>Formulario Registro de Secuestros</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Formulario Registro de Secuestros</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">

                <!-- FORMULARIO PARA AGREGAR REGISTRO DE SECUESTROS -->
                <form method="POST" enctype="multipart/form-data" class="row g-3 pt-3">
                    <div class="col-md-6">
                        <label for="inputDate" class="col-form-label">Fecha y hora de registro</label>
                            <input disabled type="datatime" id="txtFechaHoraRegistro" name="txtFechaHoraRegistro" class="form-control" value="<?php date_default_timezone_set("America/Argentina/Catamarca");
                                                                                                                                                echo date("d-m-Y H:i"); ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="txtFecha_reg" class="form-label">Fecha de registro</label>
                            <input required type="date" id="txtFecha_reg" name="txtFecha_reg" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="txtHora_reg" class="form-label">Hora</label>
                        <input type="text" id="txtHora_reg" name="txtHora_reg" class="form-control clockpicker" data-placement="left" data-align="top" data-autoclose="true" readonly="">
                    </div>

                    <div class="col-md-6">
                        <label readonly for="txtHecho" class="form-label">Hecho</label>
                        <input required type="text" name="txtHecho" id="txtHecho" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label readonly for="txtElemento_secuestrado" class="form-label">Elemento secuestrado</label>
                        <input required type="text" name="txtElemento_secuestrado" id="txtElemento_secuestrado" class="form-control">
                    </div>

                    <div class="text-center">
                        <button type="submit" name="agregar" class="btn btn-primary float-end">Agregar</button>
                    </div>

                </form><!-- End Multi Columns Form -->

            </div>
        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


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

    <!-- Script de reloj -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="clockpicker.js"></script>
    <script type="text/javascript">
        $('.clockpicker').clockpicker();
    </script>


</body>

</html>