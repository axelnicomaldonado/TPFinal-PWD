<?php
include_once("../../configuracion.php");
$titulo = 'Productos';
$producto = new AbmProducto;
$productos = $producto->buscar(null);
$href = '../productos/producto.php';
$session = new Session();
$resp = $session->validar();
if ($resp) {
    include_once '../estructura/navbar.php';

} else {
    include_once("../estructura/headerInseguro.php");
}




?>

<div class="container" style="padding-top: 4em;">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach($productos as $objProducto) { ?>
            <div class="col cardContainer mx-auto">
                <div class="card shadow-sm cardProducto">
                    <?php 
                    $id = $objProducto->getIdProducto();
                    $imagen = "../imagenes/productos/$id.png";
                    if(!file_exists($imagen)){
                        $imagen = "../imagenes/default.jpg";
                    } ?>
                    <div class="imgContainer">
                    <img src="<?php echo $imagen ?>" class="card-img-top imgProducto" alt="Producto Image">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="titlePrice">
                                <h5 class="card-title"> <?php echo $objProducto->getProNombre()?></h5>
                                <p class="card-text"> $<?php echo number_format($objProducto->getProPrecio(), 2, ',', '.')?> </p>
                            </div>
                            <div class="btn-group">
                                <img src="../imagenes/agregarcarrito.png" class="agregarCarrito" onclick="agregarProducto(<?php echo $id ?>, '<?php echo hash_hmac('sha1',$id, KEY_TOKEN);?>')">
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

<div id="stockInsuficienteModal" class="modal fade" tabindex="-1" aria-labelledby="stockInsuficienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockInsuficienteModalLabel">Stock Insuficiente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                El stock disponible es insuficiente para agregar más unidades.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php
?>