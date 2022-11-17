<?php
include('conexion.php');
session_start();
$idUsuario = $_GET['id'];


$consultaSelectUsuario = "SELECT * FROM usuarios WHERE idUsuario=$idUsuario";
$resultado1 = mysqli_query($conexion, $consultaSelectUsuario);
if ($row1 = $resultado1->fetch_assoc()) {
  $nombreUsuario = $row1['usuario'];
  $contraseñaUsuario = $row1['contraseña'];
  $idPersona = $row1['idPersona'];
}

$consultaSelectPersona = "SELECT * FROM personas WHERE idPersona=$idPersona";
$resultado2 = mysqli_query($conexion, $consultaSelectPersona);
if ($row2 = $resultado2->fetch_assoc()) {
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

      <!-- CODIGO DE ALERTAS -->
    <?php
          if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta')
          {
      ?>

          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Rellena todos los campos.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      
      <?php
          }
      ?>
      
      <?php
          if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado')
          {
      ?>

          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Registrado!</strong> Se asigno correctame la comisaria al usuario.
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
              <strong> El usuairo ya pertenese a esa comisaria.</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      
      <?php
          }
      ?>

      <?php
          if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado')
          {
      ?>

          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Cambiado!</strong> Los datos fueron actualizados.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      
      <?php
          }
      ?>


        <ul class="list-group mb-3">
          <li class="list-group-item fw-bold">Nombre: <span class="fw-normal ms-2"><?php echo $nombrePersona; ?></span></li>
          <li class="list-group-item fw-bold">Apellido: <span class="fw-normal ms-2"><?php echo $apellidoPersona; ?></span></li>
          <li class="list-group-item fw-bold">Correo: <span class="fw-normal ms-2"><?php echo $correoPersona; ?></span></li>
          <li class="list-group-item fw-bold">Teléfono: <span class="fw-normal ms-2"><?php echo $telefonoPersona; ?></span></li>
          <li class="list-group-item fw-bold">Genero: <span class="fw-normal ms-2"><?php if ($sexoPersona == 1) 
                                                                                              {
                                                                                                echo "Masculino";
                                                                                              } else { 
                                                                                                if($sexoPersona == 2){
                                                                                                  echo "Femenino";
                                                                                                }else{
                                                                                                  echo "No binario";
                                                                                                }
                                                                                              } ?></span>
          </li>
          <li class="list-group-item fw-bold">DNI: <span class="fw-normal ms-2"><?php echo $dniPersona; ?></span> </li>
          <li class="list-group-item fw-bold">Fecha de Registro: <span class="fw-normal ms-2"><?php echo $fechaRegistroPersona; ?></span></li>
          <li class="list-group-item fw-bold">Usuario: <span class="fw-normal ms-2"><?php echo $nombreUsuario; ?></span></li>          
          <li class="list-group-item fw-bold">Habilitado: <span class="fw-normal ms-2"><?php if ($habilitadoPersona == 1) 
                                                                                              {
                                                                                                echo "Si";
                                                                                              } else {
                                                                                                echo "No";
                                                                                              } ?></span>
          </li>
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
                <p>¿Esta seguro que desea realizar ésta acción?</p>
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
        <button type="button" class="btn btn-warning float-end mt-3" data-bs-toggle="modal" data-bs-target="#modalEditar">
          <i class="bi bi-pencil-square"></i>
          Editar
        </button>
        <!-- MODAL EDITAR -->
        <div class="modal fade" id="modalEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <form class="row g-3" method="post" action="">
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
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Habilitado</label>
                        <select id="inputState" class="form-select">
                          <option selected>Habilitado</option>
                          <option>Deshabilitado</option>
                        </select>
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

        <!-- BOTON DESIGNAR COMISARIA-->
        <button type="button" class="btn btn-info float-left mt-3" data-bs-toggle="modal" data-bs-target="#btn-designar">
          <i class="bi bi-pencil-square"></i>
          Asignar comisaria
        </button>

        <div class="modal fade bd-example-modal-lg" id="btn-designar" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Asignar Comisaria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
                <div class="card">
                  <div class="card-body">

                    <!-- FORMULARIO PARA DESIGNAR COMISARIA -->
                      <div class="p-6">
                        <table class="table align-middle" style="text-align: center;">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Direccion</th>
                              <th scope="col">Provincia</th>
                              <th scope="col">Departamento</th>
                              <th scope="col">Seleccionar</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            // Codigo Para Designar Comisaria
                            // $sentencia = $bd_conex->query("select * from comisarias");
                            // $usuario_comisaria = $sentencia->fetchAll(PDO::FETCH_OBJ);

                            $tabla_comisaria = "SELECT * FROM comisarias WHERE eliminado<1 AND habilitado>0";
                            $resultado4 = mysqli_query($conexion, $tabla_comisaria);

                            // SELECT * FROM `usuario-comisaria` WHERE idUsuario = $idUsuario

                            // $sql = "SELECT * FROM `usuario-comisaria` WHERE idUsuario = $idUsuario ORDER BY idComisaria ASC";
                            // $resultado5 = mysqli_query($conexion, $sql);
                            
                            // $idComisaria_TUC;

                            while (($row4 = $resultado4->fetch_assoc())) 
                            {
                              $idComisaria_TC = $row4['idComisaria'];
                              $nombre = $row4['nombre'];
                              $direccion = $row4['direccion'];
                              $provincia = $row4['provincia'];
                              $departamento = $row4['departamento'];

                              // $idUsuario_TUC = $row5['idUsuario'];
                              // $idComisaria_TUC = $row5['idComisaria'];

                              

                              ?>
                              <tr>

                                <td scope="row"><?php echo $idComisaria_TC; ?></td>
                                <td><?php echo $nombre?></td>
                                <td><?php echo $direccion; ?></td>
                                <td><?php echo $provincia; ?></td>
                                <td><?php echo $departamento; ?></td>
                                <td>
                                    <a class="btn btn-primary" href="designar-comisaria.php?idComisaria=<?php echo $idComisaria_TC; ?>&idUsuario=<?php echo $idUsuario;?>">Asignar</a>
                                  </td>
                              </tr>
                                <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Understood</button> -->
              </div>

              <!-- End Multi Columns Form -->
            </div>
          </div>
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