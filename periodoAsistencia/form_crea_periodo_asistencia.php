<?php
	session_start();
	
	require_once("../gestionBD.php");
	require_once("gestionPeriodosAsistencia.php");
	
	#Si no existen datos del formulario en la sesión, se crea una entrada con los valores por defecto.
	if (!isset($_SESSION["form_crea_periodo_asistencia"])) {
		$form_crea_periodo_asistencia["fechaInicio"] = "";
		$form_crea_periodo_asistencia["dni"] = "";
	
		$_SESSION["form_crea_periodo_asistencia"] = $form_crea_periodo_asistencia;
	}#Si ya existen valores, los utilizamos para inicializar el formulario.
	else {
		$form_crea_periodo_asistencia = $_SESSION["form_crea_periodo_asistencia"];
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
	<title>Periodos de Asistencia</title>
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
		
		<form id="form_crea_periodo_asistencia" method="post" action="accion_crea_periodo_asistencia.php" novalidate>
		<p>
		Los campos obligatorios están marcados con <em>*</em>
		</p>
		<fieldset>
			<legend>
			Periodo de Asistencia
			</legend>
			<div>
				<label for="fechaInicio">Fecha de Inicio:<em>*</em></label>
				<input id="fechaInicio" name="fechaInicio" type="date" value="<?php echo $form_crea_periodo_asistencia["fechaInicio"]; ?>"required>
			</div>

			<div><label for="dni">Cliente:<em>*</em></label>
				<select id="dni" name="dni" size="1" required>
					<option label="Selecciona un Cliente" value="">
						<?php
			  				$conexion = crearConexionBD();
			  				$clientes = listarClientes($conexion);
							cerrarConexionBD($conexion);
	
			  				foreach($clientes as $cliente) {
								echo "<option label='".$cliente["apellidoscliente"].", ".$cliente["nombrecliente"]."' value='".$cliente["dni"]."'>";
							}
						?>
						
				</select>
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