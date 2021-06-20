<?php
	session_start();
	

	if (isset($_SESSION['form_tabla_ejercicio'])) {

		$nuevaTablaEjercicio["nombreTablaE"] = $_POST["nombreTablaE"];
		$nuevaTablaEjercicio["descripcion"] = $_POST["descripcion"];
		$nuevaTablaEjercicio["duracion"] = $_POST["duracion"];
		$nuevaTablaEjercicio["recuperacion"] = $_POST["recuperacion"];
	}

	else {
		header("Location: form_tabla_ejercicio.php");
	}
	

	$_SESSION["form_tabla_ejercicio"] = $nuevaTablaEjercicio;
	

	$errores = validarDatos($nuevaTablaEjercicio);
	

	if (isset($errores)) {

		$_SESSION["errores"] = $errores;
		header('Location: form_crea_tabla_ejercicio.php');
	} else {

		header('Location: exito_crea_tabla_ejercicio.php');
	}
	

	
	function validarDatos($nuevaTablaEjercicio) {

		if ($nuevaTablaEjercicio["nombreTablaE"] == "")
			$errores[] = "<p>El nombre no puede estar vacío</p>";

		if ($nuevaTablaEjercicio["duracion"] == "")
			$errores[] = "<p>La duración de la tabla no puede estar vacía</p>";
	
		if (($nuevaTablaEjercicio["recuperacion"] != 1) && ($nuevaTablaEjercicio["recuperacion"] != 0))
			$errores[] = "<p>La duración no puede estar vacía</p>";
	
		return $errores;
	
	}
?>
