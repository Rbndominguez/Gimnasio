<?php

	require_once ("../gestionBD.php");
	require_once ("gestionComidas.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if (isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaComida($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
	
		if ($filas == NULL) {
			$mensaje = "<p>No hay ninguna comida con ese nombre</p>";
		} else {
			echo 'Resultados para <strong>' . $consultaBusqueda . '</strong>';
	
			foreach ($filas as $fila) {
				$oid_c = $fila['oid_c'];
				$nombreComida = $fila['nombrecomida'];
				$descripcion = $fila['descripcion'];
	
				$mensaje .= '
						<article class="comida">
							<form method="post" action="controlador_comidas.php">
								<div class="fila_comida">
									<div class="datos_comida">		
										<input type="hidden" id="oid_c" name="oid_c"
											value="' . $oid_c . '" />
										<input type="hidden" id="nombreComida" name="nombreComida"
											value="' . $nombreComida . '" />
										<input type="hidden" id="descripcion" name="descripcion"
											value="' . $descripcion . '" />
										
										<br>
										<div class="nombres">' . $nombreComida. ': ' . $descripcion . '</div>
								
									</div>
					
									<div id="botones_fila">
									<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
									<i class="fa fa-edit" class="editar_fila" alt="Editar comida"></i>
									</button>
									<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila">
									<i class="fa fa-trash" class="editar_fila" alt="Borrar comida"></i>
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

