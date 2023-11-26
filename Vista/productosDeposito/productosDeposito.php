<?php
$titulo = "Productos";
include_once '../../configuracion.php';
include_once '../estructura/headerSeguro.php';

$abmProducto = new AbmProducto;
$productos = array();
$productos = $abmProducto->buscar(null);

$datos = data_submitted();
?>

<html>

    <head>
    <link href="../css/deposito.css" rel="stylesheet">
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap/bootstrap.bundle.min.js">
  </script>
    </head>

<body>
    <div class="agregarEditarProducto">
        <div class="col-md-6">
        <h2 class="mb-4">Agregar/Editar producto</h2>
            <form method="post" action="../accion/accionAgregarEditarProducto.php" enctype="multipart/form-data">
                <div class="mb-1">
                    <label class="form-label" for="idProducto">Id para editar:</label>
                    <br/>
                    <input class="form-control" type="text" id="idProducto" name="idProducto"/>
                    <br/>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="proNombre">Nombre:</label>
                    <br/>
                    <input class="form-control" required type="text" id="proNombre" name="proNombre"/>
                    <br/>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="proDetalle">detalle:</label>
                    <br/>
                    <input class="form-control" required type="text" id="proDetalle" name="proDetalle"/>
                    <br/>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="proCantStock">Stock:</label>
                    <br/>
                    <input class="form-control" required type="number" id="proCantStock" name="proCantStock"/>
                    <br/>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="proPrecio">Precio:</label>
                    <br/>
                    <input step="0.01" class="form-control" required type="number" id="proPrecio" name="proPrecio"/>
                    <br/>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="foto">Foto:</label>
                    <br/>
                    <input class="form-control" id="foto" name="foto" required type="file" accept="image/png"/>
                    <br/>
                </div>
                <input type="submit" class="btn btn-primary" value="enviar"/>
            </form>
        </div>
    </div>

    <br/>
    <div class="eliminarProductos">
        <div class="col-md-6">
            <h2 class="mb-4">Eliminar producto</h2>
            <form method="get" action="../accion/accionEliminarProducto.php">
                <label class="form-label" for="idProducto">Id del producto:</label>
                <br/>
                <input required class="form-control" type="number" id="idProducto" name="idProducto"/>
                <br/>
                <input type="submit" class="btn btn-primary" value="enviar"/>
            </form>
        </div>
    </div>

    <div class="verProductos">
        <h2> Productos </h2>
            <?php

                if (count($productos) > 0) {
                    foreach ($productos as $producto) {
                        if($producto->getProDeshabilitado() == null || $producto->getProDeshabilitado() == '0000-00-00 00:00:00'){
                            echo "<div onclick='rellenar(" . $producto->getIdProducto() . ", `" . $producto->getProNombre() . "`, `" . 
                            $producto->getProDetalle() . "`, " . $producto->getProCantStock() . ", " . $producto->getProPrecio() . 
                            ")' class='producto'>";
                            echo "<p>" . $producto->getProNombre() . "</p>";
                            echo "<img width='250' height='150' src='../imagenes/productos/" . $producto->getIdProducto() . ".png' />";
                            echo '<br/>';
                            echo "$" . $producto->getProPrecio();
                            echo "<br/>";
                            echo "<p>" . $producto->getProCantStock() . " unidades <br/>";
                            echo "id: " . $producto->getIdProducto() . "</P>";
                            echo "</div>";
                        }
                    }
                } else{
                    echo "<h4>No hay productos cargados</h4>";
                }

                

            ?>
        
    </div>

<script>

    function rellenar(id, nombre, detalle, stock, precio){

        idProducto = document.getElementById('idProducto')
        proNombre = document.getElementById('proNombre')
        proDetalle = document.getElementById('proDetalle')
        proCantStock = document.getElementById('proCantStock')
        proPrecio = document.getElementById('proPrecio')
        foto = document.getElementById('foto')

        idProducto.value = id
        proNombre.value = nombre
        proDetalle.value = detalle
        proCantStock.value = stock
        proPrecio.value = precio
    }
    
</script>

    </body>
</html>

