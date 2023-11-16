<?php
include_once("../../configuracion.php");
$obj = new Session();
$objUserRol = new AbmUsuarioRol();
$resp = $obj->validar();
$listRol = $obj->getRol();
if($resp) {
    if($listRol[0]->getobjrol()->getIdRol() == 2){
        include_once("../estructura/estAdmin/headerAdmin.php");
    }
    elseif ($listRol[0]->getobjrol()->getIdRol() == 3) {
        include_once("../estructura/estDeposito/headerDeposito.php");
    }
    else{
        $mensaje ="Error, acceso solo Admin. Inicie sesion como admin para continuar";
        echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
    }
} else {
    $mensaje ="Error, vuelva a intentarlo";
    echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>


    </div>
</main>

<?php 
include_once '../estructura/footer.php';
?>
