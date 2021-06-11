<?php
	session_start();
	
	require_once ("../gestionBD.php");
	require_once ("gestionMonitores.php");
	
	$form_modifica_monitor = $_SESSION["monitor"];
	
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Modificar monitor</title>
		<link rel="stylesheet" type="text/css" href="../css/formulario.css">
	</head>

	<body>

		<?php
		// Mostrar los errores de validación (Si los hay)
		if (isset($errores) && count($errores) > 0) {
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach ($errores as $error)
				echo $error;
			echo "</div>";
		}
		?>

		<form id="form_modifica_monitor" method="post" action="accion_modificar_monitor.php" novalidate>
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos personales</legend>
			
		<div>
		<label for="dniMonitor">DNI:<em>*</em></label>
		<input id="dniMonitor" name="dniMonitor" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]{1}$" title="8 digitos seguidos de una letra mayúscula" size="50" value="<?php echo $form_modifica_monitor["dniMonitor"]; ?>"required>
		</div>

		<div>
		<label for="nombre">Nombre:<em>*</em></label>
		<input id="nombre" name="nombre" type="text" size="50" value="<?php echo $form_modifica_monitor["nombre"]; ?>"required>
		</div>

		<div>
		<label for="apellidos">Apellidos:<em>*</em></label>
		<input  id="apellidos" name="apellidos" type="text" size="50" value="<?php echo $form_modifica_monitor["apellidos"]; ?>"required>
		</div>

		<div>
		<label for="telefono">Teléfono:</label>
		<input id="telefono" name="telefono" type="text" size="9" value="<?php echo $form_modifica_monitor["telefono"]?>">
		</div>

		<div>
		<label for="estaActivo"></label>
		<input id="estaActivo" name="estaActivo" type="hidden" value="<?php echo $form_modifica_monitor["estaActivo"] = 1; ?>"required>
		</div>

		<div>
			<label for="fechaContratacion">Fecha de contratación:<em>*</em></label>
			<input id="fechaContratacion" name="fechaContratacion" type="date" value="<?php echo parseaFechaFormulario($form_modifica_monitor["fechaContratacion"]); ?>"required>
		</div>

		</fieldset>

		<div>
			</br>
			<input id="boton" type="submit" value="Enviar">
			<input id="boton" type="reset" value="Reset">
			<button onClick="window.close();">
					Cerrar
			</button>
		</div>
		</form>

	</body>
</html>
