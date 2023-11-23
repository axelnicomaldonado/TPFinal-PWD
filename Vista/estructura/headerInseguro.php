<?php
// Configuración
include_once "../../configuracion.php";
$session = new Session();
$login = false;
$seguro = false;
if($session->validar()){
    $login = true;
}
?>

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
</body>