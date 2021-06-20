<?php
	session_start();


	require_once("../gestionBD.php");
	require_once("gestionarClientes.php");
		

	if(isset($_SESSION["form_alta_cliente"])) {
		$nuevoCliente = $_SESSION["form_alta_cliente"];
		unset($_SESSION["form_alta_cliente"]);
		unset($_SESSION["errores"]);
	}
	else header("Location: form_alta_cliente.php");
	

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
		<?php 	
				if(alta_cliente($conexion,$nuevoCliente)) {
		?>

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

	cerrarConexionBD($conexion);
?>

