<?php
session_start();


if (isset($_SESSION['form_alta_monitor'])) {

	$monitor["dniMonitor"] = $_POST["dniMonitor"];
	$monitor["nombre"] = $_POST["nombre"];
	$monitor["apellidos"] = $_POST["apellidos"];
	$monitor["telefono"] = $_POST["telefono"];
	$monitor["estaActivo"] = $_POST["estaActivo"];
	$monitor["fechaContratacion"] = $_POST["fechaContratacion"];
}

else {
	header("Location: form_alta_monitor.php");
}


$_SESSION["form_alta_monitor"] = $monitor;


$errores = validarDatos($monitor);


if (isset($errores)) {

	$_SESSION["errores"] = $errores;
	header('Location: form_alta_monitor.php');
} else {

	header('Location: exito_alta_monitores.php');
}

function validarDatos($monitor) {

	if ($monitor["dniMonitor"] == "")
		$errores[] = "<p>El DNI no puede estar vacío</p>";
	else if (!preg_match("/^[0-9]{8}[A-Z]$/", $monitor["dniMonitor"])) {
		$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $monitor["dniMonitor"] . "</p>";
	}

	if ($monitor["nombre"] == "")
		$errores[] = "<p>El nombre no puede estar vacío</p>";


	if ($monitor["apellidos"] == "")
		$errores[] = "<p>El apellido no puede estar vacío</p>";

	if ($monitor["telefono"] == "") {
		$errores[] = "<p>El teléfono no puede estar vacío</p>";
	}


	$fechaContratacion = date('d/m/Y', strtotime($monitor["fechaContratacion"]));
	if ($monitor["fechaContratacion"] == "") {
		$errores[] = "<p>La fecha de contratación no puede estar vacía</p>";
	}
	return $errores;
}
?>