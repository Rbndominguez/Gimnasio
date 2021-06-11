<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionClases.php");
	
	if($_SESSION["login"]!="admin"){
		header("Location: ../index.php");
	}
	
	if (isset($_SESSION["clase"])){
		$clase = $_SESSION["clase"];
		unset($_SESSION["clase"]);
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
	

	$qry = pg_query($dbconn, "select count(*) as total from clases"); 
	$row_sql = pg_fetch_row($qry); 
	$total_records = $row_sql[0]; 
	$total_pages = ceil($total_records / $records);


	
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $records;
	$_SESSION["paginacion"] = $paginacion;
	unset($_SESSION["paginacion"]);

	$select = pg_query($dbconn, "SELECT * FROM CLASES NATURAL JOIN MONITORES ORDER BY SALA, APELLIDOS, NOMBRE, NOMBRECLASE LIMIT $records OFFSET $start_from");
	cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Lista de Clases</title>
    <link href="../css/consulta.css" rel="stylesheet" type="text/css">
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
						<a href="consulta_clases.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $records; ?>"><?php echo $pagina; ?></a>
				<?php } ?>			
			</div>
		
			<form id="form_pag" method="get" action="consulta_clases.php">
			<br>
				<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
				Mostrando 
				<input id="PAG_TAM" name="PAG_TAM" type="number" 
					min="1" max="<?php echo $total_records;?>" 
					value="<?php echo $records?>" /> 
					entradas de <?php echo $total_records;?>
				<input class="btn btn-outline-secondary" type="submit" value="Cambiar">
			</form>
		</nav>		
		<br>	
		<button id="btnnuevo" name="nuevo" type="submit">
	<a href="form_crea_clase.php" target="popup">
    <i class="fa fa-plus"></i>
	</a>				
	</button>
	<button id="btnbuscar" name="buscar" type="submit">
	<a href="busqueda_clase.php" target="popup">
    <i class="fa fa-search"></i>
	</a>				
	</button>	
	
		<br>
	<?php
		while($row = pg_fetch_assoc($select)) {

	?>
	<br>
	<article class="clase">
		<form method="post" action="controlador_clases.php" target="popup" >			
			<div class="fila_clase col-7 col-tab-7 col-">
			<div class="datos_periodoAsistencia">	
					<input type="hidden" id="oid_cl" name="oid_cl"
						value="<?php echo $row["oid_cl"]; ?>" />
					<input type="hidden" id="horario" name="horario"
						value="<?php echo $row["horario"]; ?>" />
					<input type="hidden" id="dniMonitor" name="dniMonitor"
						value="<?php echo $row["dnimonitor"]; ?>" />
					<input type="hidden" id="nombre" name="nombre"
						value="<?php echo $row["nombre"]; ?>" />
					<input type="hidden" id="apellidos" name="apellidos"
						value="<?php echo $row["apellidos"]; ?>" />
					<input type="hidden" id="sala" name ="sala"
						value="<?php echo $row["sala"];?>"/>
					<input type="hidden" id="nombreClase" name="nombreClase"
						value="<?php echo $row["nombreclase"]; ?>" />
						
					<button class="btn btn-outline-primary" name="mostrar" type="submit" class="mostrar_fila">
						<div class="nombres"><?php echo $row["nombreclase"] . " - " . $row["horario"] . " - " . $row["apellidos"] . ", " . $row["nombre"]; ?></div>
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


</body>
</html>
