<?php
	session_start();
	
	$tablaEjercicio = $_SESSION["tablaEjercicio"];
	unset($_SESSION["tablaEjercicio"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	}
	
	require_once("../gestionBD.php");
	require_once("gestionTablaEjercicio.php");
	
	$conexion = crearConexionBD();
	$num_ejercicios = tieneEjercicios($conexion, $tablaEjercicio);
	$ejercicios = getEjercicios($conexion, $tablaEjercicio);
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
  <link href="../css/muestra.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php if ($tablaEjercicio["recuperacion"] == 0) { 
			$esRecuperacion = "normal";
		} else {
			$esRecuperacion = "recuperacion";
		} ?>
	<p><b><?php echo $tablaEjercicio["nombreTablaE"] . ": " . $tablaEjercicio["descripcion"] . " [" . $tablaEjercicio["duracion"] . " - " . $esRecuperacion . "]";?>
	
	<?php if ($num_ejercicios > 0) { ?>
			
			<table class="table table-striped" style="width:100%">
 				<tr>
    				<th>Orden</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th>Reps/Duración</th>
    				<th>Series</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($ejercicios as $ejercicio) { ?>
  					<form method="post" action="controlador_tablas_ejercicios.php">
						<input type="hidden" id="oid_e" name="oid_e"
							value="<?php echo $ejercicio["oid_e"]; ?>" />
								
						<input type="hidden" id="oid_te" name="oid_te"
							value="<?php echo $tablaEjercicio["oid_te"]; ?>" />
						<input type="hidden" id="nombreTablaE" name="nombreTablaE"
							value="<?php echo $tablaEjercicio["nombreTablaE"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $tablaEjercicio["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $tablaEjercicio["duracion"]; ?>" />
						<input type="hidden" id="recuperacion" name ="recuperacion"
							value="<?php echo $tablaEjercicio["recuperacion"];?>"/>
						<tr>
   			 				<td><?php echo $ejercicio["numeroorden"] . "º"; ?></td>
    						<td><?php echo $ejercicio["nombreejercicio"]; ?></td> 
   				 			<td><?php echo $ejercicio["descripcion"]; ?></td>
   				 			<td><?php if($ejercicio["repeticiones"] != NULL) {
   				 					echo $ejercicio["repeticiones"] . " reps";
								} else if($ejercicio["duracion"] != NULL) {
									echo $ejercicio["duracion"] . " min";
								} 
   				 				?></td>
   				 			<td><?php echo $ejercicio["series"]; ?></td>
   				 			<td><button id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
				<?php } ?>
			</table>
		<?php } ?>
	
	<article class="tablaEjercicio">
		<form method="post" action="controlador_tablas_ejercicios.php">
			<div class="fila_tablaEjercicio">
				<div class="datos_tablaEjercicio">		
					<input type="hidden" id="oid_te" name="oid_te"
						value="<?php echo $tablaEjercicio["oid_te"]; ?>" />
					<input type="hidden" id="nombreTablaE" name="nombreTablaE"
						value="<?php echo $tablaEjercicio["nombreTablaE"]; ?>" />
					<input type="hidden" id="descripcion" name="descripcion"
						value="<?php echo $tablaEjercicio["descripcion"]; ?>" />
					<input type="hidden" id="duracion" name="duracion"
						value="<?php echo $tablaEjercicio["duracion"]; ?>" />
					<input type="hidden" id="recuperacion" name ="recuperacion"
						value="<?php echo $tablaEjercicio["recuperacion"];?>"/>
				
				</div>
				
				<div id="botones_fila">
					<button id="editar" name="editar" type="submit" class="editar_fila">
						<img src="../images/editar_small.png" class="editar_fila" alt="Editar tablaEjercicio">
					</button>
					
					<button id="borrar" name="borrar" type="submit" class="editar_fila">
						<img src="../images/remove_small.png" class="editar_fila" alt="Borrar tablaEjercicio">
					</button>
					
					<button id="añadir" name="añadir" type="submit" class="editar_fila">
						Añadir ejercicio
					</button>
					
					<button onClick="window.close();opener.location.reload();">Cerrar</button>
				</div>
			</div>
		</form>
	</article>
	
	</body>
</html>
