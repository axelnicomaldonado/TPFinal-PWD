<?php

include_once "../../configuracion.php";
include_once '../estructura/estDeposito/headerDeposito.php';
$abmProducto = new AbmProducto;
$datos = data_submitted();
$date = getdate();

$producto = $abmProducto->buscar($datos);
$param['idProducto'] = $producto[0]->getIdProducto();
$param['proNombre'] = $producto[0]->getProNombre();
$param['proDetalle'] = $producto[0]->getProDetalle();
$param['proCantStock'] = $producto[0]->getProCantStock();
$param['proPrecio'] = $producto[0]->getProPrecio();
$param['proDeshabilitado'] = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] .
':' . $date['seconds'];

if($abmProducto->modificacion($param)){
    unlink('../imagenes/productos/' . $datos['idProducto'] . '.png');
    ?>
        <h2 style="text-align: center; color: green">El producto se elimino correctamente</h2>
    <?php
} else {
    ?>
        <h2 style='color: red; text-align: center; '>Se ha producido un error</h2>
    <?php
}