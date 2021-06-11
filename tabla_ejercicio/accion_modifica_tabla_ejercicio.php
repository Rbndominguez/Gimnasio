<?php	
	session_start();	
	
	if (isset($_SESSION["tablaEjercicio"])) {
		$tablaEjercicioModificada["oid_te"] = $_POST["oid_te"];
		$tablaEjercicioModificada["nombreTablaE"] = $_POST["nombreTablaE"];
		$tablaEjercicioModificada["descripcion"] = $_POST["descripcion"];
		$tablaEjercicioModificada["duracion"] = $_POST["duracion"];
		$tablaEjercicioModificada["recuperacion"] = $_POST["recuperacion"];
		
		$_SESSION["tablaEjercicio"] = $tablaEjercicioModificada;
		
		require_once("../gestionBD.php");
		require_once("gestionTablaEjercicio.php");
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		$conexion = crearConexionBD();
		// INVOCAR "MODIFICAR_TITULO"
		$resultado = modifica_tabla_ejercicio($conexion, $tablaEjercicioModificada);
		// CERRAR LA CONEXIÓN
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_tablas_ejercicios.php";
			header("Location: ../excepcion.php");
		}
		
		else {
			header("Location: muestra_tabla_ejercicio.php");
		}
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		header("Location: consulta_tablas_ejercicios.php");

?>