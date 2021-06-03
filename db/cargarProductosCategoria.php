
<?php

include 'conexion.php'; 
    $categoria =  $_REQUEST["id"];

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$ins = "SELECT * from PRODUCTO where idCategoria = $categoria";
	$resul = mysqli_query($bd, $ins);

	if (!$resul) {
		return FALSE;
	}

	$listaProductos = array();

	while ($fila = mysqli_fetch_assoc($resul)) {
		$listaProductos[] = $fila;
	}

	//si hay 1 o más
    echo json_encode($listaProductos);
