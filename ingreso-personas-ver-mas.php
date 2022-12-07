<?php
$id = $_GET['id'];
include('conexion.php');
session_start();
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}
$idComisaria = $_SESSION['idComisaria'];

//CONSULTA TABLA INGRESO DE PERSONAS
$consultaSQL = $bd_conex->prepare("SELECT * FROM ingreso_persona WHERE id=:id");
$consultaSQL->bindParam(':id', $id);
$consultaSQL->execute();
$roww = $consultaSQL->fetch(PDO::FETCH_LAZY);
//OBTENCION DE DATOS TABLA INGRESO DE PERSONAS
$idIngresoPersonas = $roww['id'];
$fecha_hora_reg = $roww['fecha_hora_reg'];
$tipo = $roww['tipo'];
$subtipo = $roww['subtipo'];
$dispuesto_por = $roww['dispuesto_por'];
$fecha_hora_ingreso = $roww['fecha_hora_ingreso'];
$fecha_hora_egreso = $roww['fecha_hora_egreso'];
$secuestro = $roww['secuestro'];
$elem_secuestrado = $roww['elem_secuestrado'];
$idComisaria = $roww['idComisaria'];
$eliminado = $roww['eliminado'];


//OBTENER NOMBRE COMISARIA
$consultaSQL = $bd_conex->prepare("SELECT nombre FROM comisarias WHERE idComisaria=:id");
$consultaSQL->bindParam(':id', $idComisaria);
$consultaSQL->execute();
$ressqlcom = $consultaSQL->fetch(PDO::FETCH_LAZY);
$nombreComisaria = $ressqlcom['nombre'];


//ELIMINAR UN REGISTRO
if (isset($_POST['confirmarEliminarRegistro'])) {
  $eliminado = 1;
  $sentenciaSQL = $bd_conex->prepare('UPDATE ingreso_persona SET eliminado=:eliminado WHERE id=:id');
  $sentenciaSQL->bindParam(':id', $idIngresoPersonas);
  $sentenciaSQL->bindParam(':eliminado', $eliminado);
  $sentenciaSQL->execute();
  header('Location: ingreso-personas-tabla.php');
}
//BOTON GUARDAR->VERMASNOVEDADES->
if (isset($_POST['guardarIngresoPersonas'])) {
  $fecha_hora_egreso = $_POST['fecha_hora_egreso'];
  //CONSULTA PARA ACTUALIZAR VALORES EN BASE DE DATOS
  $sqlUpdateIngresoPersonas = "UPDATE ingreso_persona SET fecha_hora_egreso='$fecha_hora_egreso' WHERE id=$idIngresoPersonas ";
  $resultadoUpdateNovedades = mysqli_query($conexion, $sqlUpdateIngresoPersonas);
  if (mysqli_errno($conexion) != 0) {
    echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
  } else {
?>
    <script language='JavaScript' type="text/javascript">
      function B() {
        location.href = 'ingreso-personas-ver-mas.php?id=<?php echo $idIngresoPersonas ?>';
      }
      B();
    </script>
<?php
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
      <h1>Tabla Ingreso de Personas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="ingreso-personas-tabla.php">Tabla Ingreso de Personas</a></li>
          <li class="breadcrumb-item active">Ver Más</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card w-75 pt-3">
      <div class="card-body">
        <ul class="list-group">
          <li class="list-group-item fw-bold">Fecha y Hora de Registro: <span class="fw-normal ms-2"><?php echo date("d/m/Y H:i:s", strtotime($fecha_hora_reg)) ?></span></li>
          </li>
          <li class="list-group-item fw-bold">Tipo: <span class="fw-normal ms-2"><?php echo $tipo ?></span></li>
          <li class="list-group-item fw-bold">Sub Tipo: <span class="fw-normal ms-2"><?php echo $subtipo ?></span></li>
          <li class="list-group-item fw-bold">Dispuesto Por: <span class="fw-normal ms-2"><?php echo $dispuesto_por ?></span></li>
          <li class="list-group-item fw-bold">Fecha y Hora de Ingreso: <span class="fw-normal ms-2"><?php echo date("d/m/Y H:i:s", strtotime($fecha_hora_ingreso)) ?></span></li>

          <?php if ($fecha_hora_egreso == "") { ?>
            <li class="list-group-item fw-bold">Fecha y Hora de Egreso: <span class="fw-normal ms-2"><?php echo $fecha_hora_egreso ?></span></li>
          <?php
          } else { ?>
            <li class="list-group-item fw-bold">Fecha y Hora de Egreso: <span class="fw-normal ms-2"><?php echo date("d/m/Y H:i:s", strtotime($fecha_hora_egreso)) ?></span></li>

          <?php
          }
          ?>
          <li class="list-group-item fw-bold">Secuestro: <span class="fw-normal ms-2"><?php echo $secuestro ?></span></li>
          <li class="list-group-item fw-bold">Elemento Secuestrado: <span class="fw-normal ms-2"><?php echo $elem_secuestrado ?></span></li>
          <li class="list-group-item fw-bold">Comisaria: <span class="fw-normal ms-2"><?php echo $nombreComisaria ?></span></li>

        </ul>
        <!-- BOTON MODAL ELIMINAR -->
        <?php
        if ($_SESSION['rol'] == 1) { ?>
          <button type="button" class="btn btn-danger float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#eliminarNovedadesGuardia">Eliminar</button>
        <?php
        }
        ?>
        <!-- Modal ELIMINAR -->
        <div class="modal fade" id="eliminarNovedadesGuardia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>¿Esta seguro que desea eliminar este Registro?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="" method="post">
                  <button type="submit" class="btn btn-danger" name="confirmarEliminarRegistro" value="eliminar" data-bs-dismiss="modal">Eliminar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal EDITAR -->
        <?php if ($fecha_hora_egreso == "") { ?>
          <button type="button" class="btn btn-warning float-end mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-pencil-square"></i>
            Agregar fecha de Egreso
          </button>
        <?php
        } else { ?>
          <button disabled type="button" class="btn btn-warning float-end mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-pencil-square"></i>
            Agregar fecha de Egreso
          </button>
        <?php
        }
        ?>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Ingreso de Personas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-body">
                    <!-- FORMULARIO PARA EDITAR NOVEDADES DE RELEVANCIA -->
                    <form class="row g-4 pt-3" method="POST" action="">
                      <div class="col-md-6">
                        <label for="fecha_hora_reg" class="form-label">Fecha y Hora de Registro</label>
                        <input disabled require type="datetime-local" class="form-control" id="fecha_hora_reg" name="fecha_hora_reg" value="<?php echo $fecha_hora_reg ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select disabled required id="tipo" name="tipo" class="form-select">
                          <option value=""><?php echo $tipo ?></option>
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
                        <input disabled require type="text" class="form-control" value="<?php echo $subtipo ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="dispuesto_por" class="form-label">Dispuesto Por</label>
                        <input disabled require type="text" class="form-control" id="dispuesto_por" name="dispuesto_por" value="<?php echo $dispuesto_por ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="fecha_hora_ingreso" class="form-label">Fecha y Hora de Ingreso</label>
                        <input disabled require type="datetime-local" class="form-control" id="fecha_hora_ingreso" name="fecha_hora_ingreso" value="<?php echo $fecha_hora_ingreso ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="fecha_hora_egreso" class="form-label">Fecha y Hora de Egreso</label>
                        <input require type="datetime-local" class="form-control" id="fecha_hora_egreso" name="fecha_hora_egreso" value="<?php echo $fecha_hora_egreso ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="secuestro" class="form-label">Secuestro</label>
                        <input disabled require type="text" class="form-control" id="secuestro" name="secuestro" value="<?php echo $secuestro ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="elem_secuestrado" class="form-label">Elemento Secuestrado</label>
                        <input disabled require type="text" class="form-control" id="elem_secuestrado" name="elem_secuestrado" value="<?php echo $elem_secuestrado ?>">
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary float-end" value="guardarIngresoPersonas" id="guardarIngresoPersonas" name="guardarIngresoPersonas">Guardar</button>
                      </div>
                    </form><!-- End Multi Columns Form -->

                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="btn btn-primary" href="ingreso-personas-tabla.php">Volver</a>
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