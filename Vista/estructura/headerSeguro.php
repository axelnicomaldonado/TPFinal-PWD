<?php
include_once("../../configuracion.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php
    $obj = new Session();
    $resp = $obj->validar();
    if($resp) {
        echo("<script>location.href = '../home/index.php';</script>");
    } else {
        $mensaje ="Error, vuelva a intentarlo";
        echo("<script>location.href = '../login/index.php';</script>");
    }
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
    <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
    <title><?php $titulo ?></title>
  </head>
  <body class="hold-transition layout-fixed">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="../home/index.php" class="nav-link px-2 link-secondary">Inicio</a></li>
      </ul>
      <div class="col-md-3 text-end">
      <form action="../accion/accionLoginLogout.php" method="post">
      <button type="sumbit" class="btn btn-primary me-2" name="accion" value="cerrar">Cerrar Sesion</button>
      </form>
      </div>
      //seguir agregando items, etc.
    </header>
</body>
