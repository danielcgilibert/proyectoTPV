<?php


include 'conexion.php';
/**
	 echo 2 contraseña con expresion regular incorrecta
	 echo 3 fallo en el update de la base de datos
	 echo 1 fallo minimo 8 caracteres
 */

//datos
$idUsuario =  $_REQUEST["id"];
$NombreUsuario =  $_REQUEST["NombreUsuario"];
$ApellidosUsuario =  $_REQUEST["ApellidosUsuario"];
$emailUsuario =  $_REQUEST["emailUsuario"];
$perfilUsuario =  $_REQUEST["perfilUsuario"];

if(isset($_REQUEST["contrasenaUsuario"])){
	$contrasenaUsuario =  $_REQUEST["contrasenaUsuario"];

	if (strlen($contrasenaUsuario) > 8) {
		if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/", $contrasenaUsuario) == 1) {
			$hashed_password = password_hash($contrasenaUsuario, PASSWORD_DEFAULT);
	
			$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
			$consulta = "UPDATE usuario SET email='$emailUsuario', nombre='$NombreUsuario', perfil='$perfilUsuario', apellidos='$ApellidosUsuario', contrasena='$hashed_password' WHERE idUsuario='$idUsuario'";
			$resul = mysqli_query($bd, $consulta);
	
			if (!$resul) {
				echo 3;
			} else {
				echo 0;
			}
		} else {
			echo 2;
		}
	} else {
		echo 1;
	}
}else{
	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "UPDATE usuario SET email='$emailUsuario', nombre='$NombreUsuario', perfil='$perfilUsuario', apellidos='$ApellidosUsuario' WHERE idUsuario='$idUsuario'";
	$resul = mysqli_query($bd, $consulta);
	

}


