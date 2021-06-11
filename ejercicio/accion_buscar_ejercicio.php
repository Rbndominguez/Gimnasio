<?php

	require_once("../gestionBD.php");
	require_once("gestionEjercicios.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaEjercicio($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		if ($filas == NULL) {
			$mensaje = "<p>No hay ningún producto con ese nombre y/o apellidos</p>";
		} else {
			echo 'Resultados para <strong>' . $consultaBusqueda . '</strong>';
			
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
							<form method="post" action="controlador_ejercicios.php">
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
																																		
									</div>
					
									<div id="botones_fila">
									<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
									<i class="fa fa-edit" class="editar_fila" alt="Editar ejercicio"></i>
									</button>
									<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila">
									<i class="fa fa-trash" class="editar_fila" alt="Borrar ejercicio"></i>
									</button>
									</div>
								</div>
							</form>
						</article>';
						
				} else if($repeticiones != NULL) {
					$mensaje .= '
						<article class="ejercicio">
							<form method="post" action="controlador_ejercicios.php">
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
						
									</div>
					
									<div id="botones_fila">
									<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
									<i class="fa fa-edit" class="editar_fila" alt="Editar ejercicio"></i>
									</button>
									<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila">
									<i class="fa fa-trash" class="editar_fila" alt="Borrar ejercicio"></i>
									</button>
									</div>
								</div>
							</form>
						</article>';
				}
			}
		}
	}
	
	echo $mensaje;
	
?>

