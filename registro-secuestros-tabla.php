<?php
include 'conexion.php';
session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}

$idUsuario = $_SESSION['id'];
$idComisaria = $_SESSION['idComisaria'];

if (isset($_POST['BtnAgregar'])) {
    $txtFechaRegTabla = $_POST['txtFechaRegTabla'];
    $txtFechaReg = $_POST['txtFechaReg'];
    $txtHora = $_POST['txtHora'];
    $txtHecho = $_POST['hecho'];
    $txtElementoSecuestrado = $_POST['elementoSecuestrado'];


    //CONSULTA INSERTAR DATOS
    $insertar = "INSERT INTO registro_secuestro (fecha_reg_tabla, fecha_reg, hora_reg, hecho, elemento_secuestrado, idComisaria, idUsuario) VALUES (NOW(),'$txtFechaReg','$txtHora','$txtHecho','$txtElementoSecuestrado','$idComisaria','$idUsuario')";

    //EJECUTAR CONSULTA INSERTAR DATOS
    $ejecutarInsertar = mysqli_query($conexion, $insertar);
    if (!$ejecutarInsertar) {
        echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
    } else {
        header('location:registro-secuestros-tabla.php');
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



</head>

<body>

    <!-- ======= Header ======= -->
    <?php include("template/dashboard.php") ?>

    <!-- ======= Sidebar ======= -->
    <?php if ($_SESSION['rol'] == 1) {
        include("template/admin.php");
    } else {
        include("template/usuario.php");
    }
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Registro de Secuestros</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Registro de Secuestros</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <!-- CODIGO DE ALERTAS -->
        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'agregado') {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Exito!</strong> Se agregó correctamente un nuevo registro.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong> Error</strong> No se pudo agregar el registro correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado') {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Eliminado!</strong> Se eliminó correctamente el registro.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>

        <!--INPUT BUSCAR EN TABLAS-->
        <div class="search">
            <form method="post"><input type="text" name="campo" id="campo" placeholder="Buscar" class="rounded">
                <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bi bi-plus-circle-fill"></i>
                    Agregar
                </button>
            </form>
        </div>
        <!--FIN INPUT BUSCAR EN TABLAS-->

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Registro de Secuestro</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <!-- FORMULARIO PARA AGREGAR USUARIO -->

                                <form class="row g-3 needs-validation" method="POST">

                                    <div class="col-12">
                                        <label for="inputEmail5" class="form-label">Fecha de registro tabla</label>
                                        <div class="col-sm-10">
                                            <input required type="date" id="txtFecha" name="txtFechaRegTabla" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="inputEmail5" class="form-label">Fecha de registro </label>
                                        <div class="col-sm-10">
                                            <input required type="date" id="txtFechaReg" name="txtFechaReg" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="inputEmail5" class="form-label">Hora</label>
                                        <input type="text" id="txtHora" name="txtHora" class="form-control clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                    </div>

                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Hecho</label>
                                        <input type="text" name="hecho" class="form-control" id="hecho" required>
                                        <div class="invalid-feedback">¡Por favor, escriba el hecho!
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Elemento secuestrado</label>
                                        <input type="text" name="elementoSecuestrado" class="form-control" id="elementoSecuestrado" required>
                                        <div class="invalid-feedback">¡Por favor, escriba el elemeto secuestrado!
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="BtnAgregar" id="BtnAgregar" value="btnAgregar" class="btn btn-primary float-end">Agregar</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <table class="table table-sm table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr>

                        <th scope="col">Fecha </th>
                        <th scope="col"> Hora </th>
                        <th scope="col"> Hecho </th>
                        <th scope="col">Elemento Sucuestrado</th>
                        <th scope="col"> ... </th>

                    </tr>
                </thead>
                <tbody id="content">

                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                    <label id="ldl-total"></label>
                </div>
                <div class="col-6" id="nav-paginacion">

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <script>
        let paginaActual = 1

        /* Llamando a la función getData() */
        getData(paginaActual)

        /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
        document.getElementById("campo").addEventListener("keyup", function(){
            getData(1)
        }, false)

        /* Peticion AJAX */
        function getData(pagina) {
            let input = document.getElementById("campo").value
            let content = document.getElementById("content")

            if(pagina != null){
                paginaActual = pagina
            }
            
            let url = "registro-secuestros-search.php"
            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('pagina', pagina)

        fetch(url, {
                method: "POST",
                body: formaData
            }).then(response => response.json())
            .then(data => {
                content.innerHTML = data.data
                document.getElementById("ldl-total").innerHTML = 'Mostrando ' +  data.totalFiltro +
                ' de ' + data.totalRegistros + ' registros'
                document.getElementById("nav-paginacion").innerHTML = data.paginacion
            }).catch(err => console.log(err))
        }
    </script>


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