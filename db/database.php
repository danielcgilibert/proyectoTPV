<?php


    function cargar_categorias(){
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "SELECT * FROM categoria";
	$resul = mysqli_query($bd, $consulta);
    
 

	if (!$resul) {
		return FALSE;
	}
	if (mysqli_num_rows($resul) == 0) {
		return FALSE;
	}

    $listaCategorias = array();

	while ($fila = mysqli_fetch_assoc($resul)) {
		$listaCategorias[] = $fila;
	}
    
	//si hay 1 o más
	return $listaCategorias;
}

function cargar_productos($categoria)
{
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$ins = "SELECT * from PRODUCTO where idCategoria = $categoria";
	$resul = mysqli_query($bd, $ins);

	if (!$resul) {
		return FALSE;
	}

	$listaProductos = array();

	while ($fila = mysqli_fetch_assoc($resul)) {
		$listaProductos[] = $fila;
	}
    
	//si hay 1 o más
	return $listaProductos;
}

function cargar_mesas()
{
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$ins = "SELECT * from mesa";
	$resul = mysqli_query($bd, $ins);

	if (!$resul) {
		return FALSE;
	}

	$listaMesas = array();

	while ($fila = mysqli_fetch_assoc($resul)) {
		$listaMesas[] = $fila;
	}
    
	//si hay 1 o más
	return $listaMesas;
}


function cargar_usuarios()
{
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$ins = "SELECT * from usuario";
	$resul = mysqli_query($bd, $ins);

	if (!$resul) {
		return FALSE;
	}

	$listaUsuarios = array();

	while ($usuario = mysqli_fetch_assoc($resul)) {
		$listaUsuarios[] = $usuario;
	}
    
	//si hay 1 o más
	return $listaUsuarios;
}


function cargar_empresa()
{
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$ins = "SELECT * from empresa";
	$resul = mysqli_query($bd, $ins);

	if (!$resul) {
		return FALSE;
	}

	$empresa = array();

	while ($fila = mysqli_fetch_assoc($resul)) {
		$empresa[] = $fila;
	}
    
	//si hay 1 o más
	return $empresa;
}

function ultimo_ticket()
{
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$ins = "SELECT MAX(idTicket) from ticket";
	$resul = mysqli_query($bd, $ins);

	if (!$resul) {
		return FALSE;
	}

	if ($fila = mysqli_fetch_row($resul)) {
		$id = trim($fila[0]);
		}
		

    
	//si hay 1 o más
	return $id;
}

function cargar_ticket($idTicket)
{
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$ins = "SELECT * from ticket WHERE idTicket=$idTicket";
	$resul = mysqli_query($bd, $ins);

	if (!$resul) {
		return FALSE;
	}

	$ticket = array();

	while ($fila = mysqli_fetch_assoc($resul)) {
		$ticket[] = $fila;
	}
    
	//si hay 1 o más
	return $ticket;
}

function cargar_lineas_Ticket($idTicket)
{
	include 'conexion.php'; 

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);
	$consulta = "SELECT ticket.idTicket,ticket.idMesa,ticket.fecha,lineaticket.idLinea,lineaticket.unidadesPedidas,empresa.nombre AS nombreEmpresa,empresa.telefono,empresa.CIF,producto.idProducto,producto.descripcion,producto.nombre,producto.precio,usuario.nombre AS nombreUsuario,usuario.apellidos AS apellidosUsuario FROM `ticket` INNER JOIN lineaticket ON ticket.idTicket=lineaticket.idTicket INNER JOIN producto ON lineaticket.idProducto=producto.idProducto INNER JOIN empresa ON ticket.idEmpresa=empresa.idEmpresa INNER JOIN usuario ON ticket.idUsuario=usuario.idUsuario WHERE ticket.idTicket='$idTicket' GROUP BY lineaticket.idLinea";
	$resul = mysqli_query($bd, $consulta);

if (!$resul) {
	return FALSE;
}

$filaNuevas = array();

while ($filas = mysqli_fetch_assoc($resul)) {
	
	$filaNuevas[]=$filas;

}

return $filaNuevas;

}
