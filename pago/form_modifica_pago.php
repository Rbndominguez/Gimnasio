<?php
session_start();

require_once ("../gestionBD.php");
require_once ("gestionPagos.php");

$form_modifica_pago = $_SESSION["pago"];
if (isset($_SESSION["errores"]))
	$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Modificar pago</title>
		<link href="../css/formulario.css" rel="stylesheet" type="text/css">
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

		<form id="form_modifica_pago" method="post" action="accion_modificar_pago.php" novalidate>
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos del pago</legend>

		<div>
		<input id="oid_pa" name="oid_pa" type="hidden" value="<?php echo $form_modifica_pago["oid_pa"]; ?>" required/>
		</div>
		<div>
		<input id="nombreCliente" name="nombreCliente" type="hidden" value="<?php echo $form_modifica_pago["nombreCliente"]; ?>" required/>
		</div>
		<div>
		<input id="apellidosCliente" name="apellidosCliente" type="hidden" value="<?php echo $form_modifica_pago["apellidosCliente"]; ?>" required/>
		</div>
		<div>
		<label for="importePago">Importe <em>*</em></label>
		<input id="importePago" name="importePago" type="text" min="0" step="0.01" value="<?php echo $form_modifica_pago["importePago"]; ?>"required>
		</div>

		<div>
		<label for="fechaPago">Fecha del pago<em>*</em></label>
		<input id="fechaPago" name="fechaPago" type="date" value="<?php echo parseaFechaFormulario($form_modifica_pago["fechaPago"]); ?>"required>
		</div>

		<div>
		<label for="motivo">Motivo <em>*</em></label>
		<input  id="motivo" name="motivo" type="text" size="50" value="<?php echo $form_modifica_pago["motivo"]; ?>"required>
		</div>
		<div>
		<label for="tipoPago">Tipo de pago <em>*</em></label>
		<select id="tipoPago" name="tipoPago" size="1">
		<option value="mensual" <?php if($form_modifica_pago["tipoPago"]=="mensual")echo "selected";?> >Mensual</option>
		<option value="bimensual" <?php if($form_modifica_pago["tipoPago"]=="bimensual")echo "selected";?> >Bimensual</option>
		<option value="trimestral" <?php if($form_modifica_pago["tipoPago"]=="trimestral")echo "selected";?> >Trimestral</option>
		<option value="estudiante" <?php if($form_modifica_pago["tipoPago"]=="estudiante")echo "selected";?> >Estudiante</option>
		<option value="porHora" <?php if($form_modifica_pago["tipoPago"]=="porHora")echo "selected";?> >Por Hora</option>
		<option value="puntual" <?php if($form_modifica_pago["tipoPago"]=="puntual")echo "selected";?> >Puntual</option>
		</select>
		</div>

		<div>
		<label for="dni">Cliente: <em>*</em></label>
		<select id="dni" name="dni" size="1" required>
		<option label="Selecciona un cliente" value="">
		<?php
		$conexion = crearConexionBD();
		$clientes = listarClientes($conexion);
		cerrarConexionBD($conexion);

		foreach ($clientes as $cliente) {
			if ($cliente["dni"] == $form_modifica_pago["dni"]) {
				echo "<option label='" . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . "' value='" . $cliente["dni"] . "' selected > ";
			} else {
				echo "<option label='" . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . "' value='" . $cliente["dni"] . "'>";
			}
		}
		?>
		</select>
		</div>
		<?php
if($form_modifica_pago["oid_pasis"]!=NULL){

		?>
		<div>
		<label for="oid_pasis">Periodo de asistencia: <em>*</em></label>
		<select id="oid_pasis" name="oid_pasis" size="1" required>
		<option label="Selecciona un periodo de asistencia" value="">
		<?php
		$conexion = crearConexionBD();
		$pasiss = listarPasis($conexion);
		cerrarConexionBD($conexion);

		foreach ($pasiss as $pasis) {
			if ($pasis["oid_pasis"] == $form_modifica_pago["oid_pasis"]) {
				echo "<option label='" . $pasis["fechainicio"] . "-" . $pasis["fechafin"] . ", " . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . ", " . $pasis["dni"] . "' value='" . $pasis["oid_pasis"] . "' selected >";
			} else {
				echo "<option label='" . $pasis["fechainicio"] . "-" . $pasis["fechafin"] . ", " . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . ", " . $pasis["dni"] . "' value='" . $pasis["oid_pasis"] . "' >";
			}
		}
		?>

		</select>
		</div>
		<?php 	} ?>
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
