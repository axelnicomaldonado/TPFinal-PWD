<?php

class CompraItem{
    private $idCompraItem;
    private $objProducto;
    private $objCompra;
    private $ciCantidad;
    private $mensajeOperacion;

    public function __construct(){
        $this->idCompraItem = 0;
        $this->objProducto = new Producto;
        $this->objCompra = new Compra;
        $this->ciCantidad = 0;
        $this->mensajeOperacion = "";
    }

    public function getIdCompraItem(){
        return $this->idCompraItem;
    }

    public function getObjProducto(){
        return $this->objProducto;
    }

    public function getObjCompra(){
        return $this->objCompra;
    }

    public function getCiCantidad(){
        return $this->ciCantidad;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }


    public function setIdCompraItem($idCompraItem){
        $this->idCompraItem = $idCompraItem;
    }

    public function setObjProducto($objProducto){
        $this->objProducto = $objProducto;
    }

    public function setObjCompra($objCompra){
        $this->objCompra = $objCompra;
    }

    public function setCiCantidad($ciCantidad){
        $this->ciCantidad = $ciCantidad;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }


    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql="SELECT * FROM compraitem WHERE idcompraitem = ".$this->getIdCompraItem();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $objProducto = new Producto();
                    $objProducto->setIdProducto($row['idproducto']);
                    $objProducto->cargar();
                    $objCompra = new Compra();
                    $objCompra->setIdCompra($row['idcompra']);
                    $objCompra->cargar();
                    $this->setear($row['idcompraitem'], $objProducto, $objCompra, $row['cicantidad']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("compra->cargar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$sql="INSERT INTO compraitem(idproducto, idcompra, cicantidad)
				VALUES ('".$this->getObjProducto()->getIdProducto()."','".$this->getObjCompra()->getIdCompra()."','".$this->getCiCantidad(). "')";
		if($base->Iniciar()){
            $id = $base->EjecutarInsert($sql);
			if($id != null){
			    $resp = true;
				$this->setIdCompra($id);
			}else {
				$this->setMensajeOperacion("compra->insertar: ".$base->getError());
			}
		} else {
				$this->setMensajeOperacion("compra->insertar: ".$base->getError());
		}
		return $resp;
	}

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE compra 
        SET idproducto = '" . $this->getObjProducto()->getIdProducto() . "', 
        idcompra = '" . $this->getObjCompra()->getIdCompra() . "', 
        cicantidad = '" .$this->getCiCantidad(). "', 
        WHERE idcompraitem = '" . $this->getIdCompraItem() . "'";
    
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compra->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("compra->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM compraitem WHERE idcompraitem = ".$this->getIdCompraItem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compra->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("compra->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new CompraItem();
                    $objProducto = new Producto();
                    $objProducto->setIdProducto($row['idproducto']);
                    $objProducto->cargar();
                    $objCompra = new Compra();
                    $objCompra->setIdCompra($row['idcompra']);
                    $objCompra->cargar();
                    $obj->setear($row['idcompraitem'], $objProducto, $objCompra, $row['cicantidad']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("compra->listar: ".$base->getError());
        }
        return $arreglo;
    }

    public function setear($idCompraItem, $objProducto, $objCompra, $ciCantidad){
        $this->setIdCompraItem($idCompraItem);
        $this->setObjProducto($objProducto);
        $this->setObjCompra($objCompra);
        $this->setCiCantidad($ciCantidad);
    }
}