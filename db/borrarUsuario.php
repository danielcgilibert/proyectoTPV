<?php


	include 'conexion.php';
	
	//datos
	$idUsuario =  $_REQUEST["id"];

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "DELETE FROM usuario WHERE idUsuario='$idUsuario'";
	
	$resul = mysqli_query($bd, $consulta);
	
	//  echo "<pre>";
	//  print_r($_REQUEST["descripcion"]);
	//  echo"</pre>";

	return $resul;
	