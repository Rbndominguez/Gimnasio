<?php
	session_start();
	

	if (isset($_SESSION['form_crea_dieta'])) {

		$nuevaDieta["nombreDieta"] = $_POST["nombreDieta"];
		$nuevaDieta["descripcion"] = $_POST["descripcion"];
		$nuevaDieta["duracion"] = $_POST["duracion"];
	}

	else {
		header("Location: form_crea_dieta.php");
	}
	

	$_SESSION["form_crea_dieta"] = $nuevaDieta;
	
	$errores = validarDatos($nuevaDieta);
	

	if (isset($errores)) {

		$_SESSION["errores"] = $errores;
		header('Location: form_crea_dieta.php');
	} else {

		header('Location: exito_crea_dieta.php');
	}

	
	function validarDatos($nuevaDieta) {

		if ($nuevaDieta["nombreDieta"] == "")
			$errores[] = "<p>El nombre no puede estar vacío</p>";
	
		if ($nuevaDieta["duracion"] == "")
			$errores[] = "<p>La duración no puede estar vacía</p>";
		
		return $errores;
	}
?>