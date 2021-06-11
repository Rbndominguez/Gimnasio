<?php

	require_once("../gestionBD.php");
	require_once("../dieta/gestionDietas.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaDieta($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		echo '<p>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
		foreach($filas as $fila) {
			$oid_di = $fila['oid_di'];
			$nombre = $fila['nombredieta'];
			$descripcion = $fila['descripcion'];
			$duracion = $fila['duracion'];
				
			$mensaje .= '
				<article class="dieta">
					<form method="post" action="accion_asignar_dieta.php">
						<div class="fila_dieta">
							<div class="datos_dieta">		
								<input type="hidden" id="oid_di" name="oid_di"
									value="' . $oid_di . '" />
								<input type="hidden" id="nombreDieta" name="nombreDieta"
									value="' . $nombre . '" />
								<input type="hidden" id="descripcion" name="descripcion"
									value="' . $descripcion . '" />
								<input type="hidden" id="duracion" name="duracion"
									value="' . $duracion . '" />
						
								<div class="nombres">' . $nombre . ', ' . $duracion . '</div>
							
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

