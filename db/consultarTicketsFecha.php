<?php


include 'conexion.php';

//datos
$fechaInicio =  $_REQUEST["fechaInicio"];
$fechaFin =  $_REQUEST["fechaFin"];

$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
$consulta = "SELECT idTicket FROM ticket";

$resul = mysqli_query($bd, $consulta);

if (!$resul) {
	echo 1;
}else{
    $ticketsFechas = array();

    while ($filas = mysqli_fetch_assoc($resul)) {
        $consultaTicket = "SELECT ticket.idTicket,lineaticket.unidadesPedidas,lineaticket.precioUnitario FROM `ticket` INNER JOIN lineaticket ON lineaticket.idTicket=ticket.idTicket WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin' AND ticket.idTicket=".$filas['idTicket'];
        
        $resulTicket = mysqli_query($bd, $consultaTicket);

        while ($filasTicket = mysqli_fetch_assoc($resulTicket)) {

            // echo "<pre>";
            // print_r($filasTicket);
            // echo "</pre>";
            $ticketsFechas[$filas['idTicket']][$filasTicket["unidadesPedidas"]]=$filasTicket["precioUnitario"];
        }

    
    }
    
    echo json_encode($ticketsFechas);
}


