<?php 
	$servidor='localhost';
	$usuario='root';
	$clave='41624421';
	$bd='bdsae911';

	$conexion=mysqli_connect($servidor,$usuario,$clave,$bd);
	if (!$conexion) {
		echo "ERROR EN LA CONEXIÓN CON EL SERVIDOR";
	}
 ?>