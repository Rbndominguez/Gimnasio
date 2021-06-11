<?php	
	session_start();	
	
	if (isset($_SESSION["periodoAsistencia"])) {
		$periodoAsistenciaModificado["oid_pasis"]=$_POST["oid_pasis"];
		$periodoAsistenciaModificado["fechaInicio"] = $_POST["fechaInicio"];
		$periodoAsistenciaModificado["fechaFin"] = $_POST["fechaFin"];
		$periodoAsistenciaModificado["numeroDias"] = $_POST["numeroDias"];
		$periodoAsistenciaModificado["dni"] = $_POST["dni"];
		$periodoAsistenciaModificado["nombre"] = $_POST["nombre"];
		$periodoAsistenciaModificado["apellidos"] = $_POST["apellidos"];
		
		$_SESSION["periodoAsistencia"] = $periodoAsistenciaModificado;
		
		require_once("../gestionBD.php");
		require_once("gestionPeriodosAsistencia.php");
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		$conexion = crearConexionBD();
		$resultado = modifica_periodo_asistencia($conexion, $periodoAsistenciaModificado);
		// CERRAR LA CONEXIÓN
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_periodos_asistencias.php";
			header("Location: excepcion.php");
		}
		
		else {
			$numeroDias = getNumDias($conexion, $periodoAsistenciaModificado["oid_pasis"]);
			$periodoAsistenciaModificado["numeroDias"] = $numeroDias;
			$_SESSION["periodoAsistencia"] = $periodoAsistenciaModificado;
			header("Location: muestra_periodo_asistencia.php");
		}
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		header("Location: consulta_periodos_asistencias.php");

?>
