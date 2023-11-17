<?php
include_once("../../configuracion.php");
$titulo = 'Productos';
$producto = new AbmProducto;
$productos = $producto->buscar(null);
$href = '../productos/producto.php';

$obj = new Session();
$objUserRol = new AbmUsuarioRol();
$resp = $obj->validar();
$listRol = $obj->getRol();
if($resp) {
    if($listRol[0]->getobjrol()->getIdRol() == 1){
        include_once("../estructura/estCliente/headerCliente.php");
    }
    else{
        $mensaje ="Error, acceso solo Admin. Inicie sesion como admin para continuar";
        echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
    }
} else {
    include_once("../estructura/estPublico/headerPublico.php");
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

<?php
?>