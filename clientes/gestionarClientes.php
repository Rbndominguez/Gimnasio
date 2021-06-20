<?php


 function alta_cliente($conexion,$usuario) {
	try {
		$consulta = "CALL ALTA_CLIENTES(:nombre, :apellidos, :dni, :direccion, :codigoPostal, :email, :pass, :telefono, :lesiones, :esEstudiante, :entrenamientoPersonal)";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':apellidos',$usuario["apellidos"]);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':direccion',$usuario["direccion"]);
		$stmt->bindParam(':codigoPostal',$usuario["codigoPostal"]);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':pass',$usuario["password"]);
		$stmt->bindParam(':telefono',$usuario["telefono"]);
		$stmt->bindParam(':lesiones',$usuario["lesiones"]);
		$stmt->bindParam(':esEstudiante',$usuario["esEstudiante"]);
		$stmt->bindParam(':entrenamientoPersonal',$usuario["entrenamientoPersonal"]);
		$stmt->execute();
		return true;
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->GetMessage();
	}
}

function consultarCliente($conexion,$dni,$pass) {
	try {
 		$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTES WHERE DNI=:dni AND PASSWD=:pass";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':dni',$dni);
		$stmt->bindParam(':pass',$pass);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return 0;
		echo "error: " . $e->getMessage();
	}
}

function modifica_cliente($conexion, $clienteModificado) {
 	try {
  		$consulta = "CALL MODIFICA_CLIENTES(:nombre, :apellidos, :dni, :direccion, :codigoPostal, :email, :telefono, :lesiones, :esEstudiante, :entrenamientoPersonal, :estaBaja, :oid_te, :oid_di)";
  		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":nombre", $clienteModificado["nombre"]);
		$statement -> bindParam(":apellidos", $clienteModificado["apellidos"]);
		$statement -> bindParam(":dni", $clienteModificado["dni"]);
		$statement -> bindParam(":direccion", $clienteModificado["direccion"]);
		$statement -> bindParam(":codigoPostal", $clienteModificado["codigoPostal"]);
		$statement -> bindParam(":email", $clienteModificado["email"]);
		$statement -> bindParam(":telefono", $clienteModificado["telefono"]);
		$statement -> bindParam(":lesiones", $clienteModificado["lesiones"]);
		$statement -> bindParam(":esEstudiante", $clienteModificado["esEstudiante"]);
		$statement -> bindParam(":entrenamientoPersonal", $clienteModificado["entrenamientoPersonal"]);
		$statement -> bindParam(":estaBaja", $clienteModificado["estaBaja"]);
		$statement -> bindParam(":oid_te", $clienteModificado["oid_te"]);
		$statement -> bindParam(":oid_di", $clienteModificado["oid_di"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
  		echo "error: " . $e -> getMessage();
  		return false;
	}
}

function modifica_password_cliente($conexion, $dni, $password) {
	try {
		$consulta = "CALL MODIFICA_PASSWD_CLIENTES(:dni, :pass)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dni", $dni);
		$statement -> bindParam(":pass", $password);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function getPassword($conexion, $dni) {
	try {
		$consulta = "SELECT PASSWD FROM CLIENTES WHERE DNI=:dni";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':dni',$dni);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function dar_baja_cliente($conexion, $cliente) {
	try {
		$consulta = "CALL BAJA_CLIENTES(:dni)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dni", $cliente["dni"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}

function vuelve_dar_alta_cliente($conexion, $cliente) {
	try {
		$consulta = "CALL VUELVE_ALTA_CLIENTES(:dni)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dni", $cliente["dni"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}

function asignar_tablaEjercicios_cliente($conexion, $cliente, $oid_te) {
	try {
		$consulta = "CALL ASIGNATEJERCICIOS_CLIENTES(:dni, :oid_te)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dni", $cliente["dni"]);
		$statement -> bindParam(":oid_te", $oid_te);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}

function desasignar_tablaEjercicios_cliente($conexion, $cliente) {
	try {
		$consulta = "CALL DESASIGNATEJERCICIOS_CLIENTES(:dni)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dni", $cliente["dni"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}

function asignar_dieta_cliente($conexion, $cliente, $oid_di) {
	try {
		$consulta = "CALL ASIGNADIETA_CLIENTES(:dni, :oid_di)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dni", $cliente["dni"]);
		$statement -> bindParam(":oid_di", $oid_di);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}

function desasignar_dieta_cliente($conexion, $cliente) {
	try {
		$consulta = "CALL DESASIGNADIETA_CLIENTES(:dni)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dni", $cliente["dni"]);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}

function crea_asiste_a($conexion, $cliente, $oid_cl) {
	try {
		$consulta = "CALL CREA_CLIENTE_ASISTE_A(:dni, :oid_cl)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dni", $cliente["dni"]);
		$statement -> bindParam(":oid_cl", $oid_cl);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}


function elimina_asiste_a($conexion, $cliente, $oid_cl) {
	try {
		$consulta = "CALL ELIMINA_CLIENTE_ASISTE_A(:dni, :oid_cl)";
		$statement = $conexion -> prepare($consulta);
		$statement -> bindParam(":dni", $cliente["dni"]);
		$statement -> bindParam(":oid_cl", $oid_cl);
		$statement -> execute();
		return true;
	} catch(PDOException $e) {
			return $e -> getMessage();
	}
}


function elimina_cliente($conexion, $usuario) {
	 try {
  		$consulta = "CALL ELIMINA_CLIENTES(:dni)";
 		$statement = $conexion -> prepare($consulta);
  		$statement -> bindParam(":dni", $usuario["dni"]);
  		$statement -> execute();
  		return true;
 	} catch(PDOException $e) {
  		echo "error: " . $e -> getMessage();
  		return false;
 	}
}

function busquedaCliente($conexion, $consultaBusqueda) {
 	$consulta = "SELECT * FROM CLIENTES WHERE NOMBRECLIENTE LIKE '%$consultaBusqueda%' OR APELLIDOSCLIENTE LIKE '%$consultaBusqueda%' OR (NOMBRECLIENTE || ' ' || APELLIDOSCLIENTE) LIKE '%$consultaBusqueda%'";
	return $conexion->query($consulta);	
}

function clientesActivos($conexion) {
	try {
 		$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTES WHERE ESTABAJA=0";
		$stmt = $conexion->prepare($consulta);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return 0;
		echo "error: " . $e->getMessage();
	}	
}

function tieneClases($conexion, $cliente) {
	try {
 		$consulta = "SELECT COUNT(*) AS TOTAL FROM ASISTEA WHERE DNI=:dni";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':dni',$cliente['dni']);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getClases($conexion, $cliente) {
	try {
		$consulta = "SELECT * FROM ASISTEA NATURAL JOIN CLASES WHERE DNI=:dni ORDER BY NOMBRECLASE";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':dni',$cliente['dni']);
		$stmt->execute();
		return $stmt;
	} catch(PDOException $e) {
		return false;
		echo "error: " . $e->getMessage();
	}	
}

function getTabla($conexion, $oid_te) {
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

function getDieta($conexion, $oid_di) {
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

?>
