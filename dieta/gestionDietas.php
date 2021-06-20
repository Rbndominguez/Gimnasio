<?php

function crea_dieta($conexion, $dieta) {
	try {
		$consulta = "CALL CREA_DIETAS (:nombreDieta, :descripcion, :duracion)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":nombreDieta", $dieta["nombreDieta"]);
		$statement -> bindParam(":descripcion", $dieta["descripcion"]);
		$statement -> bindParam(":duracion", $dieta["duracion"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function modifica_dieta($conexion, $dieta) {
	try {
		$consulta = "CALL MODIFICA_DIETA (:oid_di, :nombreDieta, :descripcion, :duracion)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_di", $dieta["oid_di"]);
		$statement -> bindParam(":nombreDieta", $dieta["nombreDieta"]);
		$statement -> bindParam(":descripcion", $dieta["descripcion"]);
		$statement -> bindParam(":duracion", $dieta["duracion"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function elimina_dieta($conexion, $dieta) {
	try {
		$consulta = "CALL ELIMINA_DIETA (:oid_di)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_di", $dieta["oid_di"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function crea_linea_comidas($conexion, $dieta, $dia, $hora, $oid_c) {
	try {
		$consulta = "CALL CREA_LINEA_COMIDAS(:dia, :hora, :oid_c, :oid_di)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_di", $dieta["oid_di"]);
		$statement -> bindParam(":dia", $dia);
		$statement -> bindParam(":hora", $hora);
		$statement -> bindParam(":oid_c", $oid_c);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function elimina_linea_comidas($conexion, $dieta, $oid_c) {
	try {
		$consulta = "CALL ELIMINA_LINEA_COMIDAS(:oid_c, :oid_di)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_c", $oid_c);
		$statement -> bindParam(":oid_di", $dieta["oid_di"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}

function busquedaDieta($conexion, $consultaBusqueda) {
 	$consulta = "SELECT * FROM DIETAS WHERE NOMBREDIETA LIKE '%$consultaBusqueda%'";
	return $conexion->query($consulta);	
}

function tieneComidas($conexion, $dieta) {
	try {
 		$consulta = "SELECT COUNT(*) AS TOTAL FROM LINEACOMIDAS WHERE OID_DI=:oid_di";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_di',$dieta['oid_di']);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getComidas($conexion, $dieta, $dia) {
	try {
		$consulta = "SELECT * FROM LINEACOMIDAS NATURAL JOIN COMIDAS WHERE OID_DI=:oid_di AND DIA=:dia ORDER BY HORA";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_di',$dieta['oid_di']);
		$stmt->bindParam(':dia',$dia);
		$stmt->execute();
		return $stmt;
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}


?>