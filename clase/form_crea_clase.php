<?php
	session_start();
	require_once ("../gestionBD.php");
	require_once ("gestionClases.php");
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION["form_crea_clase"])) {
		$form_crea_clase["nombreClase"] = "";
		$form_crea_clase["horario"] = "";
		$form_crea_clase["dniMonitor"] = "";
		$form_crea_clase["nombre"]="";
		$form_crea_clase["apellidos"]="";
		$form_crea_clase["sala"] = "";
	
		$_SESSION["form_crea_clase"] = $form_crea_clase;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$form_crea_clase = $_SESSION["form_crea_clase"];
	
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Creación de Clase</title>
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
		<form id="form_crea_clase" method="post" action="accion_crea_clase.php" novalidate>
		<section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Datos de la clase</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
								<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>
				
				<div class="form-group">
					<label for="nombreClase">Nombre: *</label>
					<input type="text" class="form-control" id="nombreClase" name="nombreClase" value="<?php echo $form_crea_clase["nombreClase"];?>" required/>
				</div>

				<div class="form-group">
					<label for="horario">Horario: *</label>
					<input type="text" class="form-control" id="horario" name="horario" value="<?php echo $form_crea_clase["horario"];?>" required/>
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
								echo "<option label='".$monitor["apellidos"].", ".$monitor["nombre"]."' value='".$monitor["dnimonitor"]."'> ";
							}
						?>
					</select>
				</div>

						
				<div class="form-group">
				<label for="sala">Sala: *</label>
				<select class="form-select" id="sala" name="sala" size="1" required>
						<option value="<?php echo $form_crea_clase["sala"] = NULL; ?>">Seleccione una sala de la lista</option>
						<option value="<?php echo $form_crea_clase["sala"] = "SalaDeMusculacion"; ?>">Sala de musculación</option>
						<option value="<?php echo $form_crea_clase["sala"] = "SalaDeSpinning"; ?>">Sala de spinning</option>
						<option value="<?php echo $form_crea_clase["sala"] = "SalaMultiusos"; ?>">Sala Multiusos</option>
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
