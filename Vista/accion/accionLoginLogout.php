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
            if($listRol[0]->getobjrol()->getIdRol() == 2 || $listRol[0]->getobjrol()->getIdRol() == 3){
                echo("<script>location.href = '../home/panel.php';</script>");
            }
            elseif ($listRol[0]->getobjrol()->getIdRol() == 1 || $listRol[0]->getobjrol()->getIdRol() == 4) {
                echo("<script>location.href = '../home/index.php';</script>");
            }
            else{
                $mensaje ="Error, acceso solo Admin. Inicie sesion como admin para continuar";
                echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
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

