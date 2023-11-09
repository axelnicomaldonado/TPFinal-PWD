<?php
class AbmCompra{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param){
        $obj = null;      
        if (array_key_exists('idCompra',$param) && array_key_exists('coFecha',$param)
        && array_key_exists('idUsuario',$param)){
            $obj = new Compra();
            $obj->setear($param['idCompra'], $param['coFecha'], $param['idUsuario']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idCompra']) ){
            $obj = new Compra();
            $obj->setear($param['idCompra'], null, null, null);
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
        if (isset($param['idCompra']))
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idCompra'] = null;
        $objCompra = $this->cargarObjeto($param);
        // verEstructura($objCompra);
        if ($objCompra!=null && $objCompra->insertar()){
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
            $objCompra = $this->cargarObjetoConClave($param);
            if ($objCompra!=null && $objCompra->eliminar()){
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
            $objCompra = $this->cargarObjeto($param);
            if($objCompra!=null && $objCompra->modificar()){
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
            if(isset($param['idCompra'])) $where.=" and idcompra = ".$param['idCompra'];
            if(isset($param['coFecha'])) $where.=" and cofecha ='".$param['coFecha']."'";
            if(isset($param['objUsuario'])) $where.=" and idusuario =".$param['objUsuario']['idUsuario'];
        }

        $arreglo = Compra::listar($where);
        return $arreglo;
    }

}

//private $idCompra;
//private $coFecha;
//private $objUsuario;