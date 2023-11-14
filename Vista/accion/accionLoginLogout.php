<?php
include_once("../estructura/cabeceraNoSegura.php");
$datos = data_submitted();
$resp = false;
$obj = new Session();
if (isset($datos['accion'])){

    if ($datos['accion']=="login"){
        $resp = $obj->iniciar($datos['usnombre'],$datos['uspass']);
        if($resp) {
            echo("<script>location.href = '../home/index.php';</script>");
        } else {
            $mensaje ="Error, vuelva a intentarlo";
            echo("<script>location.href = '../login/index.php?msg=".$mensaje."';</script>");
        }

    }

    
    if ($datos['accion']=="cerrar"){
        $resp = $obj->cerrar();
        if($resp) {
            echo("<script>location.href = '../login/index.php';</script>");
        }
    }
}

?>
