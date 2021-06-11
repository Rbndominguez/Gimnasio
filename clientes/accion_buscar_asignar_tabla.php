<?php

	require_once("../gestionBD.php");
	require_once("../tabla_ejercicio/gestionTablaEjercicio.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaTabla($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		echo '<p>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
		foreach($filas as $fila) {
			$oid_te = $fila['oid_te'];
			$nombre = $fila['nombretablae'];
			$descripcion = $fila['descripcion'];
			$duracion = $fila['duracion'];
			$recuperacion = $fila['recuperacion'];
			if ($recuperacion == 0) {
				$recuperacion = "normal";
			} else {
				$recuperacion = "recuperacion";
			} 
				
			$mensaje .= '
				<article class="tablaEjercicio">
					<form method="post" action="accion_asignar_tabla.php">
						<div class="fila_tablaEjercicio">
							<div class="datos_tablaEjercicio">
								<input type="hidden" id="oid_te" name="oid_te"
									value="' . $oid_te . '" />		
								<input type="hidden" id="nombreTablaE" name="nombreTablaE"
									value="' . $nombre . '" />
								<input type="hidden" id="descripcion" name="descripcion"
									value="' . $descripcion . '" />
								<input type="hidden" id="duracion" name="duracion"
									value="' . $duracion . '" />
								<input type="hidden" id="recuperacion" name ="recuperacion"
									value="' . $recuperacion . '"/>
							
								<div class="nombres">' . $nombre . ', ' . $duracion . ' [' . $recuperacion . ']</div>
							
							</div>
								
							<div id="botones_fila">
								<button class="btn btn-primary" id="asignar" name="asignar" type="submit" class="editar_fila">
									Asignar
								</button>
							</div>
						</div>
					</form>
					<br>
				</article>';
			}
		}
	
	echo $mensaje;
	
?>

