<?php
	session_start();

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["form_alta_cliente"])) {
		// Recogemos los datos del formulario
		$nuevoCliente["nombre"] = $_POST["nombre"];
		$nuevoCliente["apellidos"] = $_POST["apellidos"];
		$nuevoCliente["dni"] = $_POST["dni"];
		$nuevoCliente["direccion"] = $_POST["direccion"];
		$nuevoCliente["codigoPostal"] = $_POST["codigoPostal"];
		$nuevoCliente["email"] = $_POST["email"];
		$nuevoCliente["password"] = $_POST["password"];
		$nuevoCliente["confirmPassword"] = $_POST["confirmPassword"];
		$nuevoCliente["telefono"] = $_POST["telefono"];
		$nuevoCliente["lesiones"] = $_POST["lesiones"];
		$nuevoCliente["esEstudiante"] = $_POST["esEstudiante"];
		$nuevoCliente["entrenamientoPersonal"] = $_POST["entrenamientoPersonal"];
	}
	else // En caso contrario, vamos al formulario
		header("Location: form_alta_cliente.php");

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["form_alta_cliente"] = $nuevoCliente;

	// Validamos el formulario en servidor 
	$errores = validarDatos($nuevoCliente);
	
	// Si se han detectado errores
	if (isset($errores)) {
		$_SESSION["errores"] = $errores;
		header('Location: form_alta_cliente.php');
	} else
		// Si todo va bien, vamos a la página de éxito
		header('Location: exito_alta_cliente.php');

	
	// Validación en servidor del formulario de alta de usuario

	function validarDatos($nuevoCliente){
		// Validación del Nombre			
		if($nuevoCliente["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		
		//Validación apellidos
		if ($nuevoCliente["apellidos"] == "")
			$errores[] = "<p>Los apellidos no puede estar vacío</p>";
		
		// Validación del DNI
		if($nuevoCliente["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoCliente["dni"])){
			$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $nuevoCliente["dni"]. "</p>";
		}
		
		// Validación del email
		if($nuevoCliente["email"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoCliente["email"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoCliente["email"]. "</p>";
		}
		
		// Validación de la contraseña
		if (($nuevoCliente["password"] == "") || (strlen($nuevoCliente["password"]) < 8)) {
			$errores[] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		} else if (!preg_match("/[a-z]+/", $nuevoCliente["password"]) || !preg_match("/[A-Z]+/", $nuevoCliente["password"]) || !preg_match("/[0-9]+/", $nuevoCliente["password"])) {
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
		} else if ($nuevoCliente["password"] != $nuevoCliente["confirmPassword"]) {
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
		
		// Validación del esEstudiante
		if($nuevoCliente["esEstudiante"] != 0 &&
			$nuevoCliente["esEstudiante"] != 1) {
			$errores[] = "<p>El cliente debe ser estudiante o no</p>";
		}
			
		// Validación del entrenamientoPersonal
		if($nuevoCliente["entrenamientoPersonal"] != 0 &&
			$nuevoCliente["entrenamientoPersonal"] != 1) {
			$errores[] = "<p>El cliente debe tener entrenamiento personal o no</p>";
		}
	
		return $errores;
	}

?>
