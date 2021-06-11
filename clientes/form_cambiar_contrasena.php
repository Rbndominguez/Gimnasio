<?php
	session_start();
	
	if (!isset($_SESSION['login'])) {
		header("Location: ../index.php");
	} 
	
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
			
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Cambiar contraseña</title>
  <link href="../css/formulario.css" rel="stylesheet" type="text/css">
</head>

<body>
	
	<?php 
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	
	<form id="cambiarPass" method="post" action="accion_cambiar_contrasena.php" novalidate>
		<fieldset><legend>Cambiar contraseña</legend>
			<div><label for="old_pass">Contraseña antigua</label>
			<input id="old_pass" name="old_pass" type="password" required>
			</div>

			<div><label for="new_pass">Nueva contraseña:</label>
			<input id="new_pass" name="new_pass" type="password" required/>
			</div>
			
			<div><label for="new_confirmpass">Confirmar nueva contraseña:</label>
			<input id="new_confirmpass" name="new_confirmpass" type="password" required/>
			</div>
			
		</fieldset>

		<div>
			</br>
			<input type="submit" value="Enviar">
			<button onClick="window.close();">Cerrar</button>
		</div>
	</form>
	
	</body>
</html>
