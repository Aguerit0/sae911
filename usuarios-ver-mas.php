<?php
  include('conexion.php');
  session_start();
  $idUsuario = $_GET['id'];

  //************************   PRIMERA FORMA   ************************ 
  //CONSULTA TABLA USUARIOS/PERSONAS
  // $consultaSelectUsuarios="SELECT * FROM usuarios, personas WHERE (usuarios.idUsuario =  personas.idPersona) AND usuarios.idUsuario= '$idUsuario'";
  // $consultaSelectUsuarios = "SELECT * FROM personas INNER JOIN usuarios WHERE usuarios.idUsuario ='$idUsuario'";


  // /*$consultaSelectUsuarios = "SELECT * FROM usuarios u LEFT JOIN personas p ON u.idPersona=u.idPersona UNION ALL SELECT * FROM usuarios u RIGHT JOIN personas p ON u.idPersona=p.idPersona";*/
  // $resultado = mysqli_query($conexion, $consultaSelectUsuarios);
  // if (!$resultado) {
  //   echo '<script>alert("ERROR AL ENCONTRAR INFORMACIÓN")</script>';
  // }

  // if ($row = $resultado->fetch_assoc()) {
  //   //persona
  //   $nombrePersona = $row['nombre'];
  //   $apellidoPersona = $row['apellido'];
  //   $correoPersona = $row['correo'];
  //   $telefonoPersona = $row['telefono'];
  //   $sexoPersona = $row['sexo'];
  //   $dniPersona = $row['dni'];
  //   $fechaRegistroPersona = $row['fechaRegistro'];
  //   $habilitadoPersona = $row['habilitado'];
  //   $eliminadoPersona = $row['eliminado'];

  //   //usuario
  //   $nombreUsuario = $row['usuario'];
  //   $contraseñaUsuario = $row['contraseña'];
  //   $idUsuario=$row['idUsuario'];
  // }




  //************************   SEGUNDA FORMA   ************************ 
  //OBTENCION DE DATOS TABLA 
  /*$consultaSelectUsuario = "SELECT * FROM usuarios WHERE idUsuario=$idUsuario";
  $consultaSelectPersona = "SELECT * FROM personas WHERE idPersona=$idUsuario";
  $resultado1=mysqli_query($conexion,$consultaSelectUsuario);
  $resultado2=mysqli_query($conexion,$consultaSelectPersona);
  if ($row1 = $resultado1->fetch_assoc()) {
    $nombreUsuario = $row1['usuario'];
    $contraseñaUsuario = $row1['contraseña'];
    $idUsuario=$row1['idUsuario'];
  }
  if ($row2=$resultado2->fetch_assoc()) {
    $nombrePersona = $row2['nombre'];
    $apellidoPersona = $row2['apellido'];
    $correoPersona = $row2['correo'];
    $telefonoPersona = $row2['telefono'];
    $sexoPersona = $row2['sexo'];
    $dniPersona = $row2['dni'];
    $fechaRegistroPersona = $row2['fechaRegistro'];
    $habilitadoPersona = $row2['habilitado'];
    $eliminadoPersona = $row2['eliminado'];
  }*/
  //************************   TERCERA FORMA   ************************ 

  $consultaSelectUsuario = "SELECT * FROM usuarios WHERE idUsuario=$idUsuario";
  $resultado1=mysqli_query($conexion,$consultaSelectUsuario);
  if ($row1 = $resultado1->fetch_assoc()) {
    $nombreUsuario = $row1['usuario'];
    $contraseñaUsuario = $row1['contraseña'];
    $idPersona=$row1['idPersona'];
    $eliminadoUsuario = $row['eliminado'];
  }
  $consultaSelectPersona = "SELECT * FROM personas WHERE idPersona=$idPersona";
  $resultado2=mysqli_query($conexion,$consultaSelectPersona);
  if ($row2=$resultado2->fetch_assoc()) {
    $nombrePersona = $row2['nombre'];
    $apellidoPersona = $row2['apellido'];
    $correoPersona = $row2['correo'];
    $telefonoPersona = $row2['telefono'];
    $sexoPersona = $row2['sexo'];
    $dniPersona = $row2['dni'];
    $fechaRegistroPersona = $row2['fechaRegistro'];
    $habilitadoPersona = $row2['habilitado'];
    $eliminadoPersona = $row2['eliminado'];
  }

  // HABILITAR / DESHABILITAR

  if(isset($_POST['confirmarDeshabilitar'])){
    if($habilitadoPersona == 1){
      $estado = 0;
    }elseif($habilitadoPersona==0){
      $estado = 1;
    }
    $sentenciaSQL=$bd_conex->prepare('UPDATE personas SET habilitado=:estado WHERE idPersona=:id');
    $sentenciaSQL->bindParam(':id', $idPersona);
    $sentenciaSQL->bindParam(':estado',$estado);
    $sentenciaSQL->execute();

    header('Location: usuarios-tabla.php');
  }

  // ELIMINAR
  if (isset($_POST['confirmarEliminarRegistro'])){
    $eliminadoUsuario = 1;
    $sentenciaSQL=$bd_conex->prepare('UPDATE usuarios SET eliminado=:eliminado WHERE idUsuario=:id');
    $sentenciaSQL->bindParam(':id', $idUsuario);
    $sentenciaSQL->bindParam(':eliminado', $eliminadoUsuario);
    $sentenciaSQL->execute();
    
    header('Location: usuarios-tabla.php');
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
  <?php include("./template/dashboard.php")?>

  <!-- ======= Sidebar ======= -->
  <?php  if($_SESSION['rol'] == 1){
      include ("./template/admin.php");
    }else{
      include ("./template/usuario.php");
    }
  ?>

  <main id="main" class="main container">
    <div class="pagetitle">
      <h1>Tabla Usuarios</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="usuarios-tabla.php">Usuarios</a></li>
          <li class="breadcrumb-item active">Ver Más</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card w-75 pt-3">
      <div class="card-body">

        <ul class="list-group mb-3">
          <li class="list-group-item fw-bold">ID USUARIO: <span class="fw-normal ms-2"><?php echo $idUsuario; ?></span></li>
          <li class="list-group-item fw-bold">ID PERSONA: <span class="fw-normal ms-2"><?php echo $idPersona; ?></span></li>
          <li class="list-group-item fw-bold">Nombre: <span class="fw-normal ms-2"><?php echo $nombrePersona; ?></span></li>
          <li class="list-group-item fw-bold">Apellido: <span class="fw-normal ms-2"><?php echo $apellidoPersona; ?></span></li>
          <li class="list-group-item fw-bold">Correo: <span class="fw-normal ms-2"><?php echo $correoPersona; ?></span></li>
          <li class="list-group-item fw-bold">Teléfono: <span class="fw-normal ms-2"><?php echo $telefonoPersona; ?></span> </li>
          <li class="list-group-item fw-bold">Género: <span class="fw-normal ms-2"><?php echo $sexoPersona; ?></span> </li>
          <li class="list-group-item fw-bold">DNI: <span class="fw-normal ms-2"><?php echo $dniPersona; ?></span> </li>
          <li class="list-group-item fw-bold">Fecha de Registro: <span class="fw-normal ms-2"><?php echo $fechaRegistroPersona; ?></span></li>
          <li class="list-group-item fw-bold">Usuario: <span class="fw-normal ms-2"><?php echo $nombreUsuario; ?></span></li>
          <li class="list-group-item fw-bold">Contraseña: <span class="fw-normal ms-2"><?php echo $contraseñaUsuario; ?></span></li>
          <li class="list-group-item fw-bold">
            Habilitado: <span class="fw-normal ms-2"><?php if ($habilitadoPersona == 1) {
                                                        echo "Habilitado";
                                                      } else {
                                                        echo "Deshabilitado";
                                                      } ?></span>
          </li>
          <li class="list-group-item fw-bold">Eliminado: <span class="fw-normal ms-2"><?php echo $eliminadoUsuario; ?></span></li>
        </ul>

        <!-- BOTON MODAL ELIMINAR -->
        <button type="button" class="btn btn-danger float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalEliminar">
          Eliminar
        </button>
        <!-- Modal ELIMINAR -->
        <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="" method="post">
                  <button type="submit" class="btn btn-danger" name="confirmarEliminarRegistro" value="eliminar" data-bs-dismiss="modal">Eliminar</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- BOTON MODAL DESHABILITAR -->
        <?php if($habilitadoPersona == 1){?>
            <button type="button" class="btn btn-secondary float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalDeshabilitar">
              Deshabilitar
            </button>                    
          <?php }elseif($habilitadoPersona==0){?>
            <button type="button" class="btn btn-success float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalDeshabilitar">
             Habilitar
            </button>                    
          <?php }?> 
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
                <form action="" method="post">
                    <?php if($habilitadoPersona == 1){?>
                            <button type="submit" name="confirmarDeshabilitar" value="deshabilitar" class="btn btn-danger">Deshabilitar</button>
                    <?php }elseif($habilitadoPersona==0){?>
                            <button type="submit" name="confirmarDeshabilitar" value="deshabilitar" class="btn btn-success">Habilitar</button>
                    <?php }?>                     
                  </form>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-body">

                    <!-- FORMULARIO PARA EDITAR USUARIO -->
                    <form class="row g-3">
                      <div class="col-md-12">
                        <label for="inputName5" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="inputName5">
                      </div>
                      <div class="col-md-12">
                        <label for="inputLastName5" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="inputLastName5">
                      </div>
                      <div class="col-md-12">
                        <label for="inputEmail5" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="inputEmail5">
                      </div>
                      <div class="col-12">
                        <label for="inputPhone5" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="inputPhone5">
                      </div>
                      <div class="col-md-12">
                        <label for="inputUser5" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="inputUser5">
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary float-end">Guardar</button>
                      </div>
                    </form>
                    <!-- End Multi Columns Form -->

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
      </div>
    </div>
    <br>
    <div class="d-flex justify-content-between">
      <a class="btn btn-primary " href="usuarios-tabla.php">Volver</a>
    </div>
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