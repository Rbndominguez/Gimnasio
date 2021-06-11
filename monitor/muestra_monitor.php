<?php
	session_start();
	
	$monitor = $_SESSION["monitor"];
	unset($_SESSION["monitor"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	} 

	require_once("../gestionBD.php");
	require_once("gestionMonitores.php");
	
	$conexion = crearConexionBD();
	$num_clases = tieneClases($conexion, $monitor);
	$clases = getClases($conexion, $monitor);
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información del monitor</title>
  <link href="../css/muestra.css" rel="stylesheet" type="text/css">
</head>

<body>

	<p><b>DNI del monitor: </b><?php echo $monitor["dniMonitor"];?></p>
	<p><b>Nombre: </b><?php echo $monitor["nombre"];?></p>
	<p><b>Apellidos: </b><?php echo $monitor["apellidos"];?></p>
	<p><b>Telefono: </b><?php echo $monitor["telefono"];?></p>
	<p><b>¿Está activo?: </b><?php if($monitor["estaActivo"] == 0){
			echo "No";
		} else if($monitor["estaActivo"] == 1){
			echo "Sí";
		} ?></p>
	<p><b>Fecha de contratación: </b><?php echo $monitor["fechaContratacion"];?></p>
	<?php if($monitor["fechaFin"] != NULL) { ?>
		<p><b>Fecha de finalización de contrato: </b><?php echo $monitor["fechaFin"];?></p>
	<?php } 
		if ($num_clases > 0) { ?>
			<p><b>Imparte: </b>
			<?php foreach($clases as $clase) {
				if($clase["sala"] == "SalaDeMusculacion") {
					$sala = "Sala de musculación";
				} else if($clase["sala"] == "SalaDeSpinning") {
					$sala = "Sala de spinning";
				} else if($clase["sala"] == "SalaMultiusos") {
					$sala = "Sala multiusos";
				}
				echo "<p>" . $clase["nombreclase"] . " - " . $clase["horario"] . " - " . $sala . "</p>";?>
			<?php } 
		 } ?>
	
	<article class="monitor">
		<form method="post" action="controlador_monitores.php">
			<div class="fila_monitor">
				<div class="datos_monitor">		
					<input type="hidden" id="dniMonitor" name="dniMonitor"
						value="<?php echo $monitor["dniMonitor"]; ?>" />
					<input type="hidden" id="nombre" name="nombre"
						value="<?php echo $monitor["nombre"]; ?>" />
					<input type="hidden" id="apellidos" name="apellidos"
						value="<?php echo $monitor["apellidos"]; ?>" />
					<input type="hidden" id="telefono" name="telefono"
						value="<?php echo $monitor["telefono"]; ?>" />
					<input type="hidden" id="estaActivo" name="estaActivo"
						value="<?php echo $monitor["estaActivo"]; ?>" />
					<input type="hidden" id="fechaContratacion" name="fechaContratacion"
						value="<?php echo $monitor["fechaContratacion"]; ?>" />
					<input type="hidden" id="fechaFin" name="fechaFin"
						value="<?php echo $monitor["fechaFin"]; ?>" />
				
				</div>
				
				<div id="botones_fila">
					<!-- Botón de editar -->
					<button id="editar" name="editar" type="submit" class="editar_fila">
						<img src="../images/editar_small.png" class="editar_fila" alt="Editar monitor">
					</button>
					<!-- Botón de borrar -->
					<button id="borrar" name="borrar" type="submit" class="editar_fila">
						<img src="../images/remove_small.png" class="editar_fila" alt="Borrar monitor">
					</button>
					
					<?php if ($monitor["estaActivo"] == 1) { ?>
						<button id="darBaja" name="darBaja" type="submit" class="editar_fila">
							Dar Baja
						</button>
					<?php } else { ?>
						<button id="darAlta" name="darAlta" type="submit" class="editar_fila">
							Dar Alta
						</button>
					<?php } ?>
					
					<button onClick="window.close();opener.location.reload();">Cerrar</button>
				</div>
			</div>
		</form>
	</article>
	
	</body>
</html>