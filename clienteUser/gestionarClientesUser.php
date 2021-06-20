<?php


function getOID($conexion, $dni) {
	try {
		$consulta = "SELECT OID_TE FROM CLIENTES WHERE DNI=:dni";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':dni',$dni);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getRecuperacion($conexion, $oid_te) {
	try {
		$consulta = "SELECT RECUPERACION FROM TABLASEJERCICIOS WHERE OID_TE=:oid_te";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_te',$oid_te);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getNombre($conexion, $oid_te) {
	try {
		$consulta = "SELECT NOMBRETABLAE FROM TABLASEJERCICIOS WHERE OID_TE=:oid_te";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_te',$oid_te);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getDescripcion($conexion, $oid_te) {
	try {
		$consulta = "SELECT DESCRIPCION FROM TABLASEJERCICIOS WHERE OID_TE=:oid_te";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_te',$oid_te);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getDuracion($conexion, $oid_te) {
	try {
		$consulta = "SELECT DURACION FROM TABLASEJERCICIOS WHERE OID_TE=:oid_te";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_te',$oid_te);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function tieneEjercicios($conexion, $oid_te) {
	try {
 		$consulta = "SELECT COUNT(*) AS TOTAL FROM LINEAEJERCICIOS WHERE OID_TE=:oid_te";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_te',$oid_te);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getEjercicios($conexion, $oid_te) {
	try {
		$consulta = "SELECT * FROM LINEAEJERCICIOS NATURAL JOIN EJERCICIOS WHERE OID_TE=:oid_te ORDER BY NUMEROORDEN";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_te',$oid_te);
		$stmt->execute();
		return $stmt;
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getOID_D($conexion, $dni) {
	try {
		$consulta = "SELECT OID_DI FROM CLIENTES WHERE DNI=:dni";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':dni',$dni);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getNombreD($conexion, $oid_di) {
	try {
		$consulta = "SELECT NOMBREDIETA FROM DIETAS WHERE OID_DI=:oid_di";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_di',$oid_di);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getDescripcionD($conexion, $oid_di) {
	try {
		$consulta = "SELECT DESCRIPCION FROM DIETAS WHERE OID_DI=:oid_di";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_di',$oid_di);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getDuracionD($conexion, $oid_di) {
	try {
		$consulta = "SELECT DURACION FROM DIETAS WHERE OID_DI=:oid_di";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_di',$oid_di);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}


function tieneComidas($conexion, $oid_di) {
	try {
 		$consulta = "SELECT COUNT(*) AS TOTAL FROM LINEACOMIDAS WHERE OID_DI=:oid_di";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_di',$oid_di);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getComidas($conexion, $oid_di, $dia) {
	try {
		$consulta = "SELECT * FROM LINEACOMIDAS NATURAL JOIN COMIDAS WHERE OID_DI=:oid_di AND DIA=:dia ORDER BY HORA";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':oid_di',$oid_di);
		$stmt->bindParam(':dia',$dia);
		$stmt->execute();
		return $stmt;
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}


?>
