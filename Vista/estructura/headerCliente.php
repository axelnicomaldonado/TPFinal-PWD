<?php
include_once("../../configuracion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilos.css">
  <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
  <title><?php $titulo ?></title>
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


        <img src="../imagenes/carrito.png" alt="" class="imgCart">

        <div class="dropdown-center">
          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../imagenes/user.png" alt="user" class="imgUser">
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../cliente/cuenta.php">Mi Cuenta</a></li>
            <li><a class="dropdown-item" href="Aca va el logout">Cerrar Sessión</a></li>
          </ul>
        </div>
      </ul>
    </nav>

  </header>