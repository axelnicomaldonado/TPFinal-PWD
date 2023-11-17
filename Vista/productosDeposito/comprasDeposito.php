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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

            
            foreach ($listadoCompra as $compra) {
                $stringProductosCompra = '';
                $total = 0;
                foreach($listadoCompraItem as $compraItem){
                    if($compraItem->getObjCompra()->getIdCompra() == $compra->getIdCompra()){
                        foreach($listadoProducto as $producto){
                            if($compraItem->getObjProducto()->getIdProducto() == $producto->getIdProducto()){
                                $total = $total + $producto->getProPrecio() * $compraItem->getCiCantidad();

                                $stringProductosCompra = $stringProductosCompra . $producto->getProNombre() . 
                                " x" . $compraItem->getCiCantidad() . "\n";
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
                        $ceFechaIni = $ceFechaIni . $compraEstado->getCeFechaIni() . "<br/>";
                        $ceFechaFin = $ceFechaFin . $compraEstado->getCeFechaFin() . "<br/>";
                        $estadoTipo = $compraEstado->getObjCompraEstadoTipo()->getCetDescripcion();
                    }
                }

                echo $ceFechaIni . "</td>";
                echo "<td>" . $ceFechaFin . "</td>";
                echo "<td>";
                echo '<button type="button" class="btn btn-primary" onclick=" return abrirModalProductos(`' . $stringProductosCompra . '`)"> Ver producto</button>';
                echo "</td>";
                echo "<td>" . $estadoTipo . "</td>";
                echo "</tr>";

            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";



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

        <script>
        function abrirModalProductos(string){
            Swal.fire(string);
        }

        </script>

        <div class="editarCompras">
            <h2 class="mb-4">Editar compras</h2>
            <form method="get" action="../accion/accionEditarCompra.php">
                <div class="mb-1">
                    <label class="form-label" for="idCompra">Id de compra:</label>
                    <br/>
                    <input class="form-control" type="number" id="idCompra" name="idCompra" required/>
                    <br/>
                </div>
                <label class="form-label" for="idCompraEstadoTipo">Estado:</label>
                <select required name="idCompraEstadoTipo" id="idCompraEstadoTipo">
                    <option value="1"> Iniciada </option>
                    <option value="2"> Aceptada </option>
                    <option value="3"> Enviada </option>
                    <option value="4"> Cancelada </option>
                </select>
                <input type="submit" class="btn btn-primary" value="enviar"/>
            </form>
        </div>
        
    </body>
</html>