<?php

	require_once("../gestionBD.php");
	require_once("gestionPagos.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if (isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaPagos($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		if ($filas == NULL) {
			$mensaje = "<p>No hay ningún pago con ese nombre o importe</p>";
		} else {
		echo '<p><br>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
		foreach($filas as $fila) {
			$oid_pa = $fila['oid_pa'];
			$importePago = $fila['importepago'];
			$fechaPago = $fila['fechapago'];
			$motivo = $fila['motivo'];
			$tipoPago = $fila['tipopago'];
			$dni = $fila['dni'];
			$oid_pasis = $fila['oid_pasis'];
							
			$mensaje .= '
				<article class="pago">
					<form method="post" action="controlador_pagos.php">
						<div class="fila_pago">
							<div class="datos_pago">		
								<input type="hidden" id="oid_pa" name="oid_pa"
									value="' . $oid_pa . '" />
								<input type="hidden" id="importePago" name="importePago"
									value="' . $importePago . '" />
								<input type="hidden" id="fechaPago" name="fechaPago"
									value="' . $fechaPago . '" />
								<input type="hidden" id="motivo" name="motivo"
									value="' . $motivo . '" />
								<input type="hidden" id="tipoPago" name="tipoPago"
									value="' . $tipoPago . '" />
								<input type="hidden" id="dni" name="dni"
									value="' . $dni . '" />
								<input type="hidden" id="oid_pasis" name="oid_pasis"
									value="' . $oid_pasis . '" />
								<br>
								<button class="btn btn-primary" id="mostrar" name="mostrar" type="submit" class="mostrar_fila">
									<div class="nombres">' . $fechaPago . ', ' . $importePago.'</div>
								</button>
					
							</div>
							<br>
							<div id="botones_fila">
							<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
									<i class="fa fa-edit" class="editar_fila" alt="Editar pago"></i>
								</button>
								<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila">
									<i class="fa fa-trash" class="editar_fila" alt="Borrar pago"></i>
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

