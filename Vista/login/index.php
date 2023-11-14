<?php
include_once("../estructura/cabeceraNoSegura.php");
$datos = data_submitted();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-dfNb1hK4br2lMD4TIYyMq8ig4cYIi5m5UdmJ1oAzMWvE+maIExmGNMOjAZxZ7fC" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="mb-4">Inicio de Sesión</h2>
        <form action="../accion/accionLoginLogout.php" method="post">
        <input id="accion" name ="accion" value="login" type="hidden">
          <div class="mb-3">
            <label for="usnombre" class="form-label">Usuario:</label>
            <input type="text" class="form-control" id="usnombre" name="usnombre" required>
          </div>
          <div class="mb-3">
            <label for="uspass" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="uspass" name="uspass" required autocomplete="off">
          </div>
          <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        
        <?php 
          if(isset($datos) && isset($datos['msg']) && $datos['msg']!=null) {
            echo '<div class="alert alert-danger mt-3">' . $datos['msg'] . '</div>';
          }
        ?>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-GLhlTQ8iK1u5lTR+JKTQtbIvaa/9MlQ5ZjEfxIcaF8E/Dq4WygFZB89tiYK31nke" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-s9QDH5ZstEz9R6ZgE3U8rEXHWJQkQcXg9s9qE3LFA+nvMClZ+gTSKtg6LdSmCA7A" crossorigin="anonymous"></script>
</body>
</html>
