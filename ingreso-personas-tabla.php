<?php
    include 'conexion.php';
    session_start();
    // PREGUNTA SI HAY UN USUARIO REGISTRADO
    if(!isset($_SESSION['usuario'])){
    header('Location: index.php');
    }
    //INICIALIZAMOS DATOS
  $idUsuario = $_SESSION['id'];

  if (isset($_POST['agregar'])) {
    $comisaria = $_POST['txtComisaria'];
    $tipo = $_POST['tipo'];
    $subtipo = $_POST['subtipo'];
    $dispuestoPor = $_POST['dispuesto_por'];
    $fechaHoraIngreso = $_POST['fecha_hora_ingreso'];
    $secuestro = $_POST['secuestro'];
    $elementoSecuestrado = $_POST['elem_secuestrado'];
    

    //CONSULTA INSERTAR DATOS
    $insertar = "INSERT INTO ingreso_persona (fecha_hora_reg, tipo, subtipo, dispuesto_por, fecha_hora_ingreso, secuestro, elem_secuestrado, idComisaria, idUsuario) VALUES (NOW(),'$tipo','$subtipo','$dispuestoPor','$fechaHoraIngreso','$secuestro','$elementoSecuestrado','$comisaria','$idUsuario')";

    //EJECUTAR CONSULTA INSERTAR DATOS
    $ejecutarInsertar=mysqli_query($conexion,$insertar);
    if(!$ejecutarInsertar){
      echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
    }
    else{
      header('location:ingreso-personas-tabla.php');
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
            <h1>Tabla Ingreso de Personas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio-dashboard.html">Home</a></li>
                    <li class="breadcrumb-item active">Ingreso de Personas</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <!-- CODIGO DE ALERTAS -->
        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'agregado')
        {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Exito!</strong> Se ingresó correctament la persona.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            }
        ?>
        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error')
        {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> Error</strong> No se pudo agregar la nueva comisaria.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            }
        ?>
        <?php
        if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado')
        {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Se eliminó correctamente el registro.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            }
        ?>

        <div class="search">
            <!--INPUT BUSCAR EN TABLAS-->
            <form method="POST">
                <input type="text" name="campo" id="campo" placeholder="Buscar" class="rounded">
                <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bi bi-plus-circle-fill"></i>
                    Agregar
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <!-- FORMULARIO PARA INGRESO DE PERSONAS -->
                                <form method="POST" enctype="multipart/form-data" class="row g-3 pt-3">
                                    <div class="col-md-6">
                                        <label for="inputDate" class="col-form-label">Fecha y hora de registro</label>
                                        <input disabled type="datatime" id="txtFechaHoraRegistro" name="txtFechaHoraRegistro" class="form-control"  value="<?php date_default_timezone_set("America/Argentina/Catamarca"); echo date("d-m-Y H:i");?>">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="inputState" class="form-label">Comisaria</label>
                                        <select required id="txtComisaria" name="txtComisaria" class="form-select">
                                            <option value="">Seleccionar</option>
                                            <?php
                                            include('conexion.php');
                                            if($_SESSION['rol'] == 1){
                                            $tabla_comisaria = "SELECT idComisaria, nombre FROM comisarias WHERE (eliminado<1) AND habilitado = 1 ORDER BY idComisaria ASC;";
                                            $resultado4 = mysqli_query($conexion, $tabla_comisaria);
                                            }else{
                                            $tabla_comisaria = "SELECT idUsuario, u.idComisaria, nombre FROM `usuario-comisaria` u INNER JOIN comisarias c WHERE (c.eliminado<1) AND c.habilitado = 1 AND u.idUsuario = $idUsuario AND c.idComisaria = u.idComisaria ORDER BY u.idComisaria ASC;";
                                            $resultado4 = mysqli_query($conexion, $tabla_comisaria);
                                            }
                                            
                                            while ($row = mysqli_fetch_assoc($resultado4)){
                                            
                                            $idComisaria = $row['idComisaria'];
                                            $nombre = $row['nombre'];
                                            ?>
                                            
                                            <option value="<?php echo $idComisaria; ?>"><?php echo $nombre; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
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
                                        <input required type="text" name="dispuesto_por" id="dispuesto_por" class="form-control" >
                                    </div>

                                    <div class="col-md-6">
                                        <label readonly for="fecha_hora_ingreso" class="form-label">Fecha y Hora de Ingreso</label>
                                        <input required type="datetime-local" name="fecha_hora_ingreso" id="fecha_hora_ingreso" class="form-control" >
                                    </div>

                                    <div class="col-md-6">
                                        <label readonly for="secuestro" class="form-label">Secuestro</label>
                                        <select required name="secuestro" id="secuestro" class="form-select">
                                            <option value="">Seleccionar</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label readonly for="elem_secuestrado" class="form-label">Elemento Secuestrado</label>
                                        <input required type="text" name="elem_secuestrado" id="elem_secuestrado" class="form-control">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="agregar" value="agregar"  class="btn btn-primary float-end">Agregar</button>
                                    </div>
                                </form><!-- End Multi Columns Form -->
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
        <!-- R -->
        <table class="table table-sm table-hover table-bordered text-center">
            <thead class="table-dark">
            <tr>
                <th class="align-middle" scope="col">Tipo</th>
                <th class="align-middle" scope="col">Sub Tipo</th>
                <th class="align-middle" scope="col">Dispuesto por</th>
                <th class="align-middle" scope="col">Secuestro</th>
                <th class="align-middle" scope="col">Elem. Secuestrado</th>
                <th class="align-middle" scope="col">. . .</th>
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

            let url = "ingreso-personas-search.php"
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

    <!-- Script de select -->
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="novedades-relevancia-agregar.js"></script>

    <!-- Script de reloj -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="clockpicker.js"></script>
    <script type="text/javascript">$('.clockpicker').clockpicker();</script>


</body>

</html>