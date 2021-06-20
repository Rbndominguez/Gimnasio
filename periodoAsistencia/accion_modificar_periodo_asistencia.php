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
		
		$conexion = crearConexionBD();
		$resultado = modifica_periodo_asistencia($conexion, $periodoAsistenciaModificado);

		cerrarConexionBD($conexion);

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
	else 
		header("Location: consulta_periodos_asistencias.php");

?>
