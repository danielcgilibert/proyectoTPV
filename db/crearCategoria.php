<?php


	include 'conexion.php';
	
	//datos
	$nombreCategoria =  $_REQUEST["nombre"];
	$imagen = $_FILES['image']['tmp_name'];
	//echo $imagen;
	$imagen = base64_encode(file_get_contents(addslashes($imagen)));

	
	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "INSERT INTO categoria (nombre,imagen) VALUES('$nombreCategoria','$imagen' )";
	$resul = mysqli_query($bd, $consulta);
	echo $consulta;


	return $resul;
	