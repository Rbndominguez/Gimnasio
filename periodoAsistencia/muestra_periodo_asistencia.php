<?php
	session_start();
	
	$periodoAsistencia = $_SESSION["periodoAsistencia"];
	unset($_SESSION["periodoAsistencia"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	}
	
	require_once("../gestionBD.php");
	require_once("gestionPeriodosAsistencia.php");
	
	$conexion = crearConexionBD();
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
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
            <a href="consulta_periodos_asistencia.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_periodos_asistencia.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Datos del Periodo de Asistencia</h4>
            </div>
            <div class="card-body">
	<p><b>Fecha de Inicio: </b><?php echo $periodoAsistencia["fechaInicio"];?></p>
	<?php if($periodoAsistencia["fechaFin"] != NULL) { ?>
		<p><b>Fecha Fin: </b><?php echo $periodoAsistencia["fechaFin"];?></p>
		<p><b>Número de Días: </b><?php echo $periodoAsistencia["numeroDias"];?></p>
	<?php } ?>
	<p><b>Cliente: </b><?php echo $periodoAsistencia["apellidos"] . ", " . $periodoAsistencia["nombre"];?></p>

	
	<article class="periodoAsistencia">
		<form method="post" action="controlador_periodos_asistencia.php">
			<div class="fila_periodoAsistencia">
				<div class="datos_periodoAsistencia">		
					<input type="hidden" id="oid_pasis" name="oid_pasis"
						value="<?php echo $periodoAsistencia["oid_pasis"]; ?>" />
					<input type="hidden" id="fechaInicio" name="fechaInicio"
						value="<?php echo $periodoAsistencia["fechaInicio"]; ?>" />
					<input type="hidden" id="fechaFin" name="fechaFin"
						value="<?php echo $periodoAsistencia["fechaFin"]; ?>" />
					<input type="hidden" id="numeroDias" name="numeroDias"
						value="<?php echo $periodoAsistencia["numeroDias"]; ?>" />
					<input type="hidden" id="dni" name="dni"
						value="<?php echo $periodoAsistencia["dni"]; ?>" />
					<input type="hidden" id="nombre" name="nombre"
						value="<?php echo $periodoAsistencia["nombre"]; ?>" />
					<input type="hidden" id="apellidos" name="apellidos"
						value="<?php echo $periodoAsistencia["apellidos"]; ?>" />
				
				</div>
				
					<div id="botones_fila">
				<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
					<i class="fa fa-edit" class="editar_fila" alt="Editar periodo de asistencia"></i>
					</button>
					
					<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila" >
					<i class="fa fa-trash" class="editar_fila" alt="Borrar periodo de asistencia"></i>
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