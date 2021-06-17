<?php
	session_start();
  	
	if (!isset($_SESSION['login'])) {
		header("Location: ../index.php");
	}
	
	if ($_SESSION['login'] == "admin") {
		header("Location: ../index.php");
	}
	
?>
	
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Menú Cliente</title>
</head>

<body>

<main>
<?php
  	require_once("../gestionBD.php");
	require_once("menuCliente.php");
?>

</main>

</body>
</html>

