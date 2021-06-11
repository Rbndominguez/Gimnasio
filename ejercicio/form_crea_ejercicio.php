<?php
	session_start();
	
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['form_crea_ejercicio'])) {
		$form_crea_ejercicio['nombreEjercicio'] = "";
		$form_crea_ejercicio['descripcion'] = "";
		$form_crea_ejercicio['repeticiones'] = "";
		$form_crea_ejercicio['duracion'] = "";
		$form_crea_ejercicio['series'] = "";
		$form_crea_ejercicio['numeroOrden'] = "";
	
		$_SESSION['form_crea_ejercicio'] = $form_crea_ejercicio;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$form_crea_ejercicio = $_SESSION['form_crea_ejercicio'];
	
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])) {
		$errores = $_SESSION["errores"];
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Creación de Ejercicio</title>
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
            <a href="consulta_ejercicios.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_ejercicios.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
		<form id="form_crea_ejercicio" method="post" action="accion_crea_ejercicio.php" novalidate>
		<section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Datos del ejercicio</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
								<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>
				
				<div class="form-group">
					<label for="nombreEjercicio">Nombre del Ejercicio: *</label>
					<input type="text" class="form-control" id="nombreEjercicio" name="nombreEjercicio" value="<?php echo $form_crea_ejercicio['nombreEjercicio'];?>" required/>
				</div>
				<div class="form-group">
					<label for="descripcion">Descripción: *</label>
					<input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $form_crea_ejercicio['descripcion'];?>" required/>
				</div>
				<div class="form-group">
					<label for="repeticiones">Repeticiones:</label>
					<input type="text" class="form-control" id="repeticiones" name="repeticiones" value="<?php echo $form_crea_ejercicio['repeticiones'];?>"/>
				</div>
				<div class="form-group">
					<label for="duracion">Duración:</label>
					<input type="text" class="form-control" id="duracion" name="duracion" value="<?php echo $form_crea_ejercicio['duracion'];?>"/>
				</div>
				<div class="form-group">
					<label for="series">Series:</label>
					<input type="text" class="form-control" id="series" name="series" value="<?php echo $form_crea_ejercicio['series'];?>"/>
				</div>
				</div>
						</div>
			<br>
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