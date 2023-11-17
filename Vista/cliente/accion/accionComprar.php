<?php

require_once '../../../configuracion.php';

$compra = new AbmCompra();
$producto = new AbmProducto();
$sesion = new Session();
$compraitem = new AbmCompraItem();


/*$datos['idusuario'] = $_SESSION['idusuario'];
$res = $compra->alta($datos);

if($id > 0){
    $res = $compra->alta($datos);

}
*/



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action == 'comprar') {

        $datos['idUsuario'] = $_SESSION['idusuario'];
        $usuario = new AbmUsuario();
        $objUsuario = $usuario->buscar($datos);
       // var_dump($objUsuario);
        $datos['objUsuario'] = $objUsuario[0];


        $datos['idProducto'] = $_SESSION['carrito']['productos'];
        $compra->alta($datos);

       /* $arrayCompras = $compra->buscar(null);
        $objUltCompra = end($arrayCompras);


        $idCompra = $objUltCompra->getIdCompra();
*/



        $productosCarrito = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

        $productosCompra = [];
        if ($productosCarrito != null) {
            foreach ($productosCarrito as $id => $cantidad) {
                //var_dump($datos);
                /*$producto = new AbmProducto($id);
                    $objProducto = $producto->buscar($datos);
                    $datos['producto'] = $objProducto[0];

*/  
                $compra = new AbmCompra();
                $arrayCompras = $compra->buscar(null);
                $objUltCompra = end($arrayCompras);




                $idCompra = $objUltCompra->getIdCompra();
                $datos['idCompra'] = $idCompra;



                $datos['idproducto'] = $id;
                $datos['idProducto'] = $id;
                $producto = new AbmProducto();
                $objetoActual = $producto->buscar($datos);
                $datos['objProducto'] = $objetoActual[0];
                $param['idProducto'] = $id;
                //echo 'Valor de idproducto: ' . $param['idproducto'];

                //var_dump($_SESSION['carrito']['productos']);
               /* $datosProducto = $producto->buscar($param);
                echo 'JKSAFJKASJKFJKASF';
                //var_dump($datosProducto); //HASTA ACA LLEGA SIN ROMPERSE
                $datos['objProducto'] = $datosProducto;   NO TENGO Q ENVIAR DATOS PRODUCTO, TENGO Q ENVIAR EL*/ 


                $compra = new AbmCompra($id);
                $objCompra = $usuario->buscar($datos);
                $datos['objCompra'] = $objCompra[0];


                $datos['ciCantidad'] = $_SESSION['carrito']['productos'][$id];
                


                array_push($productosCompra, $datos);

                $compraitem->alta($datos);
                $datos['ok'] = true;
            }
        }

        

        $compraEstadoTipo = new AbmCompraEstadoTipo();
        $tiposEstado = $compraEstadoTipo->buscar(null);
        $datos['idCompraEstadoTipo'] = $tiposEstado[0]->getIdCompraEstadoTipo();
        var_dump($tiposEstado[0]);
        $compraEstado = new AbmCompraEstado();

        $compraEstado->alta($datos);

        unset($_SESSION['carrito']);
        unset($_SESSION['numero']);



        $datos['ok'] = true;
    } else {
        $datos['ok'] = false;
    }

    echo json_encode($datos);
    exit;
}



/*$listaCarrito = [];
if ($productosCarrito != null) {
    foreach ($productosCarrito as $id => $cantidad) {

        $params['idProducto'] = $id;
        $productoObj = $producto->buscar($params);

        $productoObj['cantidad'] = $cantidad;
        array_push($listaCarrito, $productoObj);
    }
}  else {
    header("Location: ../../home/index.php");
    exit;
}



// PARA TRAER TODOS LOS DATOS NECESARIOS


if ($listaCarrito == null) {
    echo '<tr><td colspan="5" class="text-center"><b>Lista vacía</b></td></tr>';
} else {
    $total = 0;
    $i = 0;
    foreach ($listaCarrito as $productoItem) {
        $idProducto = $productoItem[0]->getIdProducto();
        $nombre = $productoItem[0]->getProNombre();
        $detalle = $productoItem[0]->getProDetalle();
        $cantStock = $productoItem[0]->getProCantStock();
        $imagenProducto = "../imagenes/productos/$idProducto/principal.jpeg";
        if(!file_exists($imagenProducto)){
            $imagenProducto = "../imagenes/default.jpg";
        } 
        $cantidad = $productoItem['cantidad'];
        $precio = $productoItem[0]->getProPrecio();
        $subTotal = $cantidad * $precio;
        $total += $subTotal;
?>


        <tr>
            <td><img  class="imgCarrito" src="<?php echo $imagenProducto ?>"><?php echo $nombre ?></td>
            <td>$<?php echo number_format($precio, 2, '.', ','); ?></td>
            <td>
            <input type="number" min="1" max="<?php echo $cantStock ?>" step="1" value="<?php echo $_SESSION['carrito']['productos'][$idProducto] ?>" size="5" id="cantidad_<?php echo $idProducto ?>" onchange="actualizaCantidad(this.value, <?php echo $idProducto ?>)">
            </td>
            <td>
            <div id="subtotal_<?php echo $idProducto; ?>" name="subtotal[]">$<?php echo number_format($subTotal, 2, '.', ','); ?>
</div>
            </td>
            <td>
                <a href="#" id="eliminar" class="btn btn-outline-danger btn-sm" data-bs-id="<?php echo $idProducto ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
            </td>


        </tr>
    <?php } ?>

    <tr>
        <td colspan="2"></td>
        <td colspan="2">
            <p class="h4" id="total">Total: $<?php echo number_format($total, 2, '.', ',');?></p>
        </td>
    </tr>

</tbody>
<?php } ?>
*/
