<?php


include 'conexion.php';

//datos
$nombreProducto =  $_REQUEST["nombre"];
$idProducto =  $_REQUEST["id"];
$descripcionProducto =  $_REQUEST["descripcion"];
$precioProducto =  $_REQUEST["precio"];

$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);

if (!empty($_FILES['image'])) {
	$imagen = $_FILES['image']['tmp_name'];
	$imagen = base64_encode(file_get_contents(addslashes($imagen)));
	$consulta = "UPDATE producto SET nombre='$nombreProducto', descripcion='$descripcionProducto',precio='$precioProducto',imagen='$imagen' WHERE idProducto='$idProducto'";
} else {
	$consulta = "UPDATE producto SET nombre='$nombreProducto', descripcion='$descripcionProducto',precio='$precioProducto' WHERE idProducto='$idProducto'";
}

$resul = mysqli_query($bd, $consulta);


return $resul;
