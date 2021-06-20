<?php
	
	session_start();
	

	require_once("../gestionBD.php");
	require_once("gestionMonitores.php");

	
	if(isset($_SESSION["form_alta_monitor"])){
		$monitor = $_SESSION["form_alta_monitor"];
		unset($_SESSION["form_alta_monitor"]);
		unset($_SESSION["errores"]);
	}
	else header("Location: form_alta_monitor.php");
	

	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Alta de monitor realizada con éxito</title>
</head>

<body>
	
	<main>
		<?php 

		if(alta_monitor($conexion, $monitor)){
		?>

		<div id="div_exito">
			<h1>Se ha registrado correctamente al monitor: <?php echo $monitor["apellidos"] . ", " . $monitor["nombre"]; ?></h1>
			<script language="javascript"> 
				function cierraPopup(){
    				opener.location.reload(); 
					window.close(); 
				}
				function retardo(){ 
					window.setTimeout("cierraPopup()", 3000); 	
   				}
   				retardo();
  			</script>
		</div>
		<?php } else { ?>
			<div id="div_error_registro">
				<h1>Se ha producido un error al registrar el monitor</h1>
			</div>	
			<div id="div_volver">
				<h1>Pulsa <a href="form_alta_monitor.php">aquí</a> para volver al formulario.</h1>
			</div>
		<?php } ?>
		
	</main>
</body>	
</html>
<?php

cerrarConexionBD($conexion);
?>