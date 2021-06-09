<?php


include 'conexion.php';

//datos
$idTicket =  $_REQUEST["id"];


$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
$consulta = "SELECT ticket.idTicket,ticket.idMesa,ticket.fecha,empresa.nombre AS nombreEmpresa,empresa.telefono,empresa.CIF,usuario.nombre AS nombreUsuario,usuario.apellidos AS apellidosUsuario FROM ticket INNER JOIN empresa ON ticket.idEmpresa=empresa.idEmpresa INNER JOIN usuario ON ticket.idUsuario=usuario.idUsuario WHERE idTicket='$idTicket'";
$resul = mysqli_query($bd, $consulta);
if (!$resul) {
	return FALSE;
}

$filaNuevas = array();

while ($filas = mysqli_fetch_assoc($resul)) {
	
	$filaNuevas[]=$filas;

}

echo json_encode($filaNuevas);
