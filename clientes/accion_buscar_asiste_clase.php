<?php

	require_once("../gestionBD.php");
	require_once("../clase/gestionClases.php");
	
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
				
			$mensaje .= '
				<article class="clase">
					<form method="post" action="accion_asiste_clase.php">
						<div class="fila_clase">
							<div class="datos_clase">	
								<input type="hidden" id="oid_cl" name="oid_cl"
								value="' . $oid_cl. '">	
								<input type="hidden" id="nombreClase" name="nombreClase"
									value="' . $nombreClase . '" />
								<input type="hidden" id="horario" name="horario"
									value="' . $horario . '" />
																
								<div class="nombres">' . $nombreClase . ', ' . $horario . '</div>
					
							</div>
								<button class="btn btn-primary" id="asiste" name="asiste" type="submit" class="editar_fila">
									Asiste
								</button>
							
							</div>
						</div>
					</form>
				</article>';
			}
		}
	
	echo $mensaje;
	
?>

