<?php
include_once("../../configuracion.php");
$obj = new Session();
$resp = $obj->validar();
$listRol = $obj->getRol();
if($resp) {
    $i = 0;
    while ($listRol[$i]->getobjusuario()->getidusuario() != $_SESSION["idusuario"]) {
        $i++;
    }
    $archivoIncluir = [ 2 => "../estructura/estAdmin/headerAdmin.php", 3 => "../estructura/estDeposito/headerDeposito.php",];
    if($listRol[$i]->getobjusuario()->getidusuario() == 2 || $listRol[$i]->getobjusuario()->getidusuario() == 3){
        include_once($archivoIncluir[$listRol[$i]->getobjusuario()->getidusuario()]);
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
