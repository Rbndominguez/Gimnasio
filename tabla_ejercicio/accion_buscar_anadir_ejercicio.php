<?php

	require_once("../gestionBD.php");
	require_once("../ejercicio/gestionEjercicios.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaEjercicio($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		echo '<p>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
		foreach($filas as $fila) {
			$oid_e = $fila['oid_e'];
			$nombreEjercicio = $fila['nombreejercicio'];
			$descripcion = $fila['descripcion'];
			$repeticiones = $fila['repeticiones'];
			$duracion = $fila['duracion'];
			$series = $fila['series'];
				
			if($duracion != NULL) {
				$mensaje .= '
					<article class="ejercicio">
						<form method="post" action="accion_anadir_ejercicio.php">
							<div class="fila_ejercicio">
								<div class="datos_ejercicio">
									<input type="hidden" id="oid_e" name="oid_e"
										value="' . $oid_e . '" />		
									<input type="hidden" id="nombreEjercicio" name="nombreEjercicio"
										value="' . $nombreEjercicio . '" />
									<input type="hidden" id="descripcion" name="descripcion"
										value="' . $descripcion . '" />
									<input type="hidden" id="repeticiones" name="repeticiones"
										value="' . $repeticiones . '" />
									<input type="hidden" id="duracion" name="duracion"
										value="' . $duracion . '" />
									<input type="hidden" id="series" name="series"
										value="' . $series . '" />
										
									<br>										
									<div class="nombres">' .  $nombreEjercicio . ': ' . $descripcion . ' [' . $duracion . ' min]</div>

									<div class="form-group">
								<label for="numOrden">Número de orden: *</label>
										<input class="form-control" id="numOrden" name="numOrden" type="text" size="5" required />
									</div>
																																		
								</div>
					
								<div id="botones_fila">
									<button class="btn btn-primary" id="añadir" name="añadir" type="submit" class="editar_fila">
										Añadir
									</button>
								</div>
							</div>
						</form>
					</article>';
						
			} else if($repeticiones != NULL) {
				$mensaje .= '
					<article class="ejercicio">
						<form method="post" action="accion_anadir_ejercicio.php">
							<div class="fila_ejercicio">
								<div class="datos_ejercicio">
									<input type="hidden" id="oid_e" name="oid_e"
										value="' . $oid_e . '" />		
									<input type="hidden" id="nombreEjercicio" name="nombreEjercicio"
										value="' . $nombreEjercicio . '" />
									<input type="hidden" id="descripcion" name="descripcion"
										value="' . $descripcion . '" />
									<input type="hidden" id="repeticiones" name="repeticiones"
										value="' . $repeticiones . '" />
									<input type="hidden" id="duracion" name="duracion"
										value="' . $duracion . '" />
									<input type="hidden" id="series" name="series"
										value="' . $series . '" />
										
									<br>
									<div class="nombres">' . $nombreEjercicio . ': ' . $descripcion . ' [' . $series . ' series, ' . $repeticiones . ' reps/serie]</div>										
									
									<div class="form-group">
								<label for="numOrden">Número de orden: *</label>
										<input class="form-control" id="numOrden" name="numOrden" type="text" size="5" required />
									</div>
								
							</div>
					
								<div id="botones_fila">
									<button id="añadir" name="añadir" type="submit" class="editar_fila">
										Añadir
									</button>
								</div>
							</div>
						</form>
					</article>';
					}
			}
		}
	
	echo $mensaje;
	
?>

