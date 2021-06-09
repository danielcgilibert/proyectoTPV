<?php


	include 'conexion.php';
	
	//datos
	$idLinea =  $_REQUEST["idLinea"];


	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "UPDATE lineaTicket SET Entregado='1' WHERE idLinea='$idLinea'";
    $resul = mysqli_query($bd, $consulta);
	
    echo $resul;