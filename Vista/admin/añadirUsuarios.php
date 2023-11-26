<?php
$titulo = "Añadir usuario";
include_once("../../configuracion.php");
$datos = data_submitted();
$obj = new Session();
include_once("../estructura/headerSeguro.php");
?>

<form action="./accion/accionAñadir.php" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre Usuario:</label>
        <input type="text" class="form-control" id="name" name="usnombre" placeholder="" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="uspass" placeholder="" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Mail:</label>
        <input type="email" class="form-control" id="email" name="usmail" placeholder="" required>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Rol:</label>
        <select class="form-select" id="role" name="idrol" required>
            <option value="2">Admin</option>
            <option value="1">Cliente</option>
            <option value="3">Deposito</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>

<?php
if (isset($datos) && isset($datos['msg']) && $datos['msg'] != null){
    echo '<div class="alert alert-danger text-center mt-3">' . $datos['msg'] . '</div>';
}
?>

<?php 
include_once '../estructura/footer.php';
?>