<?php
class AbmMenu{

    //private $idMenu;
    //private $meNombre;
    //private $meDescripcion;
    //private $objMenu;
    //private $meDeshabilitado;

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param){
        $obj = null;      
        if (array_key_exists('idMenu',$param) && array_key_exists('meNombre',$param) 
        && array_key_exists('meDescripcion',$param) && array_key_exists('objMenu',$param) && 
        array_key_exists('meDeshabilitado',$param)){
            $obj = new Menu();
            $obj->setear($param['idMenu'], $param['meNombre'], $param['meDescripcion'], $param['objMenu'], 
            $param['meDeshabilitado']);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idMenu']) ){
            $objMenu = new Menu();
            $objMenu -> setear($param['idMenu'], null, null);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idMenu']))
            $resp = true;
        return $resp;
    }

    /**
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idMenu'] = null;
        $objMenu = $this->cargarObjeto($param);
        if ($objMenu!=null && $objMenu->insertar()){
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
            $objMenu = $this->cargarObjetoConClave($param);
            if ($objMenu!=null && $objMenu->eliminar()){
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
            $objMenu = $this->cargarObjeto($param);
            if($objMenu!=null && $objMenu->modificar()){
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
            if(isset($param['meNombre'])) $where.=" and meNombre ='".$param['meNombre']."'";
            if(isset($param['meDescripcion'])) $where.=" and meDescripcion ='".$param['meDescripcion']."'";
            if(isset($param['objMenu'])) $where.=" and idpadre =".$param['objMenu']['idMenu'];
            if(isset($param['meDeshabilitado'])) $where.=" and meDeshabilitado ='".$param['meDeshabilitado']."'"; //revisar (es un timestamp)
        }

        $objMenu = new Menu;
        $arreglo = $objMenu->listar($where);

        return $arreglo;
    }

}