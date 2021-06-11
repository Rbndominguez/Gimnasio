<?php	
	session_start();	
	
	if (isset($_SESSION["salario"])) {
		$salarioModificado["oid_sm"] = $_POST["oid_sm"];
		$salarioModificado["cantidad"] = $_POST["cantidad"];
		$salarioModificado["fecha"] = $_POST["fecha"];
		$salarioModificado["dniMonitor"] = $_POST["dniMonitor"];
		
		$_SESSION["salario"] = $salarioModificado;
		
		require_once("../gestionBD.php");
		require_once("gestionSalarios.php");
		
		// CREAR LA CONEXIÓN A LA BASE DE DATOS
		$conexion = crearConexionBD();
		// INVOCAR "MODIFICAR_TITULO"
		$resultado = modifica_salarios($conexion, $salarioModificado);
		// CERRAR LA CONEXIÓN
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_salarios.php";
			header("Location: ../excepcion.php");
		}
		
		else {
			echo '<script language="javascript">
				function cierraPopup(){
    				window.close(); 
				}
  				function modificado(){
  					opener.location.reload();
					document.open();
					document.write("<h1>El salario ha sido modificado con éxito</h1>");
 					window.setTimeout("cierraPopup()", 1500);
				}
				modificado();
			</script>';
		}
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		header("Location: consulta_salarios.php");

?>