<?php


include 'conexion.php';

//datos
$nombre =  $_REQUEST["nombre"];
$apellidos =  $_REQUEST["apellidos"];
$email =  $_REQUEST["email"];
$password =  $_REQUEST["password1"];
$tipo =  $_REQUEST["tipo"];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//   echo "<pre>";
//   print_r($_POST);
//   echo"</pre>";
$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);

$consultaSiExiste = "SELECT * FROM usuario WHERE email = '$email'";
$resulSiExiste = mysqli_query($bd, $consultaSiExiste);
if (mysqli_num_rows($resulSiExiste) == 0) {
	$consulta = "INSERT INTO usuario (email,nombre,contrasena,perfil,apellidos) VALUES('$email','$nombre','$hashed_password','$tipo','$apellidos')";
	$resul = mysqli_query($bd, $consulta);
	
	echo 0;
} else {

	echo 1;
}
