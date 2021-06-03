<?php


include 'conexion.php';



//datos
$idEmpresa =  $_REQUEST["id"];
$nombreEmpresa =  $_REQUEST["nombreEmpresa"];
$telefonoEmpresa =  $_REQUEST["telefonoEmpresa"];
$cifEmpresa =  $_REQUEST["cifEmpresa"];


$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
$consulta = "UPDATE empresa SET nombre='$nombreEmpresa', telefono='$telefonoEmpresa', cif='$cifEmpresa' WHERE idEmpresa='$idEmpresa'";
$resul = mysqli_query($bd, $consulta);


return $resul;
