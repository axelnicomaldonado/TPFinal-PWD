<?php
class CompraEstado{
    private $idCompraEstado;
    private $objCompra;
    private $objCompraEstadoTipo;
    private $ceFechaIni;
    private $ceFechaFin;
    private $mensajeOperacion;


    public function __construct(){
        $this->idCompraEstado = 0;
        $this->objCompra = new Compra;
        $this->objCompraEstadoTipo = new CompraEstadoTipo;
        $this->ceFechaIni = '';
        $this->ceFechaFin = '';
        $this->mensajeOperacion = '';
    }


    public function getIdCompraEstado(){
        return $this->idCompraEstado;
    }

    public function getObjCompra(){
        return $this->objCompra;
    }

    public function getObjCompraEstadoTipo(){
        return $this->objCompraEstadoTipo;
    }

    public function getCeFechaIni(){
        return $this->ceFechaIni;
    }

    public function getCeFechaFin(){
        return $this->ceFechaFin;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }


    public function setIdCompraEstado($idCompraEstado){
        $this->idCompraEstado = $idCompraEstado;
    }

    public function setObjCompra($objCompra){
        $this->objCompra = $objCompra;
    }

    public function setObjCompraEstadoTipo($objCompraEstadoTipo){
        $this->objCompraEstadoTipo = $objCompraEstadoTipo;
    }

    public function setCeFechaIni($ceFechaIni){
        $this->ceFechaIni = $ceFechaIni;
    }

    public function setCeFechaFin($ceFechaFin){
        $this->ceFechaFin = $ceFechaFin;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado WHERE idcompraestado = ".$this->getIdCompraEstado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $objCompra = new Compra();
                    $objCompra->setIdCompra($row['idcompra']);
                    $objCompra->cargar();
                    $objCompraEstadoTipo = new CompraEstadoTipo();
                    $objCompraEstadoTipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                    $objCompraEstadoTipo->cargar();
                    $this->setear($row['idcompraestado'], $objCompra, $objCompraEstadoTipo, $row['cefechaini'], $row['cefechafin']);
                    $resp = true;
                }
            }
        } else {
            $this->setMensajeOperacion("compraestado->cargar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$sql="INSERT INTO compraestado(idcompra,idcompraestadotipo)
				VALUES ('".$this->getObjCompra()->getIdCompra()."','".$this->getObjCompraEstadoTipo()->getIdCompraEstadoTipo().
                "')";

        
		if($base->Iniciar()){
            $id = $base->Ejecutar($sql);
			if($id != null){
			    $resp=  true;
				$this->setIdCompraEstado($id);
			}else{
				$this->setMensajeOperacion("compraestado->insertar: ".$base->getError());
			}
		} else {
				$this->setMensajeOperacion("compraestado->insertar: ".$base->getError());
		}
		return $resp;
	}

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $objCompra = $this -> getObjCompra();
        $objCompraEstadoTipo = $this -> getObjCompraEstadoTipo();
        $sql = 
        "UPDATE compraEstado SET 
            idCompra='" . $objCompra->getIdCompra() . "',
            idCompraEstadoTipo='" . $objCompraEstadoTipo->getIdCompraEstadoTipo() . "',
            ceFechaIni='" . $this->getCeFechaIni() . "',
            ceFechaFin='" . $this->getceFechaFin() . "'
        WHERE idCompraEstado='" . $this->getIdCompraEstado() . "'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("compraEstado->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("compraEstado->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql = "DELETE FROM compraestado WHERE idcompraestado = ".$this->getIdCompraEstado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("compraestado->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("compraestado->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $objCompraEstado= new CompraEstado();
                    $objCompra = new Compra();
                    $objCompra->setIdCompra($row['idcompra']);
                    $objCompra->cargar();
                    $objCompraEstadoTipo = new CompraEstadoTipo();
                    $objCompraEstadoTipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                    $objCompraEstadoTipo->cargar();
                    $objCompraEstado->setear($row['idcompraestado'],$objCompra,$objCompraEstadoTipo,$row['cefechaini'], $row['cefechafin']);
                    array_push($arreglo, $objCompraEstado);
                }
            }
        } else {
            $this->setMensajeOperacion("compraestado->listar: ".$base->getError());
        }
        return $arreglo;
    }

    public function setear($idCompraEstado, $objCompra, $objCompraEstadoTipo, $ceFechaIni, $ceFechaFin){
        $this->setIdCompraEstado($idCompraEstado);
        $this->setObjCompra($objCompra);
        $this->setObjCompraEstadoTipo($objCompraEstadoTipo);
        $this->setCeFechaIni($ceFechaIni);
        $this->setCeFechaFin($ceFechaFin);
    }

}