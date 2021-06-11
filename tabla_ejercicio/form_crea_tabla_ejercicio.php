<?php
	session_start();
	if (!isset($_SESSION["form_tabla_ejercicio"])) {
		$form_tabla_ejercicio["nombreTablaE"] = "";
		$form_tabla_ejercicio["descripcion"] = "";
		$form_tabla_ejercicio["duracion"] = "";
		$form_tabla_ejercicio["recuperacion"] = "";
	
		$_SESSION["form_tabla_ejercicio"] = $form_tabla_ejercicio;
	}
	else {
		$form_tabla_ejercicio = $_SESSION["form_tabla_ejercicio"];
	}
	if (isset($_SESSION["errores"])) {
		$errores = $_SESSION["errores"];
	}
?>
<!DOCTYPE HTML>
<html lang = "es">
<head>
	<meta charset="UTF-8">
	<title>Crear Tabla de Ejercicios</title>
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
            <a href="consulta_tablas_ejercicios.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_tablas_ejercicios.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Tabla de Ejercicios</h4>
            </div>
            <div class="card-body">
		<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h6> Errores en el formulario:</h6>";
    		foreach($errores as $error) echo '<em style="font-size:14px">'.$error."</em>"; 
    		echo "</div>";
  		}
		?>
		
		<form id="form_tabla_ejercicio" method="post" action="accion_crea_tabla_ejercicio.php" novalidate>
		<section class="section">
	<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>

			<div class="form-group">
            <label for="nombreTablaE">Nombre: *</label>
        	<input type="text" class="form-control" id="nombreTablaE" name="nombreTablaE" value="<?php echo $form_tabla_ejercicio["nombreTablaE"];?>" required/>
            </div>

			<div class="form-group">
            <label for="descripcion">Descripción: </label>
        	<input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $form_tabla_ejercicio["descripcion"];?>"/>
            </div>

			<div class="form-group">
            <label for="duracion">Duración: *</label>
        	<input type="text" class="form-control" id="duracion" name="duracion" value="<?php echo $form_tabla_ejercicio["duracion"];?>" required/>
            </div>

			<div class="form-group">
			<label for="recuperacion">¿Recuperación? * </label>
				<input class="form-check-input" type="radio" id="recuperacion" name="recuperacion" value="<?php echo $form_tabla_ejercicio["recuperacion"] = 1; ?>"/>
				<label class="form-check-label">
					Sí
				</label>
				<input class="form-check-input" type="radio" id="recuperacion" name="recuperacion" value="<?php echo $form_tabla_ejercicio["recuperacion"] = 0; ?>"/>
				<label class="form-check-label">
					No
				</label>
			</div>
				</div>
	</div>
	<div class="col-sm-12 d-flex justify-content-end">
								</br>
								<input class="btn btn-primary me-1 mb-1" id="boton" type="submit" value="Enviar">
								<input class="btn btn-light-secondary me-1 mb-1" id="boton" type="reset" value="Limpiar el formulario">
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