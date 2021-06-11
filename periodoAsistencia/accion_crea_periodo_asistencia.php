<?php
	session_start();
	
	//Comprobar que el formulario coincide con el que se ha enviado
	if (isset($_SESSION['form_crea_periodo_asistencia'])) {
		//Recogemos los datos del formulario
		$nuevoPeriodoAsistencia["fechaInicio"] = $_POST["fechaInicio"];
		$nuevoPeriodoAsistencia["dni"] = $_POST["dni"];
	}
	//en caso contrario, reenviamos al formulario
	else {
		header("Location: form_crea_periodo_asistencia.php");
	}
	
	//Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["form_crea_periodo_asistencia"] = $nuevoPeriodoAsistencia;
	
	//Validamos el formulario en el servidor
	$errores = validarDatos($nuevoPeriodoAsistencia);
	
	//En el caso de que se detecten errores
	if (isset($errores)) {
		//Guardar en la sesion el mensaje de error y volver al formulario
		$_SESSION["errores"] = $errores;
		header('Location: form_crea_periodo_asistencia.php');
	} else {
		//Si no hay errores, ir a la página de exito
		header('Location: exito_crea_periodo_asistencia.php');
	}
	//Validacion en el servidor del formulario
	
	function validarDatos($nuevoPeriodoAsistencia) {
		//Validación fechaInicio
		$fecha = date('d/m/Y', strtotime($nuevoPeriodoAsistencia["fechaInicio"]));
		if ($fecha == "") {
			$errores[] = "<p>La fecha de inicio no puede estar vacía</p>";
		}
		
		//Validación dni
		if ($nuevoPeriodoAsistencia["dni"] == "")
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoPeriodoAsistencia["dni"])) {
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoPeriodoAsistencia["dni"] . "</p>";
		}
		
		return $errores;
	}
?>