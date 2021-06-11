<?php

	require_once("../gestionBD.php");
	require_once("gestionDietas.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaDieta($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		echo '<p><br>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
		foreach($filas as $fila) {
			$oid_di = $fila['oid_di'];
			$nombre = $fila['nombredieta'];
			$descripcion = $fila['descripcion'];
			$duracion = $fila['duracion'];
				
			$mensaje .= '
				<article class="dieta">
					<form method="post" action="controlador_dietas.php" target="popup" 
							onsubmit="window.open("", "popup", "toolbar=NO , location=NO , status=NO , menubar=NO , scrollbars=NO , resizable=1 ,left=300em,top=150em,width=800em,height=400em");">
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
									<br>	
								<button class="btn btn-primary" id="mostrar" name="mostrar" type="submit" class="mostrar_fila">
										<div class="nombres">' . $nombre . ', ' . $duracion . '</div>
								</button>
							
							</div>
							<br>
							<div id="botones_fila">
								<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
									<i class="fa fa-edit" class="editar_fila" alt="Editar dieta"></i>
								</button>
								<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila">
									<i class="fa fa-trash" class="editar_fila" alt="Borrar dieta"></i>
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

