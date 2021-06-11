<?php	
	session_start();
	
	if (isset($_POST["dniMonitor"])) {
		$monitor["dniMonitor"] = $_POST["dniMonitor"];
		$monitor["nombre"] = $_POST["nombre"];
		$monitor["apellidos"] = $_POST["apellidos"];
		$monitor["telefono"] = $_POST["telefono"];
		$monitor["estaActivo"] = $_POST["estaActivo"];
		$monitor["fechaContratacion"] = $_POST["fechaContratacion"];
		$monitor["fechaFin"] = $_POST["fechaFin"];
		
		$_SESSION["monitor"] = $monitor;
		
		if (isset($_POST["mostrar"])) 
			header("Location: muestra_monitor.php");
		if (isset($_POST["editar"])) 
			header("Location: form_modifica_monitor.php"); 
		if (isset($_POST["borrar"])) 
			header("Location: accion_borrar_monitor.php"); 
		if (isset($_POST["darBaja"]))
			header("Location: accion_dar_baja_monitor.php");
		if (isset($_POST["darAlta"]))
			header("Location: accion_dar_alta_monitor.php");
	}
	else 
		header("Location: consulta_monitores.php");
	
?>
