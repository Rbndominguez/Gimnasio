<?php
	session_start();
	

	if (isset($_SESSION['form_crea_comida'])) {

		$nuevaComida["nombreComida"] = $_POST["nombreComida"];
		$nuevaComida["descripcion"] = $_POST["descripcion"];
		
	}

	else {
		header("Location: form_crea_comida.php");
	}
	

	$_SESSION["form_crea_comida"] = $nuevaComida;

	$errores = validarDatos($nuevaComida);


	 if (isset($errores)) {

	 	$_SESSION["errores"] = $errores;
	 	header('Location: form_crea_comida.php');
	 } else {

		header('Location: exito_crea_comida.php');
	 }

	
	function validarDatos($nuevaComida) {

		if ($nuevaComida["nombreComida"] == "") {
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		}

		if ($nuevaComida["descripcion"] == "") {
			$errores[] = "<p>La descripción no puede estar vacía</p>";
		}
	
		return $errores;
	}
?>