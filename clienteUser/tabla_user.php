<?php
	session_start();
	
	if ($_SESSION['login'] == "admin" || !isset($_SESSION['login'])) {
		header("Location: ../index.php");
	}
	
	$dni = $_SESSION['login'];
	
	require_once("../gestionBD.php");
	require_once("gestionarClientesUser.php");
	
	$conexion = crearConexionBD();
	$oid_te = getOID($conexion, $dni);
	$recuperacion = getRecuperacion($conexion, $oid_te);
	$nombre = getNombre($conexion, $oid_te);
	$descripcion = getDescripcion($conexion, $oid_te);
	$duracion = getDuracion($conexion, $oid_te);
	$num_ejercicios = tieneEjercicios($conexion, $oid_te);
	$ejercicios = getEjercicios($conexion, $oid_te);
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
	if($oid_te == NULL) { ?>
		<script>window.close();</script>
	<?php }
	 
	if ($recuperacion == 0) { 
			$esRecuperacion = "normal";
		} else {
			$esRecuperacion = "recuperacion";
		} ?>
	<p><b><?php echo $nombre . ": " . $descripcion . " [" . $duracion . " - " . $esRecuperacion . "]";?>
	
	<?php if ($num_ejercicios > 0) { ?>
			
			<table class="table table-striped" style="width:100%">
 				<tr>
    				<th>Orden</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th>Reps/Duración</th>
    				<th>Series</th>
    			
  				</tr>
  				
  			<?php foreach($ejercicios as $ejercicio) { ?>
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
 			 		</tr>
				<?php } ?>
			</table>
		<?php } ?>
	
					
		<button onClick="window.close();">Cerrar</button>
	
	</body>
</html>
