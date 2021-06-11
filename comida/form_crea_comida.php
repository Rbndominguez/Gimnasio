<?php
	session_start();
	
	if (!isset($_SESSION["form_crea_comida"])) {
		$form_crea_comida["nombreComida"] = "";
		$form_crea_comida["descripcion"] = "";
	
		$_SESSION["form_crea_comida"] = $form_crea_comida;
	}
	else {
		$form_crea_comida = $_SESSION["form_crea_comida"];
	}
	
	if (isset($_SESSION["errores"])) {
		$errores = $_SESSION["errores"];
	}
?>

<!DOCTYPE HTML>
<html lang = "es">
<head>
	<meta charset="UTF-8">
	<title>Crear Comidas</title>
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
	
	<form id="creaComida" method="post" action="accion_crea_comida.php" novalidate>
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos de la Comida</legend>
			
			<div><label for="nombreComida">Nombre:<em>*</em></label>
				<input id="nombreComida" name="nombreComida" type="text" size="50" value="<?php echo $form_crea_comida["nombreComida"]; ?>"required/>
			</div>

			<div><label for="descripcion">Descripción:<em>*</em></label>
				<input  id="descripcion" name="descripcion" type="text" size="50" value="<?php echo $form_crea_comida["descripcion"]; ?>"required/>
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
