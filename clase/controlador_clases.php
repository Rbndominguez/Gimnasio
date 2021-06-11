<?php
	session_start();
	
	if (isset($_POST["oid_cl"])) {
		$clase["oid_cl"] = $_POST["oid_cl"];
		$clase["nombreClase"] = $_POST["nombreClase"];
		$clase["horario"] = $_POST["horario"];
		$clase["nombre"]=$_POST["nombre"];
		$clase["apellidos"]=$_POST["apellidos"];
		$clase["dniMonitor"] = $_POST["dniMonitor"];
		$clase["sala"] = $_POST["sala"];
	
		$_SESSION["clase"] = $clase;
	
		if (isset($_POST["mostrar"]))
			header("Location: muestra_clase.php");
		if (isset($_POST["editar"]))
			header("Location: form_modifica_clase.php");
		if (isset($_POST["borrar"]))
			header("Location: accion_borrar_clase.php");
	} else
		header("Location: consulta_clases.php");
?>
