<?php
class AbmUsuario{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */
    private function cargarObjeto($param){
        $obj = null;      
        if (array_key_exists('idUsuario',$param) && array_key_exists('usNombre',$param) 
        && array_key_exists('usPass',$param) && array_key_exists('usMail',$param) && 
        array_key_exists('usDeshabilitado',$param)){
            $obj = new Usuario();
            $obj->setear($param['idUsuario'], $param['usNombre'], $param['usPass'], $param['usMail'], 
            $param['usDeshabilitado']);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return Usuario
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idUsuario']) ){
            $objUsuario = new Usuario();
            $objUsuario -> setear($param['idUsuario'], null, null);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idUsuario']))
            $resp = true;
        return $resp;
    }

    /**
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $objUsuario = $this->cargarObjeto($param);
        if ($objUsuario!=null && $objUsuario->insertar()){
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
            $objUsuario = $this->cargarObjetoConClave($param);
            if ($objUsuario!=null && $objUsuario->eliminar()){
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
            $objUsuario = $this->cargarObjeto($param);
            if($objUsuario!=null && $objUsuario->modificar()){
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
            if(isset($param['idUsuario'])) $where.=" and idUsuario = ".$param['idUsuario'];
            if(isset($param['usNombre'])) $where.=" and usNombre ='".$param['usNombre']."'";
            if(isset($param['usPass'])) $where.=" and usPass =".$param['usPass'];
            if(isset($param['usMail'])) $where.=" and usMail ='".$param['usMail']."'";
            if(isset($param['usDeshabilitado'])) $where.=" and usDeshabilitado ='".$param['usDeshabilitado']."'"; //revisar (es un timestamp)
        }

        $objUsuario = new Usuario;
        $arreglo = $objUsuario->listar($where);

        return $arreglo;
    }

}