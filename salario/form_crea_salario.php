<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionSalarios.php");

	if (!isset($_SESSION["form_crea_salario"])) {
		$form_crea_salario["cantidad"] = "";
		$form_crea_salario["fecha"] = "";
		$form_crea_salario["dniMonitor"] = "";
	
		$_SESSION["form_crea_salario"] = $form_crea_salario;
	
	} else {
		$form_crea_salario = $_SESSION["form_crea_salario"];
	}
	
	if (isset($_SESSION["errores"])) {
		$errores = $_SESSION["errores"];
	}
?>
<!DOCTYPE HTML>
<html lang = "es">
<head>
	<meta charset="UTF-8">
	<title>Crear Salario</title>
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
		
		<form id="form_crea_salario" method="post" action="accion_crea_salarios.php" novalidate>
			<p><i>Los campos obligatorios están marcados con <em>*</em></i></p>
			<fieldset><legend>Datos del Salario Mensual</legend>
				
				<div><label for="cantidad">Cantidad <em>*</em></label>
					<input id="cantidad" name="cantidad" type="text" value="<?php echo $form_crea_salario["cantidad"]; ?>"required>
				</div>

				<div><label for="fecha">Fecha del salario <em>*</em></label>
					<input id="fecha" name="fecha" type="date" value="<?php echo $form_crea_salario["fecha"]; ?>"required>
				</div>

				<div><label for="dniMonitor">Monitor:<em>*</em></label>
					<select id="dniMonitor" name="dniMonitor" size="1" required>
						<option label="Selecciona un Monitor" value="">
						<?php
			  				$conexion = crearConexionBD();
			  				$monitores = listarMonitores($conexion);
							cerrarConexionBD($conexion);
	
			  				foreach($monitores as $monitor) {
								echo "<option label='".$monitor["apellidos"].", ".$monitor["nombre"]."' value='".$monitor["dnimonitor"]."'>";
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
