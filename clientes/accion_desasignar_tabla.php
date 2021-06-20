<?php
	session_start();
	
	if (isset($_SESSION["cliente"])) {
	
		$cliente = $_SESSION["cliente"];
	
		require_once ("../gestionBD.php");
		require_once ("gestionarClientes.php");
	
		$conexion = crearConexionBD();
		$resultado = desasignar_tablaEjercicios_cliente($conexion, $cliente);
		cerrarConexionBD($conexion);
	
		if ($resultado <> true) {
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_clientes.php";
			header("Location: ../excepcion.php");
		}
		else {
			$cliente["oid_te"] = NULL;
			$_SESSION["cliente"] = $cliente;
			header("Location: muestra_cliente.php");
		}
	} else
		header("Location: consulta_clientes.php");
?>
