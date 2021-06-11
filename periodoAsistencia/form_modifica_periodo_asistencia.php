<?php
session_start();

	$form_modifica_periodo_asistencia = $_SESSION["periodoAsistencia"];

	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
	
	require_once ("../gestionBD.php");
	require_once ("gestionPeriodosAsistencia.php");
	
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Modificar periodo de asistencia</title>
		<link rel="stylesheet" type="text/css" href="../css/formulario.css">
	</head>

	<body>

		<form id="form_modifica_periodo_asistencia" method="post" action="accion_modificar_periodo_asistencia.php" novalidate>
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos periodo de asistencia</legend>
			
		<div>
		<input id="oid_pasis" name="oid_pasis" type="hidden" value="<?php echo $form_modifica_periodo_asistencia["oid_pasis"]; ?>" required/>
		</div>
		
		<div>
		<input id="dni" name="dni" type="hidden" value="<?php echo $form_modifica_periodo_asistencia["dni"]; ?>" required/>
		</div>
		
		<div>
		<input id="nombre" name="nombre" type="hidden" value="<?php echo $form_modifica_periodo_asistencia["nombre"]; ?>" required/>
		</div>
		
		<div>
		<input id="apellidos" name="apellidos" type="hidden" value="<?php echo $form_modifica_periodo_asistencia["apellidos"]; ?>" required/>
		</div>
		
		<div>
		<label for="fechaInicio">Fecha de Inicio:<em>*</em></label>
		<input id="fechaInicio" name="fechaInicio" type="date" value="<?php echo parseaFechaFormulario($form_modifica_periodo_asistencia["fechaInicio"]); ?>"required>
		</div>
		
		<div>
		<label for="fechaFin">Fecha de Fin:</label>
		<input id="fechaFin" name="fechaFin" type="date" value="<?php echo parseaFechaFormulario($form_modifica_periodo_asistencia["fechaFin"]); ?>"required>
		</div>

		</fieldset>

		<div>
			</br>
			<input id="boton" type="submit" value="Enviar">
			<input id="boton" type="reset" value="Reset">
			<button onClick="window.close();">Cerrar</button>
		</div>
		</form>

	</body>
</html>
