<?php
	session_start();
	
	if (isset($_SESSION["dieta"])) {
		
		$comidaActual = $_SESSION["comidaActual"];
		unset($_SESSION["comidaActual"]);
		$dieta = $_SESSION["dieta"];
	
		require_once ("../gestionBD.php");
		require_once ("gestionDietas.php");
	
		$conexion = crearConexionBD();
		$resultado = elimina_linea_comidas($conexion, $dieta, $comidaActual);
		cerrarConexionBD($conexion);
	
		if ($resultado <> true) {
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_dietas.php";
			header("Location: ../excepcion.php");
		}
		else {
			header("Location: muestra_dieta.php");
		}
	} else// Se ha tratado de acceder directamente a este PHP
		header("Location: consulta_dietas.php");
?>
