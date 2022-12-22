<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';
session_start();
/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['idUsuario','usuario', 'nombre', 'correo', 'fechaRegistro', 'habilitado', 'eliminado'];
$idConteo = 'idUsuario';

/* Nombre de la tabla */
$table = "usuarios INNER JOIN personas";

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;

/*Limmit */
$pagina = isset($_POST['pagina']) ? $conexion->real_escape_string($_POST['pagina']) : 0;
$limit = 8;

if(!$pagina){
    $inicio = 0;
    $pagina = 2;
}else{
    $inicio = ($pagina -1) * $limit;
}

$sLimit = "LIMIT $inicio, $limit";


/* Consulta y filtrado */
$consultaDatosTabla = "SELECT * FROM usuarios u INNER JOIN personas p WHERE (u.idPersona=p.idPersona) AND (usuario LIKE '%$campo%' OR nombre LIKE '%$campo%' OR nombre LIKE '%$campo%' OR correo LIKE '%$campo%' OR fechaRegistro LIKE '%$campo%') $sLimit";

/*variable para sacar cantidad de filas dependiendo del tipo de usuario */
$sqlTotal = "SELECT count($idConteo) FROM usuarios n WHERE (n.eliminado<1)";

$resultado = $conexion->query($consultaDatosTabla);
$num_rows = $resultado->num_rows;

/*Consulta para total de registros */

$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conexion->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/*Consulta para total de registros */

$resTotal = $conexion->query($sqlTotal);
$row_total = $resTotal->fetch_array();
$totalRegistros = $row_total[0];

/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';


if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
            $id=$row['idUsuario'];
            $sql = "SELECT * FROM usuarios WHERE idUsuario=$id ";
            $res=mysqli_query($conexion,$sql);
            if ($row1=$res->fetch_assoc()) {
                $eliminado=$row1['eliminado'];
            }
            if ($eliminado>=1) {
                
            }else{
                $output['data'] .= '<tr>';
                $output['data'] .= '<th scope="row">' . $row['usuario'] . '</td>';
                $output['data'] .= '<th scope="row">' . $row['nombre'] . '</td>';
                $output['data'] .= '<th scope="row">' . $row['correo'] . '</td>';
                $output['data'] .= '<td scope="row">' . $newDate = date("d/m/Y", strtotime($row['fechaRegistro'])) . '</td>';
                if($row['habilitado'] == 1){
                                            $output['data'] .= '<td scope="row">SI</td>';
                                        }else{$output['data'] .= '<td scope="row">NO</td>';}
                
                $id=$row['idUsuario'];
                $output['data'] .= '<td scope="row"><a class="btn btn-primary" href="usuarios-ver-mas.php?id=' . $row['idUsuario'] .'">Ver más</a></td>';
                $output['data'] .= '</tr>';        
            }
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="7">Sin resultados</td>';
    $output['data'] .= '</tr>';
}
if($output['totalRegistros'] > 0){
    $totalPaginas =  ceil($output['totalRegistros'] /$limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination">';

    $numeroInicio = 1;

    if(($pagina - 4) > 1){
        $numeroInicio = $pagina - 4;
    }

    $numeroFin = $numeroInicio + 4;
    if($numeroFin > $totalPaginas){
        $numeroFin = $totalPaginas;
    }

    for($i = $numeroInicio; $i <= $numeroFin; $i++){
        if($pagina == $i){
            $output['paginacion'] .= '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';

        }else{
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="getData('.$i.')">'.$i.'</a></li>';
        }

    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';

}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>