<?php 
  include('conexion.php');
  session_start();
  // PREGUNTA SI HAY UN USUARIO REGISTRADO
  if(!isset($_SESSION['usuario'])){
    header('Location: index.php');
  }
      
  $idComisaria = $_GET['id'];
  $id = $_GET['id'];
  $estado ="";
  $nombre="";
  

  //CONSULTA TABLA COMISARIA
  $consulta = $bd_conex->prepare("SELECT * FROM comisarias WHERE idComisaria = :id");
  $consulta->bindParam(':id',$id);
  $consulta->execute();
  $comisaria = $consulta->fetch(PDO::FETCH_LAZY);

  $nombreComisaria=$comisaria['nombre'];
  $direccionComisaria=$comisaria['direccion'];
  $provinciaComisaria=$comisaria['provincia'];
  $departamentoComisaria=$comisaria['departamento'];
  $localidadComisaria=$comisaria['localidad'];
  $telefonoComisaria=$comisaria['telefono'];
  $latitudComisaria=$comisaria['latitud'];
  $longitudComisaria=$comisaria['longitud'];
  $habilitadoComisaria=$comisaria['habilitado'];
  $eliminadoComisaria=$comisaria['eliminado'];



  //EDITAR UN REGISTRO
    
  if (isset($_POST['guardar'])) {
    $nombre=$_POST['nombre'];
    $direccion=$_POST['direccion'];
    $provincia=$_POST['provincia'];
    $departamento=$_POST['departamento'];
    $localidad=$_POST['localidad'];
    $telefono=$_POST['telefono'];

    $editar ="UPDATE comisarias SET nombre='$nombre', direccion='$direccion', provincia='$provincia', departamento='$departamento', localidad='$localidad', telefono='$telefono' WHERE idComisaria='$idComisaria'";
    
    $resultadoEditarRegistro = mysqli_query($conexion,$editar);
    if (mysqli_errno($conexion)!=0) {
      ?>
      <script language='JavaScript' type="text/javascript">
        function B()
                {     
                location.href ='comisarias-ver-mas.php?mensaje=error&id=<?php echo $id?>';
                }
                B();
      </script>
      <?php
    }else{
      // header('location:comisarias-ver-mas.php?id=<?php echo $id;?>');
      ?>
      <script language='JavaScript' type="text/javascript">
        function B()
                {     
                location.href ='comisarias-ver-mas.php?mensaje=editado&id=<?php echo $id?>';
                }
                B();
      </script>
      <?php
    }
     
  }

  //ELIMINAR UN REGISTRO
  if (isset($_POST['confirmarEliminarRegistro'])){
    $eliminadoComisaria = 1;
    $sentenciaSQL=$bd_conex->prepare('UPDATE comisarias SET eliminado=:eliminado WHERE idComisaria=:id');
    $sentenciaSQL->bindParam(':id', $id);
    $sentenciaSQL->bindParam(':eliminado', $eliminadoComisaria);
    $sentenciaSQL->execute();
    
    header('Location: comisarias-tabla.php?mensaje=eliminado');
  }


  // HABILITAR / DESHABILITAR

  if(isset($_POST['confirmarDeshabilitar'])){
    if($habilitadoComisaria == 1){
      $estado = 0;
    }elseif($habilitadoComisaria==0){
      $estado = 1;
    }
    $sentenciaSQL=$bd_conex->prepare('UPDATE comisarias SET habilitado=:estado WHERE idComisaria=:id');
    $sentenciaSQL->bindParam(':id',$id);
    $sentenciaSQL->bindParam(':estado',$estado);
    $sentenciaSQL->execute();

    ?>
      <script language='JavaScript' type="text/javascript">
        function B()
                {     
                location.href ='comisarias-ver-mas.php?id=<?php echo $id?>';
                }
                B();
      </script>
      <?php
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
        <h1>Tabla Comisarias</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="comisarias-tabla.php">Tabla Comisarias</a></li>
            <li class="breadcrumb-item active">Ver Más</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <!-- DATOS DE COMISARIA -->
    <div class="card w-75 pt-3">
      <div class="card-body">

        <!-- CODIGO DE ALERTAS -->
        <?php
          if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado')
          {
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Editado!</strong> Los datos fueron actualizados.
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
            <strong> Error</strong> No se pudo editar la infomación.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
            }
        ?>
        
        <ul class="list-group mb-3">
            <li class="list-group-item fw-bold">Nombre: <span class="fw-normal ms-2"><?php echo $nombreComisaria; ?></span></li>
            <li class="list-group-item fw-bold">Direccion: <span class="fw-normal ms-2"><?php echo $direccionComisaria; ?></span></li>
            <li class="list-group-item fw-bold">Provincia: <span class="fw-normal ms-2"><?php echo $provinciaComisaria; ?></span></li>
            <li class="list-group-item fw-bold">Departamento: <span class="fw-normal ms-2"><?php echo $departamentoComisaria; ?></span> </li>
            <li class="list-group-item fw-bold">Localidad: <span class="fw-normal ms-2"><?php echo $localidadComisaria; ?></span> </li>
            <li class="list-group-item fw-bold">Telefono: <span class="fw-normal ms-2"><?php echo $telefonoComisaria; ?></span> </li>
            <li class="list-group-item fw-bold">Latitud: <span class="fw-normal ms-2"><?php echo $latitudComisaria; ?></span></li>
            <li class="list-group-item fw-bold">Longitud: <span class="fw-normal ms-2"><?php echo $longitudComisaria; ?></span></li>
            <li class="list-group-item fw-bold">
              Habilitado: <span class="fw-normal ms-2"><?php if($habilitadoComisaria == 1){echo "Si";}else{echo "No";} ?></span> 
            </li>
        </ul>

         <!-- BOTON MODAL ELIMINAR -->
         <button type="button" class="btn btn-danger float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalEliminar" value="eliminarRegistro">
          Eliminar
          </button>

          <!-- Modal ELIMINAR -->
          <form method="post">
          <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel" data-bs-dismiss="modal">Eliminar</h1>
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

          </form>
          
          
          <!-- BOTON MODAL DESHABILITAR -->
          <?php if($habilitadoComisaria == 1){?>
            <button type="button" class="btn btn-secondary float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#modalDeshabilitar">
              Deshabilitar
            </button>                    
          <?php }elseif($habilitadoComisaria==0){?>
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
                    <?php if($habilitadoComisaria == 1){?>
                            <button type="submit" name="confirmarDeshabilitar" value="deshabilitar" class="btn btn-danger">Deshabilitar</button>
                    <?php }elseif($habilitadoComisaria==0){?>
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
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Comisaria</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      <!-- FORMULARIO PARA EDITAR COMISARIA -->
                      <form class="row g-3" method="post" action="">
                        <div class="col-md-12">
                          <label for="inputName5" class="form-label">Nombre</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombreComisaria?>">
                        </div>
                        <div class="col-md-12">
                          <label for="inputEmail5" class="form-label">Dirección</label>
                          <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccionComisaria ?>">
                        </div>
                        <div class="col-md-6">
                          <label for="inputEmail5" class="form-label">Provincia</label>
                          <input type="text" class="form-control" id="provincia" name="provincia" value="<?php echo $provinciaComisaria ?>">
                        </div>
                        <div class="col-md-6">
                          <label for="inputPassword5" class="form-label">Departamento</label>
                          <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $departamentoComisaria ?>">
                        </div>
                        <div class="col-md-12">
                          <label for="inputPassword5" class="form-label">Localidad</label>
                          <input type="text" class="form-control" id="localidad" name="localidad" value="<?php echo $localidadComisaria ?>">
                        </div>
                        <div class="col-12">
                          <label for="inputAddress5" class="form-label">Teléfono</label>
                          <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefonoComisaria ?>">
                        </div>
                        
                        <div class="text-center">
                          
                          <button type="submit" name="guardar" class="btn btn-primary float-end" value="guardar">Guardar</button>
 
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
      </div>
    </div>
    <div class="d-flex justify-content-between">
      <a class="btn btn-primary " href="comisarias-tabla.php">Volver</a>
    </div>
    
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