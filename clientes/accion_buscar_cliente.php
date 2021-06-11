<?php

	require_once("../gestionBD.php");
	require_once("gestionarClientes.php");
	
	$consultaBusqueda = $_POST["valorBusqueda"];
	
	$mensaje = "";
	
	if(isset($consultaBusqueda)) {
		$conexion = crearConexionBD();
		$filas = busquedaCliente($conexion, $consultaBusqueda);
		cerrarConexionBD($conexion);
		
		echo '<p>Resultados para <strong>' . $consultaBusqueda . '</strong></p>';
			
		foreach($filas as $fila) {
			$nombre = $fila['nombrecliente'];
			$apellidos = $fila['apellidoscliente'];
			$dni = $fila['dni'];
			$direccion = $fila['direccion'];
			$codigoPostal = $fila['codigopostal'];
			$email = $fila['email'];
			$telefono = $fila['telefono'];
			$lesiones = $fila['lesiones'];
			$esEstudiante = $fila['esestudiante'];
			$entrenamientoPersonal = $fila['entrenamientopersonal'];
			$estaBaja = $fila['estabaja'];
			$oid_te = $fila['oid_te'];
			$oid_di = $fila['oid_di'];
			if ($estaBaja == 0) {
				$estaBaja = "activo";
			} else {
				$estaBaja = "de baja";
			} 
				
			$mensaje .= '
				<article class="cliente">
					<form method="post" action="controlador_clientes.php">
						<div class="fila_cliente">
							<div class="datos_cliente">		
								<input type="hidden" id="dni" name="dni"
									value="' . $dni . '" />
								<input type="hidden" id="direccion" name="direccion"
									value="' . $direccion . '" />
								<input type="hidden" id="codigoPostal" name="codigoPostal"
									value="' . $codigoPostal . '" />
								<input type="hidden" id="email" name="email"
									value="' . $email . '" />
								<input type="hidden" id="telefono" name="telefono"
									value="' . $telefono . '" />
								<input type="hidden" id="lesiones" name="lesiones"
									value="' . $lesiones . '" />
								<input type="hidden" id="esEstudiante" name="esEstudiante"
									value="' . $esEstudiante . '" />
								<input type="hidden" id="entrenamientoPersonal" name="entrenamientoPersonal"
									value="' . $entrenamientoPersonal . '" />
								<input type="hidden" id="oid_te" name="oid_te"
									value="' . $oid_te . '" />
								<input type="hidden" id="oid_di" name="oid_di"
									value="' . $oid_di. '" />

								<input type="hidden" id="apellidos" name="apellidos"
									value="' . $apellidos . '" />
								<input type="hidden" id="nombre" name="nombre"
									value="' . $nombre . '" />
								<input type="hidden" id="estaBaja" name="estaBaja"
									value="' . $estaBaja . '" />
									
								<button class="btn btn-outline-primary" id="mostrar" name="mostrar" type="submit" class="mostrar_fila">
									<div class="nombres">' . $apellidos . ', ' . $nombre . ' [' . $estaBaja . ']</div>
								</button>
					
							</div>
							<br>
							<div id="botones_fila">
								<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
									<i class="fa fa-edit" class="editar_fila" alt="Editar cliente"></i>
								</button>
								<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila">
									<i class="fa fa-trash" class="editar_fila" alt="Borrar cliente"></i>
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

