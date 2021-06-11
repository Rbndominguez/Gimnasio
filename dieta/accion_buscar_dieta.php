<?php

	require_once("../gestionBD.php");
	require_once("gestionDietas.php");
	
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
								<button id="mostrar" name="mostrar" type="submit" class="mostrar_fila">
										<div class="nombres">' . $nombre . ', ' . $duracion . '</div>
								</button>
							
							</div>
							
							<div id="botones_fila">
								<button id="editar" name="editar" type="submit" class="editar_fila">
									<img src="../images/editar_small.png" class="editar_fila" alt="Editar dieta">
								</button>
								<button id="borrar" name="borrar" type="submit" class="editar_fila">
									<img src="../images/remove_small.png" class="editar_fila" alt="Borrar dieta">
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

