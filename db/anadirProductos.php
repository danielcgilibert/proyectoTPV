<?php


include 'conexion.php';

//datos
$nombreProducto =  $_REQUEST["nombre"];
$descripcionProducto =  $_REQUEST["descripcion"];
$precioProducto =  $_REQUEST["precio"];
$categoriaProducto =  $_REQUEST["categoria"];
$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);

if (!empty($_FILES['image'])) {
	$imagen = $_FILES['image']['tmp_name'];
	$imagen = base64_encode(file_get_contents(addslashes($imagen)));
	$consulta = "INSERT INTO producto (descripcion,idCategoria,nombre,precio,imagen) VALUES('$descripcionProducto','$categoriaProducto','$nombreProducto','$precioProducto','$imagen')";
} else {
	$consulta = "INSERT INTO producto (descripcion,idCategoria,nombre,precio) VALUES('$descripcionProducto','$categoriaProducto','$nombreProducto','$precioProducto')";
}

$resul = mysqli_query($bd, $consulta);

return $resul;
