<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';
session_start();
$idcom = $_SESSION['idComisaria'];

$idConteo = 'id';
/*Nombre de la tabla */
$table = 'ingreso_persona';

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;

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


/*Consulta */

if ($_SESSION['rol']==1) {
    $sql2 = "SELECT * FROM  ingreso_persona n INNER JOIN comisarias c WHERE (n.eliminado<1) AND (n.idComisaria=c.idComisaria) AND (tipo LIKE '%$campo%' OR subtipo LIKE '%$campo%' OR dispuesto_por LIKE '%$campo%' OR secuestro LIKE '%$campo%' OR elem_secuestrado LIKE '%$campo%') $sLimit";

    /*variable para sacar cantidad de filas dependiendo del tipo de usuario */
    $sqlTotal = "SELECT count($idConteo) FROM ingreso_persona n WHERE (n.eliminado<1)";
}else if ($_SESSION['rol']==0) {
    $sql2 = "SELECT * FROM ingreso_persona n INNER JOIN comisarias c WHERE (n.idComisaria=$idcom) AND (n.eliminado<1) AND (c.idComisaria=$idcom) AND (tipo LIKE '%$campo%' OR subtipo LIKE '%$campo%' OR dispuesto_por LIKE '%$campo%' OR secuestro LIKE '%$campo%' OR elem_secuestrado LIKE '%$campo%') $sLimit";

    /*variable para sacar cantidad de filas dependiendo del tipo de usuario */
    $sqlTotal = "SELECT count($idConteo) FROM ingreso_persona n WHERE n.idComisaria = $idcom AND (n.eliminado<1)";
}

$resultado = $conexion->query($sql2);
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
        if (($row['eliminado']>=1)) {
            
        }else{
        $output['data'] .= '<tr>';
        $output['data'] .= '<th class="align-middle" scope="row">' . $row['tipo'] . '</td>';
        $output['data'] .= '<td class="align-middle" scope="row">' . $row['subtipo'] . '</td>';
        $output['data'] .= '<td class="align-middle" scope="row">' . $row['dispuesto_por'] . '</td>';
        $output['data'] .= '<td class="align-middle" scope="row">' . $row['secuestro'] . '</td>';
        $output['data'] .= '<td class="align-middle" scope="row">' . $row['elem_secuestrado'] . '</td>';
        $id=$row['id'];
        $output['data'] .= '<td scope="row"><a class="btn btn-primary" href="ingreso-personas-ver-mas.php?id=' . $row['id'] .'">Ver más</a></td>';
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