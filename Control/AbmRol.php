<?php
class AbmRol{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param){
        $obj = null;      
        if (array_key_exists('idrol',$param) && array_key_exists('rodescripcion',$param)){
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
        if( isset($param['idrol']) ){
            $objRol = new Rol();
            $objRol -> setear($param['idrol'], null);
        }
        return $obj;
    }

    /**
    * @param array $param
    * @return boolean
    */
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idrol']))
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
            if(isset($param['idrol'])) $where.=" and idrol = ".$param['idrol'];
            if(isset($param['rodescripcion'])) $where.=" and rodescripcion ='".$param['rodescripcion']."'";
        }

        $objRol = new Rol;
        $arreglo = $objRol->listar($where);

        return $arreglo;
    }

    /**
     * Retorna todos sus obj menu a los que puede acceder
     */
    public function buscarPermisos($param){
        $where = " true ";
        $claves = ["id"];
        $clavesDB = ["idrol"];


        if ($param<>null){
            for($i = 0; $i < count($claves); $i++){
                if(isset($param[$claves[$i]])){
                    $where.= " and " . $clavesDB[$i] . " = '". $param[$claves[$i]]  ."'";
                }
            }
        }

        $obj = new MenuRol();
        $arreglo = $obj->listarRoles($where);
        return $arreglo;
    }

}
