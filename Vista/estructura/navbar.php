<?php
$objC = new AbmUsuario();
$arreglo = $objC->buscar(["id" => $session->getUsuario()->getidusuario()]);

$objR = new AbmRol();
$menu = "";

// buscar roles del usuario
$arregloRoles = $objC->buscarRoles(["id" => $session->getUsuario()->getidusuario()]);

// armar arreglo de opciones de menu
$nuevo = array();

foreach ($arregloRoles as $rol) {
    $permisos = $objR->buscarPermisos(["id" => $rol->getObjRol()->getIdRol()]);
    if ($permisos != null) {
        $menu .= "<h5>" . $rol->getObjRol()->getRoDescripcion() . "</h5><hr>";
        // mostrar
        foreach ($permisos as $permiso) {
            if($permiso->getObjMenu()->getMeDescripcion() != "../Perfil/index.php"){
                $menu .= '
                    <div class="col-12 mb-2">
                        <a href="' . $permiso->getObjMenu()->getMeDescripcion() . '" class="btn text-success">
                            <h4 class="d-inline mx-3">' . $permiso->getObjMenu()->getMeNombre() . '</h4>
                        </a>
                    </div>';
            }
        }
    }
}
?>

<header class="encabezado">
    <div class="logo">
      <a href="../home/index.php"><img src="../imagenes/Logo_vinoteca.png" alt="Vinoteca"></a>
    </div>

    <nav class="navbar navbar-light bg-light sticky-top navbar-expand-lg">
    <div class="container-fluid max">
        <a class="navbar-brand fw-bold" href="../Home/index.php">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex align-items-end justify-content-start" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn text-dark" data-bs-toggle="offcanvas" href="#menu-dinamico" role="button" aria-controls="offcanvas">
                    <i class="fa-solid fa-bars"></i> Menu
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="menu-dinamico" aria-labelledby="menu-dinamico-label">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title text-center fw-5" id="menu-dinamico-label"><img src="../img/logo_pizza.png" class="col-10 img-fluid" alt=""></h1>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <hr>
        <?php echo $menu; ?>
        <hr>
        <div class="col-12 mb-1 mx-2">
            <a href="../perfil/accion/cerrarSesion.php" class="text-decoration-none text-danger">Cerrar Sesión</a>
        </div>
    </div>
</div>
</div>