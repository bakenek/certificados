<?php

$nombre = "";
  include_once('../php/conexion.php'); // llamar a la pagina
  $link = Conectarse(); //conexion mysql
  error_reporting(0);


    $cedula = ($_REQUEST['valor']);
	$sql = "SELECT * FROM certificados WHERE cedula = '".$cedula ."'"; 
	$result = mysqli_query($link, $sql);
	if (mysqli_num_rows($result) <= 0) {
		// aqui debo volver a la pagina principal indicando que no hay registros
		$lcmsg = "No hay solicitudes pendientes";
		echo "<script>alert('".$lcmsg."')</script>";
		exit(); // FINALIZO EL SCRIPT 
	}
    if($registro = mysqli_fetch_array($result)) // esta funcion crea un arreglo asociativo a partir del resultado de la busqueda
  {
    $nombre = $registro['nombre'];
    $apellido = $registro['apellido'];
    $cedulamuestra = $registro['cedulamuestra'];
  }	

  require('pdf/fpdf.php');

  $fpdf = new FPDF();

  $fpdf->AddFont('impact','','impact.php');

  $fpdf->SetTextColor(220, 15, 12);

  $fpdf->AddPage("L,A5");
  $fpdf->SetFont('impact','',40); 
  //$fpdf->SetFont('times','BI',30);
  $fpdf->Image('cert.jpg', 0, 0,293,206);
  $fpdf->SetXY(47, 103);
  $fpdf->cell(100,10, utf8_decode($nombre)." ".utf8_decode($apellido), 0, 0,'C');

  $fpdf->SetTextColor(0, 0, 0);
  $fpdf->SetFont('impact','',20); 

  $fpdf->SetXY(75, 120);
  $fpdf->Write(0,'C.I: ' .$cedulamuestra);



$fpdf->Output('I','Certificado_pequiven_'.$cedula.'.pdf');


/*
$imagick = new Imagick();
$imagick->readImage('certificadostemp/Certificado_pequiven_'.$cedula.'.pdf');
$imagick->writeImage('Certificado_pequiven_'.$cedula.'.jpg', false);*/

?>

<html>

<head>
  <title>Examenes en linea</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body bgcolor="#649E9F">
	<p> Su solicitud ha sido enviada.</p><br />
	<p><? echo nl2br ($contenidomail); ?> </p>
</body>

</html>