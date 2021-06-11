<?php
session_start();

if (isset($_POST["oid_pasis"])) {
	$periodoAsistencia["oid_pasis"] = $_POST["oid_pasis"];
	$periodoAsistencia["fechaInicio"] = $_POST["fechaInicio"];
	$periodoAsistencia["fechaFin"] = $_POST["fechaFin"];
	$periodoAsistencia["numeroDias"] = $_POST["numeroDias"];
	$periodoAsistencia["dni"] = $_POST["dni"];
	$periodoAsistencia["nombre"] = $_POST["nombre"];
	$periodoAsistencia["apellidos"] = $_POST["apellidos"];
	
	$_SESSION["periodoAsistencia"] = $periodoAsistencia;
	
	if (isset($_POST["mostrar"])) 
		header("Location: muestra_periodo_asistencia.php");
	if (isset($_POST["editar"]))
		header("Location: form_modifica_periodo_asistencia.php");
	if (isset($_POST["borrar"]))
		header("Location: accion_borrar_periodo_asistencia.php");
} else
	header("Location: consulta_periodos_asistencia.php");
?>
