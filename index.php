<?php
include("conexion.php");
if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
  //FUNCION PARA VALIDAR LOS DATOS INGRESADOS
  function validar($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $USUARIO = validar($_POST['usuario']);
  $CONTRASEÑA = validar($_POST['contraseña']);
  //Consulta sql
  $consulta = "SELECT * FROM usuarios WHERE usuario='$USUARIO' AND contraseña='$CONTRASEÑA'";
  //EJECUTAMOS LA CONSULTA
  $resultado = mysqli_query($conexion, $consulta);

  //SI ENTRA REDIRIGIMOS AL INICIO
  if (mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_assoc($resultado);
    if ($row['usuario'] == $USUARIO && $row['contraseña'] == $CONTRASEÑA) {
      $_SESSION['usuario'] == $row['usuario'];
      $_SESSION['nombre'] == $row['nombre'];
      $_SESSION['idUsuario'] == $row['idUsuario'];
      header('Location: inicio-dashboard.php');
      exit();
    } else {
      header('Location: index.php?fallo=true');
    }
  }
}

mysqli_close($conexion);



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

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Ingrese a su Cuenta</h5>
                    <p class="text-center small">Ingrese su nombre de usuario y contraseña para iniciar sesión</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Nombre de Usuario</label>
                      <div class="input-group has-validation">
                        <input type="text" name="usuario" class="form-control" id="usuario" required>
                        <div class="invalid-feedback">Por favor, introduzca su nombre de usuario.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">contraseña</label>
                      <input type="password" name="contraseña" class="form-control" id="contraseña" required>
                      <div class="invalid-feedback">Por favor, introduzca su contraseña.</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Recordar cuenta</label>
                      </div>
                    </div>

                    <div class="col-12">
                      <div style='color:red'>
                        <?php
                        if (isset($_GET["fallo"]) && $_GET["fallo"] == 'true') {
                          echo "Usuario o contraseña invalido ";
                        }
                        ?> 
                        </div>
                    </div>
                    

                </div>

                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit" name="ingresar">Ingresar</button>
                </div>
                </form>

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