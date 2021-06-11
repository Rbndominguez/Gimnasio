<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionPeriodosAsistencia.php");
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	} 
	
	if (isset($_SESSION["periodoAsistencia"])){
		$periodoAsistencia = $_SESSION["periodoAsistencia"];
		unset($_SESSION["periodoAsistencia"]);
	}

	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"]; 
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$records = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 10);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($records < 1) $records = 10;
	$start_from = ($pagina_seleccionada-1) * $records;
		
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();
	$dbconn = crearConexionPG();
	
	$qry = pg_query($dbconn, "select count(*) as total from periodosasistencia"); 
	$row_sql = pg_fetch_row($qry); 
	$total_records = $row_sql[0]; 
	$total_pages = ceil($total_records / $records);

	
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $records;
	$_SESSION["paginacion"] = $paginacion;
	unset($_SESSION["paginacion"]);

	$select = pg_query($dbconn, "SELECT * FROM PERIODOSASISTENCIA NATURAL JOIN CLIENTES ORDER BY FechaInicio, APELLIDOSCLIENTE, NOMBRECLIENTE LIMIT $records OFFSET $start_from");
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Lista de Periodos de Asistencia</title>
  <link rel="stylesheet" type="text/css" href="../css/consulta.css">
</head>

<body>



<main>
	<?php
	include_once("../header2.php");
			include_once("../admin/menuAdmin.php");
		?>
<nav>
			<div class="enlaces">
				<br>
				<?php
					for( $pagina = 1; $pagina <= $total_paginas; $pagina++ ) 
						if ( $pagina == $pagina_seleccionada) { 	?>
							<span class="current"><?php echo $pagina; ?></span>
				<?php } else { ?>			
						<a href="consulta_periodos_asistencia.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $records; ?>"><?php echo $pagina; ?></a>
				<?php } ?>			
			</div>
		
			<form id="form_pag" method="get" action="consulta_periodos_asistencia.php">
			<br>
				<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
					Mostrando 
				<input id="PAG_TAM" name="PAG_TAM" type="number" 
					min="1" max="<?php echo $total_records;?>" 
					value="<?php echo $records?>" /> 
					entradas de <?php echo $total_records?>
				<input class="btn btn-outline-secondary" type="submit" value="Cambiar">
			</form>
		</nav>
<br>

		<button id="btnnuevo" name="nuevo" type="submit">
	<a href="form_crea_periodo_asistencia.php" target="popup">
    <i class="fa fa-plus"></i>
	</a>				
	</button>
	<button id="btnbuscar" name="buscar" type="submit">
	<a href="busqueda_periodo_asistencia.php" target="popup">
    <i class="fa fa-search"></i>
	</a>				
	</button>			
		<br>
		<br>
		
		<?php
	while($row = pg_fetch_assoc($select)) {
	?>

	<article class="periodoAsistencia">
			<form method="post" action="controlador_periodos_asistencia.php" target="popup" >
				<div class="fila_periodoAsistencia col-7 col-tab-7 col-">
					<div class="datos_periodoAsistencia">			
					<input type="hidden" id="oid_pasis" name="oid_pasis"
						value="<?php echo $row["oid_pasis"]; ?>" />
					<input type="hidden" id="fechaInicio" name="fechaInicio"
						value="<?php echo $row["fechainicio"]; ?>" />
					<input type="hidden" id="fechaFin" name="fechaFin"
						value="<?php echo $row["fechafin"]; ?>" />
					<input type="hidden" id="numeroDias" name="numeroDias"
						value="<?php echo $row["numerodias"]; ?>" />
					<input type="hidden" id="dni" name="dni"
						value="<?php echo $row["dni"]; ?>" />
					<input type="hidden" id="nombre" name="nombre"
						value="<?php echo $row["nombrecliente"]; ?>" />
					<input type="hidden" id="apellidos" name="apellidos"
						value="<?php echo $row["apellidoscliente"]; ?>" />
					<button class="btn btn-outline-primary" name="mostrar" type="submit" class="mostrar_fila">
							<div class="nombres"><?php echo $row["fechainicio"] . " - " . $row["apellidoscliente"] . ", " . $row["nombrecliente"];?></div>
						</button>
				
				</div>
				
				<div>						
						<button id="editar" name="editar" type="submit">
						<i class="fa fa-edit"></i>
						</button>
						
						<button id="borrar" name="borrar" type="submit">
						<i class="fa fa-trash"></i>
						</button>
					</div>
			</div>
		</form>
	</article>
	<br>

	<?php } ?>
</main>
<br>


</body>
</html>
