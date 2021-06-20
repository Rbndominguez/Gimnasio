<?php	
	session_start();	
	
	if (isset($_SESSION["ejercicio"])) {
		$ejercicioModificado["oid_e"] = $_POST["oid_e"];
		$ejercicioModificado["nombreEjercicio"] = $_POST["nombreEjercicio"];
		$ejercicioModificado["descripcion"] = $_POST["descripcion"];
		$ejercicioModificado["repeticiones"] = $_POST["repeticiones"];
		$ejercicioModificado["duracion"] = $_POST["duracion"];
		$ejercicioModificado["series"] = $_POST["series"];
		
		$_SESSION["ejercicio"] = $ejercicioModificado;
		
		require_once("../gestionBD.php");
		require_once("gestionEjercicios.php");
		

		$conexion = crearConexionBD();

		$resultado = modifica_ejercicios($conexion, $ejercicioModificado);

		cerrarConexionBD($conexion);
		

		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_ejercicios.php";
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
					document.write("<h1>El ejercicio ha sido modificado con éxito</h1>");
 					window.setTimeout("cierraPopup()", 1500);
				}
				modificado();
			</script>';
		}
	} 
	else 
		header("Location: consulta_ejercicios.php");

?>