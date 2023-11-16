<?php

include_once "../../configuracion.php";
$abmProducto = new AbmProducto;

$datos = data_submitted();

if ($_POST['idProducto']){

    if ($abmProducto->modificacion($datos)) {
        ?>
            <p style="text-align: center; color: green">Los datos fueron actualizados correctamente.</p>
        <?php
        } else {
        ?>
            <p style='color: red; text-align: center; '>No se realizaron cambios debido a un error</p>
        
        <?php
    }

} else {
    if($abmProducto->alta($datos)){
        ?>
            <p style="text-align: center; color: green">Se ha ingresado el producto correctamente.</p>
        <?php
    } else{
        ?>
            <p style='color: red; text-align: center; '>No se realizaron cambios debido a un error</p>
        <?php
    }

}

// echo print_r($_POST);
//Array ( [nombre] => asaa [detalle] => aaaa [stock] => 20 ) 1