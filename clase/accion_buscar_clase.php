<?php

	require_once("../gestionBD.php");
	require_once("gestionClases.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaClase($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		echo '<p>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
		foreach($filas as $fila) {
			$oid_cl = $fila['oid_cl'];
			$nombreClase = $fila['nombreclase'];
			$horario = $fila['horario'];
			$dniMonitor = $fila['dnimonitor'];
			$sala = $fila['sala'];	
			$mensaje .= '
				<article class="clase">
					<form method="post" action="controlador_clases.php">
						<div class="fila_clase">
							<div class="datos_clase">	
								<input type="hidden" id="oid_cl" name="oid_cl"
								value="' . $oid_cl. '">	
								<input type="hidden" id="nombreClase" name="nombreClase"
									value="' . $nombreClase . '" />
								<input type="hidden" id="horario" name="horario"
									value="' . $horario . '" />
								<input type="hidden" id="dniMonitor" name="dniMonitor"
									value="' . $dniMonitor . '" />
								<input type="hidden" id="sala" name="sala"
									value="' . $sala . '" />
								<br>					
								<button class="btn btn-primary" id="mostrar" name="mostrar" type="submit" class="mostrar_fila">
									<div class="nombres">' . $nombreClase . ', ' . $horario . '</div>
								</button>
					
							</div>

				
							<div id="botones_fila">
							<br>
							<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
							<i class="fa fa-edit" class="editar_fila" alt="Editar cliente"></i>
							</button>
							<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila">
							<i class="fa fa-trash" class="editar_fila" alt="Borrar cliente"></i>
							</button>
							</div>
						</div>
					</form>
				</article>';
			}
		}
	
	echo $mensaje;
	
?>

