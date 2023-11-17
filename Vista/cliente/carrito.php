<?php
include_once('../../configuracion.php');



$obj = new Session();
$objUserRol = new AbmUsuarioRol();
$resp = $obj->validar();
$listRol = $obj->getRol();
if($resp) {
    if($listRol[0]->getobjrol()->getIdRol() == 1){
        $botonComprar = '<div class="row">
        <div class="col-md-5 offset-md-7 d-grid gap-2">
            <a href="../home/index.php" class="btn btn-outline-success btn-lg" id="comprarBtn" data-bs-toggle="modal" data-bs-target="#successModal">Comprar</a>
        </div>
    </div>';
        include_once("../estructura/estCliente/headerCliente.php");
    }
    else{
        $mensaje ="Error, acceso solo Admin. Inicie sesion como admin para continuar";
        echo("<script>location.href = '../login/login.php?msg=".$mensaje."';</script>");
    }
} else {
    $botonComprar = '<div class="row">
    <div class="col-md-5 offset-md-7 d-grid gap-2">
        <a href="../login/login.php" class="btn btn-outline-success btn-lg" >Comprar</a>
    </div>
</div>';
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
                        $cantidad = $_SESSION['carrito']['productos'][$idProducto];
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

<?php
if($listaCarrito != null){


 echo $botonComprar ;
}
?>

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



<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">¡Compra Exitosa!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tu compra se ha realizado con éxito.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div> 