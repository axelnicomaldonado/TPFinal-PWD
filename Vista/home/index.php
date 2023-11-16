<?php
include_once("../../configuracion.php");
$obj = new Session();
$objUserRol = new AbmUsuarioRol();
$resp = $obj->validar();
$listRol = $obj->getRol();
if($resp) {
    if($listRol[0]->getobjrol()->getIdRol() == 1){
        include_once("../estructura/estCliente/headerCliente.php");
    }
    else{
        $mensaje ="Error, acceso solo Admin. Inicie sesion como admin para continuar";
        echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
    }
} else {
    include_once("../estructura/estPublico/headerPublico.php");
}
?>



<?php
include_once("../productos/productos.php");
?>
