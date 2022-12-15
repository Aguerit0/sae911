<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';
session_start();
$id = $_SESSION['idComisaria'];


/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id','nombre','fecha', 'turno', 'superior_de_turno', 'oficial_servicio','idComisaria','eliminado'];
$idConteo = 'id';
/* Nombre de la tabla */
$table = "novedades_de_guardia";

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE idComisaria='$id' AND (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

/*Limmit */
$pagina = isset($_POST['pagina']) ? $conexion->real_escape_string($_POST['pagina']) : 0;;
$limit = 8;

if(!$pagina){
    $inicio = 0;
    $pagina = 2;
}else{
    $inicio = ($pagina -1) * $limit;
}

$sLimit = "LIMIT $inicio, $limit";

/* Consulta */
$sql = "SELECT " . implode(", ", $columns) . "
FROM $table
$where
$sLimit ";

if ($_SESSION['rol']==1) {
    $sql2 = "SELECT SQL_CALC_FOUND_ROWS * FROM  novedades_de_guardia n INNER JOIN comisarias c WHERE (n.eliminado<1) AND (n.idComisaria=c.idComisaria) AND (fecha LIKE '%$campo%' OR turno LIKE '%$campo%' OR superior_de_turno LIKE '%$campo%' OR oficial_servicio LIKE '%$campo%' OR nombre LIKE '%$campo%') $sLimit";
}else if ($_SESSION['rol']==0) {
    $sql2 = "SELECT SQL_CALC_FOUND_ROWS * FROM novedades_de_guardia n INNER JOIN comisarias c WHERE (n.idComisaria=$id) AND (n.eliminado<1)  AND (c.idComisaria=$id) AND (fecha LIKE '%$campo%' OR turno LIKE '%$campo%' OR superior_de_turno LIKE '%$campo%' OR oficial_servicio LIKE '%$campo%' OR nombre LIKE '%$campo%')";
}


$resultado = $conexion->query($sql2);
$num_rows = $resultado->num_rows;

/*Consulta para total de registros */

$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conexion->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/*Consulta para total de registros */

$sqlTotal = "SELECT count($idConteo) FROM $table ";
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
        if (($row['eliminado']>=1)) {
            
        }else{
        $output['data'] .= '<tr>';
        $output['data'] .= '<th scope="row">' . $row['nombre'] .'</td>';
        $output['data'] .= '<th scope="row">' . $row['fecha'] . '</td>';
        $output['data'] .= '<td scope="row">' . $row['turno'] . '</td>';
        $output['data'] .= '<td scope="row">' . $row['superior_de_turno'] . '</td>';
        $output['data'] .= '<td scope="row">' . $row['oficial_servicio'] . '</td>';
        $id=$row['id'];
        $output['data'] .= '<td scope="row"><a class="btn btn-primary" href="novedades-ver-mas.php?id=' . $row['id'] .'">Ver más</a></td>';
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
