<?php
class Rol {
    private $idRol;
    private $roDescripcion;
    private $mensajeOperacion;

    public function __construct() {
        $this->idRol = 0;
        $this->roDescripcion = "";
        $this->mensajeOperacion = "";
    }
    
    
    public function getIdRol(){
        return $this->idRol;
    }
    
    public function getRoDescripcion(){
        return $this->roDescripcion;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }
    
    
    public function setIdRol($idRol){
        $this->idRol=$idRol;
    }
    
    public function setRoDescripcion($roDescripcion){
        $this->roDescripcion=$roDescripcion;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion=$mensajeOperacion;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM rol WHERE idRol = ".$this->getIdRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idRol'], $row['roDescripcion']);
                    
                }
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO rol(idRol,roDescripcion)
            VALUES(".$this->getIdRol().",'".$this->getRoDescripcion()."');";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE rol SET roDescripcion='" . $this->getRoDescripcion() . "' WHERE idRol=" . $this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM rol WHERE idRol=" .$this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();

        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idRol'], $row['roDescripcion']); 
                    array_push($arreglo, $obj);
                }
            }
        }
        return $arreglo;
    }

    public function setear($idRol, $roDescripcion) {
        $this->idRol = $idRol;
        $this->roDescripcion = $roDescripcion;
    }
}