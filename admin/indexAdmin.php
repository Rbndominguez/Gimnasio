<?php
	session_start();
  	
	if (!isset($_SESSION['login'])) {
		header("Location: ../index.php");
	}
	
	if ($_SESSION['login'] != "admin") {
		header("Location: ../index.php");
	}
	
  	require_once("../gestionBD.php");
	  require_once("menuAdmin.php");
?>