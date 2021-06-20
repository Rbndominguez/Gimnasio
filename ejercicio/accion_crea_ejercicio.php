<?php
	session_start();

	if (isset($_SESSION["form_crea_ejercicio"])) {

		$nuevoEjercicio["nombreEjercicio"] = $_POST["nombreEjercicio"];
		$nuevoEjercicio["descripcion"] = $_POST["descripcion"];
		$nuevoEjercicio["repeticiones"] = $_POST["repeticiones"];
		$nuevoEjercicio["duracion"] = $_POST["duracion"];
		$nuevoEjercicio["series"] = $_POST["series"];
	}
	else 
		header("Location: form_crea_ejercicio.php");

	$_SESSION["form_crea_ejercicio"] = $nuevoEjercicio;

	$errores = validarDatosEjercicio($nuevoEjercicio);
	
	if (isset($errores)) {
		$_SESSION["errores"] = $errores;
		header('Location: form_crea_ejercicio.php');
	} else
		header('Location: exito_crea_ejercicio.php');




	function validarDatosEjercicio($nuevoEjercicio){
			
		if($nuevoEjercicio["nombreEjercicio"]=="") 
			$errores[] = "<p>El nombre del ejercicio no puede estar vacío</p>";
		

		if($nuevoEjercicio["descripcion"]=="") 
			$errores[] = "<p>El descripcion no puede estar vacío</p>";
		
	
		return $errores;
	}

?>

