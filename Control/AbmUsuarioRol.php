<?php
class AbmUsuarioRol{

    /**
     * 
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param){
        $obj = null;      
        if (array_key_exists('idusuario',$param) && array_key_exists('idrol',$param)){
            $obj = new UsuarioRol();
            $obj->setear($param['idusuario'], $param['idrol']);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idusuario']) && isset($param['idrol'])){
            $obj = new UsuarioRol();
            $obj -> setearConClave($param['idusuario'],$param['idrol']);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idusuario']) && isset($param['idrol']))
            $resp = true;
        return $resp;
    }

    /**
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $obj = $this->cargarObjetoConClave($param);
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
            $obj = $this->cargarObjetoConClave($param);
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
            if(isset($param['idusuario'])) $where.=" and idusuario = ".$param['idusuario'];
            if(isset($param['idrol'])) $where.=" and idrol = ".$param['idrol'];
        }

        $obj = new UsuarioRol;
        $arreglo = $obj->listar($where);

        return $arreglo;
    }

}
