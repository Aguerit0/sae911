<?php 
	$servidor='localhost';
	$usuario='root';
	$clave='';
	$bd='sae911';

	$conexion=mysqli_connect($servidor,$usuario,$clave,$bd);
	if (!conexion) {
		echo "ERROR EN LA CONEXIÓN CON EL SERVIDOR";
	}
 ?>