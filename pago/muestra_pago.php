<?php
session_start();

$pago = $_SESSION["pago"];
unset($_SESSION["pago"]);

if ($_SESSION['login'] != "admin") {
 header("Location: ../index.php");
	 }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información de los pagos</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
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
	<p><b>Fecha del pago: </b><?php echo $pago["fechaPago"]; ?></p>
	<p><b>Importe del pago: </b><?php echo $pago["importePago"];?> €</p>
	<p><b>Motivo: </b><?php echo $pago["motivo"]; ?></p>
	<p><b>Tipo de pago: </b><?php echo $pago["tipoPago"]; ?></p>
	<p><b>Nombre del Cliente: </b><?php echo $pago["nombreCliente"] . " " . $pago["apellidosCliente"]; ?></p>
	<p><b>DNI del cliente: </b><?php echo $pago["dni"]; ?></p>
	<?php		
			if($pago["oid_pasis"]!=NULL){
	?>
	<p><b>OID del periodo de asistencia: </b><?php echo $pago["oid_pasis"]; ?></p>
	<?php
	}
	?>
	<article class="pago">
		<form method="post" action="controlador_pagos.php">
			<div class="fila_pago">
				<div class="datos_pago">
					<input type="hidden" id="oid_pa" name="oid_pa"
						value="<?php echo $pago["oid_pa"]; ?>" />		
					<input type="hidden" id="importePago" name="importePago"
						value="<?php echo $pago["importePago"]; ?>" />
					<input type="hidden" id="fechaPago" name="fechaPago"
						value="<?php echo $pago["fechaPago"]; ?>" />
					<input type="hidden" id="motivo" name="motivo"
						value="<?php echo $pago["motivo"]; ?>" />
					<input type="hidden" id="tipoPago" name="tipoPago"
						value="<?php echo $pago["tipoPago"]; ?>" />
					<input type="hidden" id="dni" name ="dni"
						value="<?php echo $pago["dni"]; ?>"/>
					<input type="hidden" id="oid_pasis" name="oid_pasis"
						value="<?php echo $pago["oid_pasis"]; ?>" />
				
				</div>
				
				<div id="botones_fila">
				<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
					<i class="fa fa-edit" class="editar_fila" alt="Editar pago"></i>
					</button>
					
					<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila" >
					<i class="fa fa-trash" class="editar_fila" alt="Borrar pago"></i>
						</button>
					<button class="btn btn-danger" onClick="window.close();opener.location.reload();">Cerrar</button>
					</div>
				
				</div>
			</form>
			</article>
				</div>
			</div>
		</div>
		
	
	</body>
	
	</html>
	