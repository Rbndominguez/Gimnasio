<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="../admin/indexAdmin.php"><img src="../assets/images/logo/logo1.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menú</li>
                        <li class="sidebar-item ">
                            <a href="../clienteUser/dieta_user.php" class='sidebar-link'>
                                <i class="bi bi-list-ul"></i>
                                <span>Mi Dieta</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="../clienteUser/tabla_user.php" class='sidebar-link'>
                                <i class="bi bi-table"></i>
                                <span>Mi Tabla de Ejercicios</span>
                            </a>
                        </li>
						<li class="sidebar-item">
                            <a href="../clientes/form_cambiar_contrasena.php" class='sidebar-link' data-toggle="pill">
                                <i class="bi bi-shield-lock-fill"></i>
                                <span>Cambiar Contraseña</span>
                            </a>
                        </li>
						<li class="sidebar-item">
							<a href="../logout.php" class="btn btn-outline-secondary"><i data-feather="user"></i>Log out</a>
						</li>

                    </ul>
                </div>
				
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
        </div>
                    
	<script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../assets/js/pages/dashboard.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>
<aside>
	<nav>
		<ul class="menu">
			<li><a href="../clienteUser/tabla_user.php" target="popup"
				onClick="window.open(this.href, this.target, 'toolbar=0 , location=0 , status=0 , menubar=0 , scrollbars=0 , resizable=1 ,left=300em,top=150em,width=800em,height=600em');">
				Mi Tabla de Ejercicios</a></li>
			<li><a href="../clienteUser/dieta_user.php" target="popup"
				onClick="window.open(this.href, this.target, 'toolbar=0 , location=0 , status=0 , menubar=0 , scrollbars=0 , resizable=1 ,left=300em,top=150em,width=1000em,height=850em');">
				Mi Dieta</a></li>
		  	<li><a href="../clientes/form_cambiar_contrasena.php" target="popup"
				onClick="window.open(this.href, this.target, 'toolbar=0 , location=0 , status=0 , menubar=0 , scrollbars=0 , resizable=1 ,left=300em,top=150em,width=800em,height=500em');">
		  		Cambiar contraseña</a></li>
			<li><a id="desconectar" href="../logout.php">Desconectar</a></li>
			
		</ul>
	</nav>
</aside>
