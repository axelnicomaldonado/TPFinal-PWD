<?php

include_once "../../configuracion.php";
$abmProducto = new AbmProducto;

$datos = data_submitted();

if($abmProducto->baja($datos)){
    unlink('../imagenes/productos/' . $datos['idProducto'] . '.png');
    ?>
        <p style="text-align: center; color: green">El producto se elimino correctamente</p>
    <?php
} else {
    ?>
        <p style='color: red; text-align: center; '>Se ha producido un error</p>
    <?php
}