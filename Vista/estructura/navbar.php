<?php

$objC = new AbmUsuario();
$arreglo = $objC->buscar(["id" => $session->getUsuario()->getidusuario()]);

$objR = new AbmRol();
$menu = "";

// buscar roles del usuario
$arregloRoles = $objC->buscarRoles(["id" => $session->getUsuario()->getidusuario()]);

// armar arreglo de opciones de menu
foreach ($arregloRoles as $rol) {
    $permisos = $objR->buscarPermisos(["id" => $rol->getObjRol()->getIdRol()]);
    if ($permisos != null) {
        $menu .= "<h5>Opciones de " . $rol->getObjRol()->getRoDescripcion() . "</h5><hr>";
        // Muestra las funciones de cada rol
        foreach ($permisos as $permiso) {
            if($permiso->getObjMenu()->getMeDescripcion() != "../home/index.php"){
                $menu .= '
                        <a href="' . $permiso->getObjMenu()->getMeDescripcion() . '" class="btn text-danger">'
                        .$permiso->getObjMenu()->getMeNombre().'</a>';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="../home/index.php">Inicio</a>
            <!--Menú desplegable -->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand ps-3" href="#">Bienvenido, <?php echo $session->getUsuario()->getusnombre(); ?>.</a>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                <form action="../accion/accionLoginLogout.php" method="post">
                <button class="dropdown-item btn btn-link" type="submit" name="accion" value="cerrar">Cerrar sesión</button>
                </form>
                </li>
                </ul>
                </li>
            </ul>

        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Interfaz</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                Opciones
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <?php echo $menu; ?>
                                </nav>
                            </div>
                        
                    <div class="sb-sidenav-footer">
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">