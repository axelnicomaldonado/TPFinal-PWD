<?php
include_once("../../configuracion.php");

echo '<nav class="menu">
      <ul class="nav">
        <li><a href="#">Inicio</a> </li>
        <li><a href="../productos/productos.php">Productos</a> </li>
        <li><a href="contacto.php">Contacto</a> </li>
        <a href="../cliente/carrito.php" class="carritoHeader">
        <img   src="../imagenes/carrito.png" alt="" class="imgCart">
        <span id="contadorCarrito">';
        echo isset($_SESSION['numero']) ?$_SESSION['numero'] : 0;
        echo '</span></a>';


?>