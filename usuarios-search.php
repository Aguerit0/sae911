<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';




$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;

$consultaDatosTabla = "SELECT * FROM usuarios u INNER JOIN personas p WHERE (u.idPersona=p.idPersona) AND (usuario LIKE '%$campo%' OR nombre LIKE '%$campo%' OR nombre LIKE '%$campo%' OR correo LIKE '%$campo%' OR fechaRegistro LIKE '%$campo%')";

$resultado = $conexion->query($consultaDatosTabla);
$num_rows = $resultado->num_rows;



/* Mostrado resultados */
$html = '';

if (($num_rows > 0) and ($campo!=null)) {
    while ($row = $resultado->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<th scope="row">' . $row['usuario'] . '</td>';
        $html .= '<th scope="row">' . $row['nombre'] . '</td>';
        $html .= '<th scope="row">' . $row['correo'] . '</td>';
        $html .= '<td scope="row">' . $row['fechaRegistro'] . '</td>';
        if($row['habilitado'] == 1){
                                    $html .= '<td scope="row">SI</td>';
                                }else{$html .= '<td scope="row">SI</td>';}
        
        $id=$row['idUsuario'];
        $html .= '<td scope="row"><a class="btn btn-primary" href="usuarios-ver-mas.php?id=' . $row['idUsuario'] .'">Ver más</a></td>';
        $html .= '</tr>';

    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>