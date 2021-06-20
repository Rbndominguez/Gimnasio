<?php	
	session_start();	
	
	if (isset($_SESSION["cliente"])) {
		$cliente = $_SESSION["cliente"];
		unset($_SESSION["cliente"]);
		
		require_once("../gestionBD.php");
		require_once("gestionarClientes.php");
		

		$conexion = crearConexionBD();

		$resultado = elimina_cliente($conexion, $cliente);

		cerrarConexionBD($conexion);

		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_clientes.php";
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
 					w.document.write("<h1>El cliente ha sido eliminado con éxito</h1>");
 					w.setTimeout("cierraPopup()", 1500);
				}
				borrado();
			</script>';
		}

	}
	else 
		header("Location: consulta_clientes.php"); 
?>
