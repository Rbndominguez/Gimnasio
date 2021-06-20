<?php
	session_start();
		
	require_once ("../gestionBD.php");
	require_once ("gestionEjercicios.php");
	
	if (isset($_SESSION["form_crea_ejercicio"])) {
		$nuevoEjercicio = $_SESSION["form_crea_ejercicio"];
		unset($_SESSION["form_crea_ejercicio"]);
		unset($_SESSION["errores"]);
	} else
		header("Location:form_crea_ejercicio.php");
	
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Creación de Ejercicio realizada con éxito</title>
</head>

<body>

	<main>
			<?php
				if(crea_ejercicios($conexion,$nuevoEjercicio)) {
			?>
			<div id="div_exito">
				<h1>El ejercicio "<?php echo $nuevoEjercicio["nombreEjercicio"]; ?>" ha sido creado con éxito</h1>
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
				<h1>Se ha producido un error al registrar el ejercicio</h1>
			</div>
			<div id="div_volver">
				<h1>Pulsa <a href="form_crea_ejercicio.php">aquí</a> para volver al formulario.</h1>
			</div>
			<?php } ?>
			
		</main>
</body>
</html>
<?php

	cerrarConexionBD($conexion);
?>

