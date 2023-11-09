<?php

class Menu {
    private $idMenu;        //Primaria
    private $meNombre;      //Nombre del item del menu
    private $meDescripcion; //Descripcion mas detallada del item del menu
    private $objMenu;       //Referencia al id del menu que es subitem
    private $meDeshabilitado; //Fecha en la que el menu fue deshabilitado por ultima vez
    private $mensajeOperacion;

    public function __construct(){
        $this->idMenu = 0;
        $this->meNombre = "";
        $this->meDescripcion = "";
        $this->objMenu = null;
        $this->meDeshabilitado = null;
        $this->mensajeOperacion = "";
    }

    public function getIdMenu(){
        return $this->idMenu;
    }

    public function getMeNombre(){
        return $this->meNombre;
    }

    public function getMeDescripcion(){
        return $this->meDescripcion;
    }

    public function getObjMenu(){
        return $this->objMenu;
    }

    public function getMeDeshabilitado(){
        return $this->meDeshabilitado;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }


    public function setIdMenu($idMenu){
        $this->idMenu = $idMenu;
    }

    public function setMeNombre($meNombre){
        $this->meNombre = $meNombre;
    }

    public function setMeDescripcion($meDescripcion){
        $this->meDescripcion = $meDescripcion;
    }

    public function setObjMenu($objMenu){
        $this->objMenu = $objMenu;
    }

    public function setMeDeshabilitado($meDeshabilitado){
        $this->meDeshabilitado = $meDeshabilitado;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }



    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM menu WHERE idmenu = ".$this->getIdmenu();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $menu = null;
                    if ($row['idpadre']!=null or $row['idpadre']!='' ){
                        $menu = new Menu();
                        $menu->setIdmenu($row['idpadre']);
                        $menu->cargar();
                    }
                    $this->setear($row['idmenu'], $row['menombre'],$row['medescripcion'],$menu,$row['medeshabilitado']); 
                    
                }
            }
        } else {
            $this->setMensajeOperacion("menu->cargar: ".$base->getError());
        }
        return $resp;
    }


    public function insertar(){
		$base = new BaseDatos();
		$resp = false;
		$sql = "INSERT INTO menu(menombre, medescripcion, idpadre, medeshabilitado)";
        $sql.=" VALUES('".$this->getMeNombre()."','".$this->getMeDescripcion()."',";
        if ($this->getObjMenu()!= null){
            $sql.=$this->getObjMenu()->getIdMenu().",";
        }
        else {
            $sql.="null,";
        }
        if ($this->getMeDeshabilitado()!=null) {
            $sql.= "'".$this->getMeDeshabilitado()."')";
        }
        else {
            $sql.="null)";
        }
        if ($base->Iniciar()) {
            if ($idSet = $base->Ejecutar($sql)) {
                $this->setIdMenu($idSet);
                $resp = true;
            } else {
                $this->setMensajeOperacion("menu->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("menu->insertar: ".$base->getError());
        }
        return $resp;
    }


    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE menu SET menombre='".$this->getMeNombre()."',medescripcion='".$this->getMeDescripcion()."'";
   
        if ($this->getObjMenu()!= null){
            $sql.=",idpadre= ".$this->getObjMenu()->getIdMenu();
        }
         else {
            $sql.=",idpadre= null";
        }
         if ($this->getMeDeshabilitado()!=null) {
             $sql.= ",medeshabilitado='".$this->getMeDeshabilitado()."'";
        }
         else {
              $sql.=",medeshabilitado=null";
        }
        $sql.= " WHERE idmenu = ".$this->getIdMenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setMensajeOperacion("menu->modificar ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("menu->modificar ".$base->getError());
        }
        return $resp;
    }
    

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menu WHERE idmenu =".$this->getIdMenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("menu->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeOperacion("menu->eliminar: ".$base->getError());
        }
        return $resp;
    }


    public static  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menu ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj = new Menu();
                    $menu = null;
                    if ($row['idpadre']!=null){
                        $menu = new Menu();
                        $menu->setIdMenu($row['idpadre']);
                        $menu->cargar();
                    }
                    $obj->setear($row['idmenu'], $row['menombre'],$row['medescripcion'],$menu,$row['medeshabilitado']); 
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMensajeOperacion("menu->listar: ".$base->getError());
        }
        return $arreglo;
    }

    public function setear($idMenu, $meNombre, $meDescripcion, $ObjMenu, $meDeshabilitado){
        $this->setIdmenu($idMenu);
        $this->setMenombre($meNombre);
        $this->setMedescripcion($meDescripcion);
        $this->setObjmenu($ObjMenu);
        $this->setMedeshabilitado($meDeshabilitado);
    }
}