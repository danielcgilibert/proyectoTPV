<?php

session_start();
include 'conexion.php';


if (isset($_POST['email']) && isset($_POST['password'])) {

	$user =  $_POST['email'];
	$password = $_POST['password'];

	$bd = mysqli_connect($host, $usuario, $contrasenia, $baseDatos);


	$consultaSiExiste = "SELECT * FROM usuario WHERE email = '$user'";
	$result = mysqli_query($bd, $consultaSiExiste);
	if ($result->num_rows === 1) {
		$row = $result->fetch_array(MYSQLI_ASSOC);

		if (password_verify($password, $row['contrasena'])) {
			//Password matches, so create the session
			if (isset($_SESSION['errorLogin'])) {
				unset($_SESSION['errorLogin']);
			}
			$_SESSION['user'] = array('id' => $row['idUsuario'], 'nombre' => $row['nombre'], 'email' => $row['email'],);
			header("Location: ../admin.php");
		} else {
			header("Location: ../login.php");
			$_SESSION['errorLogin'] = "usuario no verficado";
		}
	}
}
