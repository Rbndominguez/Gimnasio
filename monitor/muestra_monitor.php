<?php
	session_start();
	
	$monitor = $_SESSION["monitor"];
	unset($_SESSION["monitor"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	} 

	require_once("../gestionBD.php");
	require_once("gestionMonitores.php");
	
	$conexion = crearConexionBD();
	$num_clases = tieneClases($conexion, $monitor);
	$clases = getClases($conexion, $monitor);
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información del monitor</title>
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
            <a href="consulta_monitores.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_monitores.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Datos del Monitor</h4>
            </div>
            <div class="card-body">
	<p><b>DNI del monitor: </b><?php echo $monitor["dniMonitor"];?></p>
	<p><b>Nombre: </b><?php echo $monitor["nombre"];?></p>
	<p><b>Apellidos: </b><?php echo $monitor["apellidos"];?></p>
	<p><b>Telefono: </b><?php echo $monitor["telefono"];?></p>
	<p><b>¿Está activo?: </b><?php if($monitor["estaActivo"] == 0){
			echo "No";
		} else if($monitor["estaActivo"] == 1){
			echo "Sí";
		} ?></p>
	<p><b>Fecha de contratación: </b><?php echo $monitor["fechaContratacion"];?></p>
	<?php if($monitor["fechaFin"] != NULL) { ?>
		<p><b>Fecha de finalización de contrato: </b><?php echo $monitor["fechaFin"];?></p>
	<?php } 
		if ($num_clases > 0) { ?>
			<p><b>Imparte: </b>
			<?php foreach($clases as $clase) {
				if($clase["sala"] == "SalaDeMusculacion") {
					$sala = "Sala de musculación";
				} else if($clase["sala"] == "SalaDeSpinning") {
					$sala = "Sala de spinning";
				} else if($clase["sala"] == "SalaMultiusos") {
					$sala = "Sala multiusos";
				}
				echo "<p>" . $clase["nombreclase"] . " - " . $clase["horario"] . " - " . $sala . "</p>";?>
			<?php } 
		 } ?>
	
	<article class="monitor">
		<form method="post" action="controlador_monitores.php">
			<div class="fila_monitor">
				<div class="datos_monitor">		
					<input type="hidden" id="dniMonitor" name="dniMonitor"
						value="<?php echo $monitor["dniMonitor"]; ?>" />
					<input type="hidden" id="nombre" name="nombre"
						value="<?php echo $monitor["nombre"]; ?>" />
					<input type="hidden" id="apellidos" name="apellidos"
						value="<?php echo $monitor["apellidos"]; ?>" />
					<input type="hidden" id="telefono" name="telefono"
						value="<?php echo $monitor["telefono"]; ?>" />
					<input type="hidden" id="estaActivo" name="estaActivo"
						value="<?php echo $monitor["estaActivo"]; ?>" />
					<input type="hidden" id="fechaContratacion" name="fechaContratacion"
						value="<?php echo $monitor["fechaContratacion"]; ?>" />
					<input type="hidden" id="fechaFin" name="fechaFin"
						value="<?php echo $monitor["fechaFin"]; ?>" />
				
				</div>
				
				<div id="botones_fila">
				<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
					<i class="fa fa-edit" class="editar_fila" alt="Editar monitor"></i>
					</button>
					
					<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila" >
					<i class="fa fa-trash" class="editar_fila" alt="Borrar monitor"></i>
						</button>
					<?php if ($monitor["estaActivo"] == 1) { ?>
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

