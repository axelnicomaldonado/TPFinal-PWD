<?php
$titulo = "Inicio";
include_once("../../configuracion.php");
include_once("../estructura/headerInseguro.php");
$obj = new Session();
$resp = $obj->validar();
if ($resp) {
    include_once '../estructura/navbar.php';
}

?>



<?php
include_once("../productos/productos.php");
?>
