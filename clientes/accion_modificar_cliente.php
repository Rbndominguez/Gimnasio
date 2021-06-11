<?php	
	session_start();	
	
	if (isset($_SESSION["cliente"])) {
		$clienteModificado["nombre"] = $_POST["nombre"];
		$clienteModificado["apellidos"] = $_POST["apellidos"];
		$clienteModificado["dni"] = $_POST["dni"];
		$clienteModificado["direccion"] = $_POST["direccion"];
		$clienteModificado["codigoPostal"] = $_POST["codigoPostal"];
		$clienteModificado["email"] = $_POST["email"];
		$clienteModificado["telefono"] = $_POST["telefono"];
		$clienteModificado["lesiones"] = $_POST["lesiones"];
		$clienteModificado["esEstudiante"] = $_POST["esEstudiante"];
		$clienteModificado["entrenamientoPersonal"] = $_POST["entrenamientoPersonal"];
		$clienteModificado["estaBaja"] = $_POST["estaBaja"];
		$clienteModificado["oid_te"] = $_POST["oid_te"];
		$clienteModificado["oid_di"] = $_POST["oid_di"];
	
		$_SESSION["cliente"] = $clienteModificado;
		
		require_once("../gestionBD.php");
		require_once("gestionarClientes.php");
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		$conexion = crearConexionBD();
		// INVOCAR "MODIFICA_CLIENTE"
		$resultado = modifica_cliente($conexion, $clienteModificado);
		// CERRAR LA CONEXIÓN
		cerrarConexionBD($conexion);
	
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_clientes.php";
			header("Location: ../excepcion.php");
		}
		// // EN OTRO CASO, VOLVER A "CONSULTA_CLIENTES.PHP"
		else {
			header("Location: muestra_cliente.php");
		}
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		header("Location: consulta_clientes.php");

?>


