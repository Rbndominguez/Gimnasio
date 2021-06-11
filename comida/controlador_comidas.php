<?php
	session_start();

	if (isset($_POST["oid_c"])) {
		$comida["oid_c"] = $_POST["oid_c"];
		$comida["nombreComida"] = $_POST["nombreComida"];
		$comida["descripcion"] = $_POST["descripcion"];
		
		$_SESSION["comida"] = $comida;
		
		if (isset($_POST["editar"]))
			header("Location: form_modifica_comida.php");
		if (isset($_POST["borrar"]))
			header("Location: accion_borrar_comida.php");
	} else
		header("Location: consulta_comidas.php");
?>
