<?php

	require_once("../gestionBD.php");
	require_once("gestionTablaEjercicio.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaTabla($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		echo '<p><br>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
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
									<br>	
									<button class="btn btn-primary" id="mostrar" name="mostrar" type="submit" class="mostrar_fila">
										<div class="nombres">' . $nombre . ' [' . $recuperacion . ']</div>
								</button>
								
							</div>
							<br>
							<div id="botones_fila">
							<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
									<i class="fa fa-edit" class="editar_fila" alt="Editar tablaEjercicio"></i>
								</button>
								<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila">
									<i class="fa fa-trash" class="editar_fila" alt="Borrar tablaEjercicio"></i>
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

