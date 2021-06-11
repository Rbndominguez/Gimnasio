<?php

function crearConexionBD() {

	$DatosConexion = parse_ini_file("conf_BD.ini", true);
	/*$servidor = $DatosConexion[gimnasio]["servidor"];
	$bd = $DatosConexion[gimnasio]["bd"];
	$user = $DatosConexion[gimnasio]["usuario"];
	$password = $DatosConexion[gimnasio]["password"];
	$puerto = $DatosConexion[gimnasio]["puerto"];*/
	$servidor = "127.0.0.1";
	$bd = "proyecto";
	$user = "postgres";
	$password = "a";
	$puerto = "5432";

	try {
		$conexion = new PDO("pgsql:host=$servidor;port=$puerto;dbname=$bd", $user, $password);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conexion;
		
	}
	catch(PDOException $e){
		$_SESSION['excepcion'] = $e -> GetMessage();
		header("Location: ../excepcion.php");
	}
	} 
	function crearConexionPG() {
		$servidor = "127.0.0.1";
		$bd = "proyecto";
		$user = "postgres";
		$password = "a";
		$puerto = "5432";
	
		try {
			$dbconn = pg_connect("host=$servidor port=$puerto dbname=$bd user=$user password=$password");
			return $dbconn;
			
		}
		catch(PDOException $e){
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
