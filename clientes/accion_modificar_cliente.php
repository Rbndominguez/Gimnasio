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
		

		$conexion = crearConexionBD();

		$resultado = modifica_cliente($conexion, $clienteModificado);

		cerrarConexionBD($conexion);
	

		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_clientes.php";
			header("Location: ../excepcion.php");
		}

		else {
			header("Location: muestra_cliente.php");
		}
	} 
	else 
		header("Location: consulta_clientes.php");

?>


