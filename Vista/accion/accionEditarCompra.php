<?php

include_once "../../configuracion.php";
$abmCompraEstado = new AbmCompraEstado;
$abmCompraItem = new AbmCompraItem;
$abmProducto = new AbmProducto;
$datos = data_submitted();
$listaCompraEstado = $abmCompraEstado->buscar(null);
$listaCompraItem = $abmCompraItem->buscar(null);
$listaProducto = $abmProducto->buscar(null);
$indice;
$ceFechaIni = '';
$ceFechaFin = '';
$arreglo = [];

if($listaCompraEstado){
    foreach($listaCompraEstado as $compraEstado){
        if($datos['idCompra'] == $compraEstado->getObjCompra()->getIdCompra()){
            $indice = $compraEstado->getIdCompraEstado();
            $ceFechaIni = $compraEstado->getCeFechaIni();
            $ceFechaFin = $compraEstado->getCeFechaFin();
        }
    }
}

$arreglo['ceFechaIni'] = $ceFechaIni;
$arreglo['ceFechaFin'] = $ceFechaFin;
$arreglo['idCompra'] = $datos['idCompra'];
$arreglo['idCompraEstado'] = $indice;
$arreglo['idCompraEstadoTipo'] = $datos['idCompraEstadoTipo'];



if($abmCompraEstado->modificacion($arreglo)){

    if($datos['idCompraEstadoTipo'] == 3){
        $arregloProducto = [];
        if($listaCompraItem){
            foreach($listaCompraItem as $compraItem){
                if($datos['idCompra'] == $compraItem->getObjCompra()->getIdCompra()){
                    foreach($listaProducto as $producto){
                        if($producto->getIdProducto() == $compraItem->getObjProducto()->getIdProducto()){
                            $arregloProducto['idProducto'] = $producto->getIdProducto();
                            $arregloProducto['proNombre'] = $producto->getProNombre();
                            $arregloProducto['proDetalle'] = $producto->getProDetalle();
                            if($producto->getProCantStock() - $compraItem->getCiCantidad() <= 0){
                                $arregloProducto['proCantStock'] = $producto->getProCantStock() - $compraItem->getCiCantidad();
                            } else{
                                $arregloProducto['proCantStock'] = 0;
                            }
                            $arregloProducto['proPrecio'] = $producto->getProPrecio();
                        }
                    }
                }
            }
        }

        if($abmProducto->modificacion($arregloProducto)){

            ?>
                <h2 style="text-align: center; color: green">Los datos fueron actualizados correctamente, el stock se modifico.</h2>
            <?php
    
        } else {
    
        ?>
                <h2 style="text-align: center; color: yellow">el Compra estado se modifico pero el stock no se modifico.</h2>
            <?php
        }
    } else {
        ?>
                <h2 style="text-align: center; color: green">Los datos fueron actualizados correctamente.</h2>
            <?php
    }
    
} else {
    ?>
        <h2 style='color: red; text-align: center; '>No se realizaron cambios debido a un error</h2>
    
    <?php
}

// Array ( [idCompra] => 1 [estado] => 2 )