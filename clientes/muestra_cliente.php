<?php
	session_start();
	
	$cliente = $_SESSION["cliente"];
	unset($_SESSION["cliente"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	}

	require_once("../gestionBD.php");
	require_once("gestionarClientes.php");
	
	$conexion = crearConexionBD();
	$num_clases = tieneClases($conexion, $cliente);
	$clases = getClases($conexion, $cliente);
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información del cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="consulta_clientes.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_clientes.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Datos del cliente</h4>
            </div>
            <div class="card-body">
			<p><b>Nombre: </b><?php echo $cliente["nombre"];?></p>
	<p><b>Apellidos: </b><?php echo $cliente["apellidos"];?></p>
	<p><b>DNI: </b><?php echo $cliente["dni"];?></p>
	<p><b>Direccion: </b><?php echo $cliente["direccion"];?></p>
	<p><b>Código Postal: </b><?php echo $cliente["codigoPostal"];?></p>
	<p><b>Email: </b><?php echo $cliente["email"];?></p>
	<p><b>Teléfono: </b><?php echo $cliente["telefono"];?></p>
	<p><b>Lesiones: </b><?php echo $cliente["lesiones"];?></p>
	<p><b>Estudiante: </b><?php if($cliente["esEstudiante"] == 0){
								echo "No";
							} else if($cliente["esEstudiante"] == 1){
								echo "Sí";
							} ?>	
	</p>
	<p><b>Entrenamiento personal: </b><?php if($cliente["entrenamientoPersonal"] == 0){
								echo "No";
							} else if($cliente["entrenamientoPersonal"] == 1){
								echo "Sí";
							} ?>	
	</p>
	<p><b>¿Está activo?: </b><?php if($cliente["estaBaja"] == 0){
								echo "Sí";
							} else if($cliente["estaBaja"] == 1){
								echo "No";
							} ?>	
	</p>
	<?php 
		if($cliente["oid_te"] != NULL){
			$conexion = crearConexionBD();
			$tabla = getTabla($conexion, $cliente["oid_te"]);
			cerrarConexionBD($conexion);
	?>
			<p><b>Tabla de Ejercicios: </b><?php echo $tabla;?></p> 
	<?php }
		if($cliente["oid_di"] != NULL){
			$conexion = crearConexionBD(); 
			$dieta = getDieta($conexion, $cliente["oid_di"]); 
			cerrarConexionBD($conexion);
	?>
			<p><b>Dieta: </b><?php echo $dieta;?></p>
	<?php } 
					
					if ($num_clases > 0) { ?>
						<p><b>Asiste a: </b>
						<?php foreach($clases as $clase) { ?>
													
							<form method="post" action="controlador_clientes.php">
								<input type="hidden" id="oid_cl" name="oid_cl"
									value="<?php echo $clase["oid_cl"]; ?>" />
								<input type="hidden" id="nombreClase" name="nombreClase"
									value="<?php echo $clase["nombreclase"]; ?>" />
								<input type="hidden" id="horario" name="horario"
									value="<?php echo $clase["horario"]; ?>" />
								<input type="hidden" id="dniMonitor" name="dniMonitor"
									value="<?php echo $clase["dnimonitor"]; ?>" />
								<input type="hidden" id="sala" name="sala"
									value="<?php echo $clase["sala"]; ?>" />
								
								<input type="hidden" id="nombre" name="nombre"
									value="<?php echo $cliente["nombre"]; ?>" />
								<input type="hidden" id="apellidos" name="apellidos"
									value="<?php echo $cliente["apellidos"]; ?>" />
								<input type="hidden" id="dni" name="dni"
									value="<?php echo $cliente["dni"]; ?>" />
								<input type="hidden" id="direccion" name="direccion"
									value="<?php echo $cliente["direccion"]; ?>" />
								<input type="hidden" id="codigoPostal" name="codigoPostal"
									value="<?php echo $cliente["codigoPostal"]; ?>" />
								<input type="hidden" id="email" name="email"
									value="<?php echo $cliente["email"]; ?>" />
								<input type="hidden" id="telefono" name="telefono"
									value="<?php echo $cliente["telefono"]; ?>" />
								<input type="hidden" id="lesiones" name="lesiones"
									value="<?php echo $cliente["lesiones"]; ?>" />
								<input type="hidden" id="esEstudiante" name="esEstudiante"
									value="<?php echo $cliente["esEstudiante"]; ?>" />
								<input type="hidden" id="entrenamientoPersonal" name="entrenamientoPersonal"
									value="<?php echo $cliente["entrenamientoPersonal"]; ?>" />
								<input type="hidden" id="estaBaja" name="estaBaja"
									value="<?php echo $cliente["estaBaja"]; ?>" />
								<input type="hidden" id="oid_te" name="oid_te"
										value="<?php echo $cliente["oid_te"]; ?>" />
								<input type="hidden" id="oid_di" name="oid_di"
										value="<?php echo $cliente["oid_di"]; ?>" />

								<p>
								<button class="btn btn-primary" id="mostrarClase" name="mostrarClase" type="submit" class="editar_fila"><?php echo $clase["nombreclase"];?></button>
								<button class="btn btn-outline-danger" id="quitarClase" name="quitarClase" type="submit" class="editar_fila">Quitar Clase</button>
								</p>
							</form>
						<?php } 
					 } ?>

	<article class="cliente">
		<form method="post" action="controlador_clientes.php">
			<div class="fila_cliente">
				<div class="datos_cliente">
					<input type="hidden" id="nombre" name="nombre"
						value="<?php echo $cliente["nombre"]; ?>" />
					<input type="hidden" id="apellidos" name="apellidos"
						value="<?php echo $cliente["apellidos"]; ?>" />
					<input type="hidden" id="dni" name="dni"
						value="<?php echo $cliente["dni"]; ?>" />
					<input type="hidden" id="direccion" name="direccion"
						value="<?php echo $cliente["direccion"]; ?>" />
					<input type="hidden" id="codigoPostal" name="codigoPostal"
						value="<?php echo $cliente["codigoPostal"]; ?>" />
					<input type="hidden" id="email" name="email"
						value="<?php echo $cliente["email"]; ?>" />
					<input type="hidden" id="telefono" name="telefono"
						value="<?php echo $cliente["telefono"]; ?>" />
					<input type="hidden" id="lesiones" name="lesiones"
						value="<?php echo $cliente["lesiones"]; ?>" />
					<input type="hidden" id="esEstudiante" name="esEstudiante"
						value="<?php echo $cliente["esEstudiante"]; ?>" />
					<input type="hidden" id="entrenamientoPersonal" name="entrenamientoPersonal"
						value="<?php echo $cliente["entrenamientoPersonal"]; ?>" />
					<input type="hidden" id="estaBaja" name="estaBaja"
						value="<?php echo $cliente["estaBaja"]; ?>" />
					<input type="hidden" id="oid_te" name="oid_te"
							value="<?php echo $cliente["oid_te"]; ?>" />
					<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $cliente["oid_di"]; ?>" />
				</div>
				
				<div id="botones_fila">
					<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
					<i class="fa fa-edit" class="editar_fila" alt="Editar cliente"></i>
					</button>
					
					<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila" >
					<i class="fa fa-trash" class="editar_fila" alt="Borrar cliente"></i>
						</button>
					
					<?php if ($cliente["oid_te"] == NULL) { ?>
						<button class="btn btn-outline-primary" id="asignarTE" name="asignarTE" type="submit" class="editar_fila">
							Asignar TE
						</button>
					<?php } else { ?>
						<button class="btn btn-outline-danger" id="quitarTE" name="quitarTE" type="submit" class="editar_fila">
							Quitar TE
						</button>
					<?php } 
					
					if ($cliente["oid_di"] == NULL) { ?>
						<button class="btn btn-outline-primary" id="asignarDI" name="asignarDI" type="submit" class="editar_fila">
							Asignar DI
						</button>
					<?php } else { ?>
						<button class="btn btn-outline-danger" id="quitarDI" name="quitarDI" type="submit" class="editar_fila">
							Quitar DI
						</button>
					<?php } ?>
					
					<button class="btn btn-outline-primary" id="asisteClase" name="asisteClase" type="submit" class="editar_fila">
						Asiste Clase
					</button>
					
					<?php if ($cliente["estaBaja"] == 0) { ?>
						<button class="btn btn-outline-danger" id="darBaja" name="darBaja" type="submit" class="editar_fila">
							Dar Baja
						</button>
					<?php } else { ?>
						<button class="btn btn-outline-primary" id="darAlta" name="darAlta" type="submit" class="editar_fila">
							Dar Alta
						</button>
					<?php } ?>
					
					<button class="btn btn-danger" onClick="window.close();opener.location.reload();">Cerrar</button>
				</div>
				
			</div>
		</form>
		</article>
            </div>
        </div>
    </div>
	

</body>

</html>

