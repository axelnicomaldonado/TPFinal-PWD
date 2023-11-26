<?php

include_once "../../configuracion.php";
include_once '../estructura/headerSeguro.php';
$abmCompraEstado = new AbmCompraEstado;
$abmCompraItem = new AbmCompraItem;
$abmProducto = new AbmProducto;
$datos = data_submitted();
$listaCompraEstado = $abmCompraEstado->buscar(null);
$listaCompraItem = $abmCompraItem->buscar(null);
$listaProducto = $abmProducto->buscar(null);
$indice;
$fechaIniActual = '';
$fechaFinAnterior = '';
$idCompraEstadoTipoAnterior = '';
$ceFechaIni = '';
$ceFechaFin = '';
$arreglo = [];
$arregloAnterior = [];

// Estado anterior
if($listaCompraEstado){
    foreach($listaCompraEstado as $compraEstado){
        if($datos['idCompra'] == $compraEstado->getObjCompra()->getIdCompra()){
            $indice = $compraEstado->getIdCompraEstado();
            $ceFechaIni = $compraEstado->getCeFechaIni();
            $ceFechaFin = $compraEstado->getCeFechaFin();
            $idCompraEstadoTipoAnterior = $compraEstado->getObjCompraEstadoTipo()->getIdCompraEstadoTipo();
        }
    }
}

if($datos['idCompraEstadoTipo'] > $idCompraEstadoTipoAnterior){

$arreglo['idCompra'] = $datos['idCompra'];
$arreglo['idCompraEstado'] = $indice + 1;
$arreglo['idCompraEstadoTipo'] = $datos['idCompraEstadoTipo'];

$arregloAnterior['idCompra'] = $datos['idCompra'];
$arregloAnterior['idCompraEstado'] = $indice;
$arregloAnterior['idCompraEstadoTipo'] = $idCompraEstadoTipoAnterior;

$date = getdate();
if($datos['idCompraEstadoTipo'] != 4){
    $fechaIniActual = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] .
    ':' . $date['seconds'];
    $arreglo['ceFechaIni'] = $fechaIniActual;
    $arreglo['ceFechaFin'] = '0000-00-00 00:00:00';
    $fechaFinAnterior = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] .
    ':' . $date['seconds'];
    $arregloAnterior['ceFechaFin'] = $fechaFinAnterior;
    $arregloAnterior['ceFechaIni'] = $ceFechaIni;
} else{ //le falta
    $fechaFinAnterior = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] .
    ':' . $date['seconds'];
    $arregloAnterior['ceFechaIni'] = $ceFechaIni;
    $arregloAnterior['ceFechaFin'] = $fechaFinAnterior;
    $arreglo['ceFechaIni'] = $fechaFinAnterior;
    $arreglo['ceFechaFin'] = $fechaFinAnterior;
}


if($abmCompraEstado->modificacion($arregloAnterior)){
    $respMod = false;
    if($abmCompraEstado->alta($arreglo)){

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
                                if($producto->getProCantStock() - $compraItem->getCiCantidad() >= 1){
                                    $arregloProducto['proCantStock'] = $producto->getProCantStock() - $compraItem->getCiCantidad();
                                } else{
                                    $arregloProducto['proCantStock'] = 0;
                                }
                                $arregloProducto['proPrecio'] = $producto->getProPrecio();
                                $arregloProducto['proDeshabilitado'] = $producto->getProDeshabilitado();
                                $respMod = $abmProducto->modificacion($arregloProducto);
                            }
                        }
                    }
                }
            }
    
            if($respMod){
    
                ?>
                    <h2 style="text-align: center; color: green">Los datos fueron actualizados correctamente, el stock se modifico.</h2>
                <?php
        
            } else {
        
            ?>
                    <h2 style="text-align: center; color: yellow">el Compra estado se modifico pero el stock no se modifico.</h2>
                <?php
            }
            } elseif($datos['idCompraEstadoTipo'] == 4 && $idCompraEstadoTipoAnterior == 3){

                $arregloProducto = [];
                if($listaCompraItem){
                    foreach($listaCompraItem as $compraItem){
                        if($datos['idCompra'] == $compraItem->getObjCompra()->getIdCompra()){
                            foreach($listaProducto as $producto){
                                if($producto->getIdProducto() == $compraItem->getObjProducto()->getIdProducto()){
                                    $arregloProducto['idProducto'] = $producto->getIdProducto();
                                    $arregloProducto['proNombre'] = $producto->getProNombre();
                                    $arregloProducto['proDetalle'] = $producto->getProDetalle();
                                    $arregloProducto['proCantStock'] = $producto->getProCantStock() + $compraItem->getCiCantidad();
                                    $arregloProducto['proPrecio'] = $producto->getProPrecio();
                                    $arregloProducto['proDeshabilitado'] = $producto->getProDeshabilitado();
                                    $respMod = $abmProducto->modificacion($arregloProducto);
                                }
                            }
                        }
                    }
                }
                if($respMod){
    
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
} else{
    ?>
            <h2 style='color: red; text-align: center; '>No se pudo modificar la fecha anterior</h2>
        
        <?php
}

} else{
    ?>
            <h2 style='color: red; text-align: center; '>El estado de compra debe ser superior al actual</h2>
        
        <?php
}



// Array ( [idCompra] => 1 [estado] => 2 )