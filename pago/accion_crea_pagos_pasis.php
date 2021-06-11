<?php
session_start();
//Comprobar que el formulario coincide con el que se ha enviado
if (isset($_SESSION['form_crea_pagos_pasis'])) {
	//Recogemos los datos del formulario
	$nuevoPagoPasis["importePago"] = $_POST["importePago"];
	$nuevoPagoPasis["fechaPago"] = $_POST["fechaPago"];
	$nuevoPagoPasis["motivo"] = $_POST["motivo"];
	$nuevoPagoPasis["tipoPago"] = $_POST["tipoPago"];
	$nuevoPagoPasis["dni"] = $_POST["dni"];
	$nuevoPagoPasis["oid_pasis"] = $_POST["oid_pasis"];
}
//en caso contrario, reenviamos al formulario
else {
	header("Location: form_crea_pagos_pasis.php");
}

//Guardar la variable local con los datos del formulario en la sesión.
$_SESSION["form_crea_pagos_pasis"] = $nuevoPagoPasis;

//Validamos el formulario en el servidor
$errores = validarDatos($nuevoPagoPasis);

//En el caso de que se detecten errores
if (isset($errores)) {
	//Guardar en la sesion el mensaje de error y volver al formulario
	$_SESSION["errores"] = $errores;
	header('Location: form_crea_pagos_pasis.php');
} else {
	//Si no hay errores, ir a la página de exito
	header('Location: exito_crea_pagos_pasis.php');
}

//Validación en el servidor del formulario

function validarDatos($nuevoPagoPasis) {
	//Validacion importePago
	if ($nuevoPagoPasis["importePago"] == ""){
		$errores[] = "<p>El pago no puede estar vacío</p>";
		}	
	//Validacion fechaPago
	$fechaPago = date('d/m/Y', strtotime($nuevoPagoPasis["fechaPago"]));
	if ($nuevoPagoPasis["fechaPago"] == "") {
		$errores[] = "<p>La fecha del pago no puede estar vacía</p>";
	}
	return $errores;
	
	//Validacion motivo
	if ($nuevoPagoPasis["motivo"] == "")
		$errores[] = "<p>La descripción del motivo no puede estar vacía</p>";
	
	//Validacion tipoPago
		if($nuevoPagoPasis["tipoPago"] != "mensual" &&
				$nuevoPagoPasis["tipoPago"] != "bimensual" &&
				$nuevoPagoPasis["tipoPago"] != "trimestral" &&
				$nuevoPagoPasis["tipoPago"] != "estudiante" &&
				$nuevoPagoPasis["tipoPago"] != "porHora" &&
				$nuevoPagoPasis["tipoPago"] != "puntual") {
			$errores[] = "<p>El pago debe ser uno de los disponibles</p>";
		}

	//Validacion dni
	if ($nuevoPagoPasis["dni"] == "")
		$errores[] = "<p>El dni no puede estar vacío</p>";
	else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoPagoPasis["dni"])) {
		$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoPagoPasis["dni"] . "</p>";
	}
	
	return $errores;
	
}

?>
