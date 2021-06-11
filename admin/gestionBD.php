<?php

function crearConexionBD() {

$DatosConexion = parse_ini_file("conf_BD.ini");
$servidor = $DatosConexion[gimnasio]["servidor"];
$bd = $DatosConexion[gimnasio]["bd"];
$user = $DatosConexion[gimnasio]["usuario"];
$password = $DatosConexion[gimnasio]["password"];
$puerto = $DatosConexion[gimnasio]["puerto"];

try{
	$conexion = new PDO("pgsql:host=$servidor;port=$puerto;dbname=$bd", $user, $password, array(PDO::ATTR_PERSISTENT => true));
	$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $conexion;

}catch(PDOException $e){
	$_SESSION['excepcion'] = $e -> GetMessage();
	header("Location: ../excepcion.php");
}
} 

function cerrarConexionBD($conexion) {
	$conexion = null;
}

function parseaFechaFormulario($fecha) {
	$arrayFecha = explode("/", $fecha);
	if ($arrayFecha[2] >= 50 && $arrayFecha[2] <= 99) {
		$res = "19" . $arrayFecha[2] . "-" . $arrayFecha[1] . "-" . $arrayFecha[0];
	} else {
		$res = "20" . $arrayFecha[2] . "-" . $arrayFecha[1] . "-" . $arrayFecha[0];
	}
	return $res;
}
?>
