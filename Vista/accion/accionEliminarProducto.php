<?php

include_once "../../configuracion.php";
$abmProducto = new AbmProducto;

$datos = data_submitted();
echo print_r($datos);

if($abmProducto->baja($datos)){
    ?>
        <p style="text-align: center; color: green">El producto se elimino correctamente</p>
    <?php
} else {
    ?>
        <p style='color: red; text-align: center; '>Se ha producido un error</p>
    <?php
}