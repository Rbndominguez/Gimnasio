<?php
session_start();

require_once ("../gestionBD.php");
require_once ("gestionEjercicios.php");

if ($_SESSION['login'] != "admin") {
	header("Location: ../index.php");
} 

if (isset($_SESSION["ejercicio"])) {
	$ejercicio = $_SESSION["ejercicio"];
	unset($_SESSION["ejercicio"]);
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

	$qry = pg_query($dbconn, "select count(*) as total from ejercicios"); 
	$row_sql = pg_fetch_row($qry); 
	$total_records = $row_sql[0]; 
	$total_pages = ceil($total_records / $records);

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $records;
	$_SESSION["paginacion"] = $paginacion;
	unset($_SESSION["paginacion"]);

	$select = pg_query($dbconn, "SELECT * FROM EJERCICIOS ORDER BY NombreEjercicio LIMIT $records OFFSET $start_from");
	cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de gimnasio: Lista de ejercicios</title>
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
						<a href="consulta_ejercicios.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $records; ?>"><?php echo $pagina; ?></a>
				<?php } ?>			
			</div>
		
			<form id="form_pag" method="get" action="consulta_ejercicios.php">
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
	<a href="form_crea_ejercicio.php" target="popup"
				onClick="window.open(this.href, this.target, 'toolbar=0 , location=0 , status=0 , menubar=0 , scrollbars=0 , resizable=1 ,left=300em,top=150em,width=800em,height=400em');">
    <i class="fa fa-plus"></i>
	</a>				
	</button>
	<button id="btnbuscar" name="buscar" type="submit">
	<a href="busqueda_ejercicio.php" target="popup"
				onClick="window.open(this.href, this.target, 'toolbar=0 , location=0 , status=0 , menubar=0 , scrollbars=0 , resizable=1 ,left=300em,top=150em,width=800em,height=400em');">
    <i class="fa fa-search"></i>
	</a>				
	</button>	
		
		
		<br>
	
	<?php
	while($row = pg_fetch_assoc($select)) {

	?>
	<br>
	<article class="ejercicio">
		<form method="post" action="controlador_ejercicios.php" target="popup" 
				onsubmit="window.open('', 'popup', 'toolbar=NO , location=NO , status=NO , menubar=NO , scrollbars=NO , resizable=1 ,left=300em,top=150em,width=800em,height=500em');">
			<div class="fila_ejercicio col-7 col-tab-7 col-">
			<div class="datos_periodoAsistencia">		
					<input type="hidden" id="oid_e" name="oid_e"
						value="<?php echo $row["oid_e"]; ?>" />
					<input type="hidden" id="nombreEjercicio" name="nombreEjercicio"
						value="<?php echo $row["nombreejercicio"]; ?>" />
					<input type="hidden" id="descripcion" name="descripcion"
						value="<?php echo $row["descripcion"]; ?>" />
					<input type="hidden" id="repeticiones" name="repeticiones"
						value="<?php echo $row["repeticiones"]; ?>" />
					<input type="hidden" id="duracion" name="duracion"
						value="<?php echo $row["duracion"]; ?>" />
					<input type="hidden" id="series" name="series"
						value="<?php echo $row["series"]; ?>" />
					
					<?php if($row["duracion"] != NULL) { ?>
						<div  id="nomostrar" class="nombres"><?php echo $row["nombreejercicio"] . ": " . $row["descripcion"] . " [" . $row["duracion"] . " min]";?></div>
					<?php } else if($row["repeticiones"] != NULL) { ?>
						<div  id="nomostrar" class="nombres"><?php echo $row["nombreejercicio"] . ": " . $row["descripcion"] . " [" . $row["series"] . " series, " . $row["repeticiones"] . " reps/serie]";?></div>
					<?php } ?>
				
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