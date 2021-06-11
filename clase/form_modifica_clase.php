<?php
	session_start();
	require_once ("../gestionBD.php");
	require_once ("gestionClases.php");
	$form_modifica_clase = $_SESSION["clase"];
	
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Modificar clase</title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="consulta_clases.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_clases.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
		<form id="form_modifica_clase" method="post" action="accion_modificar_clase.php" novalidate>
		<section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Datos de la clase</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
								<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>
				<div>
					<input id="oid_cl" name="oid_cl" type="hidden" value="<?php echo $form_modifica_clase["oid_cl"]; ?>" required/>
				</div>

				<div class="form-group">
					<label for="nombreClase">Nombre: *</label>
					<input type="text" class="form-control" id="nombreClase" name="nombreClase" value="<?php echo $form_modifica_clase["nombreClase"];?>" required/>
				</div>

				<div class="form-group">
					<label for="horario">Horario: *</label>
					<input type="text" class="form-control" id="horario" name="horario" value="<?php echo $form_modifica_clase["horario"];?>" required/>
				</div>

				<div class="form-group">
				<label for="dniMonitor">Monitor: *</label>
				<select class="form-select" id="dniMonitor" name="dniMonitor" size="1" required>
                        <option label="Selecciona un monitor" value="">
						<?php
						$conexion = crearConexionBD();
						$monitores = listarMonitores($conexion);
						cerrarConexionBD($conexion);
		
						foreach ($monitores as $monitor) {
							if ($monitor["dnimonitor"] == $form_modifica_clase["dniMonitor"]) {
								echo "<option label='" . $monitor["apellidos"] . ", " . $monitor["nombre"] . "' value='" . $monitor["dnimonitor"] . "' selected > ";
							} else {
								echo "<option label='" . $monitor["apellidos"] . ", " . $monitor["nombre"] . "' value='" . $monitor["dnimonitor"] . "'>";
							}
						}
						?>
					</select>
				</div>
				
				<div>
					<input id="nombre" name="nombre" type="hidden" value="<?php echo $form_modifica_clase["nombre"]; ?>" required/>
				</div>
				
				<div>
					<input id="apellidos" name="apellidos" type="hidden" value="<?php echo $form_modifica_clase["apellidos"]; ?>" required/>
				</div>

				<div class="form-group">
				<label for="sala">Sala: *</label>
				<select class="form-select" id="sala" name="sala" size="1" required>
						<option value="SalaDeMusculacion" <?php if($form_modifica_clase["sala"]=="SalaDeMusculacion") echo "selected"; ?>>Sala de musculación</option>
						<option value="SalaDeSpinning" <?php if($form_modifica_clase["sala"]=="SalaDeSpinning") echo "selected"; ?>>Sala de spinning</option>
						<option value="SalaMultiusos" <?php if($form_modifica_clase["sala"]=="SalaMultiusos") echo "selected"; ?>>Sala multiusos</option>
						</select>
				</div>
						</div>
						</div>
			<div class="col-sm-12 d-flex justify-content-end">
								</br>
								<input class="btn btn-primary me-1 mb-1" id="boton" type="submit" value="Enviar">
								<input class="btn btn-light-secondary me-1 mb-1" id="boton" type="reset" value="Reset">
								<button class="btn btn-danger me-1 mb-1" onClick="window.close();">Cerrar</button>
								</div>
                        </div>
                    </div>
                </section>


	</form>
    </div>
    </div>
    </div>
	
	</body>
</html>
