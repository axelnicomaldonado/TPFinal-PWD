<?php
$titulo = "Inicio de sesion";
include_once("../../configuracion.php");
include_once("../estructura/headerInseguro.php");
$datos = data_submitted();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesión</title>
  <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="mb-4">Inicio de Sesión</h2>
        <form id="form" action="../accion/accionLoginLogout.php" method="post">
    <input id="accion" name="accion" value="login" type="hidden">
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

<p>¿No tienes una cuenta? <a href="../register/register.php">Regístrate aquí</a>.</p>

        
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"></script>
    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault();

            var password = document.getElementById('uspass').value;

            var hashedPassword = md5(password);

            document.getElementById('uspass').value = hashedPassword;
            
            this.submit();
        });
    </script>
</body>
</html>
