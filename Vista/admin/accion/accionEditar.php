<?php
include_once("../../../configuracion.php");
$datos = data_submitted();
$resp = false;
$objUser = new AbmUsuario();
$objUserRol = new AbmUsuarioRol();
$datos["idusuario"]=$_GET["id"];
$respUser = $objUser->modificacion($datos);
$respUserRol = $objUserRol->modificacion($datos);
if($respUser && $respUserRol){
    $mensaje = "Modificacion realizada con exito!";
    echo("<script>location.href = '../gestionUsuarios.php?msg=".$mensaje."';</script>");
}
else{
    $mensaje = "No se pudo realizar la modificacion";
    echo("<script>location.href = '../gestionUsuarios.php?msg=".$mensaje."';</script>");
}
?>