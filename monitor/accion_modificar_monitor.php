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
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		$conexion = crearConexionBD();
		// INVOCAR "MODIFICAR_TITULO"
		$resultado = modifica_monitor($conexion, $monitorModificado);
		// CERRAR LA CONEXIÓN
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_monitores.php";
			header("Location: ../excepcion.php");
		}
		
		else {
			header("Location: muestra_monitor.php");
		}
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		header("Location: consulta_monitores.php");

?>
