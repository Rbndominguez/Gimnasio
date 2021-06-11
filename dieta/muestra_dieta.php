<?php
	session_start();
	
	$dieta = $_SESSION["dieta"];
	unset($_SESSION["dieta"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	}

	require_once("../gestionBD.php");
	require_once("gestionDietas.php");
	
	$conexion = crearConexionBD();
	$num_comidas = tieneComidas($conexion, $dieta);
	$comidasL = getComidas($conexion, $dieta, "Lunes");
	$comidasM = getComidas($conexion, $dieta, "Martes");
	$comidasX = getComidas($conexion, $dieta, "Miercoles");
	$comidasJ = getComidas($conexion, $dieta, "Jueves");
	$comidasV = getComidas($conexion, $dieta, "Viernes");
	$comidasS = getComidas($conexion, $dieta, "Sabado");
	$comidasD = getComidas($conexion, $dieta, "Domingo");
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información de la dieta</title>
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
            <a href="consulta_dietas.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_dietas.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>



	<div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Datos del Monitor</h4>
            </div>
            <div class="card-body">
	<p><b><?php echo $dieta["nombreDieta"] . ": " . $dieta["descripcion"] . " [" . $dieta["duracion"] . "]";?>
	</b></p>
	
	<?php if ($num_comidas > 0) { ?>
			<div class="table-responsive">
			<table class="table table-striped mb-0">
				<p>LUNES</p>
 				<tr>
    				<th>Hora</th>
    				<th>Nombre</th> 
    				<th>Descripcion</th>
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasL as $comidaL) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaL["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaL["hora"]; ?></td>
    						<td><?php echo $comidaL["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaL["descripcion"]; ?></td>
   				 			<td><button class="btn btn-danger" id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
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
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasM as $comidaM) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaM["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaM["hora"]; ?></td>
    						<td><?php echo $comidaM["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaM["descripcion"]; ?></td>
   				 			<td><button class="btn btn-danger" id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
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
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasX as $comidaX) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaX["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaX["hora"]; ?></td>
    						<td><?php echo $comidaX["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaX["descripcion"]; ?></td>
   				 			<td><button class="btn btn-danger" id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
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
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasJ as $comidaJ) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaJ["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaJ["hora"]; ?></td>
    						<td><?php echo $comidaJ["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaJ["descripcion"]; ?></td>
   				 			<td><button class="btn btn-danger" id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
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
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasV as $comidaV) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaV["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaV["hora"]; ?></td>
    						<td><?php echo $comidaV["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaV["descripcion"]; ?></td>
   				 			<td><button class="btn btn-danger" id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
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
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasS as $comidaS) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaS["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaS["hora"]; ?></td>
    						<td><?php echo $comidaS["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaS["descripcion"]; ?></td>
   				 			<td><button class="btn btn-danger" id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</button></td>
 			 			</tr>
			
					</form>
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
    				<th></th>
  				</tr>
  				
  			<?php foreach($comidasD as $comidaD) { ?>
  					<form method="post" action="controlador_dietas.php">
						<input type="hidden" id="oid_c" name="oid_c"
							value="<?php echo $comidaD["oid_c"]; ?>" />
								
						<input type="hidden" id="oid_di" name="oid_di"
							value="<?php echo $dieta["oid_di"]; ?>" />
						<input type="hidden" id="nombreDieta" name="nombreDieta"
							value="<?php echo $dieta["nombreDieta"]; ?>" />
						<input type="hidden" id="descripcion" name="descripcion"
							value="<?php echo $dieta["descripcion"]; ?>" />
						<input type="hidden" id="duracion" name="duracion"
							value="<?php echo $dieta["duracion"]; ?>" />
						<tr>
   			 				<td><?php echo $comidaD["hora"]; ?></td>
    						<td><?php echo $comidaD["nombrecomida"]; ?></td> 
   				 			<td><?php echo $comidaD["descripcion"]; ?></td>
   				 			<td><button class="btn btn-danger" id="quitar" name="quitar" type="submit" class="editar_fila">Quitar</class=></td>
 			 			</tr>
			
					</form>
				<?php } ?>
			</table>
			  </div>
				<br>
		<?php } ?>
	
	<article class="dieta">
		<form method="post" action="controlador_dietas.php">
			<div class="fila_dieta">
				<div class="datos_dieta">		
					<input type="hidden" id="oid_di" name="oid_di"
						value="<?php echo $dieta["oid_di"]; ?>" />
					<input type="hidden" id="nombreDieta" name="nombreDieta"
						value="<?php echo $dieta["nombreDieta"]; ?>" />
					<input type="hidden" id="descripcion" name="descripcion"
						value="<?php echo $dieta["descripcion"]; ?>" />
					<input type="hidden" id="duracion" name="duracion"
						value="<?php echo $dieta["duracion"]; ?>" />
				
				</div>
				
				<div id="botones_fila">
				<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
					<i class="fa fa-edit" class="editar_fila" alt="Editar dieta"></i>
					</button>
					
					<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila" >
					<i class="fa fa-trash" class="editar_fila" alt="Borrar dieta"></i>
						</button>

					<button class="btn btn-primary" id="añadir" name="añadir" type="submit" class="editar_fila">
						Añadir comida
					</button>
					
					<button class="btn btn-danger" onClick="window.close();opener.location.reload();">Cerrar</button>
					</div>
			</div>
		</form>
	</article>

	</body>
</html>