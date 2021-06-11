<?php

require_once ("../gestionBD.php");
require_once ("gestionPeriodosAsistencia.php");

$consultaBusqueda = $_POST["valorBusqueda"];

$mensaje = "";

if (isset($consultaBusqueda)) {
	$conexion = crearConexionBD();
	$filas = busquedaPeriodoAsistencia($conexion, $consultaBusqueda);
	cerrarConexionBD($conexion);

	if ($filas == NULL) {
		$mensaje = "<p>No hay ningún periodo de asistencia con ese nombre</p>";
	} else {
		echo 'Resultados para <strong>' . $consultaBusqueda . '</strong>';

		foreach ($filas as $fila) {
			$oid_pasis = $fila['oid_pasis'];
			$fechaInicio = $fila['fechainicio'];
			$fechaFin = $fila['fechafin'];
			$numeroDias = $fila['numerodias'];
			$dni = $fila['dni'];
			$nombre = $fila['nombrecliente'];
			$apellidos = $fila['apellidoscliente'];

			$mensaje .= '
					<article class="periodoAsistencia">
						<form method="post" action="controlador_periodos_asistencia.php">
							<div class="fila_periodoAsistencia">
								<div class="datos_periodoAsistencia">		
									<input type="hidden" id="oid_pasis" name="oid_pasis"
										value="' . $oid_pasis . '" />
									<input type="hidden" id="fechaInicio" name="fechaInicio"
										value="' . $fechaInicio . '" />
									<input type="hidden" id="fechaFin" name="fechaFin"
										value="' . $fechaFin . '" />
									<input type="hidden" id="numeroDias" name="numeroDias"
										value="' . $numeroDias . '" />
									<input type="hidden" id="dni" name="dni"
										value="' . $dni . '" />
									<input type="hidden" id="nombre" name="nombre"
										value="' . $nombre . '" />
									<input type="hidden" id="apellidos" name="apellidos"
										value="' . $apellidos . '" />
									<button id="mostrar" name="mostrar" type="submit" class="mostrar_fila">
										<div class="nombres">' . $fechaInicio. ' - ' . $fechaFin. '</div>
									</button>
					
								</div>
				
								<div id="botones_fila">
									<button id="editar" name="editar" type="submit" class="editar_fila">
										<img src="../images/editar_small.png" class="editar_fila" alt="Editar periodo de asistencia">
									</button>
									<button id="borrar" name="borrar" type="submit" class="editar_fila">
										<img src="../images/remove_small.png" class="editar_fila" alt="Borrar periodo de asistencia">
									</button>
								</div>
							</div>
						</form>
						<br>
					</article>';
		}
	}
}

echo $mensaje;
?>

