<?php

	require_once("../gestionBD.php");
	require_once("gestionMonitores.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaMonitor($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		if ($filas == NULL) {
			$mensaje = "<p>No hay ningún monitor con ese nombre y/o apellidos</p>";
		} else {
			echo '<br>Resultados para <strong>' . $consultaBusqueda . '</strong>';
			
			foreach($filas as $fila) {
				$dniMonitor = $fila['dnimonitor'];
				$nombre = $fila['nombre'];
				$apellidos = $fila['apellidos'];
				$telefono = $fila['telefono'];
				$estaActivo = $fila['estaactivo'];
				$fechaContratacion = $fila['fechacontratacion'];
				$fechaFin = $fila['fechafin'];
				
				$mensaje .= '
					<article class="producto">
						<form method="post" action="controlador_monitores.php">
							<div class="fila_producto">
								<div class="datos_producto">
									<input type="hidden" id="dniMonitor" name="dniMonitor"
										value="' . $dniMonitor . '" />		
									<input type="hidden" id="nombre" name="nombre"
										value="' . $nombre . '" />
									<input type="hidden" id="apellidos" name="apellidos"
										value="' . $apellidos . '" />
									<input type="hidden" id="telefono" name="telefono"
										value="' . $telefono . '" />
									<input type="hidden" id="estaActivo" name="estaActivo"
										value="' . $estaActivo . '" />
									<input type="hidden" id="fechaContratacion" name="fechaContratacion"
										value="' . $fechaContratacion . '" />
									<input type="hidden" id="fechaFin" name="fechaFin"
										value="' . $fechaFin . '" />
									
									<br>
									<button class="btn btn-primary" id="mostrar" name="mostrar" type="submit" class="mostrar_fila">
										<div class="nombres">' . $apellidos . ', ' . $nombre . '</div>
									</button>
					
								</div>
								<br>
								<div id="botones_fila">
								<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
									<i class="fa fa-edit" class="editar_fila" alt="Editar monitor"></i>
								</button>
								<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila">
									<i class="fa fa-trash" class="editar_fila" alt="Borrar monitor"></i>
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
