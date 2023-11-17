<?php
include_once("../../configuracion.php");
$datos = data_submitted();
$obj = new Session();
$resp = $obj->validar();
$listRol = $obj->getRol();
if($resp) {
    if($listRol[0]->getobjrol()->getIdRol() == 2){
        include_once("../estructura/estAdmin/headerAdmin.php");
    }
    else{
        $mensaje ="Error, acceso solo Admin. Inicie sesion como admin para continuar";
        echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
    }
} else {
    $mensaje ="Error, vuelva a intentarlo";
    echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
}

$objUserRol = new AbmUsuarioRol();

$users = $objUserRol->buscar($datos);

$i = 0;

while ($users[$i]->getobjusuario()->getidusuario()!=$datos["id"]) {
    $i++;
}

echo '<form action="./accion/accionEditar.php?id='.$users[$i]->getobjusuario()->getidusuario().'" method="post">';
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
        echo '<input type="email" class="form-control" id="email" name="usmail" value="'.$users[$i]->getobjusuario()->getusmail().'" required>';
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
	
<?php 
include_once '../estructura/footer.php';
?>