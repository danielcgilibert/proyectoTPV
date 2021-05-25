<?php


	include 'conexion.php';
	
	//datos
	$idProducto =  $_REQUEST["id"];

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "DELETE FROM producto WHERE idProducto='$idProducto'";
	
	$resul = mysqli_query($bd, $consulta);
	
	//  echo "<pre>";
	//  print_r($_REQUEST["descripcion"]);
	//  echo"</pre>";

	return $resul;
	