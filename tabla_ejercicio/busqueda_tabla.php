<?php
	session_start();

	require_once("../gestionBD.php");
	require_once("gestionTablaEjercicio.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Busqueda de Tabla de ejercicios</title>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script>
  $(document).ready(function() {
  	("#resultadoBusqueda").html('');
  });
  
  function buscar(){
  	var textoBusqueda = $("input#busqueda").val();
  	
  	if (textoBusqueda != "") {
  		$.post("accion_buscar_tabla.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
  			$("#resultadoBusqueda").html(mensaje);
  		});
  	} else {
  		("#resultadoBusqueda").empty();
 	};
 };
  </script>
 <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<main>
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
                <h4 class="card-title"><b>Buscar </b><em>(Pulsa Enter para limpiar la búsqueda)</em></h4>
            </div>
            <div class="card-body">
	<form accept-charset="utf-8" method="POST">
	<input size="50" type="text" name="busqueda" id="busqueda" value="" placeholder="" maxlength="50" autocomplete="off" onkeyup="buscar();" autofocus />
	</form>
	<div id="resultadoBusqueda"></div>
	<div>
		</br>
		<button class="btn btn-danger" onClick="window.close();">Cerrar</button>
	</div>
	
	</main>
</div>
        </div>
    </div>
</body>
</html>
