<?php	
	session_start();	
	
	if (isset($_SESSION["monitor"])) {
		$monitor = $_SESSION["monitor"];
		
		require_once("../gestionBD.php");
		require_once("gestionMonitores.php");
		
		$conexion = crearConexionBD();
		$resultado = vuelve_dar_alta_monitor($conexion, $monitor);
		cerrarConexionBD($conexion);
		
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Dando alta monitor</title>
</head>

<body>

<main>
	<?php
		// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "consulta_monitores.php";
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
 					document.write("<h1>El monitor ha sido dado de alta con éxito</h1>");
 					window.setTimeout("cierraPopup()", 1500);
				}
				alta();
			</script>
		<?php }

	}
	else // Se ha tratado de acceder directamente a este PHP 
		Header("Location: consulta_monitores.php"); 
?>

</main>

</body>
</html>
