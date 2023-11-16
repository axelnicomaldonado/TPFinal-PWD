<?php
include_once('../../configuracion.php');

$obj = new Session();

$resp = $obj->validar();
if($resp) {
    $listRol = $obj->getRol();
    $i = 0;
    while ($listRol[$i]->getobjusuario()->getidusuario() != $_SESSION["idusuario"]) {
        $i++;
    }
    $archivoIncluir = [ 1 => "../estructura/estCliente/headerCliente.php",];
    if($listRol[$i]->getobjusuario()->getidusuario() == 1 || $listRol[$i]->getobjusuario()->getidusuario() == 4){
        $hrefBotonComprar = '../home/index.php'; //A COMPROBAR SI FUNCIONA
        include_once($archivoIncluir[$listRol[$i]->getobjusuario()->getidusuario()]);
    }
    else{
        $mensaje ="Error, acceso solo para cliente o publico. Inicie sesion como cliente para continuar";
        echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
    }
} else {
    $hrefBotonComprar = '../login/login.php';
    include_once("../estructura/estPublico/headerPublico.php");
}


$productosCarrito = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$producto = new AbmProducto;

$listaCarrito = [];
if ($productosCarrito != null) {
    foreach ($productosCarrito as $id => $cantidad) {

        $params['idProducto'] = $id;
        $productoObj = $producto->buscar($params);

        $productoObj['cantidad'] = $cantidad;
        array_push($listaCarrito, $productoObj);
    }
}
/*echo 'separacionnnn';
var_dump($listaCarrito);

*/
//session_destroy();

?>

<div class="carritoContainer">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
            </thead>
            <tbody>
                <?php
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
                            <div id="subtotal_<?php echo $idProducto; ?>" name="subtotal[]">
    $<?php echo number_format($subTotal, 2, '.', ','); ?>
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
        </table>
    </div>

<div class="row">
    <div class="col-md-5 offset-md-7 d-grid gap-2">
        <a href=<?php echo $hrefBotonComprar  ?> class="btn btn-outline-success btn-lg">Comprar</a>
    </div>
</div>

</div>


<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>¿Desea eliminar el producto de la lista?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-elimina" type="button" class="btn btn-danger" onclick="elimina()">Eliminar</button>
      </div>
    </div>
  </div>
</div>