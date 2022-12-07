<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';
session_start();
$id = $_SESSION['idComisaria'];


/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id','fecha_reg_tabla','fecha_reg', 'hora_reg', 'tipo', 'subtipo'];

/* Nombre de la tabla */
$table = "novedades_de_relevancia";


if ($_SESSION['rol']==1) {
    $sql2 = "SELECT * FROM  novedades_de_relevancia n INNER JOIN comisarias c WHERE (n.eliminado<1) AND (n.idComisaria=c.idComisaria)";
}else if ($_SESSION['rol']==0) {
    $sql2 = "SELECT * FROM novedades_de_relevancia n INNER JOIN comisarias c WHERE (n.idComisaria=3) AND (n.eliminado<1) AND (c.idComisaria=3)";
}


$resultado = $conexion->query($sql2);
$num_rows = $resultado->num_rows;



/* Mostrado resultados */
$html = '';

echo "asd";
if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        if (($row['eliminado']>=1)) {
            
        }else{
            echo "asd";
        $html .= '<tr>';
        $html .= '<th scope="row">' . $row['fecha_reg_tabla'] . '</td>';
        $html .= '<td scope="row">' . $row['fecha_reg'] . '</td>';
        $html .= '<td scope="row">' . $row['hora_reg'] . '</td>';
        $html .= '<td scope="row">' . $row['tipo'] . '</td>';
        $html .= '<td scope="row">' . $row['subtipo'] . '</td>';
        $id=$row['id'];
        $html .= '<td scope="row"><a class="btn btn-primary" href="novedades-relevancia-vermas.php?id=' . $row['id'] .'">Ver más</a></td>';
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