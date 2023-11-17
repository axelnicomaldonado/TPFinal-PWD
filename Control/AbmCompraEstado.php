<?php
class AbmCompraEstado{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjeto ($param){
        $obj = null;
        ($param);
        if (array_key_exists('idCompra',$param) and
            array_key_exists('idCompraEstadoTipo',$param))
        {
            $obj = new CompraEstado();
            $abmCompra = new AbmCompra ();
            $abmCompraEstadoTipo = new AbmCompraEstadoTipo();
            $arrayCompra = [];
            $arrayCompraEstadoTipo = [];
            $arrayCompra ['idCompra'] = $param['idCompra'];
            $arrayCompraEstadoTipo ['idCompraEstadoTipo'] = $param['idCompraEstadoTipo']; // Modificado!!!
            // MODIFICADO!!!
            $listaCompras = $abmCompra -> buscar ($arrayCompra);
            $listaCompraEstadoTipo = $abmCompraEstadoTipo -> buscar ($arrayCompraEstadoTipo);
            print_r($listaCompraEstadoTipo);
            $objCompra = $listaCompras[0];
            $objCompraEstadoTipo = $listaCompraEstadoTipo[0];
            // MODIFICADO!!!
            $idCompraEstado = $param ['idCompraEstado'];
            $ceFechaIni = $param ['ceFechaIni'];
            $ceFechaFin = $param ['ceFechaFin'];

            $obj -> setear($idCompraEstado, $objCompra, $objCompraEstadoTipo, $ceFechaIni, $ceFechaFin);
        }
        return $obj;
    }
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoConClave($param){
        $obj = null;

        if( isset($param['idCompraEstado']) ){
            $obj = new CompraEstado();
            $obj->setear($param['idCompra'], null, null, null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
     private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idCompraEstado']))
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     */
    public function alta($param){
     
        $resp = false;
        $param['idCompraEstado'] = null;
        $objCompraEstado = $this->cargarObjeto($param);
        // verEstructura($objCompraEstado);
        if ($objCompraEstado!=null && $objCompraEstado->insertar()){
            $resp = true;
        }
        return $resp;
        
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objCompraEstado = $this->cargarObjetoConClave($param);
            if ($objCompraEstado!=null && $objCompraEstado->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objCompraEstado = $this->cargarObjeto($param);
            if($objCompraEstado!=null && $objCompraEstado->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if(isset($param['idCompraEstado'])) $where.=" and idcompraestado = ".$param['idCompraEstado'];
            if(isset($param['objCompra'])) $where.=" and idcompra =".$param['objCompra']['idCompra'];
            if(isset($param['objCompraEstadoTipo'])) $where.=" and idcompraestadotipo =".$param['objCompraEstadoTipo']['idCompraEstadoTipo'];
            if(isset($param['ceFechaIni'])) $where.=" and cefechaini ='".$param['ceFechaIni']."'";
            if(isset($param['ceFechaFin'])) $where.=" and cefechafin ='".$param['ceFechaFin']."'";
        }

        $arreglo = CompraEstado::listar($where);
        return $arreglo;
    }
}

    //private $idCompraEstado;
    //private $objCompra;
    //private $objCompraEstadoTipo;
    //private $ceFechaIni;
    //private $ceFechaFin;