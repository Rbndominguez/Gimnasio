<?php
	session_start();
	
	//Comprobar que el formulario coincide con el que se ha enviado
	if (isset($_SESSION['form_crea_dieta'])) {
		//Recogemos los datos del formulario
		$nuevaDieta["nombreDieta"] = $_POST["nombreDieta"];
		$nuevaDieta["descripcion"] = $_POST["descripcion"];
		$nuevaDieta["duracion"] = $_POST["duracion"];
	}
	//en caso contrario, reenviamos al formulario
	else {
		header("Location: form_crea_dieta.php");
	}
	
	//Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["form_crea_dieta"] = $nuevaDieta;
	
	//Validamos el formulario en el servidor
	$errores = validarDatos($nuevaDieta);
	
	//En el caso de que se detecten errores
	if (isset($errores)) {
		//Guardar en la sesion el mensaje de error y volver al formulario
		$_SESSION["errores"] = $errores;
		header('Location: form_crea_dieta.php');
	} else {
		//Si no hay errores, ir a la página de exito
		header('Location: exito_crea_dieta.php');
	}
	//Validacion en el servidor del formulario
	
	function validarDatos($nuevaDieta) {
		//Validación nombre
		if ($nuevaDieta["nombreDieta"] == "")
			$errores[] = "<p>El nombre no puede estar vacío</p>";
	
		//Validación duracion
		if ($nuevaDieta["duracion"] == "")
			$errores[] = "<p>La duración no puede estar vacía</p>";
		
		return $errores;
	}
?>