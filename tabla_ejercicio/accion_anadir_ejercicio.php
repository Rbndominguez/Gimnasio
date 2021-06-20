<?php
	session_start();
	
	if (isset($_SESSION["tablaEjercicio"])) {
		$oid_e = $_POST["oid_e"];
		$numOrden = $_POST["numOrden"];
	
		$tablaEjercicio = $_SESSION["tablaEjercicio"];
	
		require_once ("../gestionBD.php");
		require_once ("gestionTablaEjercicio.php");
	
		$conexion = crearConexionBD();
		$resultado = crea_linea_ejercicios($conexion, $tablaEjercicio, $numOrden, $oid_e);
		cerrarConexionBD($conexion);
	
		if ($resultado <> true) {
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_tablas_ejercicios.php";
			header("Location: ../excepcion.php");
		}
		else {
			header("Location: muestra_tabla_ejercicio.php");
		}
	} else
		header("Location: consulta_tablas_ejercicios.php");
?>
