<?php
	session_start();
	
	if ($_SESSION['login'] == "admin" || !isset($_SESSION['login'])) {
		header("Location: ../index.php");
	}
	
	$dni = $_SESSION['login'];
	
	require_once("../gestionBD.php");
	require_once("gestionarClientesUser.php");
	
	$conexion = crearConexionBD();
	$oid_di = getOID_D($conexion, $dni);
	$nombre = getNombreD($conexion, $oid_di);
	$descripcion = getDescripcionD($conexion, $oid_di);
	$duracion = getDuracionD($conexion, $oid_di);
	$num_comidas = tieneComidas($conexion, $oid_di);
	$comidasL = getComidas($conexion, $oid_di, "Lunes");
	$comidasM = getComidas($conexion, $oid_di, "Martes");
	$comidasX = getComidas($conexion, $oid_di, "Miercoles");
	$comidasJ = getComidas($conexion, $oid_di, "Jueves");
	$comidasV = getComidas($conexion, $oid_di, "Viernes");
	$comidasS = getComidas($conexion, $oid_di, "Sabado");
	$comidasD = getComidas($conexion, $oid_di, "Domingo");
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información de la tabla de ejercicios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<?php
	if($oid_di == NULL) { ?>
		<script>window.close();</script>
	<?php } ?>
	 
	<p><b><?php echo $nombre . ": " . $descripcion . " [" . $duracion . "]";?>
	</b></p>
	
	<?php if ($num_comidas > 0) { ?>
			
			<table class="table table-striped" style="width:100%">
				<caption>LUNES</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasL as $comidaL) { ?>
						<tr>
   			 				<td><?php echo $comidaL["hora"]; ?></td>
    						<td><?php echo $comidaL["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaL["descripcion"]; ?></td>
 			 			</tr>
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>MARTES</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasM as $comidaM) { ?>
						<tr>
   			 				<td><?php echo $comidaM["hora"]; ?></td>
    						<td><?php echo $comidaM["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaM["descripcion"]; ?></td>
 			 			</tr>			
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>MIÉRCOLES</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasX as $comidaX) { ?>
						<tr>
   			 				<td><?php echo $comidaX["hora"]; ?></td>
    						<td><?php echo $comidaX["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaX["descripcion"]; ?></td>
 			 			</tr>
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>JUEVES</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasJ as $comidaJ) { ?>
						<tr>
   			 				<td><?php echo $comidaJ["hora"]; ?></td>
    						<td><?php echo $comidaJ["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaJ["descripcion"]; ?></td>
 			 			</tr>			
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>VIERNES</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasV as $comidaV) { ?>
						<tr>
   			 				<td><?php echo $comidaV["hora"]; ?></td>
    						<td><?php echo $comidaV["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaV["descripcion"]; ?></td>
 			 			</tr>	
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>SÁBADO</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasS as $comidaS) { ?>
						<tr>
   			 				<td><?php echo $comidaS["hora"]; ?></td>
    						<td><?php echo $comidaS["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaS["descripcion"]; ?></td>
 			 			</tr>
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>DOMINGO</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasD as $comidaD) { ?>
						<tr>
   			 				<td><?php echo $comidaD["hora"]; ?></td>
    						<td><?php echo $comidaD["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaD["descripcion"]; ?></td>
 			 			</tr>
				<?php } ?>
			</table>
		<?php } ?>
	
	</body>
</html>
