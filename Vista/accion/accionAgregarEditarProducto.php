<?php

include_once "../../configuracion.php";
$abmProducto = new AbmProducto;
$datos = data_submitted();

if ($_POST['idProducto']){
    $dir = '../imagenes/productos/' . $_POST['idProducto'];

    if ($abmProducto->modificacion($datos)) {
        copy($_FILES["foto"]["tmp_name"], $dir . "/" . $_FILES["foto"]["name"])
        

        ?>
            <h2 style="text-align: center; color: green">Los datos fueron actualizados correctamente.</h2>
        <?php
        } else {
        ?>
            <h2 style='color: red; text-align: center; '>No se realizaron cambios debido a un error</h2>
        
        <?php
    }

} else {
    $resp = $abmProducto->alta($datos);
    if($resp != false){
        $dir = '../imagenes/productos/';
        copy($_FILES["foto"]["tmp_name"], $dir . $resp . '.png');
        ?>
            <h2 style="text-align: center; color: green">Se ha ingresado el producto correctamente.</h2>
        <?php
    } else{
        
        ?>
            <h2 style='color: red; text-align: center; '>No se ha ingresado el producto debido a un error</h2>
        <?php
    }

}

// echo print_r($_POST);
//Array ( [nombre] => asaa [detalle] => aaaa [stock] => 20 ) 1