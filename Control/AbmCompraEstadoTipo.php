<?php
class AbmCompraEstadoTipo{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstadoTipo
     */
    private function cargarObjeto($param){
        $obj = null;      
        if (array_key_exists('idCompraEstadoTipo',$param) && array_key_exists('cetDescripcion',$param)
        && array_key_exists('cetDetalle',$param)){
            $obj = new CompraEstadoTipo();
            $obj->setear($param['idCompraEstadoTipo'], $param['cetDescripcion'], $param['cetDetalle']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraEstadoTipo
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idCompraEstadoTipo']) ){
            $obj = new CompraEstadoTipo();
            $obj->setear($param['idCompraEstadoTipo'], null, null, null, null);
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
        if (isset($param['idCompraEstadoTipo']))
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idCompraEstadoTipo'] = null;
        $objCompraEstadoTipo = $this->cargarObjeto($param);
        // verEstructura($objCompraEstadoTipo);
        if ($objCompraEstadoTipo!=null && $objCompraEstadoTipo->insertar()){
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
            $objCompraEstadoTipo = $this->cargarObjetoConClave($param);
            if ($objCompraEstadoTipo!=null && $objCompraEstadoTipo->eliminar()){
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
            $objCompraEstadoTipo = $this->cargarObjeto($param);
            if($objCompraEstadoTipo!=null && $objCompraEstadoTipo->modificar()){
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
            if(isset($param['idCompraEstadoTipo'])) $where.=" and idcompraestadoTipo = ".$param['idCompraEstadoTipo'];
            if(isset($param['cetDescripcion'])) $where.=" and cetdescripcion =".$param['objCompra']['cetDescripcion'];
            if(isset($param['cetDetalle'])) $where.=" and cetdetalle ='".$param['cetDetalle']."'";
        }

        $arreglo = CompraEstadoTipo::listar($where);
        return $arreglo;
    }
}
