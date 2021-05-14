<?php


	include 'conexion.php';
	
	//datos
	$nombreProducto =  $_REQUEST["nombre"];
	$idProducto =  $_REQUEST["id"];
	$descripcionProducto =  $_REQUEST["descripcion"];
	$precioProducto =  $_REQUEST["precio"];

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "UPDATE producto SET nombre='$nombreProducto', descripcion='$descripcionProducto',precio='$precioProducto' WHERE idProducto='$idProducto'";
	
	$resul = mysqli_query($bd, $consulta);
	
	//  echo "<pre>";
	//  print_r($_REQUEST["descripcion"]);
	//  echo"</pre>";

	return $resul;
	