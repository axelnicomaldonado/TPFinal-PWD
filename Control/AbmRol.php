<?php
class AbmRol{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param){
        $obj = null;      
        if (array_key_exists('idRol',$param) && array_key_exists('roDescripcion',$param)){
            $obj = new Rol();
            $obj->setear($param['idRol'], $param['roDescripcion']);
        }
        return $obj;
    }

    /**
    * @param array $param
    * @return Rol
    */
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idRol']) ){
            $objRol = new Rol();
            $objRol -> setear($param['idRol'], null);
        }
        return $obj;
    }

    /**
    * @param array $param
    * @return boolean
    */
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idRol']))
            $resp = true;
        return $resp;
    }

    /**
    * @param array $param
    */
    public function alta($param){
        $resp = false;
        $objRol = $this->cargarObjeto($param);
        if ($objRol!=null && $objRol->insertar()){
            $resp = true;
        }
        return $resp;
    }
    
    /**
    * @param array $param
    * @return boolean
    */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objRol = $this->cargarObjetoConClave($param);
            if ($objRol!=null && $objRol->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
    * @param array $param
    * @return boolean
    */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objRol = $this->cargarObjeto($param);
            if($objRol!=null && $objRol->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
    * @param array $param
    * @return boolean
    */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if(isset($param['idRol'])) $where.=" and idRol = ".$param['idRol'];
            if(isset($param['roDescripcion'])) $where.=" and roDescripcion ='".$param['roDescripcion']."'";
        }

        $objRol = new Rol;
        $arreglo = $objRol->listar($where);

        return $arreglo;
    }

}