<?php
    include('conexion.php');

    $idUsuario = $_GET['idUsuario'];
    $idComisaria = $_GET['idComisaria'];
    $habilitado = 1;
    $eliminado = 0;

    // VERIFICAR SI EL USUARIO YA TIENE DESIGNADA LA COMISARIA SELECCIONADA
    $sqlo = "SELECT * FROM  `usuario-comisaria` WHERE idUsuario = $idUsuario";
    $resultadoo2 = mysqli_query($conexion,$sqlo);

    $sql_TUC = "SELECT * FROM `usuario-comisaria` WHERE idUsuario = $idUsuario and idComisaria = $idComisaria";
    $resultadoo = mysqli_query($conexion,$sql_TUC);
    if ($row2 = $resultadoo->fetch_assoc()) {
      $comisaria = $row2['idComisaria'];
    }
    
    
    if (mysqli_num_rows($resultadoo2) == 0)
    {
      // regitrar usuario-comisaria en la base de datos
      $sentencia = $bd_conex->prepare("INSERT INTO `usuario-comisaria`(`idUsuario`, `idComisaria`, `habilitado`, `eliminado`) VALUES (?,?,?,?)");
      $resultado_usu_com = $sentencia->execute([$idUsuario, $idComisaria, $habilitado, $eliminado]);

      header("Location: usuarios-ver-mas.php?id=$idUsuario&mensaje=registrado");
  
      exit();

    }
    else{
      if($idComisaria != $comisaria){
        // echo "EXISTE USUARIO/PERSONA";
        $sentencia=$bd_conex->prepare('UPDATE `usuario-comisaria` SET idComisaria=:idComisaria WHERE idUsuario=:idUsuario');
        $sentencia->bindParam(':idComisaria', $idComisaria);
        $sentencia->bindParam(':idUsuario', $idUsuario);
        $sentencia->execute();
        header("Location: usuarios-ver-mas.php?id=$idUsuario&mensaje=editado");
        exit();
      }else{
        header("Location: usuarios-ver-mas.php?id=$idUsuario&mensaje=error");
        exit();
      }
    }
?>