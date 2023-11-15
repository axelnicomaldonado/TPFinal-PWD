<?php

class Producto {
    private $idProducto;
    private $proNombre;
    private $proDetalle;
    private $proCantStock;
    private $proPrecio;
    private $mensajeOperacion;

    public function __construct(){
        $this->idProducto = 0;
        $this->proNombre = "";      //El nombre se guarda como int en la BD ¿?
        $this->proDetalle = "";
        $this->proCantStock = 0;
        $this->proPrecio = 0;
        $this->mensajeOperacion="";
    }

    public function getIdProducto(){
        return $this->idProducto;
    }
    public function getProPrecio(){
        return $this->proPrecio;
    }
    
    public function getProNombre(){
        return $this->proNombre;
    }
    
    public function getProDetalle(){
        return $this->proDetalle;
    }
    
    public function getProCantStock(){
        return $this->proCantStock;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }


    public function setIdProducto($idProducto){
        $this->idProducto = $idProducto;
    }
    public function setProPrecio($proPrecio){
        $this->proPrecio = $proPrecio;
    }
    public function setProNombre($proNombre){
        $this->proNombre = $proNombre;
    }
    
    public function setProDetalle($proDetalle){
        $this->proDetalle = $proDetalle;
    }
    
    public function setProcantStock($proCantStock){
        $this->proCantStock = $proCantStock;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM producto WHERE idproducto = ".$this->getIdProducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['proprecio']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("producto->cargar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$sql="INSERT INTO producto(pronombre, prodetalle, procantstock, proprecio)
				VALUES ('".$this->getProNombre()."','".$this->getProDetalle()."','".$this->getProCantStock()."', '".$this->getProPrecio() ."' )";
		if($base->Iniciar()){
            $id = $base->EjecutarInsert($sql);
			if($id != null){
			    $resp = true;
				$this->setIdProducto($id);
			}else {
				$this->setMensajeOperacion("producto->insertar: ".$base->getError());
			}
		} else {
				$this->setMensajeOperacion("producto->insertar: ".$base->getError());
		}
		return $resp;
	}

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET pronombre = '".$this->getProNombre()."', prodetalle = '".$this->getProDetalle()."', 
        procantstock = '".$this->getProCantStock(). "', proprecio = '".$this->getProPrecio()(). "', WHERE idproducto = '" . $this->getIdProducto() . "'";
    
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("producto->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("producto->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql = "DELETE FROM producto WHERE idproducto = ".$this->getIdProducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("producto->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("producto->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM producto ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new Producto();
                    $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['proprecio']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("producto->listar: ".$base->getError());
        }
        return $arreglo;
    }

    public function setear($idProducto, $proNombre, $proDetalle, $proCantStock, $proPrecio){
        $this->setIdProducto($idProducto);
        $this->setProNombre($proNombre);
        $this->setProDetalle($proDetalle);
        $this->setProcantStock($proCantStock);
        $this->setProPrecio($proPrecio);
    }
}