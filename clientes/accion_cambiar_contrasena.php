<?php	
	session_start();	
	
	if (!isset($_SESSION['login'])) {
		header("Location: ../index.php");
	} 
	
	require_once("../gestionBD.php");
	require_once("gestionarClientes.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Cambiando contraseña</title>
</head>

<body>

<main>
	<?php
	$dni = $_SESSION['login'];
	
	$contrasenaVieja = $_POST["old_pass"];
	$contrasenaNueva = $_POST["new_pass"];
	$confirmpassNueva = $_POST["new_confirmpass"];
			
	$conexion = crearConexionBD();
	
	$contrasenaAntigua = getPassword($conexion, $dni);
	
	if ($contrasenaVieja == "" || $contrasenaNueva == "" || $confirmpassNueva == "") {
		$errores[] = "<p>Ningún campo debe estar vacío</p>";
		$_SESSION["errores"] = $errores;
		header('Location: form_cambiar_contrasena.php');
		
	}else if (($contrasenaNueva == "") || (strlen($contrasenaNueva) < 8)) {
		$errores[] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		$_SESSION["errores"] = $errores;
		header('Location: form_cambiar_contrasena.php');
		
	} else if (!preg_match("/[a-z]+/", $contrasenaNueva) || !preg_match("/[A-Z]+/", $contrasenaNueva) || !preg_match("/[0-9]+/", $contrasenaNueva)) {
		$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
		$_SESSION["errores"] = $errores;
		header('Location: form_cambiar_contrasena.php');
		
	} else if($contrasenaVieja != $contrasenaAntigua) {
		$errores[] = "<p>La contraseña antigua no es correcta</p>";
		$_SESSION["errores"] = $errores;
		header('Location: form_cambiar_contrasena.php');
	} else if ($contrasenaVieja == $contrasenaNueva) {
		$errores[] = "<p>La contraseña nueva no debe coincidir con la antigua</p>";
		$_SESSION["errores"] = $errores;
		header('Location: form_cambiar_contrasena.php');
	} else if ($contrasenaNueva != $confirmpassNueva) {
		$errores[] = "<p>La contraseña nueva no coincide con la confirmación</p>";
		$_SESSION["errores"] = $errores;
		header('Location: form_cambiar_contrasena.php');
	} else {
		$resultado = modifica_password_cliente($conexion, $dni, $contrasenaNueva);
		if($resultado <> true){
			$_SESSION["excepcion"] = $resultado;
			$_SESSION["destino"] = "clientes/form_cambiar_contrasena.php";
			header("Location: ../excepcion.php");
		} else { ?>
			<script language="javascript">
  				function cierraPopup(){
    				window.history.back();
				}
	
				function cambiada(){	
 					document.open();
 					document.write("<h1>La contraseña ha sido cambiada con éxito</h1>");
 					window.setTimeout("cierraPopup()", 1000);
					 
				}
				cambiada();
			</script>
		<?php }
	}
	
	cerrarConexionBD($conexion);
	
?>

</main>

</body>
</html>

