<?php


function crea_pagos_pasis($conexion, $pagos) {
	$fecha = date('d/m/Y', strtotime($pagos["fechaPago"]));
	try {
		$consulta = "CALL CREA_PAGOS_PASIS(:importe, :fecha, :motivo, :tipo, :dni,:oid_pasis)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":importe", $pagos["importePago"]);
		$statement -> bindParam(":fecha", $fecha);
		$statement -> bindParam(":motivo", $pagos["motivo"]);
		$statement -> bindParam(":tipo", $pagos["tipoPago"]);
		$statement -> bindParam(":dni", $pagos["dni"]);
		$statement->bindParam(":oid_pasis",$pagos["oid_pasis"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function consultarTodosPagos($conexion) {
	$consulta = "SELECT * FROM PAGOS NATURAL JOIN CLIENTES ORDER BY FechaPago, ImportePago";
	return $conexion -> query($consulta);
}


function modifica_pagos($conexion, $pagos) {
	$fecha = date('d/m/Y', strtotime($pagos["fechaPago"]));
	try {
		$consulta = "CALL MODIFICA_PAGOS(:oid_pa, :importe, :fecha, :motivo, :tipo, :dni, :oid_pasis)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_pa", $pagos["oid_pa"]);
		$statement -> bindParam(":importe", $pagos["importePago"]);
		$statement -> bindParam(":fecha", $fecha);
		$statement -> bindParam(":motivo", $pagos["motivo"]);
		$statement -> bindParam(":tipo", $pagos["tipoPago"]);
		$statement -> bindParam(":dni", $pagos["dni"]);
		$statement -> bindParam(":oid_pasis", $pagos["oid_pasis"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function elimina_pagos($conexion, $pagos) {
	try {
		$consulta = "CALL ELIMINA_PAGOS(:oid_pa)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_pa", $pagos["oid_pa"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
	
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

function listarPasis($conexion){
	try{
		$consulta = "SELECT * FROM PERIODOSASISTENCIA NATURAL JOIN CLIENTES ORDER BY FECHAINICIO, APELLIDOSCLIENTE, NOMBRECLIENTE";
    	$stmt = $conexion->query($consulta);
		return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
    }
}

function busquedaPagos($conexion, $consultaBusqueda) {
	$consulta = "SELECT * FROM PAGOS WHERE FECHAPAGO = '%$consultaBusqueda%'::date";
	return $conexion->query($consulta);	
}


?>