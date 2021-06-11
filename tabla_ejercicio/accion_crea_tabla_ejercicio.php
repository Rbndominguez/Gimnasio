<?php
	session_start();
	
	//Comprobar que el formulario coincide con el que se ha enviado
	if (isset($_SESSION['form_tabla_ejercicio'])) {
		//Recogemos los datos del formulario
		$nuevaTablaEjercicio["nombreTablaE"] = $_POST["nombreTablaE"];
		$nuevaTablaEjercicio["descripcion"] = $_POST["descripcion"];
		$nuevaTablaEjercicio["duracion"] = $_POST["duracion"];
		$nuevaTablaEjercicio["recuperacion"] = $_POST["recuperacion"];
	}
	//en caso contrario, reenviamos al formulario
	else {
		header("Location: form_tabla_ejercicio.php");
	}
	
	//Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["form_tabla_ejercicio"] = $nuevaTablaEjercicio;
	
	//Validamos el formulario en el servidor
	$errores = validarDatos($nuevaTablaEjercicio);
	
	//En el caso de que se detecten errores
	if (isset($errores)) {
		//Guardar en la sesion el mensaje de error y volver al formulario
		$_SESSION["errores"] = $errores;
		header('Location: form_crea_tabla_ejercicio.php');
	} else {
		//Si no hay errores, ir a la página de exito
		header('Location: exito_crea_tabla_ejercicio.php');
	}
	
	//Validación en el servidor del formulario
	
	function validarDatos($nuevaTablaEjercicio) {
		//Validacion nombre
		if ($nuevaTablaEjercicio["nombreTablaE"] == "")
			$errores[] = "<p>El nombre no puede estar vacío</p>";
	
		//Validacion duracion
		if ($nuevaTablaEjercicio["duracion"] == "")
			$errores[] = "<p>La duración de la tabla no puede estar vacía</p>";
	
		//Validacion recuperacion
		if (($nuevaTablaEjercicio["recuperacion"] != 1) && ($nuevaTablaEjercicio["recuperacion"] != 0))
			$errores[] = "<p>La duración no puede estar vacía</p>";
	
		return $errores;
	
	}
?>
