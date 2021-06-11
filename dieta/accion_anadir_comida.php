<?php
	session_start();
	
	if (isset($_SESSION["dieta"])) {
		$oid_c = $_POST["oid_c"];
		$dia = $_POST["dia"];
		$hora= $_POST["hora"];
	
		$dieta = $_SESSION["dieta"];
	
		require_once ("../gestionBD.php");
		require_once ("gestionDietas.php");
	
		$conexion = crearConexionBD();
		$resultado = crea_linea_comidas($conexion, $dieta, $dia, $hora, $oid_c);
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
