<?php
	session_start();
	#Si no existen datos del formulario en la sesión, se crea una entrada con los valores por defecto.
	if (!isset($_SESSION["form_crea_dieta"])) {
		$form_crea_dieta["nombreDieta"] = "";
		$form_crea_dieta["descripcion"] = "";
		$form_crea_dieta["duracion"] = "";
	
		$_SESSION['form_crea_dieta'] = $form_crea_dieta;
	
	}#Si ya existen valores, los utilizamos para inicializar el formulario.
	else {
		$form_crea_dieta = $_SESSION["form_crea_dieta"];
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
	<title>Crear Dieta</title>
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
		
		<form id="form_crea_dieta" method="post" action="accion_crea_dieta.php" novalidate>
			<p><i>Los campos obligatorios están marcados con <em>*</em></i></p>
			<fieldset><legend>Dieta</legend>
				<div><label for="nombreDieta">Nombre <em>*</em></label>
					<input id="nombreDieta" name="nombreDieta" type="text" size="50" value="<?php echo $form_crea_dieta["nombreDieta"]; ?>"required>
				</div>

				<div><label for="descripcion">Descripción</label>
					<input  id="descripcion" name="descripcion" type="text" size="50" value="<?php echo $form_crea_dieta["descripcion"]; ?>">
				</div>

				<div><label for="duracion">Duración <em>*</em></label>
					<input  id="duracion" name="duracion" type="text" size="9" value="<?php echo $form_crea_dieta["duracion"]; ?>"required>
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