<?php
    include 'conexion.php';
    session_start();
    // PREGUNTA SI HAY UN USUARIO REGISTRADO
    if(!isset($_SESSION['usuario'])){
    header('Location: ../index.php');
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
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Css Reloj -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="clockpicker.css">

    <!-- Css Mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>


</head>

<body>

    <!-- ======= Header ======= -->
    <?php include("../template/dashboard.php") ?>

    <!-- ======= Sidebar ======= -->
    <?php if ($_SESSION['rol'] == 1) {
        include("../template/admin.php");
    } else {
        include("../template/usuario.php");
    }
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tabla Ingreso de Personas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../inicio-dashboard.html">Home</a></li>
                    <li class="breadcrumb-item active">Ingreso de Personas</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="search">
            <!--INPUT BUSCAR EN TABLAS-->
            <form method="POST">
                <input type="text" name="campo" id="campo" placeholder="Buscar" class="rounded">
                <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bi bi-plus-circle-fill"></i>
                    Agregar
                </button>
                <a href="mapa-ingreso-personas.php">
                <button type="button" class="btn btn-secondary float-end mb-2 mx-2">
                    <i class="bi bi-geo-alt-fill"></i>
                    Ver mapa
                </button>
                </a>
            </form>
        </div>
        <!--FIN INPUT BUSCAR EN TABLAS-->
        <!-- Modal Agregar -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar una Persona</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <!-- FORMULARIO PARA AGREGAR NOVEDADES DE RELEVANCIA -->

                                <form action="novedades-relevancia-agregar-log.php" method="POST" enctype="multipart/form-data" class="row g-3 pt-3">
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
                                    <input required type="text" name="dispuesto_por" id="dispuesto_por" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                    <label readonly for="fecha_hora_ingreso" class="form-label">Fecha y Hora de Ingreso</label>
                                    <input required type="datetime-local" name="fecha_hora_ingreso" id="fecha_hora_ingreso" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                    <label readonly for="fecha_hora_egreso" class="form-label">Fecha y Hora de Egreso</label>
                                    <input required type="datetime-local" name="fecha_hora_egreso" id="fecha_hora_egreso" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                    <label readonly for="inputEmail5" class="form-label">Secuestro</label>
                                    <input required type="text" name="secuestro" id="secuestro" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                    <label readonly for="inputEmail5" class="form-label">Elemento Secuestrado</label>
                                    <input required type="text" name="elem_secuestrado" id="elem_secuestrado" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                    <label readonly for="inputEmail5" class="form-label">Longitud</label>
                                    <input required type="text" name="lon" id="lon" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                    <label readonly for="inputEmail5" class="form-label">Latitud</label>
                                    <input required type="text" name="lat" id="lat" class="form-control" readonly>
                                    </div> 
                                    <div class="text-center">
                                    <button type="submit" name="BtnAgregar" class="btn btn-primary float-end">Agregar</button>
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
                <th scope="col">Tipo</th>
                <th scope="col">Sub Tipo</th>
                <th scope="col">Dispuesto po</th>
                <th scope="col">Secuestro</th>
                <th scope="col">Elem. Secuestrado</th>
                <th scope="col">. . .</th>
            </tr>
            </thead>
            <tbody id="content">
            </tbody>
        </table>
    </main><!-- End #main -->
    <script>
        /* Llamando a la función getData() */
        getData()

        /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
        document.getElementById("campo").addEventListener("keyup", getData)

        /* Peticion AJAX */
        function getData() {
            let input = document.getElementById("campo").value
            let content = document.getElementById("content")
            let url = "search-novedades-relevancia.php"
            let formaData = new FormData()
            formaData.append('campo', input)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data
                }).catch(err => console.log(err))
        }
    </script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.min.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

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