<?php
	session_start();
	
	if (isset($_SESSION["cliente"])) {
		$oid_te = $_POST["oid_te"];
	
		$cliente = $_SESSION["cliente"];
	
		require_once ("../gestionBD.php");
		require_once ("gestionarClientes.php");
	
		$conexion = crearConexionBD();
		$resultado = asignar_tablaEjercicios_cliente($conexion, $cliente, $oid_te);
		cerrarConexionBD($conexion);
	
		if ($resultado <> true) {
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_clientes.php";
			header("Location: ../excepcion.php");
		}
		else {
			$cliente["oid_te"] = $oid_te;
			$_SESSION["cliente"] = $cliente;
			header("Location: muestra_cliente.php");
		}
	} else// Se ha tratado de acceder directamente a este PHP
		header("Location: consulta_clientes.php");
?>
