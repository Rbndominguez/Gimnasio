<?php	
	session_start();
	
	if (isset($_POST["oid_di"])) {
		$dieta["oid_di"] = $_POST["oid_di"];
		$dieta["nombreDieta"] = $_POST["nombreDieta"];
		$dieta["descripcion"] = $_POST["descripcion"];
		$dieta["duracion"] = $_POST["duracion"];
		
		$comidaActual = $_POST["oid_c"];
		
		$_SESSION["dieta"] = $dieta;
		$_SESSION["comidaActual"] = $comidaActual;
			
		if (isset($_POST["mostrar"])) 
			header("Location: muestra_dieta.php");	
		if (isset($_POST["editar"])) 
			header("Location: form_modifica_dieta.php"); 
		if (isset($_POST["borrar"])) 
			header("Location: accion_borrar_dieta.php"); 
		if (isset($_POST["añadir"])) 
			header("Location: busqueda_anadir_comida.php"); 
		if (isset($_POST["quitar"])) 
			header("Location: accion_quitar_comida.php"); 
	}
	else 
		header("Location: consulta_dietas.php");
	
?>