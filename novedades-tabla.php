<?php
  include 'conexion.php';
  session_start();
  // PREGUNTA SI HAY UN USUARIO REGISTRADO
  if(!isset($_SESSION['usuario'])){
    header('Location: index.php');
  }
  $sentenciaSQL=$bd_conex->prepare('SELECT nombre FROM comisarias WHERE idComisaria =:id');
  $sentenciaSQL->bindParam(':id', $_SESSION['idComisaria']);
  $sentenciaSQL->execute();
  $comisaria = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

   //INICIALIZAMOS DATOS
  $idUsuario = $_SESSION['id'];
  // $idComisaria=$_SESSION['idComisaria'];
  // $nombreComisaria = $comisaria['nombre'];
  if (isset($_POST['agregar'])) {
    $txtComisaria=$_POST['txtComisaria'];
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
    $insertar = "INSERT INTO novedades_de_guardia (idUsuario, idComisaria, fecha, turno, superior_de_turno, oficial_servicio, personas_de_guardia, motoristas, mov_funcionamiento, mov_fuera_de_servicio, detenidos_causa_federal, detenidos_justicia_ordinaria, arres_averiguacion_de_hecho, aprehendidos, arres_averiguacion_actividades, arres_info_codigo_de_faltas, demorados) VALUES ('$idUsuario','$txtComisaria','$txtFecha','$txtTurno','$txtSuperiorTurno','$txtOficialServicio','$txtCantPersonalGuardia','$txtMotoristas','$txtMovilesFuncionamiento','$txtMovilesFueraFuncionamiento','$txtCantDetenidosCausaFederal','$txtCantDetenidosJusticiaOrdinaria','$txtArrestadisAveriguacionHecho','$txtCantAprehendidos','$txtArrestadosAveriguacionActividades','$txtArrestadosInfCodigoFaltas','$txtDemorados')";

    //EJECUTAR CONSULTA INSERTAR DATOS
    $ejecutarInsertar=mysqli_query($conexion,$insertar);
    if(!$ejecutarInsertar){
      echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
    }
    else{
      header('location:novedades-tabla.php?mensaje=agregado');
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
  <?php  if($_SESSION['rol'] == 1){
      include ("./template/admin.php");
    }else{
      include ("./template/usuario.php");
    }
  ?>

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
    <!-- CODIGO DE ALERTAS -->
    <?php
      if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'agregado')
      {
    ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Exito!</strong> Se agregó correctamente una nueva novedad de guardia.
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
        <button type="button" class="btn btn-success float-end mb-2"data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      <i class="bi bi-plus-circle-fill"></i>
      Agregar
      </button>  
      </form>
    </div><!--FIN INPUT BUSCAR EN TABLAS-->
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
              <label for="inputState" class="form-label">Comisaria</label>
              <select required id="inputState" id="txtComisaria" name="txtComisaria" class="form-select">
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
                <label for="inputState" class="form-label">Turno</label>
                <select required id="inputState" id="txtTurno" name="txtTurno" class="form-select">
                  <option value="MATUTINO (06:00 - 14:00)" selected>MATUTINO (06:00 - 14:00)</option>
                  <option value="VESPERTINO (14:00 - 22:00)">VESPERTINO (14:00 - 22:00)</option>
                  <option value="NOCTURNO (22:00 - 06:00)">NOCTURNO (22:00 - 06:00)</option>
                </select>
              </div>
            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Superior de Turno</label>
              <input required type="text" id="txtSuperiorTurno" name="txtSuperiorTurno" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="inputtext5"  class="form-label">Oficial en Servicio</label>
              <input required type="text" id="txtOficialServicio" name="txtOficialServicio" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="inputtext5"  class="form-label">Cantidad de personal en guardia</label>
              <input required type="number" id="txtCantPersonalGuardia" name="txtCantPersonalGuardia" class="form-control">
            </div>
            <div class="col-6">
              <label for="inputAddress5" class="form-label">Motoristas</label>
              <input required type="number" id="txtMotoristas" name="txtMotoristas" class="form-control">
            </div>
            <div class="col-6">
                <label for="inputAddress5" class="form-label">Moviles en funcionamiento</label>
                <input required type="text" id="txtMovilesFuncionamiento" name="txtMovilesFuncionamiento" class="form-control">
              </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Moviles fuera de servicio</label>
              <input required type="text" id="txtMovilesFueraFuncionamiento" name="txtMovilesFueraFuncionamiento" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Cantidad de detenidos Causa Federal</label>
              <input required type="number" id="txtCantDetenidosCausaFederal" name="txtCantDetenidosCausaFederal" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Cantidad de detenidos Justicia Ordinaria</label>
              <input required type="number" id="txtCantDetenidosJusticiaOrdinaria" name="txtCantDetenidosJusticiaOrdinaria" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Arrestados averiguacion del hecho</label>
              <input required type="number" id="txtArrestadisAveriguacionHecho" name="txtArrestadisAveriguacionHecho" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Cantidad de Aprehendidos</label>
              <input required type="number" id="txtCantAprehendidos" name="txtCantAprehendidos" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Arrestados averiguacion de activiades</label>
              <input required type="number" id="txtArrestadosAveriguacionActividades" name="txtArrestadosAveriguacionActividades" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Arrestados Inf. código de faltas</label>
              <input required type="number" id="txtArrestadosInfCodigoFaltas" name="txtArrestadosInfCodigoFaltas" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="inputtext5" class="form-label">Demorados</label>
              <input required type="number" id="txtDemorados" name="txtDemorados" class="form-control">
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
          <th scope="col">Comisaria</th>
          <th scope="col">Fecha</th>
          <th scope="col">Turno</th>
          <th scope="col">Superior de turno</th>
          <th scope="col">Oficial servicio</th>
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
            let url = "search-novedades.php"
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