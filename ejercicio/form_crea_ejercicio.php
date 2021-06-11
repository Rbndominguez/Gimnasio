<?php
	session_start();
	
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['form_crea_ejercicio'])) {
		$form_crea_ejercicio['nombreEjercicio'] = "";
		$form_crea_ejercicio['descripcion'] = "";
		$form_crea_ejercicio['repeticiones'] = "";
		$form_crea_ejercicio['duracion'] = "";
		$form_crea_ejercicio['series'] = "";
		$form_crea_ejercicio['numeroOrden'] = "";
	
		$_SESSION['form_crea_ejercicio'] = $form_crea_ejercicio;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$form_crea_ejercicio = $_SESSION['form_crea_ejercicio'];
	
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])) {
		$errores = $_SESSION["errores"];
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Creación de Ejercicio</title>
	<link href="../css/formulario.css" rel="stylesheet" type="text/css">
</head>

<body>
		
	<?php 
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
		   	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
	    	foreach($errores as $error) echo $error; 
	   		echo "</div>";
	  	}
	?>

		<form id="form_crea_ejercicio" method="post" action="accion_crea_ejercicio.php" novalidate>
			<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
			<fieldset><legend>Datos del ejercicio</legend>
				<div><label for="nombreEjercicio">Nombre del Ejercicio:<em>*</em></label>
					<input id="nombreEjercicio" name="nombreEjercicio" type="text" size="50" value="<?php echo $form_crea_ejercicio['nombreEjercicio']; ?>" required>
				</div>

				<div><label for="descripcion">Descripcion:<em>*</em></label>
					<input id="descripcion" name="descripcion" type="text" size="80" value="<?php echo $form_crea_ejercicio['descripcion']; ?>" required>
				</div>

				<div><label for="repeticiones">Repeticiones:</label>
					<input id="repeticiones" name="repeticiones" type="text" value="<?php echo $form_crea_ejercicio['repeticiones']; ?>">
				</div>

				<div><label for="duracion">Duracion:</label>
					<input id="duracion" name="duracion" type="text" size="50" value="<?php echo $form_crea_ejercicio['duracion']; ?>">
				</div>

				<div><label for="series">Series:</label>
					<input id="series" name="series" type="text" value="<?php echo $form_crea_ejercicio['series']; ?>">
				</div>

			</fieldset>
			<br>
			<div>
				<input id="boton" type="submit" value="Enviar" />
				<input id="boton" type="reset" value="Limpiar el formulario">
				<button onClick="window.close();">Cerrar</button>
			</div>

		</form>

	</body>
</html>
