<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionSalarios.php");
		
	if(isset($_SESSION["form_crea_salario"])) {
		$nuevoSalario = $_SESSION["form_crea_salario"];
		unset($_SESSION["form_crea_salario"]);
		unset($_SESSION["errores"]);
	}
	else header("Location:form_crea_salario.php");
	
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Salario creado con éxito</title>
</head>

<body>
	<main>
		<?php 
		//Invocar a la funcion de crea clase
			if(crea_salarios($conexion, $nuevoSalario)){
		?>
			<!--Mensaje de bienvenida-->
			<div id="div_exito">
			<?php $fechaMsg = date('d/m/Y', strtotime($nuevoSalario["fecha"]));?>
				<h1>Se ha registrado correctamente el salario de <?php echo $nuevoSalario['cantidad']?> a 
					<?php echo $nuevoSalario['dniMonitor']?>, a fecha de <?php echo $fechaMsg?></h1>
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
				<h1>Se ha producido un error al registrar el salario</h1>
			</div>
			<div id="div_volver">
				<h1>Pulsa <a href="form_crea_salario.php">aquí</a> para volver al formulario.</h1>
			</div>
		<?php } ?>
		
	</main>
	
</body>
</html>
<?php
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conexion);
?>

