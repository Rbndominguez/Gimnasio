<?php
	session_start();
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	} 
	
	$form_modifica_comida = $_SESSION["comida"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Modificar comida</title>
	<link href="../css/formulario.css" rel="stylesheet" type="text/css">
</head>

<body>

	<form id="form_modifica_comida" method="post" action="accion_modificar_comida.php" novalidate>
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos de la Comida</legend>
			
			<div>
			<input id="oid_c" name="oid_c" type="hidden" value="<?php echo $form_modifica_comida["oid_c"]; ?>" required/>
			</div>
			
			<div></div><label for="nombreComida">Nombre<em>*</em></label>
			<input id="nombreComida" name="nombreComida" type="text" size="50" value="<?php echo $form_modifica_comida["nombreComida"]; ?>" required>
			</div>
	
			<div>
				<label for="descripcion">Descripcion:<em>*</em></label>
				<input id="descripcion" name="descripcion" type="text" size="50" value="<?php echo $form_modifica_comida["descripcion"]; ?>" required/>
			</div>

		</fieldset>

		<div>
			</br>
			<input id="boton" type="submit" value="Enviar">
			<input id="boton" type="reset" value="Reset">
			<button onClick="window.close();">Cerrar</button>
		</div>
	</form>

</body>
</html>
