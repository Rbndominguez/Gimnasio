<?php
	
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionDietas.php");
	

	
	if(isset($_SESSION["form_crea_dieta"])){
		$nuevaDieta = $_SESSION["form_crea_dieta"];
		unset($_SESSION["form_crea_dieta"]);
		unset($_SESSION["errores"]);
	}
	else header("Location: form_crea_dieta.php");
	
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro de dieta realizado con éxito</title>
</head>

<body>
	<?php

	?>
	
	<main>
		<?php 

			if(crea_dieta($conexion, $nuevaDieta)){
		?>
			<div id="div_exito">
				<h1>Se ha registrado correctamente la dieta: <?php echo $nuevaDieta["nombreDieta"]; ?></h1>
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
				<h1>Se ha producido un error al registrar la dieta</h1>
			</div>
			<div id="div_volver">
				<h1>Pulsa <a href="form_crea_dieta.php">aquí</a> para volver al formulario.</h1>
			</div>
		<?php } ?>
			
	</main>
	
</body>	
</html>
<?php
	cerrarConexionBD($conexion);
?>