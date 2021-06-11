<?php
	session_start();
	#Si no existen datos del formulario en la sesión, se crea una entrada con los valores por defecto.
	if (!isset($_SESSION["form_alta_monitor"])) {
		$form_alta_monitor["dniMonitor"] = "";
		$form_alta_monitor["nombre"] = "";
		$form_alta_monitor["apellidos"] = "";
		$form_alta_monitor["telefono"] = "";
		$form_alta_monitor["estaActivo"] = "";
		$form_alta_monitor["fechaContratacion"] = "";
		$_SESSION["form_alta_monitor"] = $form_alta_monitor;
	}#Si ya existen valores, los utilizamos para inicializar el formulario.
	else {
		$form_alta_monitor = $_SESSION["form_alta_monitor"];
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
	<title>Monitores</title>
	<link rel="stylesheet" type="text/css" href="../css/formulario.css">
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
		
		<form id="form_alta_monitor" method="post" action="accion_alta_monitor.php" novalidate>
		<p>
		Los campos obligatorios están marcados con <em>*</em>
		</p>
		<fieldset>
		<legend>
		Monitor
		</legend>
		<div>
		<label for="dniMonitor">DNI:<em>*</em></label>
		<input id="dniMonitor" name="dniMonitor" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]{1}$" title="8 digitos seguidos de una letra mayúscula" size="50" value="<?php echo $form_alta_monitor["dniMonitor"]; ?>"required>
		</div>

		<div>
		<label for="nombre">Nombre:<em>*</em></label>
		<input id="nombre" name="nombre" type="text" size="50" value="<?php echo $form_alta_monitor["nombre"]; ?>"required>
		</div>

		<div>
		<label for="apellidos">Apellidos:<em>*</em></label>
		<input  id="apellidos" name="apellidos" type="text" size="50" value="<?php echo $form_alta_monitor["apellidos"]; ?>"required>
		</div>

		<div>
		<label for="telefono">Teléfono:</label>
		<input id="telefono" name="telefono" type="text" size="9" value="<?php echo $form_alta_monitor["telefono"]?>">
		</div>
		
		<div>
		<label for="estaActivo"></label>
		<input id="estaActivo" name="estaActivo" type="hidden" value="<?php echo $form_alta_monitor["estaActivo"] = 1; ?>"required>
		</div>

		<div>
			<label for="fechaContratacion">Fecha de contratación:<em>*</em></label>
			<input id="fechaContratacion" name="fechaContratacion" type="date" value="<?php echo $form_alta_monitor["fechaContratacion"]; ?>"required>
		</div>

		</fieldset>
		<div>
			</br>
			<input id="boton" type="submit" value="Enviar">
			<input id="boton" type="reset" value="Limpiar el formulario">
			<button onClick="window.close();">
					Cerrar
			</button>
		</div>
		</form>
	</body>
