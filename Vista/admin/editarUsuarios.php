<?php
$titulo = "Editar Usuario";
include_once("../../configuracion.php");
include_once('../estructura/headerSeguro.php');
$datos = data_submitted();


$objUserRol = new AbmUsuarioRol();

$users = $objUserRol->buscar($datos);

$i = 0;

while ($users[$i]->getobjusuario()->getidusuario() != $datos["id"]) {
    $i++;
}

echo '<form id="form" action="./accion/accionEditar.php?id='.$users[$i]->getobjusuario()->getidusuario().'" method="post">';
    echo '<div class="mb-3">';
        echo '<label for="name" class="form-label">Nombre:</label>';
        echo '<input type="text" class="form-control" id="name" name="usnombre" value="'.$users[$i]->getobjusuario()->getusnombre().'" required>';
    echo '</div>';

    echo '<div class="mb-3">';
        echo '<label for="password" class="form-label">Contraseña:</label>';
        echo '<input type="password" class="form-control" id="password" name="uspass" value="'.$users[$i]->getobjusuario()->getuspass().'" required>';
    echo '</div>';

    echo '<div class="mb-3">';
        echo '<label for="email" class="form-label">Mail:</label>';
        echo '<input type="email" class="form-control" id="email" name="usemail" value="'.$users[$i]->getobjusuario()->getusmail().'" required>';
    echo '</div>';

    echo '<div class="mb-3">';
        echo '<label for="role" class="form-label">Rol:</label>';
        echo '<select class="form-select" id="role" name="idrol" required>';
            echo '<option value="2">Admin</option>';
            echo '<option value="1">Cliente</option>';
            echo '<option value="3">Deposito</option>';
        echo '</select>';
    echo '</div>';

    echo '<button type="submit" class="btn btn-primary">Guardar cambios</button>';
echo '</form>';
?>

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