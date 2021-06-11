<?php	
	session_start();
	
	if (isset($_POST["oid_te"])) {
		$tablaEjercicio["oid_te"] = $_POST["oid_te"];
		$tablaEjercicio["nombreTablaE"] = $_POST["nombreTablaE"];
		$tablaEjercicio["descripcion"] = $_POST["descripcion"];
		$tablaEjercicio["duracion"] = $_POST["duracion"];
		$tablaEjercicio["recuperacion"] = $_POST["recuperacion"];
		
		$ejercicioActual = $_POST["oid_e"];
		
		$_SESSION["tablaEjercicio"] = $tablaEjercicio;
		$_SESSION["ejercicioActual"] = $ejercicioActual;
		
		if (isset($_POST["mostrar"])) 
			header("Location: muestra_tabla_ejercicio.php");	
		if (isset($_POST["editar"])) 
			header("Location: form_modifica_tabla_ejercicio.php"); 
		if (isset($_POST["borrar"])) 
			header("Location: accion_borrar_tabla_ejercicio.php"); 
		if (isset($_POST["añadir"])) 
			header("Location: busqueda_anadir_ejercicio.php"); 
		if (isset($_POST["quitar"])) 
			header("Location: accion_quitar_ejercicio.php"); 
	}
	else 
		header("Location: consulta_tablas_ejercicios.php");
	
?>
