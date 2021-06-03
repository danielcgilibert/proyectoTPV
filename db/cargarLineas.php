<?php
include 'conexion.php';

$idTicket =  $_REQUEST["id"];

$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
$consulta = "SELECT ticket.idTicket,ticket.idMesa,ticket.fecha,lineaticket.idLinea,lineaticket.unidadesPedidas,empresa.nombre AS nombreEmpresa,empresa.telefono,empresa.CIF,producto.idProducto,producto.descripcion,producto.nombre,producto.precio,usuario.nombre AS nombreUsuario,usuario.apellidos AS apellidosUsuario FROM `ticket` INNER JOIN lineaticket ON ticket.idTicket=lineaticket.idTicket INNER JOIN producto ON lineaticket.idProducto=producto.idProducto INNER JOIN empresa ON ticket.idEmpresa=empresa.idEmpresa INNER JOIN usuario ON ticket.idUsuario=usuario.idUsuario WHERE ticket.idTicket='$idTicket' GROUP BY lineaticket.idLinea";
$resul = mysqli_query($bd, $consulta);

if (!$resul) {
    return FALSE;
}

$filaNuevas = array();

while ($filas = mysqli_fetch_assoc($resul)) {

    $filaNuevas[] = $filas;
}

echo json_encode($filaNuevas);

