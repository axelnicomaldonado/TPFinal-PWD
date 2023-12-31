<?php
class AbmProducto{

    //private $idProducto;
    //private $proNombre;
    //private $proDetalle;
    //private $proCantStock;
    //private $proPrecio;
    //private $proDeshabilitado

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Producto
     */
    private function cargarObjeto($param){
        $obj = null;      
        if (array_key_exists('idProducto',$param) && array_key_exists('proNombre',$param) 
        && array_key_exists('proDetalle',$param) && array_key_exists('proCantStock',$param) 
        && array_key_exists('proPrecio', $param) && array_key_exists('proDeshabilitado', $param)){
            $obj = new Producto();
            $obj->setear($param['idProducto'], $param['proNombre'], $param['proDetalle'], $param['proCantStock'], 
            $param['proPrecio'], $param['proDeshabilitado']);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return Producto
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idProducto']) ){
            $obj = new Producto();
            $obj -> setear($param['idProducto'], null, null, null, null);
        }
        return $obj;
    }

    /**
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idProducto']))
            $resp = true;
        return $resp;
    }

    /**
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idProducto'] =null;
        $objProducto = $this->cargarObjeto($param);
        if($objProducto!=null){
            $resp = $objProducto->insertar();
        }
        //if ($objProducto!=null && $resp){
        //    $resp = $param['idProducto'];
        //}
        //echo print_r($resp);
        return $resp;
        
    }

    /**
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objProducto = $this->cargarObjetoConClave($param);
            if ($objProducto!=null && $objProducto->eliminar()){
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
            $objProducto = $this->cargarObjeto($param);
            if($objProducto!=null && $objProducto->modificar()){
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
    if ($param <> NULL){
        if (isset($param['idProducto'])) $where .= " and idproducto = " . $param['idProducto'];
        if (isset($param['proNombre'])) $where .= " and pronombre = '" . $param['proNombre'] . "'";
        if (isset($param['proDetalle'])) $where .= " and prodetalle = '" . $param['proDetalle'] . "'";
        if (isset($param['proCantStock'])) $where .= " and procantStock = " . $param['proCantStock'];
        if (isset($param['proDeshabilitado'])) $where .= " and prodeshabilitado = " . $param['proDeshabilitado'];
    }

    $objProducto = new Producto();
    $arreglo = $objProducto->listar($where);

    return $arreglo;
}

}