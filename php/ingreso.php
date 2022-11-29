<?php 
	include_once('../php/conexion.php'); // llamar a la pagina
	$link = Conectarse(); //conexion mysql
	//error_reporting(0);

	// recabando los valores del formulario con codigo de seguridad php
	$llok = true;
	$lcmsg = '';
	$llEstatus = 1;
	$cedula = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$cedula  = test_input($_REQUEST['usuario']);
	}else{
		header('Location: ../index.html'); 
	}
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	// validar el usuario
	$sql = "SELECT * FROM certificados WHERE cedula = '".$cedula ."'"; 
	$result = mysqli_query($link, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($reg = mysqli_fetch_assoc($result)){
			// Recabar las variables (la variables $cedula  ya la tengo del forulario, no necesito volver a llamarla desde sql)
			$id   = $reg['idCertificado'];
			$nombre = trim($reg['nombre']);

		}
	} else {
		$llok = false;
		header('Location: ../error.html'); 
	}

	// limpiando la conexion
	mysqli_free_result($result);
	mysqli_close($link);

	// crear la session (debe ir antes de cualquier codigo html)
	if($llok == true){
		header('Location: ../php/enviarexamencorreo.php?valor='.$cedula.''); 
	}else{
		echo $lcmsg;
		echo'<meta http-equiv="refresh" content="02;URL=../index.html" >';
		echo "<script>alert('".$lcmsg."')</script>";
	}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ingreso</title>        
    <!-- metacomandos  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilossistema.css">                    
    <script src="../js/jquery.min.js"></script>
  </head>
  <body>
  </body>
 </html>

 
 
 
 