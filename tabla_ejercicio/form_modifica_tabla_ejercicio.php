<?php
	session_start();

	$form_modifica_tabla_ejercicio = $_SESSION["tablaEjercicio"];

	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Modificar tabla de ejercicio</title>
	<link href="../css/formulario.css" rel="stylesheet" type="text/css">
</head>

<body>

	<form id="form_modifica_tabla_ejercicio" method="post" action="accion_modifica_tabla_ejercicio.php" novalidate>
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos de la tabla</legend>
			
			<div>
				<input id="oid_te" name="oid_te" type="hidden" value="<?php echo $form_modifica_tabla_ejercicio["oid_te"]; ?>" />
			</div>
			
			<div><label for="nombreTablaE">Nombre <em>*</em></label>
				<input id="nombreTablaE" name="nombreTablaE" type="text" size="50" value="<?php echo $form_modifica_tabla_ejercicio["nombreTablaE"]; ?>" required />
			</div>
				
			<div><label for="descripcion">Descripción</label>
				<input  id="descripcion" name="descripcion" type="text" size="50" value="<?php echo $form_modifica_tabla_ejercicio["descripcion"]; ?>" />
			</div>

			<div><label for="duracion">Duración <em>*</em></label>
				<input id="duracion" name="duracion" type="text" size="50" value="<?php echo $form_modifica_tabla_ejercicio["duracion"]?>" required />
			</div>

			<div><label for="recuperacion">¿Recuperación? <em>*</em></label>
				<input id="recuperacion" name="recuperacion" type="radio" value="1" <?php if($form_modifica_tabla_ejercicio["recuperacion"]==1) echo ' checked ';?> />
					Sí
				<input id="recuperacion" name="recuperacion" type="radio" value="0" <?php if($form_modifica_tabla_ejercicio["recuperacion"]==0) echo ' checked ';?> />
					No
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
