<?php	
	session_start();	
	
	if (isset($_SESSION["comida"])) {
		$comidaModificada["oid_c"]=$_POST["oid_c"];
		$comidaModificada["nombreComida"] = $_POST["nombreComida"];
		$comidaModificada["descripcion"] = $_POST["descripcion"];
		
		$_SESSION["comida"] = $comidaModificada;
		
		require_once("../gestionBD.php");
		require_once("gestionComidas.php");
		
		$conexion = crearConexionBD();
		$resultado = modifica_comida($conexion, $comidaModificada);
		cerrarConexionBD($conexion);
		
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_comidas.php";
			header("Location: excepcion.php");
		}
		
		else {
			echo '<script language="javascript">
				function cierraPopup(){
    				window.close(); 
				}
  				function modificado(){
  					opener.location.reload();
					document.open();
					document.write("<h1>La comida ha sido modificada con éxito</h1>");
 					window.setTimeout("cierraPopup()", 1500);
				}
				modificado();
			</script>';
		}
	} 
	else // Se ha tratado de acceder directamente a este PHP 
		header("Location: consulta_comidas.php");

?>
