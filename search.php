<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['idComisaria', 'nombre', 'direccion', 'provincia', 'departamento', 'localidad'];

/* Nombre de la tabla */
$table = "comisarias";

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
        $html .= '<tr>';
        $html .= '<th scope="row">' . $row['idComisaria'] . '</td>';
        $html .= '<th scope="row">' . $row['nombre'] . '</td>';
        $html .= '<td scope="row">' . $row['direccion'] . '</td>';
        $html .= '<td scope="row">' . $row['provincia'] . '</td>';
        $html .= '<td scope="row">' . $row['departamento'] . '</td>';
        $html .= '<td scope="row">' . $row['localidad'] . '</td>';
        $html .= '<td scope="row"><a class="btn btn-primary" href="comisarias-ver-mas-EJEMPLO.php?id=<?php echo $idComisaria?>">Ver más</a></td>';
        $html .= '</tr>';

    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>