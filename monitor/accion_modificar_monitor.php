<?php	
	session_start();	
	
	if (isset($_SESSION["monitor"])) {
		$monitorModificado["dniMonitor"] = $_POST["dniMonitor"];
		$monitorModificado["nombre"] = $_POST["nombre"];
		$monitorModificado["apellidos"] = $_POST["apellidos"];
		$monitorModificado["telefono"] = $_POST["telefono"];
		$monitorModificado["estaActivo"] = $_POST["estaActivo"];
		$monitorModificado["fechaContratacion"] = $_POST["fechaContratacion"];
		$monitorModificado["fechaFin"] = $_POST["fechaFin"];
		
		$_SESSION["monitor"] = $monitorModificado;
		
		require_once("../gestionBD.php");
		require_once("gestionMonitores.php");
		

		$conexion = crearConexionBD();
	
		$resultado = modifica_monitor($conexion, $monitorModificado);
	
		cerrarConexionBD($conexion);
		
	
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_monitores.php";
			header("Location: ../excepcion.php");
		}
		
		else {
			header("Location: muestra_monitor.php");
		}
	} 
	else 
		header("Location: consulta_monitores.php");

?>
