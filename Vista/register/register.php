<?php
include_once("../../configuracion.php");
include_once("../estructura/headerInseguro.php");
$datos = data_submitted();
?>
<div class="border p-3">
    <form action="accionRegister.php" method="post">
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
            <input type="email" class="form-control" id="usmail" name="usmail" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>

    <?php
    if (isset($datos) && isset($datos['msg']) && $datos['msg'] != null){
        echo '<div class="alert alert-danger text-center mt-3">' . $datos['msg'] . '</div>';
    }
    ?>
</div>


