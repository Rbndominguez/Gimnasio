<?php
	
	session_start();
	

	require_once("../gestionBD.php");
	require_once("gestionTablaEjercicio.php");
	
	if(isset($_SESSION["form_tabla_ejercicio"])){
		$tablaEjercicio = $_SESSION["form_tabla_ejercicio"];
		unset($_SESSION["form_tabla_ejercicio"]);
		unset($_SESSION["errores"]);
	}
	else header("Location: form_tabla_ejercicio.php");
	
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tabla de ejercicios creada con éxito</title>
</head>

<body>

	
	<main>
		<?php 

			if(crea_tabla_ejercicio($conexion, $tablaEjercicio)){
		?>

			<div id="div_exito">
				<h1>Se ha registrado correctamente la tabla de ejercicio: <?php echo $tablaEjercicio["nombreTablaE"]; ?></h1>
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
					<h1>Se ha producido un error al registrar la tabla de ejercicio.</h1>
				</div>	
				<div id="div_volver">
					<h1>Pulsa <a href="form_crea_tabla_ejercicio.php">aquí</a> para volver al formulario.</h1>
				</div>
			<?php } ?>
	</main>
	
</body>	
</html>
<?php
	cerrarConexionBD($conexion);
?>