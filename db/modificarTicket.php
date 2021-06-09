<?php


include 'conexion.php';

/*
    echo 0 = todo correcto
    echo 1 = error en la creacion de ticket
    echo 2 = error en la creacion de linea
    echo 3 = error en la actualizacion de la mesa
    */


//datos
$lineas =  json_decode($_REQUEST["datos"]);
$idTicket =  $_REQUEST["idTicketModificar"];
$idMesa =  $_REQUEST["idMesa"];
$idUsuario =  $_REQUEST["idUsuario"];
$fecha =  $_REQUEST["fecha"];
$empresaId =  $_REQUEST["empresaId"];

//conexión
$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);

foreach ($lineas as $key => $value) {

    $entra = $value->idLinea === null ? true : false;

    if ($entra) {
        $consulta = "INSERT INTO lineaTicket (idTicket,idProducto,unidadesPedidas,precioUnitario) VALUES('$idTicket','$value->id','$value->cantidadPedida','$value->precio')";
        $resul = mysqli_query($bd, $consulta);
        
    } else {
        print_r($lineas);
        if ($value->borrado == 2) {
            $consulta = "DELETE FROM lineaTicket WHERE idLinea=$value->idLinea and idTicket=$idTicket";
            $resul = mysqli_query($bd, $consulta);
            echo $consulta;

        } else {
            $consulta = "UPDATE lineaTicket SET idProducto=$value->id, unidadesPedidas=$value->cantidadPedida, precioUnitario=$value->precio WHERE idLinea=$value->idLinea and idTicket=$idTicket";
            $resul = mysqli_query($bd, $consulta);
            echo $consulta;

        }
    }
}

echo 0;
