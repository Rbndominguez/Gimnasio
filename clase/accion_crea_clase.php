<?php
session_start();

// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["form_crea_clase"])) {
	// Recogemos los datos del formulario
	$nuevaClase["nombreClase"] = $_POST["nombreClase"];
	$nuevaClase["horario"] = $_POST["horario"];
	$nuevaClase["dniMonitor"] = $_POST["dniMonitor"];
	$nuevaClase["nombre"]=$_POST["nombre"];
	$nuevaClase["apellidos"]=$_POST["apellidos"];
	$nuevaClase["sala"] = $_POST["sala"];
} else// En caso contrario, vamos al formulario
	header("Location: form_crea_clase.php");

// Guardar la variable local con los datos del formulario en la sesión.
$_SESSION["form_crea_clase"] = $nuevaClase;

// Validamos el formulario en servidor
$errores = validarDatosClase($nuevaClase);

// Si se han detectado errores
if (isset($errores)) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
	header('Location: form_crea_clase.php');
} else
	// Si todo va bien, vamos a la página de éxito
	header('Location: exito_crea_clase.php');

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de crear clases
///////////////////////////////////////////////////////////
function validarDatosClase($nuevaClase) {
	// Validación del Nombre
	if ($nuevaClase["nombreClase"] == "")
		$errores[] = "<p>El nombre de la clase no puede estar vacío</p>";

	// Validación del horario
	if ($nuevaClase["horario"] == "")
		$errores[] = "<p>El horario no puede estar vacío</p>";

	// Validación del DNI del monitor
	if ($nuevaClase["dniMonitor"] == "")
		$errores[] = "<p>El DNI del monitor no puede estar vacío</p>";
	else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevaClase["dniMonitor"])) {
		$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevaClase["dniMonitor"] . "</p>";
	}

	// Validación de la sala
	if ($nuevaClase["sala"] != "SalaDeMusculacion" && $nuevaClase["sala"] != "SalaDeSpinning" && $nuevaClase["sala"] != "SalaMultiusos") {
		$errores[] = "<p>La sala debe ser una de las disponibles</p>";
	}

	return $errores;
}
?>
