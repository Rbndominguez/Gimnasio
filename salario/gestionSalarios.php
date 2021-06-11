<?php
#Aquí estan las funciones de gestión de salarios de la capa de acceso a datos

#----------------------------------------#
#	  		Gestión Salarios   			 #
#----------------------------------------#
function crea_salarios($conexion, $salarios){
	$fecha = date('d/m/Y', strtotime($salarios["fecha"]));
	try{
		$consulta = "CALL CREA_SALARIOSMENSUALES(:cantidad, :fecha, :dniMonitor)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":cantidad", $salarios["cantidad"]);
		$statement->bindParam(":fecha", $fecha);
		$statement->bindParam(":dniMonitor", $salarios["dniMonitor"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function consultarTodosSalarios($conexion) {
	$consulta = "SELECT * FROM SALARIOSMENSUALES ORDER BY Cantidad";
	return $conexion -> query($consulta);
}


function modifica_salarios($conexion, $salarios){
	$fecha = date('d/m/Y', strtotime($salarios["fecha"]));
	try{
		$consulta = "CALL MODIFICA_SALARIOSMENSUALES(:oid_sm, :cantidad, :fecha, :dniMonitor)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":oid_sm",$salarios["oid_sm"]);
		$statement->bindParam(":cantidad", $salarios["cantidad"]);
		$statement->bindParam(":fecha", $fecha);
		$statement->bindParam(":dniMonitor", $salarios["dniMonitor"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function elimina_salarios($conexion, $salarios){
	try{
		$consulta = "CALL ELIMINA_SALARIOSMENSUALES(:oid_sm)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":oid_sm", $salarios["oid_sm"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error".$e->getMessage();
		return false;
	}
}

function listarMonitores($conexion){
	try{
		$consulta = "SELECT * FROM MONITORES ORDER BY APELLIDOS, NOMBRE";
    	$stmt = $conexion->query($consulta);
		return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
    }
}

function busquedaSalario($conexion, $consultaBusqueda) {
 	$consulta = "SELECT * FROM SALARIOSMENSUALES NATURAL JOIN MONITORES WHERE NOMBRE LIKE '%$consultaBusqueda%' 
 		OR APELLIDOS LIKE '%$consultaBusqueda%' OR (NOMBRE || ' ' || APELLIDOS) LIKE '%$consultaBusqueda%'";
	return $conexion->query($consulta);	
}

?>