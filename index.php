<?php
	session_start();
  	
  	require_once("gestionBD.php");
 	require_once("clientes/gestionarClientes.php");
	
	if(isset($_POST["dni"])) {

		$dni = $_POST["dni"];
		$pass = $_POST["pass"];
		
		if($dni == "admin" && $pass == "1234"){
			$_SESSION["login"] = $dni;
			header("Location: admin/indexAdmin.php");
		} else {

			$conexion = crearConexionBD();

			$num_cliente = consultarCliente($conexion, $dni, $pass);

			cerrarConexionBD($conexion);

			if($num_cliente == 1) {
				$_SESSION["login"] = $dni;

				header("Location: admin/indexCliente.php");
			} else {	
				$login = "Error";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Inicie la sesión con los datos que le proporcionó el dueño del gimnasio.</p>

                    <form action="index.php" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Usuario" name="dni" id="dni" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Contraseña" name="pass" id="pass">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" value="Log in"></input>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p><a class="font-bold" href="auth-forgot-password.html">¿Olvidaste tu contraseña?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>