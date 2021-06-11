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
  <link href="../css/muestra.css" rel="stylesheet" type="text/css">
</head>

<body>

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
					<!-- Botón de editar -->
					<button id="editar" name="editar" type="submit" class="editar_fila">
						<img src="../images/editar_small.png" class="editar_fila" alt="Editar pago">
					</button>
					<button id="borrar" name="borrar" type="submit" class="editar_fila">
						<img src="../images/remove_small.png" class="editar_fila" alt="Borrar pago">
					</button>
					<button onClick="window.close();opener.location.reload();">
					Cerrar
				</button>
				</div>
			</div>
		</form>
	</article>
	
	</body>
</html>
