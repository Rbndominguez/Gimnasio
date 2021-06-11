<?php	
	session_start();	
	
	if (isset($_SESSION["cliente"])) {
		$cliente = $_SESSION["cliente"];
		unset($_SESSION["cliente"]);
		
		require_once("../gestionBD.php");
		require_once("gestionarClientes.php");
		
		$conexion = crearConexionBD();
		$resultado = vuelve_dar_alta_cliente($conexion, $cliente);
		cerrarConexionBD($conexion);
		
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Dando alta cliente</title>
</head>

<body>

<main>
	<?php
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_clientes.php";
			header("Location: ../excepcion.php");
		}
		// EN OTRO CASO, VOLVER A "MUESTRA_CLIENTE.PHP"
		else { ?>
			<script language="javascript">
  				function cierraPopup(){
    				window.close(); 
				}
	
				function alta(){	
					opener.location.reload();
 					document.open();
 					document.write("<h1>El cliente ha sido dado de alta con éxito</h1>");
 					window.setTimeout("cierraPopup()", 1500);
				}
				alta();
			</script>
		<?php }

	}
	else // Se ha tratado de acceder directamente a este PHP 
		Header("Location: consulta_clientes.php"); 
?>

</main>

</body>
</html>
