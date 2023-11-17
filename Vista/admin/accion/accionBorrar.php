<?php
include_once("../../../configuracion.php");
$datos = data_submitted();
$resp = false;
$objUser = new AbmUsuario();
$objUserRol = new AbmUsuarioRol();
$datos["idusuario"] = $_GET["id"];
$userRolEliminar = $objUserRol->buscar($datos);
$datos["idrol"] = $userRolEliminar[0]->getobjrol()->getidrol();
$resp = $objUserRol->baja($datos);
if($resp){
    $respUsuario = $objUser->baja($datos);
    if($respUsuario){
        $mensaje = "Usuario eliminado!";
        echo("<script>location.href = '../gestionUsuarios.php?msg=".$mensaje."';</script>");
    }
    else{
        $mensaje = "No se pudo realizar la operacion";
        echo("<script>location.href = '../gestionUsuarios.php?msg=".$mensaje."';</script>");
    }
}
?>