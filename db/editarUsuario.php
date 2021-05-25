<?php


	include 'conexion.php';
	
	//datos
	$idUsuario =  $_REQUEST["id"];
	$NombreUsuario =  $_REQUEST["NombreUsuario"];
	$ApellidosUsuario =  $_REQUEST["ApellidosUsuario"];
	$emailUsuario =  $_REQUEST["emailUsuario"];
	$perfilUsuario =  $_REQUEST["perfilUsuario"];

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "UPDATE usuario SET email='$emailUsuario', nombre='$NombreUsuario', perfil='$perfilUsuario', apellidos='$ApellidosUsuario' WHERE idUsuario='$idUsuario'";
    echo $consulta;
	$resul = mysqli_query($bd, $consulta);
	
	//    echo "<pre>";
	//    print_r($_REQUEST);
	//    echo"</pre>";

header("Location: ../admin.php");	