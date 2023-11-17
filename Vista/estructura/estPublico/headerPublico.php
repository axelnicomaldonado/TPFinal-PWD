<?php
include_once('../../configuracion.php');
$obj = new Session();

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
        <li><a href="../home/index.php">Inicio</a> </li>
        <li><a href="../productos/productos.php">Productos</a> </li>
        <li><a href="sobreMi.php">Sobre mi</a> </li>
        <li><a href="preguntasFrecuentes.php">Preguntas frecuentes</a> </li>
        <li><a href="contacto.php">Contacto</a> </li>
        <a href="../cliente/carrito.php" class="carritoHeader">
        <img   src="../imagenes/carrito.png" alt="" class="imgCart">
        <span id="contadorCarrito"><?php echo isset($_SESSION['numero']) ? $_SESSION['numero'] : 0; ?></span>
        </a>

        <a href="../login/login.php">
          <img src="../imagenes/user.png" alt="user" class="imgUser">
          </a>

      </ul>
    </nav>

  </header>
