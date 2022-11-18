<?php
    include('conexion.php');

    $idUsuario = $_GET['idUsuario'];
    $idComisaria = $_GET['idComisaria'];
    $habilitado = 1;
    $eliminado = 0;

    // VERIFICAR SI EL USUARIO YA TIENE DESIGNADA LA COMISARIA SELECCIONADA

    $sql_TUC = "SELECT * FROM `usuario-comisaria` WHERE idUsuario = $idUsuario and idComisaria = $idComisaria";
    $resultadoo = mysqli_query($conexion,$sql_TUC);

    $sqlo = "SELECT * FROM  `usuario-comisaria` WHERE idUsuario = $idUsuario";
    $resultadoo2 = mysqli_query($conexion,$sql_TUC);


    if (mysqli_num_rows($resultadoo) > 0)
    {
      // echo "EXISTE USUARIO/PERSONA";
      header("Location: usuarios-ver-mas.php?id=$idUsuario&mensaje=error");
      exit();
    }elseif((mysqli_num_rows($resultadoo2) > 0))
    {
      // regitrar usuario-comisaria en la base de datos
      $sentencia = $bd_conex->prepare("INSERT INTO `usuario-comisaria`(`idUsuario`, `idComisaria`, `habilitado`, `eliminado`) VALUES (?,?,?,?)");
      $resultado_usu_com = $sentencia->execute([$idUsuario, $idComisaria, $habilitado, $eliminado]);
  
  
      header("Location: usuarios-ver-mas.php?id=$idUsuario&mensaje=registrado");
  
      exit();
      

    }else
    {
      $sentencia=$bd_conex->prepare('UPDATE `usuario-comisaria` SET idComisaria=:idComisaria WHERE idUsuario=:idUsuario');
      $sentencia->bindParam(':idComisaria', $idComisaria);
      $sentencia->bindParam(':idUsuario', $idUsuario);
      $sentencia->execute();
      header("Location: usuarios-ver-mas.php?id=$idUsuario&mensaje=registrado");
  
      exit();
      // $sentencia = $bd_conex->prepare("UPDATE `usuario-comisaria`SET idComisaria` VALUES (?) WHERE idComisaria = ");
      // $resultado_usu_com = $sentencia->execute([$idComisaria]);
    }
?>