<?php
include_once("../../configuracion.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
    <title><?php $titulo ?></title>
  </head>
  <body class="hold-transition layout-fixed">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="../login/index.php" class="nav-link px-2 link-secondary">Inicio</a></li>
      </ul>

      <div class="col-md-3 text-end">
      <form action="../accion/accionLoginOrRegister.php" method="post">
        <button type="submit" class="btn btn-outline-primary me-2" name="accion" value="goLogin">Iniciar Sesion</button>
        <button type="sumbit" class="btn btn-primary" name="accion" value="goRegister">Registrarse</button>
      </form>
      </div>
    </header>
</body>
