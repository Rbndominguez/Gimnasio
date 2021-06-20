<?php
	session_start();


	if (isset($_SESSION["form_alta_cliente"])) {

		$nuevoCliente["nombre"] = $_POST["nombre"];
		$nuevoCliente["apellidos"] = $_POST["apellidos"];
		$nuevoCliente["dni"] = $_POST["dni"];
		$nuevoCliente["direccion"] = $_POST["direccion"];
		$nuevoCliente["codigoPostal"] = $_POST["codigoPostal"];
		$nuevoCliente["email"] = $_POST["email"];
		$nuevoCliente["passwd"] = $_POST["password"];
		$nuevoCliente["confirmPasswd"] = $_POST["confirmPassword"];
		$nuevoCliente["telefono"] = $_POST["telefono"];
		$nuevoCliente["lesiones"] = $_POST["lesiones"];
		$nuevoCliente["esEstudiante"] = $_POST["esEstudiante"];
		$nuevoCliente["entrenamientoPersonal"] = $_POST["entrenamientoPersonal"];
		$nuevoCliente["password"] = password_hash($_POST["password"],PASSWORD_BCRYPT);


	}
	else 
		header("Location: form_alta_cliente.php");


	$_SESSION["form_alta_cliente"] = $nuevoCliente;


	$errores = validarDatos($nuevoCliente);
	

	if (isset($errores)) {
		$_SESSION["errores"] = $errores;
		header('Location: form_alta_cliente.php');
	} else {
		header('Location: exito_alta_cliente.php');
	}
	


	function validarDatos($nuevoCliente){
		
		if($nuevoCliente["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		

		if ($nuevoCliente["apellidos"] == "")
			$errores[] = "<p>Los apellidos no puede estar vacío</p>";
		

		if($nuevoCliente["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoCliente["dni"])){
			$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $nuevoCliente["dni"]. "</p>";
		}
		

		if($nuevoCliente["email"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoCliente["email"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoCliente["email"]. "</p>";
		}
		

		if (($nuevoCliente["passwd"] == "") || (strlen($nuevoCliente["passwd"]) < 8)) {
			$errores[] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		} else if (!preg_match("/[a-z]+/", $nuevoCliente["passwd"]) || !preg_match("/[A-Z]+/", $nuevoCliente["passwd"]) || !preg_match("/[0-9]+/", $nuevoCliente["passwd"])) {
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
		} else if ($nuevoCliente["passwd"] != $nuevoCliente["confirmPasswd"]) {
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
		

		if($nuevoCliente["esEstudiante"] != 0 &&
			$nuevoCliente["esEstudiante"] != 1) {
			$errores[] = "<p>El cliente debe ser estudiante o no</p>";
		}
			

		if($nuevoCliente["entrenamientoPersonal"] != 0 &&
			$nuevoCliente["entrenamientoPersonal"] != 1) {
			$errores[] = "<p>El cliente debe tener entrenamiento personal o no</p>";
		}
	
		return $errores;
	}

?>
