<?php
	date_default_timezone_set("America/Argentina/Catamarca");
	header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");    
	header("Content-Disposition: attachment; filename=novedad_de_relevancia_" . date("Y-m-d (H:i)").".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");

	$id=$_GET['id'];
	require_once 'conexion.php';
	
	$output = "";
	
	if(ISSET($_POST['export'])){
		$output .='
			<table border="1">
				<thead>
					<tr>
						<th>Fecha Registro Tabla</th>
						<th>Fecha Suceso</th>
						<th>Hora Suceso</th>
						<th>Tipo</th>
                        <th>Subtipo</th>
                        <th>Descripcion del lugar</th>
                        <th>Sindicados</th>
                        <th>Catacteristicas de Hecho</th>
                        <th>Movil</th>
                        <th>Elemento Sustraido</th>
                        <th>Hecho Consumado o Intento</th>
                        <th>Elemento Utilizado</th>
                        <th>Tipo de Motocicleta</th>
                        <th>Color</th>
                        <th>Adelanto Circulacion</th>
                        <th>Damificado</th>
                        <th>Edad</th>
                        <th>Genero</th>
                        <th>Denuncia</th>
                        <th>Denunciante</th>
                        <th>Unidad Judicial</th>
                        <th>Comision Personal</th>
                        <th>Medida Tomada</th>
                        <th>Comisaria</th>
					</tr>
				</thead>	
				
		';
		
		$query = mysqli_query($conexion, "SELECT * FROM `novedades_de_relevancia` WHERE id = $id");
		
		while($fetch = mysqli_fetch_array($query)){
			// Pasar la comisaria de numero a texto
			$idComisaria =  $fetch['idComisaria'];
			$sql_rel = "SELECT * FROM comisarias WHERE idComisaria = '$idComisaria'";
			$resultado2 = mysqli_query($conexion,$sql_rel);
			
			if ($row3 = $resultado2 -> fetch_assoc())
			{
				$nombreComisaria = $row3['nombre'];
			}
		$output .= '
				<tbody>
					<tr>
						<td style="text-align: center">'.$fetch['fecha_reg_tabla'].'</td>
						<td style="text-align: center">'.$fetch['fecha_reg'].'</td>
						<td style="text-align: center">'.$fetch['hora_reg'].'</td>
						<td style="text-align: center">'.$fetch['tipo'].'</td>
						<td style="text-align: center">'.$fetch['subtipo'].'</td>
						<td style="text-align: center">'.$fetch['descripcion_lugar'].'</td>
						<td style="text-align: center">'.$fetch['sindicados'].'</td>
						<td style="text-align: center">'.$fetch['caracteristicas_hecho'].'</td>
						<td style="text-align: center">'.$fetch['movil'].'</td>
						<td style="text-align: center">'.$fetch['elemento_sustraido'].'</td>
						<td style="text-align: center">'.$fetch['hecho_consumado'].'</td>
						<td style="text-align: center">'.$fetch['elemento_utilizado'].'</td>
						<td style="text-align: center">'.$fetch['tipo_motocicleta'].'</td>
						<td style="text-align: center">'.$fetch['color'].'</td>
						<td style="text-align: center">'.$fetch['adelanto_circulacion'].'</td>
						<td style="text-align: center">'.$fetch['damnificado'].'</td>
						<td style="text-align: center">'.$fetch['edad'].'</td>
						<td style="text-align: center">'.$fetch['sexo'].'</td>
						<td style="text-align: center">'.$fetch['denuncia'].'</td>
						<td style="text-align: center">'.$fetch['denunciante'].'</td>
						<td style="text-align: center">'.$fetch['unidad_judicial'].'</td>
						<td style="text-align: center">'.$fetch['comision_personal'].'</td>
						<td style="text-align: center">'.$fetch['medida_tomada'].'</td>
						<td style="text-align: center">'.$nombreComisaria.'</td>
					</tr>
		';
		}
		$output .="
				</tbody>
				
			</table>
		";
		
		echo $output;
	}
	
?>