<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id','fecha', 'turno', 'superior_de_turno', 'oficial_servicio','idComisaria'];

/* Nombre de la tabla */
$table = "novedades_de_guardia";

$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}


/* Consulta */
$sql = "SELECT " . implode(", ", $columns) . "
FROM $table
$where ";
$resultado = $conexion->query($sql);
$num_rows = $resultado->num_rows;


/* Mostrado resultados */
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $idComisaria = $row['idComisaria'];
        $cons="SELECT nombre FROM comisarias WHERE idComisaria=$idComisaria ";
        $res=mysqli_query($conexion,$cons);
        if ($fila = $res->fetch_assoc()) {
            $nombreComis=$fila['nombre'];
        }
        $html .= '<tr>';
        $html .= '<th scope="row">' . $nombreComis .'</td>';
        $html .= '<th scope="row">' . $row['fecha'] . '</td>';
        $html .= '<td scope="row">' . $row['turno'] . '</td>';
        $html .= '<td scope="row">' . $row['superior_de_turno'] . '</td>';
        $html .= '<td scope="row">' . $row['oficial_servicio'] . '</td>';
        $id=$row['id'];
        $html .= '<td scope="row"><a class="btn btn-primary" href="novedades-ver-mas.php?id=' . $row['id'] .'">Ver más</a></td>';
        $html .= '</tr>';

    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>