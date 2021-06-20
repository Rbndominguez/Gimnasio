<?php
	session_start();
	
	
	if (isset($_SESSION['form_crea_salario'])) {

		$nuevoSalario["cantidad"] = $_POST["cantidad"];
		$nuevoSalario["fecha"] = $_POST["fecha"];
		$nuevoSalario["dniMonitor"] = $_POST["dniMonitor"];
	
	}

	else {
		header("Location: form_crea_salario.php");
	}
	

	$_SESSION["form_crea_salario"] = $nuevoSalario;
	

	$errores = validarDatos($nuevoSalario);
	

	if (isset($errores)) {

		$_SESSION["errores"] = $errores;
		header('Location: form_crea_salario.php');
	} else {

		header('Location: exito_crea_salario.php');
	}
	

	
	function validarDatos($nuevoSalario) {
			

		$fecha = date('d/m/Y', strtotime($nuevoSalario["fecha"]));
		if ($fecha == "") {
			$errores[] = "<p>La fecha del salario no puede estar vacía</p>";
		}
		

		if ($nuevoSalario["cantidad"] == "") {
			$errores[] = "<p>La cantidad no puede estar vacía</p>";
		}
		

		if ($nuevoSalario["dniMonitor"] == "")
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoSalario["dniMonitor"])) {
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoSalario["dniMonitor"] . "</p>";
		}
		
		return $errores;
	}
		
?>