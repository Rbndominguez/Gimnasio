<?php
	
	session_start();
	
	//Importar la librería de la conexión a BD y la del crud de usuarios
	require_once("../gestionBD.php");
	require_once("gestionComidas.php");
	
	if(isset($_SESSION["form_crea_comida"])){
		$nuevaComida = $_SESSION["form_crea_comida"];
		unset($_SESSION["form_crea_comida"]);
		unset($_SESSION["errores"]);
	}
	else header("Location: form_crea_comida.php");
	
	//Abrir la conexión con la base de datos
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro de comida realizado con éxito</title>
</head>

<body>
	<?php
	//include_once("index.php");
	?>
	
	<main>
		<?php 
		//Invocar a la funcion de crea comida
		if(crea_comida($conexion, $nuevaComida)){
		?>
		<!--Mensaje de exito-->
		<div id="div_exito">
			<h1>Se ha registrado correctamente la comida: <?php echo $nuevaComida["nombreComida"]; ?></h1>
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
			<h1>Se ha producido un error al registrar la comida</h1>
		</div>	
		<div id="div_volver">
			<h1>Pulsa <a href="form_crea_comida.php">aquí</a> para volver al formulario.</h1>
		</div>
		<?php } ?>
	</main>
</body>	
</html>
<?php
	//Desconectar la base de datos
	cerrarConexionBD($conexion);
?>