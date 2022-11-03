<?php
// Consulta sql para traer datos para mostrar de las comisarias
// SELECT `idComisaria`, `nombre`, `direccion`, `provincia`, `departamento`, `localidad` FROM `comisarias` WHERE 1;


// el que use y funciono pero no muestra todos
$sql = "SELECT * FROM comisarias";
$resultado3 = mysqli_query($conexion, $sql);

if ($row3 = $resultado3->fetch_assoc()) 
{
    $id_com = $row3['idComisaria'];
    $nombre_com = $row3['nombre'];
    $direccion_com = $row3['direccion'];
    $provincia_com = $row3['provincia'];
    $departamento_com = $row3['departamento'];
    $localidad_com = $row3['localidad'];
}


?>


<form class="row g-3">
    <div class="p-6">
        <table class="table align-middle" style="text-align: center;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Provincia</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Localidad</th>
                    <th scope="col">Designar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"><?php echo $id_com; ?></td>
                    <td><?php echo $nombre_com; ?></td>
                    <td><?php echo $direccion_com; ?></td>
                    <td><?php echo $provincia_com; ?></td>
                    <td><?php echo $departamento_com; ?></td>
                    <td><?php echo $localidad_com; ?></td>

                    <td>
                        <!-- <a class="text-success" href="editar.php?id=<?php // echo $dato -> id; 
                        ?>">--><button type="submit" class="btn btn-primary float-end">Designar</button><!-- </a> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>