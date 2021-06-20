<?php

function crea_comida($conexion, $comida){
	try{
		$consulta = "CALL CREA_COMIDAS(:nombreComida,:descripcion)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":nombreComida", $comida["nombreComida"]);
		$statement->bindParam(":descripcion", $comida["descripcion"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function modifica_comida($conexion, $comida){
	try{
		$consulta = "CALL MODIFICA_COMIDA(:oid_c,:nombreComida,:descripcion)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":oid_c", $comida["oid_c"]);
		$statement->bindParam(":nombreComida", $comida["nombreComida"]);
		$statement->bindParam(":descripcion",$comida["descripcion"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function elimina_comida($conexion, $comida){
	try{
		$consulta = "CALL ELIMINA_COMIDA(:oid_c)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":oid_c", $comida["oid_c"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function consultarTodasComidas($conexion){
	$consulta = "SELECT * FROM COMIDAS ORDER BY NOMBRECOMIDA";
	return $conexion -> query($consulta);
}

function busquedaComida($conexion, $consultaBusqueda) {
 	$consulta = "SELECT * FROM COMIDAS WHERE NOMBRECOMIDA LIKE '%$consultaBusqueda%'";
	return $conexion->query($consulta);	
}

?>