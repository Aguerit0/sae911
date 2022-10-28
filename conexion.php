<?php 
	$servidor='localhost';
	$usuario='root';
	$clave='1234567';
	$bd='BDSae911';

	$conexion=mysqli_connect($servidor,$usuario,$clave,$bd);
	if (!$conexion) {
		echo "ERROR EN LA CONEXIÓN CON EL SERVIDOR";
	}
 ?>