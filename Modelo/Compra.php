<?php

class Compra{
    private $idCompra;
    private $coFecha;
    private $objUsuario;
    private $mensajeOperacion;

    public function __construct(){
        $this->idCompra = 0;
        $this->coFecha = '';
        $this->objUsuario = new Usuario;
        $this->mensajeOperacion = '';
    }

    public function getIdCompra(){
        return $this->idCompra;
    }

    public function getCoFecha(){
        return $this->coFecha;
    }

    public function getObjUsuario(){
        return $this->objUsuario;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }


    public function setIdCompra($idCompra){
        $this->idCompra = $idCompra;
    }

    public function setCoFecha($coFecha){
        $this->coFecha = $coFecha;
    }

    public function setObjUsuario($objUsuario){
        $this->objUsuario = $objUsuario;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
        
    }


     public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compra WHERE idcompra = ".$this->getIdCompra();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $objUsuario = new Usuario();
                    $objUsuario->setIdUsuario($row['idusuario']);
                    $objUsuario->cargar();
                    $this->setear($row['idcompra'],$row['cofecha'], $objUsuario);
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
		$sql="INSERT INTO compra(idusuario)
				VALUES ('".$this->getObjUsuario()->getIdUsuario()."')";
		if($base->Iniciar()){
            $id = $base->Ejecutar($sql);
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
        $sql = "UPDATE compra SET cofecha = '" . $this->getCoFecha() . "', idusuario = '" . $this->getObjUsuario()->getIdUsuario() . "',
        WHERE idcompra = '" . $this->getIdCompra() . "'";
    
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
        $base=new BaseDatos();
        $sql = "DELETE FROM compra WHERE idcompra = ".$this->getIdCompra();
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
        $sql="SELECT * FROM compra ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new Compra();
                    $objUsuario = new Usuario();
                    $objUsuario->setIdUsuario($row['idusuario']);
                    $objUsuario->cargar();
                    $obj->setear($row['idcompra'],$row['cofecha'], $objUsuario);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("compra->listar: ".$base->getError());
        }
        return $arreglo;
    }

    
    public function setear($idCompra, $coFecha, $objUsuario)
    {
        $this->setIdCompra($idCompra);
        $this->setCoFecha($coFecha);
        $this->setObjUsuario($objUsuario);
    }
}
