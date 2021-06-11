<?php	
	session_start();
	
	if (isset($_POST["oid_sm"])) {
		$salario["oid_sm"] = $_POST["oid_sm"];
		$salario["cantidad"] = $_POST["cantidad"];
		$salario["fecha"] = $_POST["fecha"];
		$salario["dniMonitor"] = $_POST["dniMonitor"];
		
		$_SESSION["salario"] = $salario;
			
		if (isset($_POST["editar"])) 
			header("Location: form_modifica_salario.php"); 
		if (isset($_POST["borrar"])) 
			header("Location: accion_borrar_salario.php"); 
	}
	else 
		header("Location: consulta_salarios.php");
	
?>
