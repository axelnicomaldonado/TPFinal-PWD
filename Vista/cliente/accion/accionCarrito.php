<?php
require_once '../../../configuracion.php';

if (isset($_POST['id'])) {
    $_SESSION['numero'] = 0;

    $id = $_POST['id'];
    $token = $_POST['token'];
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp) {

        $obj = new Session();

        // Obtener el producto y su cantidad actual en el carrito
        $cantidadEnCarrito = isset($_SESSION['carrito']['productos'][$id]) ? $_SESSION['carrito']['productos'][$id] : 0;
        
        // Obtener la cantidad en stock del producto
        $producto = new AbmProducto();
        $param['idProducto'] = $id;
        $productoObj = $producto->buscar($param);

        if ($productoObj) {
            $stockDisponible = $productoObj[0]->getProCantStock();

            // Verificar si hay suficiente stock para agregar más al carrito
            if ($cantidadEnCarrito < $stockDisponible) {
                $_SESSION['carrito']['productos'][$id] = $cantidadEnCarrito + 1;

                $datos['numero'] = count($_SESSION['carrito']['productos']);
                $_SESSION['numero'] = count($_SESSION['carrito']['productos']);
                $datos['ok'] = true;
            } else {
                $datos['ok'] = false;
                $datos['error'] = "No hay suficiente stock disponible.";
            }
        } else {
            $datos['ok'] = false;
            $datos['error'] = "No se pudo obtener información del producto.";
        }
    } else {
        $datos['ok'] = false;
        $datos['error'] = "Token no válido.";
    }
} else {
    $datos['ok'] = false;
    $datos['error'] = "ID no proporcionado.";
}

echo json_encode($datos);