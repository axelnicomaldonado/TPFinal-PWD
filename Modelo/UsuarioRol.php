<?php
class UsuarioRol {
    private $idUsuario;
    private $idRol;
    private $mensajeOperacion;

    public function __construct() {
        $this->idUsuario = 0;
        $this->idRol = 0;
        $this->mensajeOperacion = "";
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario=$idUsuario;
    }

    public function getIdRol(){
        return $this->idRol;
    }

    public function setIdRol($idRol){
        $this->idRol=$idRol;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion=$mensajeOperacion;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol WHERE idUsuario = ".$this->getIdUsuario()." AND idRol = ".$this->getIdRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idUsuario'], $row['idRol']);      
                }
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    
   
    }

    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuariorol(idUsuario,idRol)
            VALUES ('" . $this->getIdUsuario() . "','" . $this->getIdRol() . "')";
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
        $sql = "UPDATE usuariorol SET idUsuario = " . $this->getIdUsuario() . " , idRol = " . $this->getIdRol() .
        " WHERE idUsuario = " . $this->getIdUsuario() . " AND idRol = " . $this->getIdRol();
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
        $sql = "DELETE FROM usuariorol WHERE idUsuario = " . $this->getIdUsuario() . " AND idRol = " . $this->getIdRol();
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
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj = new UsuarioRol();
                    $obj->setear ($row['idUsuario'], $row['idRol']); 
                    array_push($arreglo, $obj);
                }
               
            }
            
        }
 
        return $arreglo;
    }
    
    public function setear($idUsuario, $idRol){
        $this->idUsuario = $idUsuario;
        $this->idRol = $idRol;
    }

}
