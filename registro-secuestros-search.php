<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';
session_start();
$idcom = $_SESSION['idComisaria'];

/* Un arreglo de las columnas a mostrar en la tabla */
$idConteo = 'id';

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

/*Consulta y filtrado */

if ($_SESSION['rol'] == 1) {
    $sql2 = "SELECT * FROM  registro_secuestro n INNER JOIN comisarias c WHERE (n.eliminado<1) AND (n.idComisaria=c.idComisaria) AND (fecha_reg LIKE '%$campo%' OR hora_reg LIKE '%$campo%' OR hecho LIKE '%$campo%' OR elemento_secuestrado LIKE '%$campo%') $sLimit";
    
    /*variable para sacar cantidad de filas dependiendo del tipo de usuario */
    $sqlTotal = "SELECT count($idConteo) FROM registro_secuestro n WHERE (n.eliminado<1)";
} else if ($_SESSION['rol'] == 0) {
    $sql2 = "SELECT * FROM registro_secuestro n INNER JOIN comisarias c WHERE (n.idComisaria=$idcom) AND (n.eliminado<1) AND (c.idComisaria=$idcom) AND (fecha_reg LIKE '%$campo%' OR hora_reg LIKE '%$campo%' OR hecho LIKE '%$campo%' OR elemento_secuestrado LIKE '%$campo%') $sLimit";

    /*variable para sacar cantidad de filas dependiendo del tipo de usuario */
    $sqlTotal = "SELECT count($idConteo) FROM registro_secuestro n WHERE n.idComisaria = $idcom AND (n.eliminado<1)";
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
        if (($row['eliminado'] >= 1)) {
        } else {
            $output['data'] .= '<tr>';
            $output['data'] .= '<th scope="row">' . $newDate = date("d/m/Y", strtotime($row['fecha_reg'])) . '</td>';
            $output['data'] .= '<td scope="row">' . $row['hora_reg'] . '</td>';
            $output['data'] .= '<td scope="row">' . $row['hecho'] . '</td>';
            $output['data'] .= '<td scope="row">' . $row['elemento_secuestrado'] . '</td>';
            $id = $row['id'];
            $output['data'] .= '<td scope="row"><a class="btn btn-primary" href="registro-secuestros-vermas.php?id=' . $row['id'] . '">Ver más</a></td>';
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
