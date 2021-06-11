<?php
	
	session_start();
	
	//Importar la librería de la conexión a BD y la del crud de usuarios
	require_once("../gestionBD.php");
	require_once("gestionTablaEjercicio.php");
	
	// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL FORMULARIO YA VALIDADOS
	// RECOGER LOS DATOS Y ANULAR LOS DATOS DE SESIÓN (FORMULARIO Y ERRORES)
	// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
	
	if(isset($_SESSION["form_tabla_ejercicio"])){
		$tablaEjercicio = $_SESSION["form_tabla_ejercicio"];
		unset($_SESSION["form_tabla_ejercicio"]);
		unset($_SESSION["errores"]);
	}
	else header("Location: form_tabla_ejercicio.php");
	
	//Abrir la conexión con la base de datos
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tabla de ejercicios creada con éxito</title>
</head>

<body>
	<?php
	//include_once("index.php");
	?>
	
	<main>
		<?php 
			//Invocar a la funcion de crea tabla de ejercicio
			if(crea_tabla_ejercicio($conexion, $tablaEjercicio)){
		?>
			<!--Mensaje de exito-->
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
	//Desconectar la base de datos
	cerrarConexionBD($conexion);
?>