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
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="../clientes/consulta_clientes.php" class='sidebar-link' data-toggle="pill">
                                <i class="bi bi-people-fill"></i>
                                <span>Clientes</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="../clase/consulta_clases.php" class='sidebar-link' data-toggle="pill">
                                <i class="bi bi-clock-history"></i>
                                <span>Clases</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="../comida/consulta_comidas.php" class='sidebar-link'>
                                <i class="bi bi-egg-fried"></i>
                                <span>Comidas</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="../dieta/consulta_dietas.php" class='sidebar-link'>
                                <i class="bi bi-list-ul"></i>
                                <span>Dietas</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="../ejercicio/consulta_ejercicios.php" class='sidebar-link'>
                                <i class="bi bi-trophy"></i>
                                <span>Ejercicios</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="../monitor/consulta_monitores.php" class='sidebar-link'>
                                <i class="bi bi-person-badge"></i>
                                <span>Monitores</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="../pago/consulta_pagos.php" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Pagos</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="../periodoAsistencia/consulta_periodos_asistencia.php" class='sidebar-link'>
                                <i class="bi bi-calendar-date"></i>
                                <span>Periodos de asistencia</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="../salario/consulta_salarios.php" class='sidebar-link'>
                                <i class="bi bi-wallet"></i>
                                <span>Salarios</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="../tabla_ejercicio/consulta_tablas_ejercicios.php" class='sidebar-link'>
                                <i class="bi bi-table"></i>
                                <span>Tablas de ejercicios</span>
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