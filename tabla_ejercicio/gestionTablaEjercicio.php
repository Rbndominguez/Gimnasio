<?php

#Aquí estan las funciones de gestión de tablas de ejercicios de la capa de acceso a datos

#----------------------------------------#
#	  Gestión Tabla de ejercicios		 #
#----------------------------------------#
function crea_tabla_ejercicio($conexion, $tablaEjercicio) {
	try {
		$consulta = "CALL CREA_TABLAS_EJERCICIOS (:nombre, :descripcion, :duracion, :recuperacion)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":nombre", $tablaEjercicio["nombreTablaE"]);
		$statement -> bindParam(":descripcion", $tablaEjercicio["descripcion"]);
		$statement -> bindParam(":duracion", $tablaEjercicio["duracion"]);
		$statement -> bindParam(":recuperacion", $tablaEjercicio["recuperacion"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function modifica_tabla_ejercicio($conexion, $tablaEjercicio) {
	try {
		$consulta = "CALL MODIFICA_TABLA_EJERCICIOS (:oid_te, :nombre, :descripcion, :duracion, :recuperacion)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_te", $tablaEjercicio["oid_te"]);
		$statement -> bindParam(":nombre", $tablaEjercicio["nombreTablaE"]);
		$statement -> bindParam(":descripcion", $tablaEjercicio["descripcion"]);
		$statement -> bindParam(":duracion", $tablaEjercicio["duracion"]);
		$statement -> bindParam(":recuperacion", $tablaEjercicio["recuperacion"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function elimina_tabla_ejercicio($conexion, $tablaEjercicio) {
	try {
		$consulta = "CALL ELIMINA_TABLA_EJERCICIOS (:oid_te)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_te", $tablaEjercicio["oid_te"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function crea_linea_ejercicios($conexion, $tablaEjercicio, $numeroOrden, $oid_e) {
	try {
		$consulta = "CALL CREA_LINEA_EJERCICIOS(:num, :oid_e, :oid_te)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_te", $tablaEjercicio["oid_te"]);
		$statement -> bindParam(":num", $numeroOrden);
		$statement -> bindParam(":oid_e", $oid_e);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function elimina_linea_ejercicios($conexion, $tablaEjercicio, $oid_e) {
	try {
		$consulta = "CALL ELIMINA_LINEA_EJERCICIOS(:oid_e, :oid_te)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":oid_e", $oid_e);
		$statement -> bindParam(":oid_te", $tablaEjercicio["oid_te"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}

function busquedaTabla($conexion, $consultaBusqueda) {
 	$consulta = "SELECT * FROM TABLASEJERCICIOS WHERE NOMBRETABLAE LIKE '%$consultaBusqueda%'";
	return $conexion->query($consulta);	
}

function tieneEjercicios($conexion, $tablaEjercicio) {
	try {
 		$consulta = "SELECT COUNT(*) AS TOTAL FROM LINEAEJERCICIOS WHERE OID_TE=:oid_te";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_te',$tablaEjercicio['oid_te']);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getEjercicios($conexion, $tablaEjercicio) {
	try {
		$consulta = "SELECT * FROM LINEAEJERCICIOS NATURAL JOIN EJERCICIOS WHERE OID_TE=:oid_te ORDER BY NUMEROORDEN";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_te',$tablaEjercicio['oid_te']);
		$stmt->execute();
		return $stmt;
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}


?>