<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id','fecha_reg', 'fecha_reg_tabla', 'hora_tabla', 'lugar'];

/* Nombre de la tabla */
$table = "novedades_de_relevancia";

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
        $id = $row['id'];
        $html .= '<tr>';
        $html .= '<th scope="row">' . $id .'</td>';
        $html .= '<th scope="row">' . $row['fecha_reg'] . '</td>';
        $html .= '<td scope="row">' . $row['fecha_reg_tabla'] . '</td>';
        $html .= '<td scope="row">' . $row['hora_tabla'] . '</td>';
        $html .= '<td scope="row">' . $row['lugar'] . '</td>';
        $id=$row['id'];
        $html .= '<td scope="row"><a class="btn btn-primary" href="novedades-relevancia-vermas.php?id=' .$id .'">Ver más</a></td>';
        $html .= '</tr>';

    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>