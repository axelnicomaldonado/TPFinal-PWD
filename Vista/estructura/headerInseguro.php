<?php
// Configuración
include_once "../../configuracion.php";
$session = new Session();
$login = false;
$navbar = false;
if($session->validar()){
    $login = true;
}

$botonComprar = '<div class="row">
    <div class="col-md-5 offset-md-7 d-grid gap-2">
        <a href="../login/login.php" class="btn btn-outline-success btn-lg" >Comprar</a>
    </div>
</div>';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Librerias-->
    <link rel="stylesheet" type="text/css" href="../../util/librerias/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="../../util/librerias/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../util/librerias/fontawesome/css/all.min.css">
    <script type="text/javascript" src="../../util/librerias/fontawesome/js/all.min.js"></script>
    
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">

    <script src="../js/scripts.js"></script>
    


    <title><?php echo $titulo ?></title>
</head>

<body>

  <header class="encabezado">
    <div class="logo">
      <a href="../home/index.php"><img src="../imagenes/Logo_vinoteca.png" alt="Vinoteca"></a>

    </div>

    <!-- MENÚ DE NAVEGACIÓN -->
<body>
    <nav class="menu">
      <ul class="nav">
        <li><a href="../home/index.php">Inicio</a> </li>
        <li><a href="sobreMi.php">Sobre mi</a> </li>
        <li><a href="preguntasFrecuentes.php">Preguntas frecuentes</a> </li>
        <li><a href="contacto.php">Contacto</a> </li>
        <a href="../cliente/carrito.php" class="carritoHeader">
        <img   src="../imagenes/carrito.png" alt="" class="imgCart">
        <span id="contadorCarrito"><?php echo isset($_SESSION['numero']) ? $_SESSION['numero'] : 0; ?></span>
        </a>
        <li>
      <?php
          echo (!$login) ? '<a href="../login/login.php">Iniciar sesión</a>' :
          '<form action="../accion/accionLoginLogout.php" method="post">
          <button class="btn btn-dark-outline" id="botonCerrar"  type="sumbit" name="accion" value="cerrar">Cerrar Sesion</button>
          </form>' 
        ?> </li>

      </ul>
    </nav>

  </header>
</body>