<?php
  require_once "conexion.php";
  session_start();
  $error = ""; //variable para almacenar error

  if (isset($_POST['submit'])){
    // VARIABLES DEL CAPTCHA
    $ip = $_SERVER['REMOTE_ADDR'];
    $captcha = $_POST['g-recaptcha-response'];
    $secretkey = "6Le2M_giAAAAAMNBT9xuD4VJAf8g_Hf_zLmLIVrH";

    $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
    $atributos = json_decode($respuesta, TRUE);

    if(!$atributos['success']){
      $error = "Verificar Captcha";

    }elseif (!isset($_POST['usuario']) && !isset($_POST['password']))
    {
      $error = "Usuario o Contraseña invalidos";
    }else{
      // DEFINE USUSARIO Y Contraseña
      $usuario = $_POST['usuario'];
      $password = $_POST['password'];

      

      $sentenciaSQL=$bd_conex->prepare('SELECT idUsuario, usuario, rol FROM usuarios WHERE usuario=:usuario AND contraseña=:password');
      $sentenciaSQL->bindParam(':usuario', $usuario);
      $sentenciaSQL->bindParam(':password', $password);
      $sentenciaSQL->execute();
      $cuenta = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

      if($cuenta == true){
        $_SESSION['usuario']=$cuenta['usuario'];
        $_SESSION['rol']=$cuenta['rol'];
        $_SESSION['id']=$cuenta['idUsuario'];

        $sentenciaSQL=$bd_conex->prepare('SELECT nombre, apellido FROM personas WHERE idPersona =:id');
        $sentenciaSQL->bindParam(':id', $_SESSION['id']);
        $sentenciaSQL->execute();
        $persona = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $_SESSION['nombre']=$persona['nombre'];
        $_SESSION['apellido']=$persona['apellido'];

        $sentenciaSQL=$bd_conex->prepare('SELECT idComisaria FROM `usuario-comisaria` WHERE idUsuario =:id');
        $sentenciaSQL->bindParam(':id', $_SESSION['id']);
        $sentenciaSQL->execute();
        $usuComisaria = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $_SESSION['idComisaria']=$usuComisaria['idComisaria'];
        
        header('Location: inicio-dashboard.php');
      }else{
        $error="Ususario o Contraseña son incorrectos";
      }
      // Para proteger de Inyecciones SQL 
      // $usuario = mysqli_real_escape_string($conexion,(strip_tags($usuario,ENT_QUOTES)));
      // $password =  sha1($password);//Algoritmo de encriptacion de la contraseña http://php.net/manual/es/function.sha1.php

      // $sql="SELECT * FROM usuarios WHERE ususario=$usuario AND contraseña = $password";
      // $query=mysqli_query($conexion,$sql);
      // $counter=mysqli_num_rows($query);

      // if ($counter==1){
      //   $_SESSION['usuario']=$usuario; // Iniciando la sesion
      //   header("location: inicio-dashboard.php"); // Redireccionando a la pagina profile.php
	    // }else {
      //   $error = "El correo electrónico o la contraseña es inválida.";	
      // }
    }
  }



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Iniciar sesion</title>
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

  <!-- RECAPTCHA -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">

                  <span class="d-none d-lg-block">SAE 911</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3 pb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Ingrese a su Cuenta</h5>
                    <p class="text-center small">Ingrese su nombre de usuario y contraseña para iniciar sesión</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Usuario</label>
                      <div class="input-group has-validation">
                        <input type="text" name="usuario" class="form-control" id="usuario" required>
                        <div class="invalid-feedback">Por favor, introduzca su nombre de usuario.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">contraseña</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Por favor, introduzca su contraseña.</div>
                    </div>

                    <div class="col-12 d-flex align-items-center justify-content-center">
                      <div style='color:red'>
                        <?php
                       
                          echo $error;
                        ?> 
                        </div>
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-center">
                      <div class="g-recaptcha" data-sitekey="6Le2M_giAAAAACUkbvA13FYQumhDiPSyaQ9wivf2" required>

                      </div>
                      <div class="invalid-feedback">Por favor, valide el captcha.</div>
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-center">
                      <button class="btn btn-primary w-50" type="submit" name="submit">Ingresar</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>

          </div>
        </div>
    </div>

    </section>

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