<?php
session_start();

require_once ("../gestionBD.php");
require_once ("gestionPagos.php");

#Si no existen datos del formulario en la sesión, se crea una entrada con los valores por defecto.
if (!isset($_SESSION["form_crea_pagos_pasis"])) {
	$form_crea_pagos_pasis["importePago"] = "";
	$form_crea_pagos_pasis["fechaPago"] = "";
	$form_crea_pagos_pasis["motivo"] = "";
	$form_crea_pagos_pasis["tipoPago"] = "";
	$form_crea_pagos_pasis["dni"] = "";
	$form_crea_pagos_pasis["oid_pasis"] = "";
	$_SESSION["form_crea_pagos_pasis"] = $form_crea_pagos_pasis;
}#Si ya existen valores, los utilizamos para inicializar el formulario.
else {
	$form_crea_pagos_pasis = $_SESSION["form_crea_pagos_pasis"];
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
		<!--<link rel="stylesheet" type = "text/css" href=direccion de la hoja de estilo>-->
		<title>Pagos</title>
		<link href="../css/formulario.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header>
			Pagos
		</header>
		<?php
		#include_once ("header.php");
		?>
		<?php
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores) > 0) {
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach ($errores as $error)
				echo $error;
			echo "</div>";
		}
		?>
		<form id="form_crea_pagos_pasis" method="post" action="accion_crea_pagos_pasis.php" novalidate>
		<p>
		Los campos obligatorios están marcados con <em>*</em>
		</p>
		<fieldset>
		<legend>
		Pago
		</legend>
		<div>
		<label for="importePago">Importe <em>*</em></label>
		<input id="importePago" name="importePago" type="text" min="0" step="0.01" value="<?php echo $form_crea_pagos_pasis["importePago"]; ?>"required>
		</div>

		<div>
		<label for="fechaPago">Fecha del pago<em>*</em></label>
		<input id="fechaPago" name="fechaPago" type="date" value="<?php echo $form_crea_pagos_pasis["fechaPago"]; ?>"required>
		</div>

		<div>
		<label for="motivo">Motivo <em>*</em></label>
		<input  id="motivo" name="motivo" type="text" size="50" value="<?php echo $form_crea_pagos_pasis["motivo"]; ?>"required>
		</div>
		<div>
		<label for="tipoPago">Tipo de pago <em>*</em></label>
		<select id="tipoPago" name="tipoPago" size="1">
		<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = NULL; ?>">Seleccione un pago de la lista</option>
		<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "mensual"; ?>">Mensual</option>
		<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "bimensual"; ?>">Bimensual</option>
		<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "trimestral"; ?>">Trimestral</option>
		<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "estudiante"; ?>">Estudiante</option>
		<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "porHora"; ?>">Por Hora</option>
		<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "puntual"; ?>">Puntual</option>
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
			echo "<option label='" . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . "' value='" . $cliente["dni"] . "'>";
		}
		?>

		</select>
		</div>

		<div>
		<label for="oid_pasis">Periodo de asistencia: <em>*</em></label>
		<select id="oid_pasis" name="oid_pasis" size="1" required>
		<option label="Selecciona un periodo de asistencia" value="">
		<?php
		$conexion = crearConexionBD();
		$pasiss = listarPasis($conexion);
		cerrarConexionBD($conexion);

		foreach ($pasiss as $pasis) {
			echo "<option label='" . $pasis["fechainicio"] . "-" . $pasis["fechafin"] . ", " . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . ", " . $pasis["dni"] . "' value='" . $pasis["oid_pasis"] . "'>";
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
