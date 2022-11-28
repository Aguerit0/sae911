<?php 
    $id=$_GET['id'];
    include('conexion.php');
    session_start();
    // PREGUNTA SI HAY UN USUARIO REGISTRADO
    if(!isset($_SESSION['usuario'])){
      header('Location: index.php');
    }

    $idNovedades=$_GET['id'];
    //CONSULTA TABLA NOVEDADES_DE_GUARDIA
    $sql = "SELECT * FROM ingreso_persona WHERE id=$id";
    $resultado = mysqli_query($conexion,$sql);
    if ($roww = mysqli_result($resultado)) {
        //OBTENCION DE DATOS TABLA NOVEDADES_DE_RELEVANCIA
        $idIngresoPersonas = $resultado['id'];
        $fecha_hora_reg = $resultado['fecha_hora_reg'];
        $tipo= $resultado['tipo'];
        $subtipo= $resultado['subtipo'];
        $dispuesto_por = $resultado['dispuesto_por'];
        $fecha_hora_ingreso = $resultado['fecha_hora_ingreso'];
        $fecha_hora_egreso = $resultado['fecha_hora_egreso'];
        $secuestro = $resultado['secuestro'];
        $elem_secuestrado = $resultado['elem_secuestrado'];
        $longitud = $resultado['longitud'];
        $latitud = $resultado['latitud'];
        $idComisaria= $resultado['idComisaria'];
        $eliminado = $resultado['eliminado'];    
    }
    
    

  //ELIMINAR UN REGISTRO
  if (isset($_POST['confirmarEliminarRegistro'])){
    $eliminado = 1;
    $sentenciaSQL=$bd_conex->prepare('UPDATE ingreso_personas SET eliminado=:eliminado WHERE id=:id');
    $sentenciaSQL->bindParam(':id', $idIngresoPersonas);
    $sentenciaSQL->bindParam(':eliminado', $eliminado);
    $sentenciaSQL->execute();
    header('Location: tabla-ingreso-personas.php');
  }


  //OBTENER NOMBRE COMISARIA
  $sqlcom = "SELECT nombre FROM comisarias WHERE idComisaria = $idComisaria";
  $ressqlcom = mysqli_query($conexion,$sqlcom);
  if($row =  mysqli_fetch_row($ressqlcom)){
    $nombreComisaria = $row['nombre'];
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
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- Css Mapa -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>

</head>

<body>

  <!-- ======= Header ======= -->
  <?php include(".././template/dashboard.php")?>

  <!-- ======= Sidebar ======= -->
  <?php  if($_SESSION['rol'] == 1){
      include (".././template/admin.php");
    }else{
      include (".././template/usuario.php");
    }
  ?>

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Tabla Ingreso de Personas</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../inicio-dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="tabla-ingreso-personas.php">Tabla Ingreso de Personas</a></li>
            <li class="breadcrumb-item active">Ver Más</li>
          </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card w-75 pt-3">
      <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item fw-bold">Fecha y Hora de Registro: <span class="fw-normal ms-2"><?php echo $fecha_hora_reg?></span></li></li>
            <li class="list-group-item fw-bold">Tipo: <span class="fw-normal ms-2"><?php echo $tipo ?></span></li>
            <li class="list-group-item fw-bold">Sub Tipo: <span class="fw-normal ms-2"><?php echo $subtipo ?></span></li>
            <li class="list-group-item fw-bold">Dispuesto Por: <span class="fw-normal ms-2"><?php echo $dispuesto_por ?></span></li>
            <li class="list-group-item fw-bold">Fecha y Hora de Ingreso: <span class="fw-normal ms-2"><?php echo $fecha_hora_ingreso ?></span></li>
            <li class="list-group-item fw-bold">Fecha y Hora de Egreso: <span class="fw-normal ms-2"><?php echo $fecha_hora_egreso ?></span></li>
            <li class="list-group-item fw-bold">Secuestro: <span class="fw-normal ms-2"><?php echo $secuestro ?></span></li>
            <li class="list-group-item fw-bold">Elemento Secuestrado: <span class="fw-normal ms-2"><?php echo $elem_secuestrado ?></span></li>
            <li class="list-group-item fw-bold">Latitud: <span class="fw-normal ms-2"><?php echo $latitud ?></span></li>
            <li class="list-group-item fw-bold">Longitud: <span class="fw-normal ms-2"><?php echo $longitud ?></span></li>
            <li class="list-group-item fw-bold">Comisaria: <span class="fw-normal ms-2"><?php echo $nombreComisaria ?></span></li>
            <li class="list-group-item fw-bold">
            <div id="map" style="height: 30vh; width: 40vw; margin: 0 auto; border-radius: 10px;"></div>
            </li>
        </ul>  
        
        <?php  if($_SESSION['rol'] == 1){
           include ("botonera-ingreso-personas.php");
          }
        ?>
      </div>
    </div>
    <a class="btn btn-primary" href="novedades-relevancia-tabla.php">Volver</a>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Script de mapa -->
  <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
  <script>
    // Coordenadas iniciales
    var lat = <?php echo $latitud ?>;
    var lon = <?php echo $longitud ?>;
    
    //inicializa mapa con centro del mapa con coordenadas iniciales y zoom de 17 en DIV mapid
    var map = L.map('map').setView([lat, lon], 17);
    //Indica que Tile se utilizará
    /* L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    }).addTo(map); */


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'

    }).addTo(map);

    L.marker([<?php echo $latitud?>,<?php echo $longitud ?>]).addTo(map);

  </script>
</body>

</html>