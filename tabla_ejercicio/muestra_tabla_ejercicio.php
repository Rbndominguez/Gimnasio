<?php
	session_start();
	
	$tablaEjercicio = $_SESSION["tablaEjercicio"];
	unset($_SESSION["tablaEjercicio"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	}
	
	require_once("../gestionBD.php");
	require_once("gestionTablaEjercicio.php");
	
	$conexion = crearConexionBD();
	$num_ejercicios = tieneEjercicios($conexion, $tablaEjercicio);
	$ejercicios = getEjercicios($conexion, $tablaEjercicio);
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
            <a href="consulta_tablas_ejercicios.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_tablas_ejercicios.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>

	<div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Tabla de Ejercicios</h4>
            </div>
            <div class="card-body">
	<?php if ($tablaEjercicio["recuperacion"] == 0) { 
			$esRecuperacion = "normal";
		} else {
			$esRecuperacion = "recuperacion";
		} ?>
	<p><b><?php echo $tablaEjercicio["nombreTablaE"] . ": " . $tablaEjercicio["descripcion"] . " [" . $tablaEjercicio["duracion"] . " - " . $esRecuperacion . "]";?>
	
	<?php if ($num_ejercicios > 0) { ?>
			
		<div class="table-responsive">
			<table class="table table-striped mb-0">
 				<tr>
    				<th>Orden</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th>Reps/Duración</th>
    				<th>Series</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($ejercicios as $ejercicio) { ?>
  					<form method="post" action="controlador_tablas_ejercicios.php">
						<input type="hidden" id="oid_e" name="oid_e"
							value="<?php echo $ejercicio["oid_e"]; ?>" />
								
						<input type="hidden" id="oid_te" name="oid_te"
							value="<?php echo $tablaEjercicio["oid_te"]; ?>" />
						<input type="hidden" id="nombreTablaE" name="nombreTablaE"
							value="<?php echo $tablaEjercicio["nombreTablaE"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $tablaEjercicio["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $tablaEjercicio["duracion"]; ?>" />
						<input type="hidden" id="recuperacion" name ="recuperacion"
							value="<?php echo $tablaEjercicio["recuperacion"];?>"/>
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
   				 			<td><button  class="btn btn-danger" id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
				<?php } ?>
			</table>
			</div>
			<br>
		<?php } ?>
	
	<article class="tablaEjercicio">
		<form method="post" action="controlador_tablas_ejercicios.php">
			<div class="fila_tablaEjercicio">
				<div class="datos_tablaEjercicio">		
					<input type="hidden" id="oid_te" name="oid_te"
						value="<?php echo $tablaEjercicio["oid_te"]; ?>" />
					<input type="hidden" id="nombreTablaE" name="nombreTablaE"
						value="<?php echo $tablaEjercicio["nombreTablaE"]; ?>" />
					<input type="hidden" id="descripcion" name="descripcion"
						value="<?php echo $tablaEjercicio["descripcion"]; ?>" />
					<input type="hidden" id="duracion" name="duracion"
						value="<?php echo $tablaEjercicio["duracion"]; ?>" />
					<input type="hidden" id="recuperacion" name ="recuperacion"
						value="<?php echo $tablaEjercicio["recuperacion"];?>"/>
				
				</div>
				
				<div id="botones_fila">
				<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
					<i class="fa fa-edit" class="editar_fila" alt="Editar tablaEjercicio"></i>
					</button>
					
					<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila" >
					<i class="fa fa-trash" class="editar_fila" alt="Borrar tablaEjercicio"></i>
						</button>

					<button class="btn btn-primary" id="añadir" name="añadir" type="submit" class="editar_fila">
						Añadir ejercicio
					</button>
					
					<button class="btn btn-danger" onClick="window.close();opener.location.reload();">Cerrar</button>
					
				</div>
			</div>
		</form>
	</article>
	</body>
</html>
