<?php


include 'conexion.php';

//datos
$idMesa =  $_REQUEST["idMesa"];

$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
$consulta = "UPDATE mesa SET estado=0, idTicket=null WHERE idMesa='$idMesa'";
$resul = mysqli_query($bd, $consulta);

if (!$resul) {
    echo 1;
} else {


    echo 0;
}
