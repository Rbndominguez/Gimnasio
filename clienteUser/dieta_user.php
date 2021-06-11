<?php
	session_start();
	
	if ($_SESSION['login'] == "admin" || !isset($_SESSION['login'])) {
		header("Location: ../index.php");
	}
	
	$dni = $_SESSION['login'];
	
	require_once("../gestionBD.php");
	require_once("gestionarClientesUser.php");
	
	$conexion = crearConexionBD();
	$oid_di = getOID_D($conexion, $dni);
	$nombre = getNombreD($conexion, $oid_di);
	$descripcion = getDescripcionD($conexion, $oid_di);
	$duracion = getDuracionD($conexion, $oid_di);
	$num_comidas = tieneComidas($conexion, $oid_di);
	$comidasL = getComidas($conexion, $oid_di, "Lunes");
	$comidasM = getComidas($conexion, $oid_di, "Martes");
	$comidasX = getComidas($conexion, $oid_di, "Miercoles");
	$comidasJ = getComidas($conexion, $oid_di, "Jueves");
	$comidasV = getComidas($conexion, $oid_di, "Viernes");
	$comidasS = getComidas($conexion, $oid_di, "Sabado");
	$comidasD = getComidas($conexion, $oid_di, "Domingo");
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información de la tabla de ejercicios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
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
            <div class="card-body">
	<?php
	if($oid_di == NULL) { ?>
		<script>window.close();</script>
	<?php } ?>
	 
	<p><b><?php echo $nombre . ": " . $descripcion . " [" . $duracion . "]";?>
	</b></p>
	
	<?php if ($num_comidas > 0) { ?>
			
		<div class="table-responsive">
			<table class="table table-striped mb-0">
				<p>LUNES</p>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasL as $comidaL) { ?>
						<tr>
   			 				<td><?php echo $comidaL["hora"]; ?></td>
    						<td><?php echo $comidaL["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaL["descripcion"]; ?></td>
 			 			</tr>
				<?php } ?>
			</table>
			  </div>
			  <br>
			<div class="table-responsive">
			<table class="table table-striped mb-0">
				<p>MARTES</p>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasM as $comidaM) { ?>
						<tr>
   			 				<td><?php echo $comidaM["hora"]; ?></td>
    						<td><?php echo $comidaM["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaM["descripcion"]; ?></td>
 			 			</tr>			
				<?php } ?>
			</table>
			  </div>
			<br>
			  <div class="table-responsive">
			<table class="table table-striped mb-0">
				<p>MIÉRCOLES</p>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasX as $comidaX) { ?>
						<tr>
   			 				<td><?php echo $comidaX["hora"]; ?></td>
    						<td><?php echo $comidaX["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaX["descripcion"]; ?></td>
 			 			</tr>
				<?php } ?>
			</table>
			</div>
			<br>

			<div class="table-responsive">
			<table class="table table-striped mb-0">
				<p>JUEVES</p>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasJ as $comidaJ) { ?>
						<tr>
   			 				<td><?php echo $comidaJ["hora"]; ?></td>
    						<td><?php echo $comidaJ["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaJ["descripcion"]; ?></td>
 			 			</tr>			
				<?php } ?>
			</table>
			</div>
			<br>
			
			<div class="table-responsive">
			<table class="table table-striped mb-0">
				<p>VIERNES</p>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasV as $comidaV) { ?>
						<tr>
   			 				<td><?php echo $comidaV["hora"]; ?></td>
    						<td><?php echo $comidaV["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaV["descripcion"]; ?></td>
 			 			</tr>	
				<?php } ?>
			</table>
			</div>
			<br>
			
			<div class="table-responsive">
			<table class="table table-striped mb-0">
				<p>SÁBADO</p>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasS as $comidaS) { ?>
						<tr>
   			 				<td><?php echo $comidaS["hora"]; ?></td>
    						<td><?php echo $comidaS["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaS["descripcion"]; ?></td>
 			 			</tr>
				<?php } ?>
			</table>
			</div>
			<br>
			
			<div class="table-responsive">
			<table class="table table-striped mb-0">
				<p>DOMINGO</p>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
  				</tr>
  				
  			<?php foreach($comidasD as $comidaD) { ?>
						<tr>
   			 				<td><?php echo $comidaD["hora"]; ?></td>
    						<td><?php echo $comidaD["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaD["descripcion"]; ?></td>
 			 			</tr>
				<?php } ?>
			</table>
			</div>
			<br>
		<?php } ?>
	
		</div>
	</article>

	</body>
</html>