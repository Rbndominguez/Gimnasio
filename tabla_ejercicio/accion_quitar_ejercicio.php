<?php
	session_start();
	
	if (isset($_SESSION["tablaEjercicio"])) {
		
		$ejercicioActual = $_SESSION["ejercicioActual"];
		unset($_SESSION["ejercicioActual"]);
		$tablaEjercicio = $_SESSION["tablaEjercicio"];

		require_once ("../gestionBD.php");
		require_once ("gestionTablaEjercicio.php");
	
		$conexion = crearConexionBD();
		$resultado = elimina_linea_ejercicios($conexion, $tablaEjercicio, $ejercicioActual);
		cerrarConexionBD($conexion);
	
		if ($resultado <> true) {
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_tablas_ejercicios.php";
			header("Location: ../excepcion.php");
		}
		else {
			header("Location: muestra_tabla_ejercicio.php");
		}
	} else// Se ha tratado de acceder directamente a este PHP
		header("Location: consulta_tablas_ejercicios.php");
?>
