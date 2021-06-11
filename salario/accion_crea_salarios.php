<?php
	session_start();
	
	//Comprobar que el formulario coincide con el que se ha enviado
	if (isset($_SESSION['form_crea_salario'])) {
		//Recogemos los datos del formulario
		$nuevoSalario["cantidad"] = $_POST["cantidad"];
		$nuevoSalario["fecha"] = $_POST["fecha"];
		$nuevoSalario["dniMonitor"] = $_POST["dniMonitor"];
	
	}
	//en caso contrario, reenviamos al formulario
	else {
		header("Location: form_crea_salario.php");
	}
	
	//Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["form_crea_salario"] = $nuevoSalario;
	
	//Validamos el formulario en el servidor
	$errores = validarDatos($nuevoSalario);
	
	//En el caso de que se detecten errores
	if (isset($errores)) {
		//Guardar en la sesion el mensaje de error y volver al formulario
		$_SESSION["errores"] = $errores;
		header('Location: form_crea_salario.php');
	} else {
		//Si no hay errores, ir a la página de exito
		header('Location: exito_crea_salario.php');
	}
	
	//Validacion en el servidor del formulario
	
	function validarDatos($nuevoSalario) {
			
		//Validación fecha
		$fecha = date('d/m/Y', strtotime($nuevoSalario["fecha"]));
		if ($fecha == "") {
			$errores[] = "<p>La fecha del salario no puede estar vacía</p>";
		}
		
		//Validación cantidad
		if ($nuevoSalario["cantidad"] == "") {
			$errores[] = "<p>La cantidad no puede estar vacía</p>";
		}
		
		//Validación dniMonitor
		if ($nuevoSalario["dniMonitor"] == "")
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoSalario["dniMonitor"])) {
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoSalario["dniMonitor"] . "</p>";
		}
		
		return $errores;
	}
		
?>