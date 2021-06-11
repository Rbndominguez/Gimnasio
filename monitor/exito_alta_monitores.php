<?php
	
	session_start();
	
	//Importar la librería de la conexión a BD y la del crud de usuarios
	require_once("../gestionBD.php");
	require_once("gestionMonitores.php");
	
	// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL FORMULARIO YA VALIDADOS
	// RECOGER LOS DATOS Y ANULAR LOS DATOS DE SESIÓN (FORMULARIO Y ERRORES)
	// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
	
	if(isset($_SESSION["form_alta_monitor"])){
		$monitor = $_SESSION["form_alta_monitor"];
		unset($_SESSION["form_alta_monitor"]);
		unset($_SESSION["errores"]);
	}
	else header("Location: form_alta_monitor.php");
	
	//Abrir la conexión con la base de datos
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Alta de monitor realizada con éxito</title>
</head>

<body>
	<?php
	//include_once("index.php");
	?>
	
	<main>
		<?php 
		//Invocar a la funcion de alta monitor
		if(alta_monitor($conexion, $monitor)){
		?>
		<!--Mensaje de bienvendia-->
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
//Desconectar la base de datos
cerrarConexionBD($conexion);
?>