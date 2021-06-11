<?php

	require_once("../gestionBD.php");
	require_once("gestionSalarios.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaSalario($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		echo '<p>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
		foreach($filas as $fila) {
			$oid_sm = $fila['oid_sm'];
			$cantidad = $fila['cantidad'];
			$fecha = $fila['fecha'];
			$dni = $fila['dnimonitor'];
			$apellidos = $fila['apellidos'];
			$nombre = $fila['nombre'];
				
			$mensaje .= '
				<article class="salario">
					<form method="post" action="controlador_salarios.php">
						<div class="fila_salario">
							<div class="datos_salario">		
								<input type="hidden" id="oid_sm" name="oid_sm"
									value="' . $oid_sm . '" />
								<input type="hidden" id="cantidad" name="cantidad"
									value="' . $cantidad . '" />
								<input type="hidden" id="fecha" name="fecha"
									value="' . $fecha . '" />
								<input type="hidden" id="dniMonitor" name="dniMonitor"
									value="' . $dni . '" />
								<div class="nombres">' . $fecha . ' - ' . $cantidad . '€ cobrados por ' . $apellidos . ', ' . $nombre . '</div>
							
							</div>
							
							<div id="botones_fila">
								<button id="editar" name="editar" type="submit" class="editar_fila">
									<img src="../images/editar_small.png" class="editar_fila" alt="Editar pedido">
								</button>
								<button id="borrar" name="borrar" type="submit" class="editar_fila">
									<img src="../images/remove_small.png" class="editar_fila" alt="Borrar pedido">
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

