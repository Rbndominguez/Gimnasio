<?php	
	session_start();
	
	if (isset($_POST["oid_e"])) {
		$ejercicio["oid_e"] = $_POST["oid_e"];
		$ejercicio["nombreEjercicio"] = $_POST["nombreEjercicio"];
		$ejercicio["descripcion"] = $_POST["descripcion"];
		$ejercicio["repeticiones"] = $_POST["repeticiones"];
		$ejercicio["duracion"] = $_POST["duracion"];
		$ejercicio["series"] = $_POST["series"];
		
		$_SESSION["ejercicio"] = $ejercicio;
			
		if (isset($_POST["editar"])) 
			Header("Location: form_modifica_ejercicio.php"); 
		if (isset($_POST["borrar"])) 
			Header("Location: accion_borrar_ejercicio.php"); 
	}
	else 
		Header("Location: consulta_ejercicios.php");
	
?>
