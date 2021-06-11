<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionSalarios.php");

	if (!isset($_SESSION["form_crea_salario"])) {
		$form_crea_salario["cantidad"] = "";
		$form_crea_salario["fecha"] = "";
		$form_crea_salario["dniMonitor"] = "";
	
		$_SESSION["form_crea_salario"] = $form_crea_salario;
	
	} else {
		$form_crea_salario = $_SESSION["form_crea_salario"];
	}
	
	if (isset($_SESSION["errores"])) {
		$errores = $_SESSION["errores"];
	}
?>
<!DOCTYPE HTML>
<html lang = "es">
<head>
	<meta charset="UTF-8">
	<title>Crear Salario</title>
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
            <a href="consulta_salarios.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_salarios.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Datos del Salario Mensual</h4>
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
		
		<form id="form_crea_salario" method="post" action="accion_crea_salarios.php" novalidate>
		<section class="section">
	<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>

			<div class="form-group">
            <label for="cantidad">Cantidad: *</label>
        	<input type="text" class="form-control" id="cantidad" name="cantidad" value="<?php echo $form_crea_salario['cantidad'];?>" required/>
            </div>
			
			<div class="form-group">
            <label for="fecha">Fecha del salario: *</label>
        	<input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $form_crea_salario['fecha'];?>" required/>
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