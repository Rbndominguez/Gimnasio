<?php

	require_once("../gestionBD.php");
	require_once("../comida/gestionComidas.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaComida($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		echo '<p>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
		foreach($filas as $fila) {
			$oid_c = $fila['oid_c'];
			$nombreComida = $fila['nombrecomida'];
			$descripcion = $fila['descripcion'];
	
			$mensaje .= '
				<article class="comida">
					<form method="post" action="accion_anadir_comida.php">
						<div class="fila_comida">
							<div class="datos_comida">		
								<input type="hidden" id="oid_c" name="oid_c"
									value="' . $oid_c . '" />
								<input type="hidden" id="nombreComida" name="nombreComida"
									value="' . $nombreComida . '" />
								<input type="hidden" id="descripcion" name="descripcion"
									value="' . $descripcion . '" />
									
								<div class="nombres">' . $nombreComida. ': ' . $descripcion . '</div>

								<div class="form-group">
								<label for="dia">Día: *</label>
								<select class="form-select" id="dia" name="dia" size="1" required>
										<option>Seleccione un día de la lista</option>
										<option value="Lunes">Lunes</option>
										<option value="Martes">Martes</option>
										<option value="Miercoles">Miércoles</option>
										<option value="Jueves">Jueves</option>
										<option value="Viernes">Viernes</option>
										<option value="Sabado">Sábado</option>
										<option value="Domingo">Domingo</option>
									</select>
								</div>
								<div class="form-group">
								<label for="hora">Hora: *</label>
								<input type="text" class="form-control" id="hora" name="hora" placeholder="HH:MM" pattern="^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$" required/>
								</div>
								
							</div>
										
							<button class="btn btn-primary" id="añadir" name="añadir" type="submit" class="editar_fila">
								Añadir
							</button>
									
						</div>
						<br>
					</form>
				</article>';
			}
		}
	
	echo $mensaje;
	
?>

