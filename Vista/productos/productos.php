<?php
include_once("../../configuracion.php");

$producto = new AbmProducto;
$productos = $producto->buscar(null);
$href = '../productos/producto.php';

?>



<div class="container" style="padding-top: 4em;">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach($productos as $producto) { ?>
            <div class="col cardContainer mx-auto">
                <div class="card shadow-sm cardProducto">
                    <?php 
                    $id = $producto->getIdProducto();
                    $imagen = "../imagenes/productos/$id/principal.jpeg";
                    if(!file_exists($imagen)){
                        $imagen = "../imagenes/default.jpg";
                    } ?>
                    <div class="imgContainer">
                    <img src="<?php echo $imagen ?>" class="card-img-top imgProducto" alt="Producto Image">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="titlePrice">
                                <h5 class="card-title"> <?php echo $producto->getProNombre()?></h5>
                                <p class="card-text"> $<?php echo number_format($producto->getProPrecio(), 2, ',', '.')?> </p>
                            </div>
                            <div class="btn-group">
                                <img src="../imagenes/agregarcarrito.png" class="agregarCarrito">
                            </div>

                        </div>
                        <div class="botonDescripcion">
                                <a href="<?php echo $href ?>?idProducto=<?php echo $id; ?>&token=<?php echo hash_hmac('sha1',$id, KEY_TOKEN);?>" class="boton">Detalles</a>
                            </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
