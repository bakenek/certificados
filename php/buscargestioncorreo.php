<?php 
  include_once('../php/conexion.php'); // llamar a la pagina
  $link = Conectarse(); //conexion mysql
  //error_reporting(0);
  session_start();
  if(!isset($_SESSION['gcIdUser'])) {
    header('Location: ../index.html');   
  }
  
  $sql = "SELECT clientes.*, examenes.* FROM clientes JOIN examenes ON clientes.idcliente = examenes.idcliente WHERE examenes.estatus = 'PR'";	
  $result = mysqli_query($link, $sql);
  if (mysqli_num_rows($result) <= 0) {
    // aqui debo volver a la pagina principal indicando que no hay registros
    $lcmsg = "No hay solicitudes pendientes";
	echo "<script>alert('".$lcmsg."')</script>";
	exit(); // FINALIZO EL SCRIPT 
  }
  
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>        
    <!-- metacomandos  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilossistema.css">              
    <script src="../js/jquery.min.js"></script>
    
	<script>
		var x;
		x=$(document);
		x.ready(inicializarEventos);
		
		function inicializarEventos()
		{
		  
		}		
	
      </script>


    
  </head>
  <body>
    <div>
      <form action="#" method="post" target="_self"> 
        <fieldset>
          <legend>Preselección de clientes / Seleccione el cliente que desea gestionar</legend>
          <table align="center">
            <caption>DATOS COINCIDENTES</caption>
            <thead id="encabezado_tabla"><tr><th>ID</th><th>Fecha</th><th>Cliente</th><th>Cédula</th><th>Telefono</th></tr></thead>
            <tbody>
              <?php
                while ($reg = mysqli_fetch_assoc($result)){
                  echo "<tr><td><div id='similboton'><a href='enviarexamencorreo.php?valor=".$reg['idexamen']."'>Enviar</a></div></td><td>".$reg['fecha']."</td><td>".$reg['cnombre']."</td><td>".$reg['crif']."</td><td>".$reg['cmovil']."</td></tr>" ;
                }
              ?>
            </tbody>
            <tfoot></tfoot>
          </table>  
        </fieldset>
      </form>
    </div>
  </body>
 </html>
