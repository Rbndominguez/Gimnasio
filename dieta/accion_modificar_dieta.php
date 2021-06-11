<?php	
	session_start();	
	
	if (isset($_SESSION["dieta"])) {
		$dietaModificada["oid_di"] = $_POST["oid_di"];
		$dietaModificada["nombreDieta"] = $_POST["nombreDieta"];
		$dietaModificada["descripcion"] = $_POST["descripcion"];
		$dietaModificada["duracion"] = $_POST["duracion"];

		$_SESSION["dieta"] = $dietaModificada;
		
		require_once("../gestionBD.php");
		require_once("gestionDietas.php");
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		$conexion = crearConexionBD();
		// INVOCAR "MODIFICAR_TITULO"
		$resultado = modifica_dieta($conexion, $dietaModificada);
		// CERRAR LA CONEXIÓN
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_dietas.php";
			header("Location: ../excepcion.php");
		}
		
		else {
			header("Location: muestra_dieta.php");
		}
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		header("Location: consulta_dietas.php");
	
?>