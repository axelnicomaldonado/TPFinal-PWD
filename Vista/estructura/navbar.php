<?php

$objC = new AbmUsuario();
$arreglo = $objC->buscar(["id" => $session->getUsuario()->getidusuario()]);

$miCuenta = '';

$objR = new AbmRol();
$menu = "";
$iniString = '<div class="dropdown-center">
<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
<img src="../imagenes/user.png" alt="user" class="imgUser">
</button>
<ul class="dropdown-menu">';
$finalString = '<li>
<form action="../accion/accionLoginLogout.php" method="post">
<li><a class="dropdown-item" href="#"><button class="btn btn-dark-outline" id="botonCerrar"  type="sumbit" name="accion" value="cerrar">Cerrar Sesion</button></a></li>
</form>
</li>
</ul>
</div>';
$selecRol = '<div class="dropdown-center">
<button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
Roles
</button><ul class="dropdown-menu"><ul class="dropdown-menu">';
$finSelec = '</ul></div>';



// buscar roles del usuario
$arregloRoles = $objC->buscarRoles(["id" => $session->getUsuario()->getidusuario()]);

// armar arreglo de opciones de menu
$miCuenta = $iniString;
foreach ($arregloRoles as $rol) {
    $permisos = $objR->buscarPermisos(["id" => $rol->getObjRol()->getIdRol()]);
    if ($permisos != null) {
        // Muestra las funciones de cada rol
        if(count($arregloRoles) > 1) {
            $miCuenta .= "<b>" . $rol->getObjRol()->getRoDescripcion(). " </b>";
        }



        foreach ($permisos as $permiso) {
            if ($permiso->getObjMenu()->getMeDescripcion() != "../home/index.php") {

                $miCuenta .= '<li><a class="dropdown-item" href="' . $permiso->getObjMenu()->getMeDescripcion() . '">'
                    . $permiso->getObjMenu()->getMeNombre() . '</a></li>';
            }
        }
       

    }

    /*if (count($arregloRoles) > 1) {
        $selecRol .= '<li><a class="class="dropdown-item">' . $rol->getRoDescripcion() . '</a></li>';
    }*/
}
$miCuenta .=   $finalString;

$botonComprar = '<div class="row">
        <div class="col-md-5 offset-md-7 d-grid gap-2">
            <a href="../home/index.php" class="btn btn-outline-success btn-lg" id="comprarBtn" data-bs-toggle="modal" data-bs-target="#successModal">Comprar</a>
        </div>
    </div>';
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="../js/scripts.js"></script>
    <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
    <title><?php echo $titulo ?></title>
</head>

<body>

    <header class="encabezado">
        <div class="logo">
            <a href="../home/index.php"><img src="../imagenes/Logo_vinoteca.png" alt="Vinoteca"></a>

        </div>

        <!-- MENÚ DE NAVEGACIÓN -->

        <nav class="menu">
            <ul class="nav">
                <li class="liNav"><a href="../home/index.php">Inicio</a> </li>
                <li class="liNav"><a href="../productos/productos.php">Productos</a> </li>
                <li class="liNav"><a href="sobreMi.php">Sobre mi</a> </li>
                <li class="liNav"><a href="preguntasFrecuentes.php">Preguntas frecuentes</a> </li>
                <li class="liNav"><a href="contacto.php">Contacto</a> </li>

                <a href="../cliente/carrito.php" class="carritoHeader">
                    <img src="../imagenes/carrito.png" alt="" class="imgCart">
                    <span id="contadorCarrito"><?php echo isset($_SESSION['numero']) ? $_SESSION['numero'] : 0; ?></span>
                </a>

                <?php echo $miCuenta ?>
                <?php /*if(count($arregloRoles) > 1){
                    echo $selecRol . $finSele;
                } */?>

            </ul>
        </nav>

    </header>