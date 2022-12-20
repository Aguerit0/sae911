<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';
session_start();
$idcom = $_SESSION['idComisaria'];


$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;
if ($_SESSION['rol'] == 1) {
    $sql2 = "SELECT * FROM  registro_secuestro n INNER JOIN comisarias c WHERE (n.eliminado<1) AND (n.idComisaria=c.idComisaria) AND (fecha_reg LIKE '%$campo%' OR hora_reg LIKE '%$campo%' OR hecho LIKE '%$campo%' OR elemento_secuestrado LIKE '%$campo%')";
} else if ($_SESSION['rol'] == 0) {
    $sql2 = "SELECT * FROM registro_secuestro n INNER JOIN comisarias c WHERE (n.idComisaria=$idcom) AND (n.eliminado<1) AND (c.idComisaria=$idcom) AND (fecha_reg LIKE '%$campo%' OR hora_reg LIKE '%$campo%' OR hecho LIKE '%$campo%' OR elemento_secuestrado LIKE '%$campo%')";
}
$resultado = $conexion->query($sql2);
$num_rows = $resultado->num_rows;




/* Mostrado resultados */
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        if (($row['eliminado'] >= 1)) {
        } else {
            $html .= '<tr>';
            $html .= '<th scope="row">' . $row['fecha_reg'] . '</td>';
            $html .= '<td scope="row">' . $row['hora_reg'] . '</td>';
            $html .= '<td scope="row">' . $row['hecho'] . '</td>';
            $html .= '<td scope="row">' . $row['elemento_secuestrado'] . '</td>';
            $id = $row['id'];
            $html .= '<td scope="row"><a class="btn btn-primary" href="registro-secuestros-vermas.php?id=' . $row['id'] . '">Ver más</a></td>';
            $html .= '</tr>';
        }
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
