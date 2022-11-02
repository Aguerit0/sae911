<?php 
	if (isset($_POST['txtBuscar'])) {
		include('conexion.php');
		
		function search(){

			$search = $conexion->real_escape_string($_POST['txtBuscar']);
			$consultaSearch = "SELECT * FROM comisarias WHERE nombre LIKE '%$txtBuscar%' ";
			$resultadoSearch = mysqli_query($conexion,$consultaSearch);
			while ($row = $resultadoSearch->fetch_array(MYSQLI_ASSOC)) {
				
			}
		}


	}
 ?>