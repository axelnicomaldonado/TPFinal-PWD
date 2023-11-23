<?php
$titulo = "Mi Cuenta";
include_once("../estructura/headerSeguro.php");
$objUsuario = new AbmUsuario();
$session = new Session();

$data["idusuario"] = $session->getUsuario()->getidusuario();
$arregloPerfil = $objUsuario->buscar($data);
?>

<div class="container d-flex justify-content-between flex-row " style="background-color: #fff; width: 90%; margin-top: 3em; border: 2px solid grey; height: 80%;">
<div style="margin-top: 5em; margin-left: 1em" class="info-cuenta">
<h2 style="position:relative; text-align: center; margin-top: 1.5em">Información de la cuenta</h2>
    <p style="margin-top: 1em;"><b>Nombre de usuario: </b><?php echo $arregloPerfil[0]->getusnombre() ?>.</p>
    <p style="margin-top: 1em;"><b>Correo Electrónico: </b><?php echo $arregloPerfil[0]->getusmail() ?></p>
    <form action="editarCliente.php" method="post">
      <button type="submit" class="btn btn-link">Cambiar datos</button>
    </form>
  </div>
</div>