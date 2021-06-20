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
		

		$conexion = crearConexionBD();

		$resultado = modifica_dieta($conexion, $dietaModificada);

		cerrarConexionBD($conexion);
		

		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_dietas.php";
			header("Location: ../excepcion.php");
		}
		
		else {
			header("Location: muestra_dieta.php");
		}
	} 
	else 
		header("Location: consulta_dietas.php");
	
?>