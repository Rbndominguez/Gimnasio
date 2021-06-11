<?php
	session_start();
	#Si no existen datos del formulario en la sesión, se crea una entrada con los valores por defecto.
	if (!isset($_SESSION["form_tabla_ejercicio"])) {
		$form_tabla_ejercicio["nombreTablaE"] = "";
		$form_tabla_ejercicio["descripcion"] = "";
		$form_tabla_ejercicio["duracion"] = "";
		$form_tabla_ejercicio["recuperacion"] = "";
	
		$_SESSION["form_tabla_ejercicio"] = $form_tabla_ejercicio;
	}#Si ya existen valores, los utilizamos para inicializar el formulario.
	else {
		$form_tabla_ejercicio = $_SESSION["form_tabla_ejercicio"];
	}
	#Si hay errores de validación, hay que mostrarlos y marcar los campos donde se encuentran los errores
	if (isset($_SESSION["errores"])) {
		$errores = $_SESSION["errores"];
	}
?>
<!DOCTYPE HTML>
<html lang = "es">
<head>
	<meta charset="UTF-8">
	<title>Crear Tabla de Ejercicios</title>
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
		
		<form id="form_tabla_ejercicio" method="post" action="accion_crea_tabla_ejercicio.php" novalidate>
			<p><i>Los campos obligatorios están marcados con <em>*</em></i></p>
			<fieldset><legend>Tabla de Ejercicios</legend>
				<div><label for="nombreTablaE">Nombre <em>*</em></label>
					<input id="nombreTablaE" name="nombreTablaE" type="text" size="50" value="<?php echo $form_tabla_ejercicio["nombreTablaE"]; ?>"required>
				</div>

				<div><label for="descripcion">Descripción</label>
					<input  id="descripcion" name="descripcion" type="text" size="50" value="<?php echo $form_tabla_ejercicio["descripcion"]; ?>">
				</div>

				<div><label for="duracion">Duración <em>*</em></label>
					<input id="duracion" name="duracion" type="text" size="50" value="<?php echo $form_tabla_ejercicio["duracion"]?>"required>
				</div>

				<div><label for="recuperacion">¿Recuperación? <em>*</em></label>
					<input id="recuperacion" name="recuperacion" type="radio" value="<?php echo $form_tabla_ejercicio["recuperacion"] = 1; ?>">
						Sí
					<input id="recuperacion" name="recuperacion" type="radio" value="<?php echo $form_tabla_ejercicio["recuperacion"] = 0; ?>">
						No
				</div>
			</fieldset>
			<div>
				</br>
				<input id="boton" type="submit" value="Enviar">
				<input id="boton" type="reset" value="Limpiar el formulario">
				<button onClick="window.close();">Cerrar</button>
			</div>
		</form>
	</body>
</html>
