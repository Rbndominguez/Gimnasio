<?php
	session_start();
	
	if (isset($_SESSION["cliente"])) {
		$oid_di = $_POST["oid_di"];
	
		$cliente = $_SESSION["cliente"];
	
		require_once ("../gestionBD.php");
		require_once ("gestionarClientes.php");
	
		$conexion = crearConexionBD();
		$resultado = asignar_dieta_cliente($conexion, $cliente, $oid_di);
		cerrarConexionBD($conexion);
	
		if ($resultado <> true) {
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_clientes.php";
			header("Location: ../excepcion.php");
		}
		else {
			$cliente["oid_di"] = $oid_di;
			$_SESSION["cliente"] = $cliente;
			header("Location: muestra_cliente.php");
		}
	} else
		header("Location: consulta_clientes.php");
?>
