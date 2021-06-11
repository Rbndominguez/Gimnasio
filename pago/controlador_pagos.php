<?php
session_start();

if (isset($_POST["oid_pa"])) {
	$pago["oid_pa"] = $_POST["oid_pa"];
	$pago["importePago"] = $_POST["importePago"];
	$pago["fechaPago"] = $_POST["fechaPago"];
	$pago["motivo"] = $_POST["motivo"];
	$pago["tipoPago"] = $_POST["tipoPago"];
	$pago["dni"] = $_POST["dni"];
	$pago["nombreCliente"] = $_POST["nombreCliente"];
	$pago["apellidosCliente"] = $_POST["apellidosCliente"];
	$pago["oid_pasis"] = $_POST["oid_pasis"];

	$_SESSION["pago"] = $pago;

	if (isset($_POST["mostrar"]))
		header("Location: muestra_pago.php");
	if (isset($_POST["editar"]))
		Header("Location: form_modifica_pago.php");
	if (isset($_POST["borrar"]))
		Header("Location: accion_borrar_pago.php");
} else
	Header("Location: consulta_pagos.php");
?>
