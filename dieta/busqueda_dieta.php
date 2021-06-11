<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionDietas.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Busqueda de Dieta</title>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script>
  $(document).ready(function() {
  	("#resultadoBusqueda").html('');
  });
  
  function buscar(){
  	var textoBusqueda = $("input#busqueda").val();
  	
  	if (textoBusqueda != "") {
  		$.post("accion_buscar_dieta.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
  			$("#resultadoBusqueda").html(mensaje);
  		});
  	} else {
  		("#resultadoBusqueda").empty();
 	};
 };
  </script>
  <link href="../css/busqueda.css" rel="stylesheet" type="text/css">
</head>

<body>

<main>
	
	<form accept-charset="utf-8" method="POST">
		<p><b>Buscar </b><em>(Pulsa Enter para limpiar la búsqueda)</em></p>
		<input type="text" name="busqueda" id="busqueda" value="" placeholder="" maxlength="50" autocomplete="off" onkeyup="buscar();" autofocus />
	</form>
	<div id="resultadoBusqueda"></div>
	<div>
		</br>
		<button id= "cerrar" onClick="window.close();">Cerrar</button>
	</div>
	
</main>

</body>
</html>
