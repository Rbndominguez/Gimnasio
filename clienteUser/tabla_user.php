<?php
	session_start();
	
	if ($_SESSION['login'] == "admin" || !isset($_SESSION['login'])) {
		header("Location: ../index.php");
	}
	
	$dni = $_SESSION['login'];
	
	require_once("../gestionBD.php");
	require_once("gestionarClientesUser.php");
	
	$conexion = crearConexionBD();
	$oid_te = getOID($conexion, $dni);
	$recuperacion = getRecuperacion($conexion, $oid_te);
	$nombre = getNombre($conexion, $oid_te);
	$descripcion = getDescripcion($conexion, $oid_te);
	$duracion = getDuracion($conexion, $oid_te);
	$num_ejercicios = tieneEjercicios($conexion, $oid_te);
	$ejercicios = getEjercicios($conexion, $oid_te);
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
	if($oid_te == NULL) { ?>
		<script>window.close();</script>
	<?php }
	 
	if ($recuperacion == 0) { 
			$esRecuperacion = "normal";
		} else {
			$esRecuperacion = "recuperacion";
		} ?>
	<p><b><?php echo $nombre . ": " . $descripcion . " [" . $duracion . " - " . $esRecuperacion . "]";?>
	
	<?php if ($num_ejercicios > 0) { ?>
			
		<div class="table-responsive">
			<table class="table table-striped mb-0">
 				<tr>
    				<th>Orden</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th>Reps/Duración</th>
    				<th>Series</th>
    			
  				</tr>
  				
  			<?php foreach($ejercicios as $ejercicio) { ?>
  					<tr>
   			 			<td><?php echo $ejercicio["numeroorden"] . "º"; ?></td>
    					<td><?php echo $ejercicio["nombreejercicio"]; ?></td> 
   				 		<td><?php echo $ejercicio["descripcion"]; ?></td>
   				 		<td><?php if($ejercicio["repeticiones"] != NULL) {
   				 				echo $ejercicio["repeticiones"] . " reps";
							} else if($ejercicio["duracion"] != NULL) {
								echo $ejercicio["duracion"] . " min";
							} 
   				 			?></td>
   				 		<td><?php echo $ejercicio["series"]; ?></td>
 			 		</tr>
				<?php } ?>
			</table>
						</div>
		<?php } ?>
	
			<br>		
		</div>
			</div>
	</article>

	</body>
</html>
