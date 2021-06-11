<?php
	session_start();
	require_once("../gestionBD.php");
	require_once("gestionClases.php");
		
	// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL FORMULARIO YA VALIDADOS
	// RECOGER LOS DATOS Y ANULAR LOS DATOS DE SESIÓN (FORMULARIO Y ERRORES)
	// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
	if(isset($_SESSION["form_crea_clase"])) {
		$nuevaClase = $_SESSION["form_crea_clase"];
		unset($_SESSION["form_crea_clase"]);
		unset($_SESSION["errores"]);
	}
	else header("Location:form_crea_clase.php");
	
	// ABRIR LA CONEXIÓN A LA BASE DE DATOS
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Clase creada con éxito</title>
</head>

<body>
	<main>
		<?php 
		//Invocar a la funcion de crea clase
		if(crea_clase($conexion, $nuevaClase)){
		?>
		<!--Mensaje de bienvenida-->
		<div id="div_exito">
			<h1>Se ha registrado correctamente la clase: <?php echo $nuevaClase["nombreClase"]; ?></h1>
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
				<h1>Se ha producido un error al registrar la clase</h1>
			</div>	
			<div id="div_volver">
				<h1>Pulsa <a href="form_crea_clase.php">aquí</a> para volver al formulario.</h1>
			</div>
		<?php } ?>
		
	</main>
	
</body>
</html>
<?php
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conexion);
?>

