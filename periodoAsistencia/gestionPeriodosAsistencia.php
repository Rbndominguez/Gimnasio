<?php
#Aquí están las funciones de gestión de periodos de asistencia de la capa de acceso a datos

#------------------------------#
#Gestión Periodos de Asistencia#
#------------------------------#
function crea_periodo_asistencia($conexion, $periodoAsistencia){
	$fecha = date('d/m/Y', strtotime($periodoAsistencia["fechaInicio"]));
	try{
		$consulta = "CALL CREA_PERIODOSASISTENCIA(:fechaInicio,:dni)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":fechaInicio", $fecha);
		$statement->bindParam(":dni",$periodoAsistencia["dni"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function modifica_periodo_asistencia($conexion, $periodoAsistencia){
	$fechaInicio = date('d/m/Y', strtotime($periodoAsistencia["fechaInicio"]));
	$fechaFin = date('d/m/Y', strtotime($periodoAsistencia["fechaFin"]));
	try{
		$consulta = "CALL MODIFICA_PERIODOSASISTENCIA(:oid_pasis,:fechaInicio,:fechaFin,:dni)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":oid_pasis", $periodoAsistencia["oid_pasis"]);
		$statement->bindParam(":fechaInicio", $fechaInicio);
		$statement->bindParam(":fechaFin",$fechaFin);
		$statement->bindParam(":dni", $periodoAsistencia["dni"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function elimina_periodo_asistencia($conexion, $periodoAsistencia){
	try{
		$consulta = "CALL ELIMINA_PERIODOSASISTENCIA(:oid_pasis)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":oid_pasis", $periodoAsistencia["oid_pasis"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function busquedaPeriodoAsistencia($conexion, $consultaBusqueda) {
 	$consulta = "SELECT * FROM PERIODOSASISTENCIA NATURAL JOIN CLIENTES WHERE NOMBRECLIENTE LIKE '%$consultaBusqueda%' OR APELLIDOSCLIENTE LIKE '%$consultaBusqueda%' OR (NOMBRECLIENTE || ' ' || APELLIDOSCLIENTE) LIKE '%$consultaBusqueda%'";
	return $conexion->query($consulta);	
}

function listarClientes($conexion){
	try{
		$consulta = "SELECT * FROM CLIENTES ORDER BY APELLIDOSCLIENTE, NOMBRECLIENTE";
    	$stmt = $conexion->query($consulta);
		return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
    }
}

function getNumDias($conexion, $oid_pasis){
	try{
		$consulta = "SELECT NUMERODIAS FROM PERIODOSASISTENCIA WHERE OID_PASIS=$oid_pasis";
    	$stmt = $conexion->query($consulta);
		return $stmt->fetchColumn();	
	}catch(PDOException $e) {
		return $e->getMessage();
    }
}

?>