<?php
	session_start();
	
	//Comprobar que el formulario coincide con el que se ha enviado
	if (isset($_SESSION['form_crea_comida'])) {
		//Recogemos los datos del formulario
		$nuevaComida["nombreComida"] = $_POST["nombreComida"];
		$nuevaComida["descripcion"] = $_POST["descripcion"];
		
	}
	//en caso contrario, reenviamos al formulario
	else {
		header("Location: form_crea_comida.php");
	}
	
	//Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["form_crea_comida"] = $nuevaComida;
	
	 //Validamos el formulario en el servidor
	$errores = validarDatos($nuevaComida);

	//En el caso de que se detecten errores
	 if (isset($errores)) {
	 	//Guardar en la sesion el mensaje de error y volver al formulario
	 	$_SESSION["errores"] = $errores;
	 	header('Location: form_crea_comida.php');
	 } else {
	//Si no hay errores, ir a la página de exito
		header('Location: exito_crea_comida.php');
	 }
	//Validacion en el servidor del formulario
	
	function validarDatos($nuevaComida) {
		//Validación nombre
		if ($nuevaComida["nombreComida"] == "") {
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		}
		//Validación descripción
		if ($nuevaComida["descripcion"] == "") {
			$errores[] = "<p>La descripción no puede estar vacía</p>";
		}
	
		return $errores;
	}
?>