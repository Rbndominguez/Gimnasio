<?php	
	session_start();
	
	if (isset($_POST["dni"])) {
		$clase["oid_cl"] = $_POST["oid_cl"];
		$clase["nombreClase"] = $_POST["nombreClase"];
		$clase["horario"] = $_POST["horario"];
		$clase["dniMonitor"] = $_POST["dniMonitor"];
		$clase["sala"] = $_POST["sala"];
		
		$cliente["nombre"] = $_POST["nombre"];
		$cliente["apellidos"] = $_POST["apellidos"];
		$cliente["dni"] = $_POST["dni"];
		$cliente["direccion"] = $_POST["direccion"];
		$cliente["codigoPostal"] = $_POST["codigoPostal"];
		$cliente["email"] = $_POST["email"];
		$cliente["telefono"] = $_POST["telefono"];
		$cliente["lesiones"] = $_POST["lesiones"];
		$cliente["esEstudiante"] = $_POST["esEstudiante"];
		$cliente["entrenamientoPersonal"] = $_POST["entrenamientoPersonal"];
		$cliente["estaBaja"] = $_POST["estaBaja"];
		$cliente["oid_te"] = $_POST["oid_te"];
		$cliente["oid_di"] = $_POST["oid_di"];
			
		$_SESSION["cliente"] = $cliente;
		$_SESSION["clase"] = $clase;
			
		if (isset($_POST["mostrar"])) 
			header("Location: muestra_cliente.php");
		if (isset($_POST["editar"])) 
			header("Location: form_modifica_cliente.php"); 
		if (isset($_POST["borrar"]))
			header("Location: accion_borrar_cliente.php");
		if (isset($_POST["asignarTE"]))
			header("Location: busqueda_asignar_tabla.php");
		if (isset($_POST["quitarTE"]))
			header("Location: accion_desasignar_tabla.php");
		if (isset($_POST["asignarDI"]))
			header("Location: busqueda_asignar_dieta.php");
		if (isset($_POST["quitarDI"]))
			header("Location: accion_desasignar_dieta.php");
		if (isset($_POST["asisteClase"]))
			header("Location: busqueda_asiste_clase.php");
		if (isset($_POST["quitarClase"]))
			header("Location: accion_quitar_clase.php");
		if (isset($_POST["mostrarClase"]))
			header("Location: ../clase/muestra_clase.php");
		if (isset($_POST["darBaja"]))
			header("Location: accion_dar_baja_cliente.php");
		if (isset($_POST["darAlta"]))
			header("Location: accion_dar_alta_cliente.php");

	}
	else 
		header("Location: consulta_clientes.php");
	
?>
