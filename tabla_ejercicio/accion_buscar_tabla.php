<?php

	require_once("../gestionBD.php");
	require_once("gestionTablaEjercicio.php");
	
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
					<form method="post" action="controlador_tablas_ejercicios.php">
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
							
								<button id="mostrar" name="mostrar" type="submit" class="mostrar_fila">
										<div class="nombres">' . $nombre . ' [' . $recuperacion . ']</div>
								</button>
								
							</div>
								
							<div id="botones_fila">
								<button id="editar" name="editar" type="submit" class="editar_fila">
									<img src="../images/editar_small.png" class="editar_fila" alt="Editar tablaEjercicio">
								</button>
								<button id="borrar" name="borrar" type="submit" class="editar_fila">
									<img src="../images/remove_small.png" class="editar_fila" alt="Borrar tablaEjercicio">
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

