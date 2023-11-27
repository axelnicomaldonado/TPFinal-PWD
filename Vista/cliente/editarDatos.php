<?php
$titulo = 'Modificar';
include_once('../../configuracion.php');
$session = new Session();
$resp = $session->validar();
if ($resp) {
    include_once '../estructura/headerSeguro.php';

}
$datos = data_submitted();

$resp = $session->validar();
$listRol = $session->getRol();
$objUserRol = new AbmUsuarioRol();

$users = $objUserRol->buscar($datos);

$i = 0;

while ($users[$i]->getobjusuario()->getidusuario() != $datos["id"]) {
    $i++;
}
?>
<div class="containerFormEditar">
    <form id="form" action="accion/editarUsuario.php?id=<?php echo $users[$i]->getobjusuario()->getidusuario(); ?>" method="post">

        <label for="name" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="name" name="usnombre" value="<?php echo $users[$i]->getobjusuario()->getusnombre() ?>" required>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="usemail" value="<?php echo $users[$i]->getobjusuario()->getusmail() ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nueva contraseña:</label>
            <input type="password" class="form-control" id="password" name="uspass" value="<?php echo $users[$i]->getobjusuario()->getuspass(); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"></script>
    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault();

            var password = document.getElementById('password').value;

            var hashedPassword = md5(password);

            document.getElementById('password').value = hashedPassword;
            
            this.submit();
        });
    </script>