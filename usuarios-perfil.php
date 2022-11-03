
<?php 
  include('conexion.php');
  session_start();
  //SUPONIENDO QUE EL ID QUE TRAEMOS ES == 1
  $idPersona = $_SESSION['id'];
  $idUsusario = $_SESSION['id'];
  $idComisaria = $_SESSION['idComisaria'];

  //CONSULTA TABLA PERSONA
  $consultaPersonas = "SELECT * FROM personas WHERE idPersona= '$idPersona'";
  //CONSULTA TABLA USUARIOS 
  $consultaUsuarios = "SELECT * FROM usuarios WHERE idUsuario='$idUsusario'";
  //CONSULTA TABLA COMISARIA
  $consultaComisarias =" SELECT * FROM comisarias WHERE idComisaria='$idComisaria'";

  //RESULTADOS
  $resultado1 = mysqli_query($conexion, $consultaPersonas);
  $resultado2 = mysqli_query($conexion, $consultaUsuarios);
  $resultado3 = mysqli_query($conexion, $consultaComisarias);

  //OBTENCIÓN DE DATOS
  //OBTENCIÓN CAMPOS TABLA PERSONAS
  if ($row1 = $resultado1->fetch_assoc()) {
      $nombrePersona = $row1['nombre'];
      $apellidoPersona=$row1['apellido'];
      $correoPersona=$row1['correo'];
      $telefonoPersona=$row1['telefono'];
      $fechaRegistroPersona=$row1['fechaRegistro'];
      $estadoPersona=$row1['habilitado'];
  }
  //OBTENIÓN CAMPOS TABLA USUARIO
  if($row2 = $resultado2->fetch_assoc()){
      $usuarioUsuario=$row2['usuario'];
      $contraseñaUsuario=$row2['contraseña'];
      $rolUsuario=$row2['rol'];
  }
  //OBTENIÓN CAMPOS TABLA COMISARIA
  if($row3 = $resultado3->fetch_assoc()){
      $nombreComisaria=$row3['nombre'];
      $direccionComisaria=$row3['direccion'];
      $provinciaComisaria=$row3['provincia'];
      $departamentoComisaria=$row3['departamento'];
      $localidadComisaria=$row3['localidad'];
      $telefonoComisaria=$row3['telefono'];
      $latitudComisaria=$row3['latitud'];
      $longitudComisaria=$row3['longitud'];
      $estadoComisaria=$row3['habilitado'];
      if($estadoComisaria==1){
        $estadoComisaria='HABILITADO';
      }else{
        $estadoComisaria='DESHABILITADO';
      }
  }
 if(isset($_POST['cambiarContraseña'])){
                            //PASO VALORES A VARIABLES
                            $contraseñaActual=$_POST['contraseñaActual'];
                            $contraseñaNueva=$_POST['contraseñaNueva'];
                            $repetirContraseñaNueva=$_POST['repetirContraseñaNueva'];

                            //CONSULTA SQL
                            $consultaCambiarContraseña="UPDATE usuarios SET contraseña='$contraseñaNueva' WHERE idUsuario=1";


                            if ($contraseñaUsuario==$contraseñaActual) {
                              //ENTRA A CAMBIAR CONTRASEÑA
                              if ($contraseñaNueva==$repetirContraseñaNueva) {
                                if ($contraseñaNueva==$contraseñaUsuario) {
                                    echo '<script>alert("La contraseña debe ser diferente");window.history.go(-1);</script>';
                                  exit;    
                                }else{
                                    //SI TODO ESTA BIEN EJECUTAMOS EL CAMBIO DE CONTRASEÑA
                                  $resultadoCambiarContraseña=mysqli_query($conexion,$consultaCambiarContraseña);
                                  if (!$resultadoCambiarContraseña) {
                                    echo "Error al cambiar contraseña";
                                  }else{
                                    
                                    echo "<script>alert('SE CAMBIO CORRECTAMENTE');</script>";
                                  }
                                }
                              }
                            }
                          }
                          mysqli_close($conexion);


 ?>

 <?php 
/*
 $insertar = "INSERT INTO  novedades_de_guardia (fecha, turno, superior_de_turno, oficial_servicio, personas_de_guardia, motoristas, mov_funcionamiento, mov_fuera_de_servicio, detenidos_causa_federal,detenidos_justicia_ordinaria, arres_averiguacion_de_hecho, aprehendidos, arres_averiguacion_actividades, arres_info_codigo_de_faltas, demorados)  VALUES ('$txtFecha','$txtTurno','$txtSuperiorTurno','$txtOficialServicio','$txtCantPersonalGuardia','$txtMotoristas','$txtMovilesFuncionamiento','$txtMo','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]','[value-15]','[value-16]','[value-17]','[value-18]')";
*/

  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Perfil Usuario</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Perfil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio-dashboard.php">Inicio</a></li>
          <li class="breadcrumb-item">Usuario</li>
          <li class="breadcrumb-item active">Perfil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/siluetaPolicia.jpg" alt="Profile" class="rounded-circle">
              
                    <h2><?php echo $apellidoPersona." ".$nombrePersona;?></h2><!--extraer campo nombre persona tabla persona-->
                    
                    <h3><?php echo "comisaria: $nombreComisaria"?></h3><!--extraer campo nombre tabla comisaria comisaria php-->
              
              
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">General</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambiar Contraseña</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Detalles del Perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Apellido y Nombre</div>
                    
                    <div class="col-lg-9 col-md-8"><?php echo $apellidoPersona." ".$nombrePersona;?></div><!--Extraer apellido y nombre tabla 'personas'-->
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Correo</div>
                    <div class="col-lg-9 col-md-8"><?php echo $correoPersona ?></div><!--Extraer correo tabla 'personas'-->
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telefono</div>
                    <div class="col-lg-9 col-md-8"><?php echo "+54 3834 $telefonoPersona" ?></div><!--Extraer telefono tabla 'personas'-->
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Fecha y Hora de Registro</div>
                    <div class="col-lg-9 col-md-8"><?php echo $fechaRegistroPersona?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Comisaria</div>
                    <div class="col-lg-9 col-md-8"><?php echo "comisaria $nombreComisaria" ?></div><!--Extraer comisaria tabla 'comisaria'-->
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Dirección Comisaria</div>
                    <div class="col-lg-9 col-md-8"><?php echo $direccionComisaria ?></div><!--Extraer dirección comisaria tabla 'comisaria'-->
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Departamento y Localidad</div>
                    <div class="col-lg-9 col-md-8"><?php echo $departamentoComisaria." - ".$localidadComisaria ?></div><!--Extraer dpto y localidad tabla 'comisaria'-->
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Estado Comisaria</div>
                    <div class="col-lg-9 col-md-8"><?php echo $estadoComisaria ?></div><!--Extraer estado tabla 'personas'-->
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Actual</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="contraseñaActual" type="password" class="form-control" id="contraseñaActual">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Nueva</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="contraseñaNueva" type="password" class="form-control" id="contraseñaNueva">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Repetir Contraseña Nueva</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="repetirContraseñaNueva" type="password" class="form-control" id="repetirContraseñaNueva">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="cambiarContraseña">Cambiar Contraseña</button>
                    </div>
                  </form><!-- End Change Password Form -->
                      

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
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