<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';
session_start();
$idcom = $_SESSION['idComisaria'];


$campo = isset($_POST['campo']) ? $conexion->real_escape_string($_POST['campo']) : null;
if ($_SESSION['rol']==1) {
    $sql2 = "SELECT * FROM  ingreso_persona n INNER JOIN comisarias c WHERE (n.eliminado<1) AND (n.idComisaria=c.idComisaria) AND (tipo LIKE '%$campo%' OR subtipo LIKE '%$campo%' OR dispuesto_por LIKE '%$campo%' OR secuestro LIKE '%$campo%' OR elem_secuestrado LIKE '%$campo%')";
}else if ($_SESSION['rol']==0) {
    $sql2 = "SELECT * FROM ingreso_persona n INNER JOIN comisarias c WHERE (n.idComisaria=$idcom) AND (n.eliminado<1) AND (c.idComisaria=$idcom) AND (tipo LIKE '%$campo%' OR subtipo LIKE '%$campo%' OR dispuesto_por LIKE '%$campo%' OR secuestro LIKE '%$campo%' OR elem_secuestrado LIKE '%$campo%')";
}
$resultado = $conexion->query($sql2);
$num_rows = $resultado->num_rows;




/* Mostrado resultados */
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        if (($row['eliminado']>=1)) {
            
        }else{
        $html .= '<tr>';
        $html .= '<th scope="row">' . $row['tipo'] . '</td>';
        $html .= '<td scope="row">' . $row['subtipo'] . '</td>';
        $html .= '<td scope="row">' . $row['dispuesto_por'] . '</td>';
        $html .= '<td scope="row">' . $row['secuestro'] . '</td>';
        $html .= '<td scope="row">' . $row['elem_secuestrado'] . '</td>';
        $id=$row['id'];
        $html .= '<td scope="row"><a class="btn btn-primary" href="ingreso-personas-ver-mas.php?id=' . $row['id'] .'">Ver más</a></td>';
        $html .= '</tr>';   
        }
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="7">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>