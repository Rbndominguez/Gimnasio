<?php
	
	session_start();
	

	require_once("../gestionBD.php");
	require_once("gestionPeriodosAsistencia.php");
	

	
	if(isset($_SESSION["form_crea_periodo_asistencia"])){
		$nuevoPeriodoAsistencia = $_SESSION["form_crea_periodo_asistencia"];
		unset($_SESSION["form_crea_periodo_asistencia"]);
		unset($_SESSION["errores"]);
	}
	else Header("Location: form_crea_periodo_asistencia.php");
	

	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro de periodo de asistencia realizado con éxito</title>
</head>

<body>
	<?php

	?>
	
	<main>
		<?php 

		if(crea_periodo_asistencia($conexion, $nuevoPeriodoAsistencia)){
		?>

		<div id="div_exito">
			<h1>Se ha registrado correctamente el periodo de asistencia con fecha de inicio: <?php echo $nuevoPeriodoAsistencia["fechaInicio"]; ?></h1>
			<script language="javascript"> 
						function cierraPopup(){
	    					opener.location.reload(); 
							window.close(); 
						}
						function retardo(){ 
							window.setTimeout("cierraPopup()", 2000); 	
	   					}
	   					retardo();
	  				 </script>
		</div>
		<?php } else { ?>
		<div id="div_error_registro">
			<h1>Se ha producido un error al registrar el periodo de asistencia</h1>
		</div>	
		<div id="div_volver">
			<h1>Pulsa <a href="form_crea_periodo_asistencia.php">aquí</a> para volver al formulario.</h1>
		</div>
		<?php } ?>
	</main>
	
</body>	
</html>
<?php

cerrarConexionBD($conexion);
?>