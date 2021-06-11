<?php
session_start();

if (isset($_SESSION["pago"])) {
	$pagoModificado["oid_pa"] = $_POST["oid_pa"];
	$pagoModificado["importePago"] = $_POST["importePago"];
	$pagoModificado["fechaPago"] = $_POST["fechaPago"];
	$pagoModificado["motivo"] = $_POST["motivo"];
	$pagoModificado["tipoPago"] = $_POST["tipoPago"];
	$pagoModificado["dni"] = $_POST["dni"];
	$pagoModificado["nombreCliente"] = $_POST["nombreCliente"];
	$pagoModificado["apellidosCliente"] = $_POST["apellidosCliente"];
	$pagoModificado["oid_pasis"] = $_POST["oid_pasis"];

	$_SESSION["pago"] = $pagoModificado;
	require_once ("../gestionBD.php");
	require_once ("gestionPagos.php");

	// CREAR LA CONEXIÓN A LA BASE DE DATOS
	$conexion = crearConexionBD();
	// INVOCAR "MODIFICAR_TITULO"
	$resultado = modifica_pagos($conexion, $pagoModificado);
	// CERRAR LA CONEXIÓN
	cerrarConexionBD($conexion);

	// SI LA FUNCIÓN RETORNÓ UN MENSAJE DE EXCEPCIÓN, ENTONCES REDIRIGIR A "EXCEPCION.PHP"
	if ($resultado <> true) {
		$_SESSION["excepcion"] = $resultado;
		$_SESSION["destino"] = "consulta_pagos.php";
		header("Location: ../excepcion.php");
	} else {
		header("Location: muestra_pago.php");
	}
} else// Se ha tratado de acceder directamente a este PHP
	header("Location: consulta_pagos.php");
?>