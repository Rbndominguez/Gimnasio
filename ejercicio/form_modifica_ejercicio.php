<?php
	session_start();
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	} 
	
	$form_modifica_ejercicio = $_SESSION["ejercicio"];
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Modificar ejercicio</title>
	<link href="../css/formulario.css" rel="stylesheet" type="text/css">
</head>

<body>

	<form id="form_modifica_ejercicio" method="post" action="accion_modificar_ejercicio.php" novalidate>
		<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
		<fieldset><legend>Datos del ejercicio</legend>
			
			<div>
				<input id="oid_e" name="oid_e" type="hidden" value="<?php echo $form_modifica_ejercicio["oid_e"]; ?>" required/>
			</div>
			
			<div><label for="nombreEjercicio">Nombre del Ejercicio:<em>*</em></label>
				<input id="nombreEjercicio" name="nombreEjercicio" type="text" size="50" value="<?php echo $form_modifica_ejercicio['nombreEjercicio']; ?>" required>
			</div>
	
			<div><label for="descripcion">Descripcion:<em>*</em></label>
				<input id="descripcion" name="descripcion" type="text" size="80" value="<?php echo $form_modifica_ejercicio['descripcion']; ?>" required>
			</div>
	
			<div><label for="repeticiones">Repeticiones:</label>
				<input id="repeticiones" name="repeticiones" type="text" value="<?php echo $form_modifica_ejercicio['repeticiones']; ?>">
			</div>
	
			<div><label for="duracion">Duracion:</label>
				<input id="duracion" name="duracion" type="text" size="50" value="<?php echo $form_modifica_ejercicio['duracion']; ?>">
			</div>
	
			<div><label for="series">Series:</label>
				<input id="series" name="series" type="text" value="<?php echo $form_modifica_ejercicio['series']; ?>">
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
