<?php
function Conectarse()
{
	//para la conexion se uso el metodo procedimental (otro metodo usado tambien es el orientado a objetos)
	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "certificados";
	// crear la conexion
	$link = mysqli_connect($servername, $username, $password, $dbname);

	// verificar la connexion
	if (!$link) {
	    die("Conneccion fallida: " . mysqli_connect_error());
	}

	return $link;

}
?>

