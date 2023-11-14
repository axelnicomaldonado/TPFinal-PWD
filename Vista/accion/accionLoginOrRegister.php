<?php
include_once("../estructura/header.php");
$datos = data_submitted();

if($datos["accion"]=="goLogin"){
    echo("<script>location.href = '../login/index.php';</script>");
}
if($datos["accion"]=="goRegister"){
    //codigo para registrarse
}

?>
