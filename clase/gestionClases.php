<?php

function crea_clase($conexion, $clase) {
	try {
		$consulta = "CALL CREA_CLASES(:nombreClase, :horario, :dniMonitor, :sala)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":nombreClase", $clase["nombreClase"]);
		$statement -> bindParam(":horario", $clase["horario"]);
		$statement -> bindParam(":dniMonitor", $clase["dniMonitor"]);
		$statement -> bindParam(":sala", $clase["sala"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}
function modifica_clase($conexion, $clase) {
	try {
		$consulta = "CALL MODIFICA_CLASES(:oid_cl,:nombreClase, :horario, :dniMonitor, :sala)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_cl", $clase["oid_cl"]);
		$statement -> bindParam(":nombreClase", $clase["nombreClase"]);
		$statement -> bindParam(":horario", $clase["horario"]);
		$statement -> bindParam(":dniMonitor", $clase["dniMonitor"]);
		$statement -> bindParam(":sala", $clase["sala"]);
		$statement -> execute();
		return true;
	}catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function elimina_clase($conexion, $clase){
	try{
	$consulta = "CALL ELIMINA_CLASES(:oid_cl)";
	$statement = $conexion -> prepare($consulta);
	$statement->bindParam(":oid_cl", $clase["oid_cl"]);		
	$statement->execute();
	return true;
}catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function consultarTodasClases($conexion) {
	$consulta = "SELECT * FROM CLASES ORDER BY NOMBRECLASE";
    return $conexion->query($consulta);
}

function busquedaClase($conexion, $consultaBusqueda) {
 	$consulta = "SELECT * FROM CLASES WHERE NOMBRECLASE LIKE '%$consultaBusqueda%'";
	return $conexion->query($consulta);	
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

function numClientes($conexion, $clase) {
	try {
 		$consulta = "SELECT COUNT(*) AS TOTAL FROM ASISTEA WHERE OID_CL=:oid_cl";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_cl',$clase['oid_cl']);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

?>