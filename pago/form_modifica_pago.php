<?php
session_start();

require_once ("../gestionBD.php");
require_once ("gestionPagos.php");

$form_modifica_pago = $_SESSION["pago"];
if (isset($_SESSION["errores"]))
	$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Modificar pago</title>
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
                <h4 class="card-title">Datos del monitor</h4>
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

		<form id="form_modifica_pago" method="post" action="accion_modificar_pago.php" novalidate>
		<section class="section">
	<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
<small class="text-muted"><i>Los campos obligatorios están marcados con *</i></small>

		<div>
		<input id="oid_pa" name="oid_pa" type="hidden" value="<?php echo $form_modifica_pago["oid_pa"]; ?>" required/>
		</div>
		<div>
		<input id="nombreCliente" name="nombreCliente" type="hidden" value="<?php echo $form_modifica_pago["nombreCliente"]; ?>" required/>
		</div>
		<div>
		<input id="apellidosCliente" name="apellidosCliente" type="hidden" value="<?php echo $form_modifica_pago["apellidosCliente"]; ?>" required/>
		</div>

		<div class="form-group">
            <label for="importePago">Importe: *</label>
        	<input class="form-control" id="importePago" name="importePago" type="text" min="0" step="0.01" value="<?php echo $form_modifica_pago["importePago"]; ?>"required>
            </div>

		<div class="form-group">
            <label for="fechaPago">Fecha del pago: *</label>
        	<input type="date" class="form-control" id="fechaPago" name="fechaPago" value="<?php echo $form_modifica_pago["fechaPago"];?>" required/>
            </div>	

			<div class="form-group">
            <label for="motivo">Motivo: *</label>
        	<input type="text" class="form-control" id="motivo" name="motivo" value="<?php echo $form_modifica_pago["motivo"];?>" required/>
            </div>
		

				<div class="form-group">
				<label for="tipoPago">Tipo de pago: *</label>
				<select class="form-select" id="tipoPago" name="tipoPago" size="1" required>
		<option value="mensual" <?php if($form_modifica_pago["tipoPago"]=="mensual")echo "selected";?> >Mensual</option>
		<option value="bimensual" <?php if($form_modifica_pago["tipoPago"]=="bimensual")echo "selected";?> >Bimensual</option>
		<option value="trimestral" <?php if($form_modifica_pago["tipoPago"]=="trimestral")echo "selected";?> >Trimestral</option>
		<option value="estudiante" <?php if($form_modifica_pago["tipoPago"]=="estudiante")echo "selected";?> >Estudiante</option>
		<option value="porHora" <?php if($form_modifica_pago["tipoPago"]=="porHora")echo "selected";?> >Por Hora</option>
		<option value="puntual" <?php if($form_modifica_pago["tipoPago"]=="puntual")echo "selected";?> >Puntual</option>
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
			if ($cliente["dni"] == $form_modifica_pago["dni"]) {
				echo "<option label='" . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . "' value='" . $cliente["dni"] . "' selected > ";
			} else {
				echo "<option label='" . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . "' value='" . $cliente["dni"] . "'>";
			}
		}
		?>
		</select>
		</div>
		<?php
if($form_modifica_pago["oid_pasis"]!=NULL){

		?>
		<div class="form-group">
				<label for="oid_pasis">Periodo de Asistencia: *</label>
				<select class="form-select" id="oid_pasis" name="oid_pasis" size="1" required>
				<option label="Selecciona un periodo de asistencia" value="">
		<?php
		$conexion = crearConexionBD();
		$pasiss = listarPasis($conexion);
		cerrarConexionBD($conexion);

		foreach ($pasiss as $pasis) {
			if ($pasis["oid_pasis"] == $form_modifica_pago["oid_pasis"]) {
				echo "<option label='" . $pasis["fechainicio"] . "-" . $pasis["fechafin"] . ", " . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . ", " . $pasis["dni"] . "' value='" . $pasis["oid_pasis"] . "' selected >";
			} else {
				echo "<option label='" . $pasis["fechainicio"] . "-" . $pasis["fechafin"] . ", " . $cliente["apellidoscliente"] . ", " . $cliente["nombrecliente"] . ", " . $pasis["dni"] . "' value='" . $pasis["oid_pasis"] . "' >";
			}
		}
		?>

		</select>
		</div>
		<?php 	} ?>
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
