<?php
class AbmCompraItem{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjeto($param){
        $obj = null;
        if (array_key_exists('idCompraItem',$param) && array_key_exists('objProducto',$param)
        && array_key_exists('objCompra',$param) && array_key_exists('ciCantidad',$param)){
            $obj = new CompraItem();
            $obj->setear($param['idCompraItem'], $param['objProducto'], $param['objCompra'], $param['ciCantidad']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idCompraItem']) ){
            $obj = new CompraItem();
            $obj->setear($param['idCompraItem'], null, null, null, null);
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
        if (isset($param['idCompraItem']))
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idCompraItem'] = null;
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
            if(isset($param['idCompraItem'])) $where.=" and idcompraitem = ".$param['idCompraItem'];
            if(isset($param['objProducto'])) $where.=" and idproducto =".$param['objProducto']['idproducto'];
            if(isset($param['objCompra'])) $where.=" and idcompra =".$param['objCompra']['idcompra'];
            if(isset($param['ciCantidad'])) $where.=" and cicantidad =".$param['ciCantidad'];
        }

        $arreglo = CompraItem::listar($where);
        return $arreglo;
    }

}

    //private $idCompraItem;
    //private $objProducto;
    //private $objCompra;
    //private $ciCantidad;