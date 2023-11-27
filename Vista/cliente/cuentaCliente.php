<?php
$titulo = "Mi Cuenta";
include_once("../../configuracion.php");
include_once("../estructura/headerSeguro.php");
$objUsuario = new AbmUsuario();
$session = new Session();
$compras = new AbmCompra();
$compraItem = new AbmCompraItem();
$compraEstado = new AbmCompraItem();
$listaItems = [];

$data["idusuario"] = $session->getUsuario()->getidusuario();
$arregloPerfil = $objUsuario->buscar($data);
$comprasRealizadas = $compras->buscar($data);
$stringProductosCompra = '';

/*foreach ($comprasRealizadas as $compra) {
  $total = 0;
  $data['idcompra'] = $compra->getIdCompra();
  $itemsCompras = $compraItem->buscar($data);
  foreach ($itemsCompras as $item) {
    $itemIndividual = $item->getObjProducto();
    array_push($listaItems, $itemIndividual);
    $cantidad = $item->getCiCantidad();
    $precio = $itemIndividual->getProPrecio();
    $stringProductosCompra .= "x" . $cantidad . $item->getProNombre() . " $" . number_format($precio, 2, '.', ',') . "\n";
    $total += $precio * $cantidad;
  }
}
*/
?>

<h3 class="infCuenta">Información de la cuenta</h3>
<div class="containerCliente d-flex justify-content-between flex-row">

  <div class="datosCuenta">

    <h5 class="subtituloDatos">Datos personales</h5>
    <div class="datosSeparados d-flex justify-content-between flex-row">
    <a class="btn componenteDato" role="button" href="editarDatos.php?id=<?php echo (int)$arregloPerfil[0]->getidusuario(); ?>">
        <p class="textoInfo">Nombre de usuario <br><?php echo $arregloPerfil[0]->getusnombre() ?></p>
        <a class="editar btn" role="button"><img class="imgEditar" src="../imagenes/edit.png"></a>
      </a>
    </div>
    <div class="datosSeparados d-flex justify-content-between flex-row">
      <a class="btn componenteDato" role="button" href="editarDatos.php?id=<?php echo (int)$arregloPerfil[0]->getidusuario(); ?>">
        <p class="textoInfo">Correo Electrónico <br><?php echo $arregloPerfil[0]->getusmail() ?></p><a class="editar btn" role="button"><img class="imgEditar" src="../imagenes/edit.png"> </a>
      </a>
    </div>
    <div class="contenedorCierre d-flex justify-content-between flex-row">

      <form action="../accion/accionLoginLogout.php" method="post" class="formCierre">
        <button class="botonCerrarCliente btn btn-outline-danger" id="botonCerrarCliente" type="sumbit" name="accion" value="cerrar">Cerrar Sesion</button>
      </form>


    </div>
  </div>


  <div class="datosCompra">
    <h5 class="subtituloDatos">Compras</h5>
    <div class="listaCompras">
      <table class="table  m-auto">
        <thead class="table-dark fw-bold">
        </thead>

    </div>

  </div>


</div>
<?php
$abmProducto = new AbmProducto;
$abmCompra = new AbmCompra;
$abmCompraItem = new AbmCompraItem;
$abmCompraEstado = new AbmCompraEstado;
$abmCompraEstadoTipo = new AbmCompraEstadoTipo;

$listadoProducto = $abmProducto->buscar(null);
$listadoCompra = $abmCompra->buscar(null);
$listadoCompraItem = $abmCompraItem->buscar(null);
$listadoCompraEstado = $abmCompraEstado->buscar(null);
$listadoCompraEstadoTipo = $abmCompraEstadoTipo->buscar(null);

?>

<html>

<head>
  <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="listaCompras">
    <table class="table  m-auto">
      <thead class="table-dark fw-bold">
        <tr>
          <th scope="col">IdCompra</th>
          <th scope="col">Fecha</th>
          <th scope="col">Productos</th>
          <th scope="col">Precio Total</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php


        foreach ($listadoCompra as $compra) {
          $stringProductosCompra = '';
          $total = 0;
          foreach ($listadoCompraItem as $compraItem) {
            if ($compraItem->getObjCompra()->getIdCompra() == $compra->getIdCompra()) {
              foreach ($listadoProducto as $producto) {
                if ($compraItem->getObjProducto()->getIdProducto() == $producto->getIdProducto()) {
                  $total = $total + $producto->getProPrecio() * $compraItem->getCiCantidad();

                  $stringProductosCompra .= "x" . $compraItem->getCiCantidad() . " " . $producto->getProNombre() . " $" . number_format($producto->getProPrecio(), 2, ',', '.') .
                    "<br>";
                }
              }
            }
          }

          $ceFechaIni = '';
          $ceFechaFin = '';
          $estadoTipo = '';
          $listaEstados = []; // Cambiado a un arreglo simple

          foreach ($listadoCompraEstado as $compraEstado) {
            if ($compraEstado->getObjCompra()->getIdCompra() == $compra->getIdCompra()) {
              $listaEstados[] = [
                'descripcion' => $compraEstado->getObjCompraEstadoTipo()->getCetDescripcion(),
                'fechaIni' => $compraEstado->getCeFechaIni(),
                'fechaFin' => $compraEstado->getCeFechaFin(),
              ];
            }
          }
        ?>



          <tr>
            <td> <?php echo $compra->getIdCompra() ?> </td>
            <td> <?php echo $compra->getCoFecha() ?> </td>
            <td> <?php echo $stringProductosCompra ?>
            <td> <?php echo number_format($total, 2, ',', '.') ?></td>



            <td>
              <a class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#miModal_<?php echo $compra->getIdCompra(); ?>">
                <?php
                // Obtener el último estado
                $ultimoEstado = end($listaEstados);
                // Imprimir la descripción del último estado
                echo $ultimoEstado['descripcion'];
                ?>
              </a>
            </td>

          </tr>



          <div class="modal fade" id="miModal_<?php echo $compra->getIdCompra(); ?>" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="miModalLabel">Seguimiento del envío</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-4">
                      <!-- Contenido de la primera columna -->
                      <p class="estadoModal">
                        <?php
                        foreach ($listaEstados as $estadito) {
                          echo $estadito['descripcion'] . "<br/>";
                        }
                        ?>
                      </p>
                    </div>

                    <!-- Segunda columna -->
                    <div class="col-md-4">
                      <!-- Contenido de la segunda columna -->
                      <p class="estadoModal">
                        <?php
                        foreach ($listaEstados as $estadito) {
                          echo $estadito['fechaIni'] . "<br/>";
                        }
                        ?>
                      </p>
                    </div>

                    <!-- Tercera columna -->
                    <div class="col-md-4">
                      <!-- Contenido de la tercera columna -->
                      <p class="estadoModal">
                        <?php
                        foreach ($listaEstados as $estadito) {
                          echo $estadito['fechaFin'] . "<br/>";
                        }
                        ?>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <!-- Otros botones o acciones si es necesario -->
                </div>
              </div>
            </div>
          </div>

        <?php

        }
        ?>
      </tbody>
    </table>
  </div>