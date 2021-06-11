<?php
	session_start();
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	} 
	require_once ("../gestionBD.php");
	require_once ("gestionMonitores.php");
	
	$form_modifica_monitor = $_SESSION["monitor"];
	
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Modificar monitor</title>
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
            <a href="consulta_monitores.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_monitores.php">
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
		<form id="form_modifica_monitor" method="post" action="accion_modificar_monitor.php" novalidate>
		<section class="section">
		<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
		<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>

			<div class="form-group">
            <label for="dniMonitor">DNI: *</label>
        	<input type="text" class="form-control" id="dniMonitor" name="dniMonitor" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]{1}$" title="8 digitos seguidos de una letra mayúscula" size="50" value="<?php echo $form_modifica_monitor["dniMonitor"]; ?>"required>
            </div>
			<div class="form-group">
            <label for="nombre">Nombre: *</label>
        	<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $form_modifica_monitor['nombre'];?>" required/>
            </div>

			<div class="form-group">
            <label for="apellidos">Apellidos: *</label>
        	<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $form_modifica_monitor['apellidos'];?>" required/>
            </div>

			<div class="form-group">
            <label for="telefono">Teléfono:</label>
        	<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $form_modifica_monitor['telefono'];?>"/>
            </div>		

			<div class="form-group">
            <label for="fechaContratacion">Fecha de contratación: *</label>
        	<input type="date" class="form-control" id="fechaContratacion" name="fechaContratacion" value="<?php echo parseaFechaFormulario($form_modifica_monitor["fechaContratacion"]);?>" required/>
            </div>	

			<div>
			<label for="estaActivo"></label>
			<input id="estaActivo" name="estaActivo" type="hidden" value="<?php echo $form_modifica_monitor["estaActivo"] = 1; ?>"required>
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
