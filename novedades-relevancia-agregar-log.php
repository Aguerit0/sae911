<?php
include 'conexion.php';

session_start();

$idUsuario = $_SESSION['id'];

$sql = "SELECT idComisaria FROM `usuario-comisaria` WHERE idUsuario = $idUsuario";

$resultado = mysqli_query($conexion, $sql);

if ($row = $resultado->fetch_assoc()) 
{
    $idComisaria = $row['idComisaria'];
}

echo $idUsuario,$idComisaria;

if (isset($_POST['BtnAgregar'])) 
{
    print_r($_POST);

    if (strlen(trim($_POST['txtHora'])) >= 1 && strlen(trim($_POST['txtDescr_Lugar'])) >= 1 && strlen(trim($_POST['txtCaractDeHecho'])) >= 1 && strlen(trim($_POST['txtMovil'])) >= 1 && strlen(trim($_POST['txtElementoSustraido'])) >= 1)
    {
        // hay que hacer la verificacion de como entro lo de color pero hay que verificar primero que dato trajo Elemento utilizado
        // lo mismo con lo de denunciante

        echo "Todo Okey";

        date_default_timezone_set("America/Argentina/Catamarca");
        $fecha_reg_tabla = date("Y/m/d H:i");        

        $txtFecha = trim($_POST['txtFecha']);
        $txtHora = trim($_POST['txtHora']);

        $tipo = $_POST['tipo'];
        $subtipo = $_POST['subtipo'];

        $txtLon = trim($_POST['lon']);
        $txtLat = trim($_POST['lat']);

        $txtDescr_Lugar = trim($_POST['txtDescr_Lugar']);

        if (strlen(trim($_POST['txtSindicados'])) >= 1)
        {
            $txtSindicados = trim($_POST['txtSindicados']);
        }
        else
        {
            $txtSindicados = "-";
        }
        

        // if ($txtSindicados >= 0)
        // {
        //     $txtSindicados = trim($_POST['txtSindicados']);
        // }
        // else
        // {
        //     header('Location: novedades-relevancia-agregar.php?mensaje=errorsindicados');
        //     exit();
        // } 


        $txtCaractDeHechos = trim($_POST['txtCaractDeHecho']);
        $txtMovil = trim($_POST['txtMovil']);
        $txtElementoSustraido = trim($_POST['txtElementoSustraido']);

        $Hecho_Con_Int = $_POST['Hecho_Con_Int'];
        $ElementoUtilizado = $_POST['ElementoUtilizado'];

        if ($ElementoUtilizado != 'Motocicleta')
        {
            $TipoMotocicleta = "-";
            $txtColor = "-";
        }
        else
        {
            if (strlen(trim($_POST['txtColor'])) >= 1)
            {
                $TipoMotocicleta = $_POST['TipoMotocicleta'];
                $txtColor = trim($_POST['txtColor']);
            }
            else
            {
                header('Location: novedades-relevancia-agregar.php?mensaje=errorcolor');
                exit();
            }
        }

        $EmitioAdelanto = $_POST['EmitioAdelanto'];

        if(strlen(trim($_POST['txtDamnificado']))>= 1)
        {
            $txtDamnificado = trim($_POST['txtDamnificado']);
        }
        else
        {
            $txtDamnificado = "No especifica";
        }
        
        if (strlen(trim($_POST['txtEdad'])) >= 1)
        {
            if ($_POST['txtEdad'] > 0)
            {
                $txtEdad = trim($_POST['txtEdad']);
            }
            else
            {
                header('Location: novedades-relevancia-agregar.php?mensaje=erroredad');
                exit();
            }
        }
        else
        {
            $txtEdad = "No especifica";
        }
        
        $Sexo = $_POST['Sexo'];
        $Denuncia = $_POST['Denuncia'];

        if ($Denuncia != 'Si')
        {
            $txtDenunciante = "-";
            $UnidadJudicial = "-";
        }
        else
        {
            if (strlen(trim($_POST['txtDenunciante'])) >= 1)
            {
                $txtDenunciante = trim($_POST['txtDenunciante']);
                $UnidadJudicial = $_POST['UnidadJudicial'];
            }
            else
            {
                header('Location: novedades-relevancia-agregar.php?mensaje=errordenunciante');
                exit();
            }
        }

        $ComisionPolicialInvestigacion = $_POST['ComisionPolicialInvestigacion'];

        // $ESTADO = $_REQUEST['ESTADO'];

        $MedidaTomadaArray = $_REQUEST['MedidaTomada'];
        if(count($MedidaTomadaArray) > count(array_unique($MedidaTomadaArray)))
        {
            // echo "¡Hay repetidos!";
            header('Location: novedades-relevancia-agregar.php?mensaje=errormedidatomada');
            exit();
        }
        else
        {
            // echo "No hay repetidos";
            if (strlen(trim($_POST['txtSindicados'])) >= 1)
            {
                for ($i=0; $i < count($MedidaTomadaArray); $i++) 
                { 
                    if ($MedidaTomadaArray[$i] == 'Ninguna')
                    {
                        $MedidaTomada = "Ninguna";
                    }
                }

                if ($MedidaTomada != "Ninguna")
                {
                    $MedidaTomada = implode(" - ",$MedidaTomadaArray);
                }
            }
            else
            {
                for ($i=0; $i < count($MedidaTomadaArray); $i++) 
                { 
                    if ($MedidaTomadaArray[$i] == 'Ninguna')
                    {
                        $MedidaTomada = "Ninguna";
                    }
                }

                if ($MedidaTomada != "Ninguna")
                {
                    $MedidaTomada = implode(" - ",$MedidaTomadaArray);
                }
                else
                {
                    header('Location: novedades-relevancia-agregar.php?mensaje=errormedidatomada3');
                    exit();
                }
            }
        }

        $eliminado = 0;

        // echo $fecha_reg_tabla, $txtFecha, $txtHora, $tipo, $subtipo, $txtLon, $txtLat, $txtDescr_Lugar, $txtSindicados, $txtCaractDeHechos, $txtMovil, $txtElementoSustraido, $Hecho_Con_Int, $ElementoUtilizado, $TipoMotocicleta, $txtColor, $EmitioAdelanto, "damni:", $txtDamnificado, "edad:", $txtEdad, $Sexo, $Denuncia, $txtDenunciante, $UnidadJudicial, $ComisionPolicialInvestigacion, $MedidaTomada, $eliminado, $idComisaria, $idUsuario;

        $sentencia = $bd_conex -> prepare("INSERT INTO `novedades_de_relevancia`(`fecha_reg_tabla`, `fecha_reg`, `hora_reg`, `tipo`, `subtipo`, `longitud`, `latitud`, `descripcion_lugar`, `sindicados`, `caracteristicas_hecho`, `movil`, `elemento_sustraido`, `hecho_consumado`, `elemento_utilizado`, `tipo_motocicleta`, `color`, `adelanto_circulacion`, `damnificado`, `edad`, `sexo`, `denuncia`, `denunciante`, `unidad_judicial`, `comision_personal`, `medida_tomada`, `eliminado`, `idComisaria`, `idUsuario`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");

        $resultado_novedades_relevancia = $sentencia -> execute([$fecha_reg_tabla, $txtFecha, $txtHora, $tipo, $subtipo, $txtLon, $txtLat, $txtDescr_Lugar, $txtSindicados, $txtCaractDeHechos, $txtMovil, $txtElementoSustraido, $Hecho_Con_Int, $ElementoUtilizado, $TipoMotocicleta, $txtColor, $EmitioAdelanto, $txtDamnificado, $txtEdad, $Sexo, $Denuncia, $txtDenunciante, $UnidadJudicial, $ComisionPolicialInvestigacion, $MedidaTomada, $eliminado, $idComisaria, $idUsuario]);

        // Comprobar si se registro novedades de relevancia
        if ($resultado_novedades_relevancia)
        {
            // echo "funciona agregar novedades relevancia";
            header('Location: novedades-relevancia-tabla.php?mensaje=registrado');
            exit();
        }
        else
        {
            // echo "no funciona agregar novedades relevancia";
            header('Location: novedades-relevancia-agregar.php?mensaje=errorbd');
            exit();
        }
    } 
    else 
    {
        // echo "datos mal ingresados";
        header('Location: novedades-relevancia-agregar.php?mensaje=errormalingresado');
        exit();
    }
}
else 
{
    // echo "no esta bien el name del boton";
    header('Location: novedades-relevancia-agregar.php?mensaje=?mensaje=errornombreboton');
    exit();
}