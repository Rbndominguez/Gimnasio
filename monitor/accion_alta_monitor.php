<?php
session_start();

//Comprobar que el formulario coincide con el que se ha enviado
if (isset($_SESSION['form_alta_monitor'])) {
	//Recogemos los datos del formulario
	$monitor["dniMonitor"] = $_POST["dniMonitor"];
	$monitor["nombre"] = $_POST["nombre"];
	$monitor["apellidos"] = $_POST["apellidos"];
	$monitor["telefono"] = $_POST["telefono"];
	$monitor["estaActivo"] = $_POST["estaActivo"];
	$monitor["fechaContratacion"] = $_POST["fechaContratacion"];
}
//en caso contrario, reenviamos al formulario
else {
	header("Location: form_alta_monitor.php");
}

//Guardar la variable local con los datos del formulario en la sesión.
$_SESSION["form_alta_monitor"] = $monitor;

//Validamos el formulario en el servidor
$errores = validarDatos($monitor);

//En el caso de que se detecten errores
if (isset($errores)) {
	//Guardar en la sesion el mensaje de error y volver al formulario
	$_SESSION["errores"] = $errores;
	header('Location: form_alta_monitor.php');
} else {
	//Si no hay errores, ir a la página de exito
	header('Location: exito_alta_monitores.php');
}
//Validacion en el servidor del formulario

function validarDatos($monitor) {
	//Validación dni
	if ($monitor["dniMonitor"] == "")
		$errores[] = "<p>El DNI no puede estar vacío</p>";
	else if (!preg_match("/^[0-9]{8}[A-Z]$/", $monitor["dniMonitor"])) {
		$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $monitor["dniMonitor"] . "</p>";
	}
	//Validación nombreCliente
	if ($monitor["nombre"] == "")
		$errores[] = "<p>El nombre no puede estar vacío</p>";

	//Validación apellidosCliente
	if ($monitor["apellidos"] == "")
		$errores[] = "<p>El apellido no puede estar vacío</p>";

	//Validación telefono
	if ($monitor["telefono"] == "") {
		$errores[] = "<p>El teléfono no puede estar vacío</p>";
	}

	//Validacion fecha contratacion
	$fechaContratacion = date('d/m/Y', strtotime($monitor["fechaContratacion"]));
	if ($monitor["fechaContratacion"] == "") {
		$errores[] = "<p>La fecha de contratación no puede estar vacía</p>";
	}
	return $errores;
}
?>