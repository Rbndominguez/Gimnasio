<?php
	session_start();
	
	$clase = $_SESSION["clase"];
	unset($_SESSION["clase"]);
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	}
	
	require_once("../gestionBD.php");
	require_once("gestionClases.php");
	
	$conexion = crearConexionBD();
	$num_clientes = numClientes($conexion, $clase);
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Información de la clase</title>
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
            <a href="consulta_clases.php"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="consulta_clases.php">
                <img src="../assets/images/logo/logo2.png">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Datos del cliente</h4>
            </div>
            <div class="card-body">

	<p><b>Nombre: </b><?php echo $clase["nombreClase"];?></p>
	<p><b>Horario: </b><?php echo $clase["horario"];?></p>
	<p><b>Monitor: </b><?php echo $clase["nombre"]." ".$clase["apellidos"]." [".$clase["dniMonitor"]."]";?></p>
	<p><b>Sala: </b>
		<?php if($clase["sala"] == "SalaDeMusculacion") {
				echo "Sala de musculación";
			} else if($clase["sala"] == "SalaDeSpinning") {
				echo "Sala de spinning";
			} else if($clase["sala"] == "SalaMultiusos") {
				echo "Sala multiusos";
			} ?></p>
	<p><b>Número de clientes que asisten a esta clase: </b><?php echo $num_clientes; ?></p>
	
	<article class="clase">
		<form method="post" action="controlador_clases.php">
			<div class="fila_clase">
				<div class="datos_clase">
					<input type="hidden" id="oid_cl" name="oid_cl"
						value="<?php echo $clase["oid_cl"]; ?>" />
					<input type="hidden" id="nombreClase" name="nombreClase"
						value="<?php echo $clase["nombreClase"]; ?>" />
					<input type="hidden" id="horario" name="horario"
						value="<?php echo $clase["horario"]; ?>" />
					<input type="hidden" id="dniMonitor" name="dniMonitor"
						value="<?php echo $clase["dniMonitor"]; ?>" />
					<input type="hidden" id="nombre" name="nombre"
						value="<?php echo $clase["nombre"]; ?>" />
					<input type="hidden" id="apellidos" name="apellidos"
						value="<?php echo $clase["apellidos"]; ?>" />
					<input type="hidden" id="sala" name="sala"
						value="<?php echo $clase["sala"]; ?>" />
				</div>
				
				<div id="botones_fila">
				<button class="btn btn-outline-primary" id="editar" name="editar" type="submit" class="editar_fila">
					<i class="fa fa-edit" class="editar_fila" alt="Editar cliente"></i>
					</button>
					
					<button class="btn btn-outline-danger" id="borrar" name="borrar" type="submit" class="editar_fila" >
					<i class="fa fa-trash" class="editar_fila" alt="Borrar clase"></i>
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
