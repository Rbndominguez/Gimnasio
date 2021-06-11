<?php
	session_start();

	// HAY QUE IMPORTAR LA LIBRERÍA DE LA CONEXIÓN A BD
	// HAY QUE IMPORTAR LA LIBRERIA DEL CRUD DE CLIENTES
	require_once("../gestionBD.php");
	require_once("gestionarClientes.php");
		
	// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL FORMULARIO YA VALIDADOS
	// RECOGER LOS DATOS Y ANULAR LOS DATOS DE SESIÓN (FORMULARIO Y ERRORES)
	// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
	if(isset($_SESSION["form_alta_cliente"])) {
		$nuevoCliente = $_SESSION["form_alta_cliente"];
		unset($_SESSION["form_alta_cliente"]);
		unset($_SESSION["errores"]);
	}
	else header("Location: form_alta_cliente.php");
	
	// ABRIR LA CONEXIÓN A LA BASE DE DATOS
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Alta de Cliente realizada con éxito</title>
</head>

<body>


	<main>
		<?php 	// AQUÍ SE INVOCA A LA FUNCIÓN DE ALTA DE USUARIO
				// EN EL CONTEXTO DE UNA SENTENCIA IF
				if(alta_cliente($conexion,$nuevoCliente)) {
		?>
				<!-- MENSAJE DE BIENVENIDO AL USUARIO -->
				<div id="div_exito">
					<h1>El cliente "<?php echo $nuevoCliente["nombre"] . " " . $nuevoCliente["apellidos"]; ?>" ha sido dado de alta con éxito</h1>
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
				<!-- MENSAJE DE QUE CLIENTE YA EXISTE -->
				<div id="div_error_registro">
					<h1>Lo sentimos, ya existe un cliente con esos datos.</h1>
				</div>
				<div id="div_volver">
					Pulsa <a href="form_alta_cliente.php">aquí</a> para volver al formulario.</h1>
				</div>
		<?php } ?>
	</main>
</body>
</html>
<?php
	// DESCONECTAR LA BASE DE DATOS
	cerrarConexionBD($conexion);
?>

