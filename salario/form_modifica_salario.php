<?php
	session_start();
	
	require_once ("../gestionBD.php");
	require_once ("gestionSalarios.php");
	
	$form_modifica_salario = $_SESSION["salario"];
	
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Modificar salario</title>
		<link href="../css/formulario.css" rel="stylesheet" type="text/css">
	</head>

	<body>

		<form id="form_modifica_salario" method="post" action="accion_modificar_salario.php" novalidate>
			<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
			<fieldset>
				<legend>
					Datos del salario
				</legend>

				<div>
					<input id="oid_sm" name="oid_sm" type="hidden" value="<?php echo $form_modifica_salario["oid_sm"]; ?>" required/>
				</div>

				<div>
					<label for="cantidad">Cantidad:<em>*</em></label>
					<input id="cantidad" name="cantidad" type="text" value="<?php echo $form_modifica_salario["cantidad"]; ?>"required>
				</div>

				<div>
					<label for="fecha">Fecha del salario:<em>*</em></label>
					<input id="fecha" name="fecha" type="date" value="<?php echo parseaFechaFormulario($form_modifica_salario["fecha"]); ?>"required>
				</div>

				<div>
					<label for="dniMonitor">Monitor:<em>*</em></label>
					<select id="dniMonitor" name="dniMonitor" size="1" required>

						<?php
						$conexion = crearConexionBD();
						$monitores = listarMonitores($conexion);
						cerrarConexionBD($conexion);

						foreach ($monitores as $monitor) {
							if ($monitor["DNIMONITOR"] == $form_modifica_salario["dniMonitor"]) {
								echo "<option label='" . $monitor["apellidos"] . ", " . $monitor["nombre"] . "' value='" . $monitor["dnimonitor"] . "' selected >";
							} else {
								echo "<option label='" . $monitor["apellidos"] . ", " . $monitor["nombre"] . "' value='" . $monitor["dnimonitor"] . "'>";
							}
						}
						?>
					</select>
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
