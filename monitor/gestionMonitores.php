<?php 


function alta_monitor($conexion, $monitor) {
	$fechaContratacion = date('d/m/Y', strtotime($monitor["fechaContratacion"]));
	try {
		$consulta = "CALL ALTA_MONITORES(:dniMonitor, :nombre, :apellidos, :telefono, :fechaContratacion)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dniMonitor", $monitor["dniMonitor"]);
		$statement -> bindParam(":nombre", $monitor["nombre"]);
		$statement -> bindParam(":apellidos", $monitor["apellidos"]);
		$statement -> bindParam(":telefono", $monitor["telefono"]);
		$statement -> bindParam(":fechaContratacion", $fechaContratacion);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}


function modifica_monitor($conexion, $monitor) {
	$fechaContratacion = date('d/m/Y', strtotime($monitor["fechaContratacion"]));
	try {
		$consulta = "CALL MODIFICA_MONITORES(:dniMonitor, :nombre, :apellidos, :telefono, :fechaContratacion)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dniMonitor", $monitor["dniMonitor"]);
		$statement -> bindParam(":nombre", $monitor["nombre"]);
		$statement -> bindParam(":apellidos", $monitor["apellidos"]);
		$statement -> bindParam(":telefono", $monitor["telefono"]);
		$statement -> bindParam(":fechaContratacion", $fechaContratacion);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function elimina_monitor($conexion, $monitor) {
	try {
		$consulta = "CALL ELIMINA_MONITORES(:dniMonitor)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dniMonitor", $monitor["dniMonitor"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function dar_baja_monitor($conexion, $monitor, $fechaFin) {
	try {
		$consulta = "CALL DAR_BAJA_M(:dniMonitor, :fecha)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dniMonitor", $monitor["dniMonitor"]);
		$statement -> bindParam(":fecha", $fechaFin);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function vuelve_dar_alta_monitor($conexion, $monitor) {
	try {
		$consulta = "CALL VUELVE_ALTA_MONITORES(:dniMonitor)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dniMonitor", $monitor["dniMonitor"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		echo "error: " . $e -> getMessage();
		return false;
	}
}

function busquedaMonitor ($conexion, $consultaBusqueda) {
 	$consulta = "SELECT * FROM MONITORES WHERE NOMBRE LIKE '%$consultaBusqueda%' OR APELLIDOS LIKE '%$consultaBusqueda%' OR (NOMBRE || ' ' || APELLIDOS) LIKE '%$consultaBusqueda%'";
	return $conexion->query($consulta);	
}

function tieneClases($conexion, $monitor) {
	try {
 		$consulta = "SELECT COUNT(*) AS TOTAL FROM CLASES WHERE DNIMONITOR=:dni";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':dni',$monitor['dniMonitor']);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getClases($conexion, $monitor) {
	try {
		$consulta = "SELECT * FROM CLASES WHERE DNIMONITOR=:dni ORDER BY NOMBRECLASE";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':dni',$monitor['dniMonitor']);
		$stmt->execute();
		return $stmt;
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

?>