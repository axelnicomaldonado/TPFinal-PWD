<?php
include_once("../../configuracion.php");
$datos = data_submitted();
$resp = false;
$objUser = new AbmUsuario();
$objUserRol = new AbmUsuarioRol();
$users = $objUser->buscar(null);
$i = 0;
while ($users[$i]->getusnombre() != $datos["usnombre"] && $i < count($users)-1) {
    $i++;
}
if ($users[$i]->getusnombre() == $datos["usnombre"]) {
    $mensaje = "nombre de usuario en uso";
    echo("<script>location.href = './register.php?msg=".$mensaje."';</script>");
}
else{
$resp = $objUser->alta($datos);

$i = 0;
$newusers = $objUser->buscar($datos);

$idNuevo = $newusers[0]->getidusuario();

$datos["idusuario"]=$idNuevo;
$datos["idrol"]=1;
$respUserRol = $objUserRol->alta($datos);

if($resp && $respUserRol){
    echo("<script>location.href = '../home/index.php';</script>");
}
else{
    $mensaje = "No se pudo realizar el alta";
    echo("<script>location.href = './register.php?msg=".$mensaje."';</script>");
}
}
?>