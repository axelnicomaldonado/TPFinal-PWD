<?php
class AbmMenuRol{

    /**
     * 
     * @param array $param
     * @return MenuRol
     */
    private function cargarObjeto($param){
        $obj = null;      
        if (array_key_exists('idMenu',$param) && array_key_exists('idRol',$param)){
            $obj = new MenuRol();
            $obj->setear($param['idMenu'], $param['idRol']);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return MenuRol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idMenu']) && isset($param['idRol'])){
            $obj = new MenuRol();
            $obj -> setear($param['idMenu'],$param['idRol']);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idMenu']) && isset($param['idRol']))
            $resp = true;
        return $resp;
    }

    /**
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $obj = $this->cargarObjeto($param);
        if ($obj!=null && $obj->insertar()){
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
            $obj = $this->cargarObjetoConClave($param);
            if ($obj!=null && $obj->eliminar()){
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
            $obj = $this->cargarObjeto($param);
            if($obj!=null && $obj->modificar()){
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
            if(isset($param['idMenu'])) $where.=" and idMenu = ".$param['idMenu'];
            if(isset($param['idRol'])) $where.=" and idRol = ".$param['idRol'];
        }

        $obj = new MenuRol;
        $arreglo = $obj->listar($where);

        return $arreglo;
    }

}