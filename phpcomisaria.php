<?php 
    include 'conexion.php';
    $idComisaria =$_GET['id'];
    //SI APRETA EL BOTON AGREGAR


      $nombre='Comisaria 4ta';
      $direccion='Av Virgen del Valle 604';
      $provincia='Catamarca';
      $departamento='SFVC';
      $localidad='Capital';
      $telefono='3834688699';
      $latitud='001231234123';
      $longitud='9123477124';
      $habilitado=1;
      $eliminado=0;


      
    //CONSULTA EDITAR REGISTRO
  $consultaEditarRegistro="UPDATE comisarias SET nombre='$nombre', direccion='$direccion', provincia='$provincia', departamento='$departamento', localidad='$localidad', telefono='$telefono', habilitado='$habilitado', latitud='$latitud', longitud='$longitud', eliminado='$eliminado' WHERE idComisaria='$idComisaria' ";

    
      
      $resultadoEditarRegistro = mysqli_query($conexion,$consultaEditarRegistro) or die(mysqli_error());
      if (!$resultadoEditarRegistro) {
        echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
      }else{
        header('location:tabla-comisaria.php');
      }
    mysqli_close($conexion);
 ?>