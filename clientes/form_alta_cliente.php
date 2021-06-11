<?php
	session_start();

	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	} 

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION['form_alta_cliente'])) {
		$form_alta_cliente['nombre'] = "";
		$form_alta_cliente['apellidos'] = "";
		$form_alta_cliente['dni'] = "";
		$form_alta_cliente['direccion'] = "";
		$form_alta_cliente['codigoPostal'] = "";
		$form_alta_cliente['email'] = "";
		$form_alta_cliente["password"] = "";
		$form_alta_cliente["confirmPassword"] = "";
		$form_alta_cliente['telefono'] = "";
		$form_alta_cliente['lesiones'] = "";
		$form_alta_cliente['esEstudiante'] = 0;
		$form_alta_cliente['entrenamientoPersonal'] = 0;
	
		$_SESSION['form_alta_cliente'] = $form_alta_cliente;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else
		$form_alta_cliente = $_SESSION['form_alta_cliente'];
			
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Alta de Cliente</title>
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
	
	<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h6> <em>Errores en el formulario:</em></h6>";
    		foreach($errores as $error) echo '<em style="font-size:14px">'.$error."</em>"; 
    		echo "</div>";
  		}
	?>
	
	<form id="altaCliente" method="post" action="accion_alta_cliente.php" novalidate>
	<section class="section">
	<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>
			<div class="form-group">
            <label for="nombre">Nombre: *</label>
        	<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $form_alta_cliente['nombre'];?>" required/>
            </div>

			<div class="form-group">
			<label for="apellidos">Apellidos: *</label>
			<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $form_alta_cliente['apellidos'];?>" required/>
			</div>

			<div class="form-group">
			<label for="dni">DNI: *</label>
			<input type="text" class="form-control" id="dni" name="dni" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $form_alta_cliente['dni'];?>" required/>
			</div>

			<div class="form-group">
			<label for="direccion">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $form_alta_cliente['direccion'];?>"/>
            </div>

			<div class="form-group">
			<label for="codigoPostal">Código Postal:</label>
            <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" value="<?php echo $form_alta_cliente['codigoPostal'];?>"/>
            </div>

			<div class="form-group">
			<label for="esEstudiante">Estudiante:* </label>
				<input class="form-check-input" type="radio" name="esEstudiante" value="1" <?php if($form_alta_cliente['esEstudiante']==1) echo ' checked ';?>/>
				<label class="form-check-label">
					Sí
				</label>
				<input class="form-check-input" type="radio" name="esEstudiante" value="0" <?php if($form_alta_cliente['esEstudiante']==0) echo ' checked ';?>/>
				<label class="form-check-label">
					No
				</label>
			</div>
			<div class="form-group">
			<label for="entrenamientoPersonal">Entrenamiento Personal: </label>
				<input class="form-check-input" type="radio" name="entrenamientoPersonal" value="1" <?php if($form_alta_cliente['entrenamientoPersonal']==1) echo ' checked ';?>/>
				<label class="form-check-label">
					Sí
				</label>
				<input class="form-check-input" type="radio" name="entrenamientoPersonal" value="0" <?php if($form_alta_cliente['entrenamientoPersonal']==0) echo ' checked ';?>/>
				<label class="form-check-label">
					No
				</label>
			</div>
			
			
	</div>
	<div class="col-md-6">
<br>
		<div class="form-group">
			<label for="email">Email: *</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="usuario@dominio.extension" value="<?php echo $form_alta_cliente['email'];?>"/>
            </div>

			<div class="form-group">
			<label for="password">Contraseña: *</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $form_alta_cliente['password'];?>"/>
            </div>

			<div class="form-group">
			<label for="confirmPassword">Confirmar la contraseña: *</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="<?php echo $form_alta_cliente['confirmPassword'];?>"/>
            </div>

			<div class="form-group">
			<label for="telefono">Teléfono:</label>
        	<input type="text" size="9" class="form-control" id="telefono" name="telefono" value="<?php echo $form_alta_cliente['telefono'];?>">
            </div>

			<div class="form-group">
			<label for="lesiones">Lesiones:</label>
			<input type="text" class="form-control" id="lesiones" name="lesiones" value="<?php echo $form_alta_cliente['lesiones'];?>">
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
