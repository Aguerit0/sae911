<?php
include 'conexion.php';

if (isset($_POST['Bregistrar'])) 
{
  print_r($_POST);

  if (strlen(trim($_POST['nombre'])) >= 1 && strlen(trim($_POST['apellido'])) >= 1 && strlen(trim($_POST['dni'])) >= 1 && strlen(trim($_POST['correo'])) >= 1 && strlen(trim($_POST['telefono'])) >= 1 && strlen(trim($_POST['username'])) >= 1 && strlen(trim($_POST['password'])) >= 1) 
  {
    // tabla personas
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $dni = trim($_POST['dni']);
    $correo = trim($_POST['correo']);
    $sexo = $_POST['sexo'];
    $telefono = trim($_POST['telefono']);
    $fechareg = date("y/m/d");
    $habilitado = 1;
    $borrado = 0;

    // tabla usuario
    $usuario = trim($_POST['username']);
    $password = trim($_POST['password']);
    $rol = 0;
    $habilitado = 1;
    $borrado = 0;

    // Verificar que no exista personas con mismo dni, ni usuarios con el mismo nombre de usuario en bd
    $sql_per = "SELECT * FROM personas WHERE dni = '$dni'";
    $resultado2 = mysqli_query($conexion,$sql_per);

    $sql_usu = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultado3 = mysqli_query($conexion,$sql_usu);

    if (mysqli_num_rows($resultado2) > 0 || mysqli_num_rows($resultado3) > 0)
    {
      // echo "EXISTE USUARIO/PERSONA";
      header('Location: usuarios-tabla.php');
      exit();
    }
    else
    {
      // echo "NO EXISTE USUARIO/PERSONA";

      //Registrar personas
      $sentencia = $bd_conex -> prepare("INSERT INTO personas(nombre, apellido, correo, telefono, sexo, dni, fechaRegistro, habilitado, borrado) VALUES (?,?,?,?,?,?,?,?,?);");
      $resultado_per = $sentencia -> execute([$nombre,$apellido,$correo,$telefono,$sexo,$dni,$fechareg,$habilitado,$borrado]);
      
      // Comprobar si se registro personas
      // if ($resultado_per)
      // {
      //   echo "funciona personas";
      // }
      // else
      // {
      //   echo "no funciona personas";
      // }


      // Registrar usuario

      // Obtener id de persona para foranea de usuario
      $consulta = "SELECT idPersona FROM personas order by idPersona DESC LIMIT 1";
      $resultado = mysqli_query($conexion,$consulta);
      
      if ($row = $resultado -> fetch_assoc())
      {
        $idPersona = $row['idPersona'];
      }

      // regitrar usuario en la base de datos
      $sentencia = $bd_conex -> prepare("INSERT INTO usuarios(usuario, contraseña, rol, habilitado, borrado, idPersona) VALUES (?,?,?,?,?,?);");
      $resultado_usu = $sentencia -> execute([$usuario,$password,$rol,$habilitado,$borrado,$idPersona]);

      // Comprobar si se registro usuario
      // if ($resultado_usu)
      // {
      //   echo "funciona usuario";
      // }
      // else
      // {
      //   echo "no funciona usuario";
      // }

      header('Location: usuarios-tabla.php');
      exit();
    }
  } 
  else 
  {
    // echo "datos mal ingresados";
    header('Location: usuarios-tabla.php');
    exit();
  }
}

?>