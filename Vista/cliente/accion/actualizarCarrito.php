<?php
require_once '../../../configuracion.php';

/*error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inicializar sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}*/



$obj = new Session();

if (!isset($_SESSION['carrito']['productos'])) {
    $_SESSION['carrito']['productos'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if ($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;

        // Verifica el valor actual antes de agregar
        $productosActuales = isset($_SESSION['carrito']['productos'][$id]) ? $_SESSION['carrito']['productos'][$id] : 0;

        // Agrega productos
        $_SESSION['carrito']['productos'][$id] = $cantidad;

        $producto = new AbmProducto();
        $param['idProducto'] = $id;
        $datosProducto = $producto->buscar($param);
        $precio = $datosProducto[0]->getProPrecio();

        $res = $cantidad * $precio;

        $datos['ok'] = true;
        $datos['sub'] = '$' . number_format($res, 2, '.', ',');
    } else if($action == 'eliminar') {
        $datos['ok'] = eliminar($id);
        

    } else {
        $datos['ok'] = false;
    }

    echo json_encode($datos);
    exit;
}

function agregar($id, $cantidad) {
    $res = 0;

    if ($id > 0 && $cantidad > 0 && is_numeric($cantidad)) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            // Sumar la cantidad existente en lugar de asignarla directamente
            $_SESSION['carrito']['productos'][$id] = $cantidad;

            $producto = new AbmProducto();
            $param['idProducto'] = $id;
            $datosProducto = $producto->buscar($param);
            $precio = $datosProducto[0]->getProPrecio();

            $res = $_SESSION['carrito']['productos'][$id] * $precio;

            return $res;
        } else {
            // Si no existe, inicializa la cantidad
            $_SESSION['carrito']['productos'][$id] = $cantidad;
        }
    } else {
        return $res;
    }
}

function eliminar($id){
    $respuesta = false;
    if($id >0) {
        if (isset($_SESSION['carrito']['productos'][$id])){
            unset($_SESSION['carrito']['productos'][$id]);
            $_SESSION['numero'] -= 1;
            $respuesta = true;
        } 
       
    } 
    return $respuesta;
 }

?>



