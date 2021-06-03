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
	$idTicket =  $_REQUEST["idTicket"];
	$idMesa =  $_REQUEST["idMesa"];
	$idUsuario =  $_REQUEST["idUsuario"];
	$fecha =  $_REQUEST["fecha"];
	$empresaId =  $_REQUEST["empresaId"];

    //conexión
	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "INSERT INTO ticket (idMesa,idUsuario,fecha,idEmpresa) VALUES('$idMesa ','$idUsuario','$fecha','$empresaId')";
	$resul = mysqli_query($bd, $consulta);



    if($resul){
        $idGenerado = 0;
        $consultaId = "SELECT @@IDENTITY AS ticket";
        $resultadoConsultaID = mysqli_query($bd, $consultaId);
    
        while ($fila = mysqli_fetch_assoc($resultadoConsultaID)) {
            $idGenerado = $fila["ticket"];
        }
        $stmt = $bd->prepare("INSERT INTO lineaTicket (idTicket,idProducto,unidadesPedidas,precioUnitario) VALUES(?,?,?,?)");

        foreach ($lineas as $key => $value) { 
     
            $stmt->bind_param('iiii', $idGenerado, $value->id, $value->cantidadPedida, $value->precio);
            if(!$stmt->execute()){
                echo 2;
            }
        }

        $consultaMesa = "UPDATE mesa SET estado='1',idTicket='$idGenerado' WHERE idMesa='$idMesa'";
        $resulMesa = mysqli_query($bd, $consultaMesa);    

        if(!$resulMesa){
            echo 3;
        }

        $stmt->close();
        echo 0;

    }else{
        echo 1;
    }

	