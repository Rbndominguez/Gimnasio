<?php
	session_start();
  	
	if (!isset($_SESSION['login'])) {
		header("Location: ../index.php");
	}
	
	if ($_SESSION['login'] == "admin") {
		header("Location: ../index.php");
	}
	
  	require_once("../gestionBD.php");
?>
	
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Indice: Cliente</title>
  <link href="../css/indexAdmin.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
	include_once("../header2.php");
	include_once("menuCliente.php");
?>

<main>

</main>
<div class="pie">
		<span><pre>Realizado por Rubén Iglesias Domínguez.©
Junio-2021</pre></span>
	</div>


</body>
</html>

