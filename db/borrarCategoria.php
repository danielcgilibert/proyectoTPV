<?php


	include 'conexion.php';
	
	//datos
	$idCategoria =  $_REQUEST["id"];

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "DELETE FROM categoria WHERE idCategoria='$idCategoria'";
	
	$resul = mysqli_query($bd, $consulta);
	
	//  echo "<pre>";
	//  print_r($_REQUEST["descripcion"]);
	//  echo"</pre>";

	return $resul;
	