<?php
	session_start();
	
	if (!isset($_SESSION['login'])) {
		header("Location: ../index.php");
	} 
	
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
			
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Cambiar contraseña</title>
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
            <a href="../admin/indexCliente.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="../admin/indexCliente.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Cambiar contraseña</h4>
            </div>
            <div class="card-body">
	<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	
	<form id="cambiarPass" method="post" action="accion_cambiar_contrasena.php" novalidate>
	<section class="section">
	<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">

			<div class="form-group">
            <label for="old_pass">Contraseña antigua:</label>
        	<input type="password" class="form-control" id="old_pass" name="old_pass" required/>
            </div>

			<div class="form-group">
            <label for="new_pass">Nueva contraseña:</label>
        	<input type="password" class="form-control" id="new_pass" name="new_pass" required/>
            </div>

			<div class="form-group">
            <label for="new_confirmpass">Confirmar nueva contraseña:</label>
        	<input type="password" class="form-control" id="new_confirmpass" name="new_confirmpass" required/>
            </div>
			</div>
	</div>
	<div class="col-sm-12 d-flex justify-content-end">
								</br>
								<input class="btn btn-primary me-1 mb-1" type="submit" value="Enviar">
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

