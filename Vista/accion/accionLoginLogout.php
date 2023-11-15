<?php
include_once("../../configuracion.php");
$datos = data_submitted();
$resp = false;
$obj = new Session();
if (isset($datos['accion'])){

    if ($datos['accion']=="login"){
        $resp = $obj->iniciar($datos['usnombre'],$datos['uspass']);
        if($resp) {
            $listRol = $obj->getRol();
            $i = 0;
            while ($listRol[$i]->getobjusuario()->getidusuario() != $_SESSION["idusuario"]) {
            $i++;
            }
            if($listRol[$i]->getobjusuario()->getidusuario() == 1 || $listRol[$i]->getobjusuario()->getidusuario() == 4){
                echo("<script>location.href = '../home/index.php';</script>");
            }
            else{
                echo("<script>location.href = '../home/panel.php';</script>");
            }
        } else {
            $mensaje ="Error, vuelva a intentarlo";
            echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
        }

    }

    
    if ($datos['accion']=="cerrar"){
        $resp = $obj->cerrar();
        if($resp) {
            echo("<script>location.href = '../home/index.php';</script>");
        }
    }
}

?>
