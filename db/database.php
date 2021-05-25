<?php


    function cargar_categorias(){
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "SELECT * FROM categoria";
	$resul = mysqli_query($bd, $consulta);
    
 

	if (!$resul) {
		return FALSE;
	}
	if (mysqli_num_rows($resul) == 0) {
		return FALSE;
	}

    $listaCategorias = array();

	while ($fila = mysqli_fetch_assoc($resul)) {
		$listaCategorias[] = $fila;
	}
    
	//si hay 1 o más
	return $listaCategorias;
}

function cargar_productos($categoria)
{
	include 'conexion.php'; 

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
	return $listaProductos;
}

function cargar_mesas()
{
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$ins = "SELECT * from mesa";
	$resul = mysqli_query($bd, $ins);

	if (!$resul) {
		return FALSE;
	}

	$listaMesas = array();

	while ($fila = mysqli_fetch_assoc($resul)) {
		$listaMesas[] = $fila;
	}
    
	//si hay 1 o más
	return $listaMesas;
}


function cargar_usuarios()
{
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$ins = "SELECT * from usuario";
	$resul = mysqli_query($bd, $ins);

	if (!$resul) {
		return FALSE;
	}

	$listaUsuarios = array();

	while ($usuario = mysqli_fetch_assoc($resul)) {
		$listaUsuarios[] = $usuario;
	}
    
	//si hay 1 o más
	return $listaUsuarios;
}





?>
