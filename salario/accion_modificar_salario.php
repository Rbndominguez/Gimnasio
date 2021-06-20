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
		

		$conexion = crearConexionBD();

		$resultado = modifica_salarios($conexion, $salarioModificado);
	
		cerrarConexionBD($conexion);
		
	
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
	else 
		header("Location: consulta_salarios.php");

?>