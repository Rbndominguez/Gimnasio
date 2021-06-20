<?php
session_start();

if (isset($_SESSION['form_crea_pagos_pasis'])) {

	$nuevoPagoPasis["importePago"] = $_POST["importePago"];
	$nuevoPagoPasis["fechaPago"] = $_POST["fechaPago"];
	$nuevoPagoPasis["motivo"] = $_POST["motivo"];
	$nuevoPagoPasis["tipoPago"] = $_POST["tipoPago"];
	$nuevoPagoPasis["dni"] = $_POST["dni"];
	$nuevoPagoPasis["oid_pasis"] = $_POST["oid_pasis"];
}

else {
	header("Location: form_crea_pagos_pasis.php");
}


$_SESSION["form_crea_pagos_pasis"] = $nuevoPagoPasis;

$errores = validarDatos($nuevoPagoPasis);


if (isset($errores)) {

	$_SESSION["errores"] = $errores;
	header('Location: form_crea_pagos_pasis.php');
} else {

	header('Location: exito_crea_pagos_pasis.php');
}



function validarDatos($nuevoPagoPasis) {

	if ($nuevoPagoPasis["importePago"] == ""){
		$errores[] = "<p>El pago no puede estar vacío</p>";
		}	

	$fechaPago = date('d/m/Y', strtotime($nuevoPagoPasis["fechaPago"]));
	if ($nuevoPagoPasis["fechaPago"] == "") {
		$errores[] = "<p>La fecha del pago no puede estar vacía</p>";
	}
	return $errores;
	

	if ($nuevoPagoPasis["motivo"] == "")
		$errores[] = "<p>La descripción del motivo no puede estar vacía</p>";
	

		if($nuevoPagoPasis["tipoPago"] != "mensual" &&
				$nuevoPagoPasis["tipoPago"] != "bimensual" &&
				$nuevoPagoPasis["tipoPago"] != "trimestral" &&
				$nuevoPagoPasis["tipoPago"] != "estudiante" &&
				$nuevoPagoPasis["tipoPago"] != "porHora" &&
				$nuevoPagoPasis["tipoPago"] != "puntual") {
			$errores[] = "<p>El pago debe ser uno de los disponibles</p>";
		}

	if ($nuevoPagoPasis["dni"] == "")
		$errores[] = "<p>El dni no puede estar vacío</p>";
	else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoPagoPasis["dni"])) {
		$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoPagoPasis["dni"] . "</p>";
	}
	
	return $errores;
	
}

?>
