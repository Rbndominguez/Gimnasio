<?php
session_start();

if (isset($_SESSION["clase"])) {
	$claseModificada["oid_cl"] = $_POST["oid_cl"];
	$claseModificada["nombreClase"] = $_POST["nombreClase"];
	$claseModificada["horario"] = $_POST["horario"];
	$claseModificada["nombre"]=$_POST["nombre"];
	$claseModificada["apellidos"]=$_POST["apellidos"];
	$claseModificada["dniMonitor"] = $_POST["dniMonitor"];
	$claseModificada["sala"] = $_POST["sala"];

	$_SESSION["clase"] = $claseModificada;
	require_once ("../gestionBD.php");
	require_once ("gestionClases.php");


	$conexion = crearConexionBD();

	$resultado = modifica_clase($conexion, $claseModificada);

	cerrarConexionBD($conexion);


	if ($resultado <> true) {
		$_SESSION["excepcion"] = $resultado;
		$_SESSION["destino"] = "consulta_clases.php";
		header("Location: ../excepcion.php");
	} else {
		header("Location: muestra_clase.php");
	}
} else
	header("Location: consulta_clases.php");
?>