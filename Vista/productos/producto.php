<?php

$titulo = 'Detalle del producto';
include_once("../../configuracion.php");

$obj = new Session();
$objUserRol = new AbmUsuarioRol();
$resp = $obj->validar();
include_once("../estructura/headerInseguro.php");



$datos = data_submitted($_GET);


$id = isset($datos['idProducto']) ? $datos['idProducto'] : '';
$token = isset($datos['token']) ? $datos['token'] : '';

if ($id == '' || $token == '') {
    echo 'Error al procesar la petición';
    exit;
} else {

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp) {

        $producto = new AbmProducto();
        $parametros = ['idProducto' => $datos['idProducto']];
        $datosProducto = $producto->buscar($parametros);

        if (!empty($datosProducto)) {
            $nombre = $datosProducto[0]->getProNombre();
            $idProducto = $datosProducto[0]->getIdProducto();
            $precio = $datosProducto[0]->getProPrecio();
            $detalle = $datosProducto[0]->getProDetalle();
            $stock = $datosProducto[0]->getProCantStock();
            $dirImages = '../imagenes/productos/' . $idProducto . '/';
            $imgPrincipal = $dirImages . 'principal.jpeg';

            if (!file_exists($imgPrincipal)) {
                $imgPrincipal = '../imagenes/default.jpg';
            }
        }
    } else {
        echo 'Error al procesar la petición';
        exit;
    }
}


?>

<main>
    <div class="containerDetalle">
        <div class="row">
            <div class="col-md-6 order-md-1">
                <img class="imgDetalle" src="<?php echo $imgPrincipal ?>">
            </div>

            <div class="col-md-6 order-md-2">
                <h2 class="titleDetalle"><?php echo $nombre ?></h2>
                <p class="detalleText"> <?php echo $detalle ?></p>
                <h3 class="precioDetalle">$<?php echo number_format($precio, 2, ',', '.'); ?> </h3>
                <div class="d-grid gap-3 col-10 mx-auto botones">
                    <button class="btn btn-dark" type="button">Comprar ahora</button>
                    <button class="btn btn-outline-dark" type="button" onclick="agregarProducto(<?php echo $id ?>, '<?php echo $token_tmp ?>')">Agregar al carrito</button>
                </div>
            </div>




        </div>
    </div>
</main>