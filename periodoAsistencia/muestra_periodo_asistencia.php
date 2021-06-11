<?php
	session_start();
	
	$periodoAsistencia = $_SESSION["periodoAsistencia"];
	unset($_SESSION["periodoAsistencia"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	}
	
	require_once("../gestionBD.php");
	require_once("gestionPeriodosAsistencia.php");
	
	$conexion = crearConexionBD();
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información de los periodos de asistencia</title>
  <link rel="stylesheet" type="text/css" href="../css/muestra.css">
</head>

<body>

	<p><b>Fecha de Inicio: </b><?php echo $periodoAsistencia["fechaInicio"];?></p>
	<?php if($periodoAsistencia["fechaFin"] != NULL) { ?>
		<p><b>Fecha Fin: </b><?php echo $periodoAsistencia["fechaFin"];?></p>
		<p><b>Número de Días: </b><?php echo $periodoAsistencia["numeroDias"];?></p>
	<?php } ?>
	<p><b>Cliente: </b><?php echo $periodoAsistencia["apellidos"] . ", " . $periodoAsistencia["nombre"];?></p>

	
	<article class="periodoAsistencia">
		<form method="post" action="controlador_periodos_asistencia.php">
			<div class="fila_periodoAsistencia">
				<div class="datos_periodoAsistencia">		
					<input type="hidden" id="oid_pasis" name="oid_pasis"
						value="<?php echo $periodoAsistencia["oid_pasis"]; ?>" />
					<input type="hidden" id="fechaInicio" name="fechaInicio"
						value="<?php echo $periodoAsistencia["fechaInicio"]; ?>" />
					<input type="hidden" id="fechaFin" name="fechaFin"
						value="<?php echo $periodoAsistencia["fechaFin"]; ?>" />
					<input type="hidden" id="numeroDias" name="numeroDias"
						value="<?php echo $periodoAsistencia["numeroDias"]; ?>" />
					<input type="hidden" id="dni" name="dni"
						value="<?php echo $periodoAsistencia["dni"]; ?>" />
					<input type="hidden" id="nombre" name="nombre"
						value="<?php echo $periodoAsistencia["nombre"]; ?>" />
					<input type="hidden" id="apellidos" name="apellidos"
						value="<?php echo $periodoAsistencia["apellidos"]; ?>" />
				
				</div>
				
				<div id="botones_fila">
					<!-- Botón de editar -->
					<button id="editar" name="editar" type="submit" class="editar_fila">
						<img src="../images/editar_small.png" class="editar_fila" alt="Editar periodo de asistencia">
					</button>
					
					<button id="borrar" name="borrar" type="submit" class="editar_fila">
						<img src="../images/remove_small.png" class="editar_fila" alt="Borrar periodo de asistencia">
					</button>
					<button onClick="window.close();opener.location.reload();">Cerrar</button>
				</div>
			</div>
		</form>
	</article>
	
	</body>
</html>
