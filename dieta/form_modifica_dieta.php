<?php
	session_start();
	
	$form_modifica_dieta = $_SESSION["dieta"];
	
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Modificar dieta</title>
	<link href="../css/formulario.css" rel="stylesheet" type="text/css">
</head>

	<body>
		
	<form id="form_modifica_dieta" method="post" action="accion_modificar_dieta.php" novalidate>
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos de la dieta</legend>
		
			<div>
				<input id="oid_di" name="oid_di" type="hidden" value="<?php echo $form_modifica_dieta["oid_di"]; ?>" required/>
			</div>
			
			<div><label for="nombreDieta">Nombre <em>*</em></label>
				<input id="nombreDieta" name="nombreDieta" type="text" size="50" value="<?php echo $form_modifica_dieta["nombreDieta"]; ?>"required>
			</div>
	
			<div><label for="descripcion">Descripción</label>
				<input  id="descripcion" name="descripcion" type="text" size="50" value="<?php echo $form_modifica_dieta["descripcion"]; ?>">
			</div>
	
			<div><label for="duracion">Duración <em>*</em></label>
				<input  id="duracion" name="duracion" type="text" size="9" value="<?php echo $form_modifica_dieta["duracion"]; ?>"required>
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