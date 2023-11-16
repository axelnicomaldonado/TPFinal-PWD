<?php
$titulo = 'Vinoteca';
include_once("../../configuracion.php");

$obj = new Session();

$resp = $obj->validar();
if($resp) {
    $listRol = $obj->getRol();
    $i = 0;
    while ($listRol[$i]->getobjusuario()->getidusuario() != $_SESSION["idusuario"]) {
        $i++;
    }
    $archivoIncluir = [ 1 => "../estructura/estCliente/headerCliente.php",];
    if($listRol[$i]->getobjusuario()->getidusuario() == 1 || $listRol[$i]->getobjusuario()->getidusuario() == 4){
        include_once($archivoIncluir[$listRol[$i]->getobjusuario()->getidusuario()]);
    }
    else{
        $mensaje ="Error, acceso solo para cliente o publico. Inicie sesion como cliente para continuar";
        echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
    }
} else {
    include_once("../estructura/estPublico/headerPublico.php");
}

include_once("../productos/productos.php");


?>