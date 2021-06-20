<?php
session_start();


if (isset($_SESSION["form_crea_clase"])) {

	$nuevaClase["nombreClase"] = $_POST["nombreClase"];
	$nuevaClase["horario"] = $_POST["horario"];
	$nuevaClase["dniMonitor"] = $_POST["dniMonitor"];
	$nuevaClase["nombre"]=$_POST["nombre"];
	$nuevaClase["apellidos"]=$_POST["apellidos"];
	$nuevaClase["sala"] = $_POST["sala"];
} else
	header("Location: form_crea_clase.php");


$_SESSION["form_crea_clase"] = $nuevaClase;


$errores = validarDatosClase($nuevaClase);


if (isset($errores)) {

	$_SESSION["errores"] = $errores;
	header('Location: form_crea_clase.php');
} else

	header('Location: exito_crea_clase.php');


function validarDatosClase($nuevaClase) {

	if ($nuevaClase["nombreClase"] == "")
		$errores[] = "<p>El nombre de la clase no puede estar vacío</p>";


	if ($nuevaClase["horario"] == "")
		$errores[] = "<p>El horario no puede estar vacío</p>";


	if ($nuevaClase["dniMonitor"] == "")
		$errores[] = "<p>El DNI del monitor no puede estar vacío</p>";
	else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevaClase["dniMonitor"])) {
		$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevaClase["dniMonitor"] . "</p>";
	}


	if ($nuevaClase["sala"] != "SalaDeMusculacion" && $nuevaClase["sala"] != "SalaDeSpinning" && $nuevaClase["sala"] != "SalaMultiusos") {
		$errores[] = "<p>La sala debe ser una de las disponibles</p>";
	}

	return $errores;
}
?>
