<?php
include_once("../../configuracion.php");
include_once("../estructura/headerInseguro.php");
$datos = data_submitted();
?>
<div class="border p-3">
    <form id="form" action="accionRegister.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Nombre de Usuario:</label>
            <input type="text" class="form-control" id="usnombre" name="usnombre" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="uspass" name="uspass" required autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" class="form-control" id="usemail" name="usemail" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>

    <?php
    if (isset($datos) && isset($datos['msg']) && $datos['msg'] != null){
        echo '<div class="alert alert-danger text-center mt-3">' . $datos['msg'] . '</div>';
    }
    ?>
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
</div>


