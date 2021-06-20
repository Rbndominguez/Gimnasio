<?php	
	session_start();	
	
	if (isset($_SESSION["ejercicio"])) {
		$ejercicio = $_SESSION["ejercicio"];
		unset($_SESSION["ejercicio"]);
		
		require_once("../gestionBD.php");
		require_once("gestionEjercicios.php");
		

		$conexion = crearConexionBD();

		$resultado = elimina_ejercicios($conexion, $ejercicio); 

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
	
				function borrado(){	
					opener.location.reload();
 					var w=window.open("", "popup", "toolbar=0 , location=0 , status=0 , menubar=0 , scrollbars=0 , resizable=1 ,left=300em,top=150em,width=800em,height=400em");
 					w.document.open();
 					w.document.write("<h1>El ejercicio ha sido eliminado con éxito</h1>");
 					w.setTimeout("cierraPopup()", 1500);
				}
				borrado();
			</script>';
		}
	}
	else 
		header("Location: consulta_ejercicios.php"); 
?>
