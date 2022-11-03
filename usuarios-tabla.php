<?php
include 'conexion.php';
session_start();


//*******************************************************************************
//SI APRETA EL BOTON AGREGAR
if (isset($_POST['agregarPersona'])) {
    $nombrePersona = $_POST['nombrePersona'];
    $apellidoPersona = $_POST['apellidoPersona'];
    $correoPersona = $_POST['correoPersona'];
    $telefonoPersona = $_POST['telefonoPersona'];
    $sexoPersona = $_POST['sexoPersona'];
    $dniPersona = $_POST['dniPersona'];
    $fecharegistroPersona = $_POST['fecharegistroPersona'];
    $habilitadoPersona = $_POST['habilitadoPersona'];
    $eliminadoPersona = $_POST['eliminadoPersona'];


    //CONSULTA INSERTAR EN SQL
    $insertarPersona = "INSERT INTO personas (nombre, apellido, correo, telefono, sexo, dni, fechaRegistro, habilitado, eliminado) VALUES ('$nombrePersona', '$apellidoPersona', '$correoPersona', '$telefonoPersona', '$sexoPersona', '$dniPersona', '$fechaRegistroPersona', '$habilitadoPersona', '$eliminadoPersona')";

    $insertarUsuario = "INSERT INTO usuarios(usuario, contraseña, idPersona) VALUES ('$usuario','$contraseña','$idPersona')";

    $resultado = mysqli_query($conexion, $insertarUsuario);

    if (!$resultado) {
        echo "ERROR2";
    } else {
        $resultado = mysqli_query($conexion, $insertarPersona);
        if ($row = $resultado->fetch_assoc()) {
            $idPersona = $row['idPersona'];
        }
    }

    //EJECUTAR CONSULTA DE INSERTAR
    $ejecutarInsertarUsuario = mysqli_query($conexion, $insertarUsuario);
    if (!$ejecutarInsertarUsuario) {
        echo "<script>alert('ERROR AL INGRESAR DATOS');</script>";
    } else {
        header('location:usuarios-tabla.php');
    }
}
//****************************************************************************************************************




//CONSULTA TABLAS PARA MOSTRAR DATOS DE USUARIO
$consultaDatosTabla = "SELECT * FROM usuarios u INNER JOIN personas p WHERE u.idPersona=p.idPersona";
//RESULTAOD DE LA CONSULTA
$resultado4 = mysqli_query($conexion, $consultaDatosTabla);
if (!$resultado4) {
    echo "<script>alert('ERROR AL CONSULTAR INFORMACIÓN 4');</script>";
} else {
}
//CERRAMOS CONEXIÓN BD
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

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Registro de Usuarios</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-plus-circle-fill"></i>
            Agregar
        </button>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <!-- FORMULARIO PARA AGREGAR USUARIO -->

                                <form class="row g-3 needs-validation" method="POST" action="registrar_log.php">
                                    <div class="col-12">
                                    <label for="yourName" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" id="yourName" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su nombre!
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourName" class="form-label">Apellido</label>
                                    <input type="text" name="apellido" class="form-control" id="yourName" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su Apellido!
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourName" class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control" id="dni" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su DNI!
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourEmail" class="form-label">Correo</label>
                                    <input type="email" name="correo" class="form-control" id="yourEmail" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su Gmail!</div>
                                    </div>

                                    <div class="col-12">
                                    <select name="sexo" class="form-select form-select-sm" aria-label="Ejemplo de .form-select-sm">
                                    <option selected value="">Sexo</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                    <option value="3">Otro</option>
                                    </select>
                                    </div>
                                    <div class="col-12">
                                    <label for="yourName" class="form-label">Telefono</label>
                                    <input type="text" name="telefono" class="form-control" id="yourName" required>
                                    <div class="invalid-feedback">¡Por favor, escriba su Telefono!
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourUsername" class="form-label">Nombre de Usuario</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                                        <div class="invalid-feedback">¡Por favor, escriba su nombre de usuario</div>
                                    </div>
                                    </div>

                                    <div class="col-12">
                                    <label for="yourPassword" class="form-label">Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    <div class="invalid-feedback">¡Por favor, escriba una Contraseña!</div>
                                    </div>

                                    <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">Acepto todos los <a href="#">terminos y condiciones</a></label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                    </div>
                                    <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit" name="Bregistrar">Crear Cuenta</button>
                                    </div>
                                    <div class="col-12">
                                    <p class="small mb-0 text-center">¿Ya tienes una cuenta? <a href="pages-login.html">Iniciar sesión</a></p>
                                    </div>
                                </form>

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
        <section class="section">
            <table class="table table-sm table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Fecha de Registro</th>
                        <th scope="col">Habilitado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = $resultado4->fetch_assoc()) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $row['usuario'] ?></th>
                            <td scope="row"><?php echo $row['nombre'] ?></td>
                            <td scope="row"><?php echo $row['correo'] ?></td>
                            <td scope="row"><?php echo $row['fechaRegistro'] ?></td>
                            <td scope="row"><?php echo $row['habilitado'] ?></td>
                            <?php $idUsuario = $row['idUsuario'] ?>
                            <td scope="row">
                                <!-- BOTON VER MAS / EDITAR / ELIMINAR -->
                                <a class="btn btn-primary" href="usuarios-ver-mas.php?id=<?php echo $idUsuario?>">Ver más</a>
                            </td>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
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