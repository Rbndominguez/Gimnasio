<?php
	session_start();
	
	$dieta = $_SESSION["dieta"];
	unset($_SESSION["dieta"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	}

	require_once("../gestionBD.php");
	require_once("gestionDietas.php");
	
	$conexion = crearConexionBD();
	$num_comidas = tieneComidas($conexion, $dieta);
	$comidasL = getComidas($conexion, $dieta, "Lunes");
	$comidasM = getComidas($conexion, $dieta, "Martes");
	$comidasX = getComidas($conexion, $dieta, "Miercoles");
	$comidasJ = getComidas($conexion, $dieta, "Jueves");
	$comidasV = getComidas($conexion, $dieta, "Viernes");
	$comidasS = getComidas($conexion, $dieta, "Sabado");
	$comidasD = getComidas($conexion, $dieta, "Domingo");
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información de la dieta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="../css/muestra.css" rel="stylesheet" type="text/css">
</head>

<body>

	<p><b><?php echo $dieta["nombreDieta"] . ": " . $dieta["descripcion"] . " [" . $dieta["duracion"] . "]";?>
	</b></p>
	
	<?php if ($num_comidas > 0) { ?>
			
			<table class="table table-striped" style="width:100%">
				<caption>LUNES</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasL as $comidaL) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaL["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaL["hora"]; ?></td>
    						<td><?php echo $comidaL["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaL["descripcion"]; ?></td>
   				 			<td><button id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>MARTES</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasM as $comidaM) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaM["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaM["hora"]; ?></td>
    						<td><?php echo $comidaM["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaM["descripcion"]; ?></td>
   				 			<td><button id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
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
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaX["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaX["hora"]; ?></td>
    						<td><?php echo $comidaX["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaX["descripcion"]; ?></td>
   				 			<td><button id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>JUEVES</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasJ as $comidaJ) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaJ["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaJ["hora"]; ?></td>
    						<td><?php echo $comidaJ["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaJ["descripcion"]; ?></td>
   				 			<td><button id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>VIERNES</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasV as $comidaV) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaV["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaV["hora"]; ?></td>
    						<td><?php echo $comidaV["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaV["descripcion"]; ?></td>
   				 			<td><button id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>SÁBADO</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasS as $comidaS) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaS["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaS["hora"]; ?></td>
    						<td><?php echo $comidaS["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaS["descripcion"]; ?></td>
   				 			<td><button id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
				<?php } ?>
			</table>
			
			<table class="table table-striped" style="width:100%">
				<caption>DOMINGO</caption>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasD as $comidaD) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaD["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaD["hora"]; ?></td>
    						<td><?php echo $comidaD["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaD["descripcion"]; ?></td>
   				 			<td><button id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
				<?php } ?>
			</table>
		<?php } ?>
	
	<article class="dieta">
		<form method="post" action="controlador_dietas.php">
			<div class="fila_dieta">
				<div class="datos_dieta">		
					<input type="hidden" id="oid_di" name="oid_di"
						value="<?php echo $dieta["oid_di"]; ?>" />
					<input type="hidden" id="nombreDieta" name="nombreDieta"
						value="<?php echo $dieta["nombreDieta"]; ?>" />
					<input type="hidden" id="descripcion" name="descripcion"
						value="<?php echo $dieta["descripcion"]; ?>" />
					<input type="hidden" id="duracion" name="duracion"
						value="<?php echo $dieta["duracion"]; ?>" />
				
				</div>
				
				<div id="botones_fila">
					<button id="editar" name="editar" type="submit" class="editar_fila">
						<img src="../images/editar_small.png" class="editar_fila" alt="Editar dieta">
					</button>
					<button id="borrar" name="borrar" type="submit" class="editar_fila">
						<img src="../images/remove_small.png" class="editar_fila" alt="Borrar dieta">
					</button>
					
					<button id="añadir" name="añadir" type="submit" class="editar_fila">
						Añadir comida
					</button>
					
					<button onClick="window.close();opener.location.reload();">Cerrar</button>
				</div>
			</div>
		</form>
	</article>
	
	</body>
</html>
