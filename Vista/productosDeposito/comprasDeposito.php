<?php

include_once '../../util/funciones.php';
include_once '../../configuracion.php';
include_once '../estructura/estDeposito/headerDeposito.php';

$abmProducto = new AbmProducto;
$abmCompra = new AbmCompra;
$abmCompraItem = new AbmCompraItem;
$abmCompraEstado = new AbmCompraEstado;
$abmCompraEstadoTipo = new AbmCompraEstadoTipo;

$listadoProducto = $abmProducto->buscar(null);
$listadoCompra = $abmCompra->buscar(null);
$listadoCompraItem = $abmCompraItem->buscar(null);
$listadoCompraEstado = $abmCompraEstado->buscar(null);
$listadoCompraEstadoTipo = $abmCompraEstadoTipo->buscar(null);

?>

<html>
    <head>
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <div class="listaCompras">
            <h2 class="mb-4">Lista de compras</h2>
            <table class="table  m-auto">
                <thead class="table-dark fw-bold">
                    <tr>
                        <th scope="col">IdCompra</th>
                        <th scope="col">Fecha de la compra</th>
                        <th scope="col">Nombre del usuario</th>
                        <th scope="col">Precio Total</th>
                        <th scope="col">Inicio de transaccion</th>
                        <th scope="col">Fin de transaccion</th>
                        <th scope="col">Productos</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
            <?php

            $arregloProductosCompra = [];
            foreach ($listadoCompra as $compra) {
                $total = 0;
                foreach($listadoCompraItem as $compraItem){
                    if($compraItem->getObjCompra()->getIdCompra() == $compra->getIdCompra()){
                        foreach($listadoProducto as $producto){
                            if($compraItem->getObjProducto()->getIdProducto() == $producto->getIdProducto()){
                                $total = $total + $producto->getProPrecio() * $compraItem->getCiCantidad();

                                $indice = count($arregloProductosCompra);
                                $arregloProductosCompra[$indice]['producto'] = $producto->getProNombre();
                                $arregloProductosCompra[$indice]['cantidad'] = $compraItem->getCiCantidad();
                            }
                        }
                    }
                }

                echo "<tr>";
                echo "<td>" . $compra->getIdCompra() . "</td>";
                echo "<td>" . $compra->getCoFecha() . "</td>";
                echo "<td>" . $compra->getObjUsuario()->getUsNombre() . "</td>";
                echo "<td>" . $total . "</td>";
                echo "<td>";

                $ceFechaIni = '';
                $ceFechaFin = '';
                $estadoTipo = '';
                foreach($listadoCompraEstado as $compraEstado){ // cambiar por while (todos los foreach)
                    if($compraEstado->getObjCompra()->getIdCompra() == $compra->getIdCompra()){
                        $ceFechaIni = $compraEstado->getCeFechaIni();
                        $ceFechaFin = $compraEstado->getCeFechaFin();
                        $estadoTipo = $compraEstado->getObjCompraEstadoTipo()->getCetDescripcion();
                    }
                }

                echo $ceFechaIni . "</td>";
                echo "<td>" . $ceFechaFin . "</td>";
                echo "<td>";
                echo "<button class='btn btn-primary' onclick='abrirModalProductos(" . $arregloProductosCompra . ")";
                echo "</td>";
                echo "<td>" . $estadoTipo . "</td>";



            }

            //function abrirModalProductos(){



            //}

            //////////////////////EDITAR COMPRA////////////////////////////

            //<form method='get' action='../accion/editarCompra.php'>";
            //    echo "<select name='estado' id='" . $compra->getIdCompra() . "'>";
            //    foreach($listadoCompraEstadoTipo as $compraEstadoTipo){
            //        echo "<option value=" . $compraEstadoTipo->getIdCompraEstadoTipo() . "'> " . 
            //        $compraEstadoTipo->getCetDescripcion() . "</option>";
            //    }
            //    echo "</select>";
            //    echo "<input type='submit' value='guardar' class='mx-1 btn btn-primary'/>";
            ?>
        </div>


    </body>
</html>