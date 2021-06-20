<?php
	session_start();
	

	if (isset($_SESSION['form_crea_periodo_asistencia'])) {

		$nuevoPeriodoAsistencia["fechaInicio"] = $_POST["fechaInicio"];
		$nuevoPeriodoAsistencia["dni"] = $_POST["dni"];
	}

	else {
		header("Location: form_crea_periodo_asistencia.php");
	}
	

	$_SESSION["form_crea_periodo_asistencia"] = $nuevoPeriodoAsistencia;
	

	$errores = validarDatos($nuevoPeriodoAsistencia);

	if (isset($errores)) {

		$_SESSION["errores"] = $errores;
		header('Location: form_crea_periodo_asistencia.php');
	} else {

		header('Location: exito_crea_periodo_asistencia.php');
	}

	
	function validarDatos($nuevoPeriodoAsistencia) {

		$fecha = date('d/m/Y', strtotime($nuevoPeriodoAsistencia["fechaInicio"]));
		if ($fecha == "") {
			$errores[] = "<p>La fecha de inicio no puede estar vacía</p>";
		}
		

		if ($nuevoPeriodoAsistencia["dni"] == "")
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoPeriodoAsistencia["dni"])) {
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoPeriodoAsistencia["dni"] . "</p>";
		}
		
		return $errores;
	}
?>