<?php
#Aquí están las funciones de gestión de ejercicios de la capa de acceso a datos

#----------------------------#
#	  Gestión Ejercicios	 #
#----------------------------#

function crea_ejercicios($conexion, $ejercicio){
	try{
		$consulta = "CALL CREA_EJERCICIOS(:nombreEjercicio, :descripcion, :repeticiones, :duracion, :series)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":nombreEjercicio", $ejercicio["nombreEjercicio"]);
		$statement->bindParam(":descripcion", $ejercicio["descripcion"]);
		$statement->bindParam(":repeticiones", $ejercicio["repeticiones"]);
		$statement->bindParam(":duracion", $ejercicio["duracion"]);
		$statement->bindParam(":series", $ejercicio["series"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function modifica_ejercicios($conexion, $ejercicio){
	try{
		$consulta = "CALL MODIFICA_EJERCICIO(:oid_e, :nombreEjercicio, :descripcion, :repeticiones, :duracion, :series)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":oid_e", $ejercicio["oid_e"]);
		$statement->bindParam(":nombreEjercicio", $ejercicio["nombreEjercicio"]);
		$statement->bindParam(":descripcion", $ejercicio["descripcion"]);
		$statement->bindParam(":repeticiones", $ejercicio["repeticiones"]);
		$statement->bindParam(":duracion", $ejercicio["duracion"]);
		$statement->bindParam(":series", $ejercicio["series"]);
		$statement->execute();
		return true;
	}catch(PDOException $e){
		echo "error: ".$e->getMessage();
		return false;
	}
}

function elimina_ejercicios($conexion, $ejercicio){
	try{
		$consulta = "CALL ELIMINA_EJERCICIO(:oid_e)";
		$statement = $conexion->prepare($consulta);
		$statement->bindParam(":oid_e", $ejercicio["oid_e"]);
		$statement->execute();
		return true;
	}catch (PDOException $e){
		echo "error: ".$e->getMessage();
	}
}


function busquedaEjercicio($conexion, $consultaBusqueda) {
 	$consulta = "SELECT * FROM EJERCICIOS WHERE NOMBREEJERCICIO LIKE '%$consultaBusqueda%' ORDER BY NOMBREEJERCICIO";
	return $conexion->query($consulta);	
}

?>