<?php
  include 'conexion.php';
  session_start();
  // PREGUNTA SI HAY UN USUARIO REGISTRADO
  if(!isset($_SESSION['usuario'])){
    header('Location: index.php');
  }

  $idUsuario = $_SESSION['id'];

  $sql = "SELECT idComisaria FROM `usuario-comisaria` WHERE idUsuario = $idUsuario";

  $resultado = mysqli_query($conexion, $sql);
  
  if ($row = $resultado->fetch_assoc()) 
  {
    $idComisaria = $row['idComisaria'];
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

  
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Css Mapa -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>


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
      <h1>Mapa Novedades de Relevancia</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="inicio-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Ver Mapa</li>
        </ol>
      </nav>
    </div>

    <div class="card">
        <div class="card-body">
          <!-- FORMULARIO PARA AGREGAR NOVEDADES DE RELEVANCIA -->
          <form method="POST" enctype="multipart/form-data" class="row g-3 pt-3">

            <h2 class="page-title text-center d-flex justify-content-center align-items-center">Filtro del Mapa</h2>
            <hr>

            <div class="col-md-6">
              <label for="inputState" class="form-label">Tipo</label>
              <select required id="tipo" name="tipo" class="form-select">
                <option value="">Seleccionar</option>
                <option value="TODOS">TODOS</option>
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
              <label for="inputState" class="form-label">Subtipo</label>
              <select required id="subtipo" name="subtipo" class="form-select" disabled>
              </select>
            </div>

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Fecha del Suceso</label>
              <!-- <div class="col-sm-10"> -->
              <input type="date" id="txtFecha" name="txtFecha" class="form-control">
              <!-- </div> -->
            </div>

            <?php
            if ($_SESSION['rol']==1) 
            { 
              ?>
              <div class="col-md-6">
              <label for="inputState" class="form-label">Comisaria</label>
              <select id="comisaria" name="comisaria" class="form-select">
                <option value="TODOS">TODOS</option>
                <?php 
                $sql_comisarias = "SELECT * FROM comisarias";
                $resultado4 = mysqli_query($conexion,$sql_comisarias);

                while ($row4 = $resultado4->fetch_assoc())
                {
                  ?>
                  <option value="<?php echo $row4['idComisaria'] ?>"><?php echo $row4['nombre'] ?></option>
                  <?php
                }
                ?>
              </select>
              </div>
              <?php
            }
            else if ($_SESSION['rol']==0) 
            {
              $sql_comisarias = "SELECT * FROM comisarias WHERE idComisaria = '$idComisaria'";
              $resultado4 = mysqli_query($conexion,$sql_comisarias);

              if ($row4 = $resultado4->fetch_assoc())
              {
                ?>
                <div class="col-md-6">
                  <label for="inputState" class="form-label">Comisaria</label>
                  <input type="text" class="form-control" value="<?php echo $row4['nombre'] ?>" disabled>
                </div>
                <?php
              }
            }
            ?>
            <div class="col-md-12 text-center d-flex justify-content-center align-items-center">
              <button type="submit" name="BtnAgregar" class="btn btn-primary float-end px-xl-5">Buscar</button>
            </div>

            <div class="col-md-12 text-center d-flex justify-content-center align-items-center">
              <h5 class="text-body" id="resultados"></h5>
            </div>

            <div class="col-md-12">
              <div id="map" style="height: 60vh; width: 69vw; margin: 0 auto; border-radius: 10px;"></div>
            </div>
          </form>
        </div>
    </div>

  </main><!-- End #main -->>

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

  <!-- Script select -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="assets/js/select-ver-mapa.js"></script>

  <!-- Script de mapa -->
  <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>

  <!-- Script codigo mapa -->
  <script>
    
    // Coordenadas iniciales

    var lat = -28.47326;
    var lon = -65.78756;
    
    //inicializa mapa con centro del mapa con coordenadas iniciales y zoom de 17 en DIV mapid

    var map = L.map('map').setView([lat, lon], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'

    }).addTo(map);

    <?php

    if (isset($_POST['BtnAgregar']))
    {
      $tipo = $_POST['tipo'];
      $subtipo = $_POST['subtipo'];
      $fecha = $_POST['txtFecha'];

      if ($_SESSION['rol']==1) 
      {
        $comisaria = $_POST['comisaria'];
      }
      else if ($_SESSION['rol']==0){}


      if ($tipo == "TODOS")
      {
        if ($fecha == "")
        {
          if ($_SESSION['rol']==1) 
          {
            if($comisaria == "TODOS")
            {
              $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE `eliminado` < 1";
            }
            else
            {
              $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE idComisaria = '$comisaria' && `eliminado` < 1";
            }
          }
          else if ($_SESSION['rol']==0) 
          {
            $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE idComisaria = '$idComisaria' && `eliminado` < 1";
          }
          // $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE idComisaria = '$idComisaria'";
        }
        else
        {
          if ($_SESSION['rol']==1) 
          {
            if($comisaria == "TODOS")
            {
              $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE fecha_reg = '$fecha' && `eliminado` < 1";
            }
            else
            {
              $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE fecha_reg = '$fecha' && idComisaria = '$comisaria' && `eliminado` < 1";
            }
          }
          else if ($_SESSION['rol']==0) 
          {
            $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE fecha_reg = '$fecha' && idComisaria = '$idComisaria' && `eliminado` < 1";
          }
          // $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE fecha_reg = '$fecha' && idComisaria = '$idComisaria'";
        }
      }
      else
      {
        if ($subtipo == "TODOS")
        {
          if ($fecha == "")
          {
            if ($_SESSION['rol']==1) 
            {
              if($comisaria == "TODOS")
              {
                $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && `eliminado` < 1";
              }
              else
              {
                $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && idComisaria = '$comisaria' && `eliminado` < 1";
              }
            }
            else if ($_SESSION['rol']==0) 
            {
              $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && idComisaria = '$idComisaria' && `eliminado` < 1";
            }
            // $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && idComisaria = '$idComisaria'";
          }
          else
          {
            if ($_SESSION['rol']==1) 
            {
              if($comisaria == "TODOS")
              {
                $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && fecha_reg = '$fecha' && `eliminado` < 1";
              }
              else
              {
                $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && fecha_reg = '$fecha' && idComisaria = '$comisaria' && `eliminado` < 1";
              }
            }
            else if ($_SESSION['rol']==0) 
            {
              $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && fecha_reg = '$fecha' && idComisaria = '$idComisaria' && `eliminado` < 1";
            }
            // $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && fecha_reg = '$fecha' && idComisaria = '$idComisaria'";
          }
        }
        else
        {
          if ($fecha == "")
          {
            if ($_SESSION['rol']==1) 
            {
              if($comisaria == "TODOS")
              {
                $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && subtipo = '$subtipo' && `eliminado` < 1";
              }
              else
              {
                $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && subtipo = '$subtipo' && idComisaria = '$comisaria' && `eliminado` < 1";
              }
            }
            else if ($_SESSION['rol']==0) 
            {
              $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && subtipo = '$subtipo' && idComisaria = '$idComisaria' && `eliminado` < 1";
            }
            // $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && subtipo = '$subtipo' && idComisaria = '$idComisaria'";
          }
          else
          {
            if ($_SESSION['rol']==1) 
            {
              if($comisaria == "TODOS")
              {
                $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && subtipo = '$subtipo' && fecha_reg = '$fecha' && `eliminado` < 1";
              }
              else
              {
                $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && subtipo = '$subtipo' && fecha_reg = '$fecha' && idComisaria = '$comisaria' && `eliminado` < 1";
              }
            }
            else if ($_SESSION['rol']==0) 
            {
              $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && subtipo = '$subtipo' && fecha_reg = '$fecha' && idComisaria = '$idComisaria' && `eliminado` < 1";
            }
            // $sql_rel = "SELECT * FROM `novedades_de_relevancia` WHERE tipo = '$tipo' && subtipo = '$subtipo' && fecha_reg = '$fecha' && idComisaria = '$idComisaria'";
          }
        }
      }

      $resultado2 = mysqli_query($conexion,$sql_rel);

      if ($_SESSION['rol']==1) 
      {
        while ($row2 = $resultado2->fetch_assoc()) 
        {
          $idComisaria = $row2['idComisaria'];

          $sql_com = "SELECT * FROM `comisarias` WHERE idComisaria = $idComisaria && `eliminado` < 1";
          $resultado3 = mysqli_query($conexion,$sql_com);

          if($row3 = $resultado3->fetch_assoc())
          {
            $nom_comisaria = $row3['nombre'];
          }

          ?>
          L.marker([<?php echo $row2['latitud'] ?>, <?php echo $row2['longitud'] ?>]).addTo(map).bindPopup(`
          <p>Referencia: <?php echo $row2['id'] ?></p>
          <p>Fecha: 
          <?php 
          $newDate = date("d/m/Y", strtotime($row2['fecha_reg']));
          echo $newDate;
          ?></p>
          <p>Hora: <?php echo $row2['hora_reg'] ?></p>
          <p>Tipo: <?php echo $row2['tipo'] ?></p>
          <p>Subtipo: <?php echo $row2['subtipo'] ?></p>
          <p>Comisaria: <?php echo $nom_comisaria ?></p>
          `);
          <?php
        }
      }
      else if ($_SESSION['rol']==0) 
      {
        while ($row2 = $resultado2->fetch_assoc()) 
        {
          $idComisaria = $row2['idComisaria'];

          $sql_com = "SELECT * FROM `comisarias` WHERE idComisaria = $idComisaria";
          $resultado3 = mysqli_query($conexion,$sql_com);

          if($row3 = $resultado3->fetch_assoc())
          {
            $nom_comisaria = $row3['nombre'];
          }
          ?>
          L.marker([<?php echo $row2['latitud'] ?>, <?php echo $row2['longitud'] ?>]).addTo(map).bindPopup(`
          <p>Referencia: <?php echo $row2['id'] ?></p>
          <p>Fecha: 
          <?php 
          $newDate = date("d/m/Y", strtotime($row2['fecha_reg']));
          echo $newDate;
          ?></p>
          <p>Hora: <?php echo $row2['hora_reg'] ?></p>
          <p>Tipo: <?php echo $row2['tipo'] ?></p>
          <p>Subtipo: <?php echo $row2['subtipo'] ?></p>
          <p>Comisaria: <?php echo $nom_comisaria ?></p>
          `);
          <?php
        }
      }  

      ?> 
          document.getElementById("resultados").innerHTML = "Cantidad de resultados: <?php echo mysqli_num_rows($resultado2) ?>";
      <?php

    }
    else
    {
      if ($_SESSION['rol']==1) 
      {
        $sql_rel = "SELECT * FROM novedades_de_relevancia WHERE `eliminado` < 1";
        $resultado2 = mysqli_query($conexion,$sql_rel);
      }
      else if ($_SESSION['rol']==0) 
      {
        $sql_rel = "SELECT * FROM novedades_de_relevancia WHERE idComisaria = '$idComisaria' && `eliminado` < 1";
        $resultado2 = mysqli_query($conexion,$sql_rel);
      }
  
      while ($row2 = $resultado2->fetch_assoc()) 
      {
        $idComisaria = $row2['idComisaria'];

        $sql_com = "SELECT * FROM `comisarias` WHERE idComisaria = $idComisaria";
        $resultado3 = mysqli_query($conexion,$sql_com);

        if($row3 = $resultado3->fetch_assoc())
        {
          $nom_comisaria = $row3['nombre'];
        }

        ?>
        L.marker([<?php echo $row2['latitud'] ?>,<?php echo $row2['longitud'] ?>]).addTo(map).bindPopup(`
        <p>Referencia: <?php echo $row2['id'] ?></p>
        <p>Fecha: 
        <?php 
        $newDate = date("d/m/Y", strtotime($row2['fecha_reg']));
        echo $newDate;
        ?></p>
        <p>Hora: <?php echo $row2['hora_reg'] ?></p>
        <p>Tipo: <?php echo $row2['tipo'] ?></p>
        <p>Subtipo: <?php echo $row2['subtipo'] ?></p>
        <p>Comisaria: <?php echo $nom_comisaria ?></p>
        `);
        <?php
      }

      ?> 
        document.getElementById("resultados").innerHTML = "Cantidad de resultados: <?php echo mysqli_num_rows($resultado2) ?>";
      <?php
    }
    ?>

    </script>

</body>

</html>