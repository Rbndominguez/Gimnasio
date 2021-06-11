<?php
	session_start();
	
	$form_modifica_dieta = $_SESSION["dieta"];
	
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Modificar dieta</title>
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
            <a href="consulta_dietas.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_dietas.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Datos de la dieta</h4>
            </div>
            <div class="card-body">
	<form id="form_modifica_dieta" method="post" action="accion_modificar_dieta.php" novalidate>
	<section class="section">
				<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
			<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>

			<div class="form-group">
            <label for="nombreDieta">Nombre: *</label>
        	<input type="text" class="form-control" id="nombreDieta" name="nombreDieta" value="<?php echo $form_modifica_dieta["nombreDieta"];?>" required/>
            </div>

			<div class="form-group">
            <label for="descripcion">Descripción: </label>
        	<input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $form_modifica_dieta["descripcion"];?>"/>
            </div>

			<div class="form-group">
            <label for="duracion">Duración: *</label>
        	<input type="text" class="form-control" id="duracion" name="duracion" value="<?php echo $form_modifica_dieta["duracion"];?>" required/>
            </div>
			<div>
				<input id="oid_di" name="oid_di" type="hidden" value="<?php echo $form_modifica_dieta["oid_di"]; ?>" required/>
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