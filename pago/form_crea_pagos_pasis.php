<?php
session_start();

require_once ("../gestionBD.php");
require_once ("gestionPagos.php");


if (!isset($_SESSION["form_crea_pagos_pasis"])) {
	$form_crea_pagos_pasis["importePago"] = "";
	$form_crea_pagos_pasis["fechaPago"] = "";
	$form_crea_pagos_pasis["motivo"] = "";
	$form_crea_pagos_pasis["tipoPago"] = "";
	$form_crea_pagos_pasis["dni"] = "";
	$form_crea_pagos_pasis["oid_pasis"] = "";
	$_SESSION["form_crea_pagos_pasis"] = $form_crea_pagos_pasis;
}
else {
	$form_crea_pagos_pasis = $_SESSION["form_crea_pagos_pasis"];
}

if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
}
?>
<!DOCTYPE HTML>
<html lang = "es">
	<head>
		<meta charset="UTF-8">

		<title>Pagos</title>
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
            <a href="consulta_pagos.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_pagos.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Datos del Pago</h4>
            </div>
            <div class="card-body">
		<?php

		if (isset($errores) && count($errores) > 0) {
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h6> Errores en el formulario:</h6>";
			foreach ($errores as $error)
				echo '<em style="font-size:14px">'.$error."</em>";
			echo "</div>";
		}
		?>
		<form id="form_crea_pagos_pasis" method="post" action="accion_crea_pagos_pasis.php" novalidate>
		<section class="section">
	<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>

			<div class="form-group">
            <label for="importePago">Importe: *</label>
        	<input class="form-control" id="importePago" name="importePago" type="text" min="0" step="0.01" value="<?php echo $form_crea_pagos_pasis["importePago"]; ?>"required>
            </div>

			<div class="form-group">
            <label for="fechaPago">Fecha del pago: *</label>
        	<input type="date" class="form-control" id="fechaPago" name="fechaPago" value="<?php echo $form_crea_pagos_pasis["fechaPago"];?>" required/>
            </div>	

			<div class="form-group">
            <label for="motivo">Motivo: *</label>
        	<input type="text" class="form-control" id="motivo" name="motivo" value="<?php echo $form_crea_pagos_pasis["motivo"];?>" required/>
            </div>

			<div class="form-group">
				<label for="tipoPago">Tipo de pago: *</label>
				<select class="form-select" id="tipoPago" name="tipoPago" size="1" required>
				<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = NULL; ?>">Seleccione un pago de la lista</option>
				<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "mensual"; ?>">Mensual</option>
				<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "bimensual"; ?>">Bimensual</option>
				<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "trimestral"; ?>">Trimestral</option>
				<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "estudiante"; ?>">Estudiante</option>
				<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "porHora"; ?>">Por Hora</option>
				<option value="<?php echo $form_crea_pagos_pasis["tipoPago"] = "puntual"; ?>">Puntual</option>
					</select>
				</div>

				<div class="form-group">
				<label for="dni">Cliente: *</label>
				<select class="form-select" id="dni" name="dni" size="1" required>
				<option label="Selecciona un cliente" value="">
					<?php
					$conexion = crearConexionBD();
					$clientes = listarClientes($conexion);
					cerrarConexionBD($conexion);

					foreach ($clientes as $cliente) {
						echo "<option label='" . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . "' value='" . $cliente["dni"] . "'>";
					}
					?>

					</select>
					</div>

						<div class="form-group">
				<label for="oid_pasis">Periodo de Asistencia: *</label>
				<select class="form-select" id="oid_pasis" name="oid_pasis" size="1" required>
				<option label="Selecciona un periodo de asistencia" value="">
					<?php
					$conexion = crearConexionBD();
					$pasiss = listarPasis($conexion);
					cerrarConexionBD($conexion);

					foreach ($pasiss as $pasis) {
						echo "<option label='" . $pasis["fechainicio"] . "-" . $pasis["fechafin"] . ", " . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . ", " . $pasis["dni"] . "' value='" . $pasis["oid_pasis"] . "'>";
					}
					?>

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
