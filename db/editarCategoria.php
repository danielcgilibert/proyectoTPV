<?php


	include 'conexion.php';
	
	//datos
	$nombreCategoria =  $_REQUEST["nombre"];
	$idCategoria =  $_REQUEST["id"];
	$imagen = $_FILES['image']['tmp_name'];
	$imagen = base64_encode(file_get_contents(addslashes($imagen)));

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "UPDATE categoria SET nombre='$nombreCategoria', imagen='$imagen' WHERE idCategoria='$idCategoria'";
	$resul = mysqli_query($bd, $consulta);


	return $resul;
	