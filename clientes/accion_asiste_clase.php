<?php
	session_start();
	
	if (isset($_SESSION["cliente"])) {
		$oid_cl = $_POST["oid_cl"];
	
		$cliente = $_SESSION["cliente"];
	
		require_once ("../gestionBD.php");
		require_once ("gestionarClientes.php");
	
		$conexion = crearConexionBD();
		$resultado = crea_asiste_a($conexion, $cliente, $oid_cl);
		cerrarConexionBD($conexion);
	
		if ($resultado <> true) {
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_clientes.php";
			header("Location: ../excepcion.php");
		}
		else {
			header("Location: muestra_cliente.php");
		}
	} else// Se ha tratado de acceder directamente a este PHP
		header("Location: consulta_clientes.php");
?>
