<?php
/*
 BUSCAR DATOS EN LAS TABLAS SON SEARCH
*/


require 'conexion.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['idUsuario','usuario', 'nombre', 'correo', 'fechaRegistro', 'habilitado', 'eliminado'];

/* Nombre de la tabla */
$table = "usuarios INNER JOIN personas";

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
FROM usuarios INNER JOIN personas
$where ";

$consultaDatosTabla = "SELECT * FROM usuarios u INNER JOIN personas p WHERE (u.idPersona=p.idPersona) AND (usuario LIKE '%$campo%' OR nombre LIKE '%$campo%' OR nombre LIKE '%$campo%' OR correo LIKE '%$campo%' OR fechaRegistro LIKE '%$campo%')";




$resultado = $conexion->query($consultaDatosTabla);
$num_rows = $resultado->num_rows;



/* Mostrado resultados */
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
            $id=$row['idUsuario'];
            $sql = "SELECT * FROM usuarios WHERE idUsuario=$id ";
            $res=mysqli_query($conexion,$sql);
            if ($row1=$res->fetch_assoc()) {
                $eliminado=$row1['eliminado'];
            }
            if ($eliminado>=1) {
                
            }else{
                $html .= '<tr>';
                $html .= '<th scope="row">' . $row['usuario'] . '</td>';
                $html .= '<th scope="row">' . $row['nombre'] . '</td>';
                $html .= '<th scope="row">' . $row['correo'] . '</td>';
                $html .= '<td scope="row">' . $row['fechaRegistro'] . '</td>';
                if($row['habilitado'] == 1){
                                            $html .= '<td scope="row">SI</td>';
                                        }else{$html .= '<td scope="row">NO</td>';}
                
                $id=$row['idUsuario'];
                $html .= '<td scope="row"><a class="btn btn-primary" href="usuarios-ver-mas.php?id=' . $row['idUsuario'] .'">Ver más</a></td>';
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