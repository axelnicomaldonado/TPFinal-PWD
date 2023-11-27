<?php
include_once("../../../configuracion.php");
$datos = data_submitted();
$resp = false;
$objUser = new AbmUsuario();
$objUserRol = new AbmUsuarioRol();
$datos["idusuario"] = $_REQUEST["id"];
$datos["usemail"] = $_POST["usemail"]; // Asegúrate de que se esté recogiendo correctamente

$respUser = $objUser->modificacion($datos);
if($respUser){
    $mensaje = "Modificacion realizada con exito!";
    echo("<script>location.href = '../cuentaCliente.php?msg=".$mensaje."';</script>");
}
else{
    $mensaje = "No se pudo realizar la modificacion";
    echo("<script>location.href = '../cuentaCliente.php?msg=".$mensaje."';</script>");
}
?>



