<?php
	session_start();
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	} 
	
	$form_modifica_cliente = $_SESSION["cliente"];
			
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Modificar Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
		
	<form id="modificaCliente" method="post" action="accion_modificar_cliente.php" novalidate>
	<section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
								<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>
                                    
									<div class="form-group">
                                        <label for="nombre">Nombre: *</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $form_modifica_cliente['nombre'];?>" required/>
                                    </div>

									<div class="form-group">
									<label for="apellidos">Apellidos: *</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $form_modifica_cliente['apellidos'];?>" required/>
                                    </div>

									<div>
									<input id="dni" name="dni" type="hidden" value="<?php echo $form_modifica_cliente['dni'];?>" />
									</div>

									<div class="form-group">
									<label for="direccion">Dirección:</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $form_modifica_cliente['direccion'];?>"/>
                                    </div>

									<div class="form-group">
									<label for="codigoPostal">Código Postal:</label>
                                        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" value="<?php echo $form_modifica_cliente['codigoPostal'];?>"/>
                                    </div>

									<div class="form-group">
									<label for="esEstudiante">Estudiante:* </label>
                                        <input class="form-check-input" type="radio" name="esEstudiante" value="1" <?php if($form_modifica_cliente['esEstudiante']==1) echo ' checked ';?>/>
                                        <label class="form-check-label">
                                            Sí
                                        </label>
										<input class="form-check-input" type="radio" name="esEstudiante" value="0" <?php if($form_modifica_cliente['esEstudiante']==0) echo ' checked ';?>/>
                                        <label class="form-check-label">
                                            No
                                        </label>
                                    </div>

									<div class="form-group">
									<label for="entrenamientoPersonal">Entrenamiento Personal: </label>
                                        <input class="form-check-input" type="radio" name="entrenamientoPersonal" value="1" <?php if($form_modifica_cliente['entrenamientoPersonal']==1) echo ' checked ';?>/>
                                        <label class="form-check-label">
                                            Sí
                                        </label>
										<input class="form-check-input" type="radio" name="entrenamientoPersonal" value="0" <?php if($form_modifica_cliente['entrenamientoPersonal']==0) echo ' checked ';?>/>
                                        <label class="form-check-label">
                                            No
                                        </label>
                                    </div>
			
									<div>
									<input id="estaBaja" name="estaBaja" type="hidden" value="<?php echo $form_modifica_cliente['estaBaja'];?>" />
									</div>
									
									<div>
									<input id="oid_te" name="oid_te" type="hidden" value="<?php echo $form_modifica_cliente['oid_te'];?>" />
									</div>
									
									<div>
									<input id="oid_di" name="oid_di" type="hidden" value="<?php echo $form_modifica_cliente['oid_di'];?>" />
									</div>
								</div>

                                <div class="col-md-6">
								<br>
								<div class="form-group">
									<label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $form_modifica_cliente['email'];?>"/>
                                    </div>

									<div class="form-group">
									<label for="telefono">Teléfono:</label>
                                    <input type="text" size="9" class="form-control" id="telefono" name="telefono" value="<?php echo $form_modifica_cliente['telefono'];?>">
                                    </div>

									<div class="form-group">
									<label for="lesiones">Lesiones:</label>
                                     <input type="text" class="form-control" id="lesiones" name="lesiones" value="<?php echo $form_modifica_cliente['lesiones'];?>">
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
