<?php
$titulo = "Editar Cliente";
include_once("../estructura/headerSeguro.php");
$session = new Session();

$id = $session->getUsuario()->getidusuario();
?>
    <h3 class="mb-2" style="text-align: center; margin-bottom: 1em; margin-top: 1em;">Cambiar datos de la cuenta</h3>
    <div style="margin: auto; border: 1px solid grey; padding: 1em; width: 40%;">
        <form class="row g-3 needs-validation" method="get" action="accion\accionEditarCliente.php">
            <div class="col-md-12">
            <label for="usuario" class="form-label">Nuevo nombre de usuario</label>
            <input type="text" class="form-control" id="usuario" required name="usuario">
            <div id="usuarioInvalid" class="invalid-feedback">
                Ingrese un usuario válido
            </div>
        </div>
        <div class="col-md-12">
            <label for="contrasenia" class="form-label">Nueva contraseña</label>
            <input type="password" class="form-control" id="contrasenia" required name="contrasenia">
            <div id="contraseniaInvalid" class="invalid-feedback">
                La contraseña no es válida
            </div>
        </div>  
        <div class="col-md-12">
            <label for="correo" class="form-label">Nuevo correo</label>
            <input type="text" class="form-control" id="correo" required name="correo">
        </div>
        <div id="correoInvalid" class="invalid-feedback">
            Ingrese un correo válido
        </div>
            <div class="col-md-12 d-md-flex justify-content-md-center" style="margin-top:1em">
            <button class=" btn btn-primary" type="submit">Editar datos</button>
        </div>
        <input type="text" name="id" id="id" hidden value="<?php echo $id; ?>">
    </form>
