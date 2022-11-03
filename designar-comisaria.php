<?php
    include('conexion.php');

    $idUsuario = $_GET['idUsuario'];
    $idComisaria = $_GET['idComisaria'];
    $habilitado = 1;
    $eliminado = 0;

    // regitrar usuario-comisaria en la base de datos
    $sentencia = $bd_conex->prepare("INSERT INTO `usuario-comisaria`(`idUsuario`, `idComisaria`, `habilitado`, `eliminado`) VALUES (?,?,?,?)");
    $resultado_usu_com = $sentencia->execute([$idUsuario, $idComisaria, $habilitado, $eliminado]);

    header("Location: usuarios-ver-mas.php?id=$idUsuario");
    exit();

?>