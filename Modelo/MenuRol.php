<?php
class MenuRol{

    private $idMenu;
    private $idRol;
    private $mensajeOperacion;

    public function __construct(){

        $this->idMenu = 0;
        $this->idRol = 0;
        $this->mensajeOperacion = '';

    }

    public function getIdMenu() {
        return $this->idMenu;
    }

    public function setIdMenu($idMenu){
        $this->idMenu = $idMenu;
    }

    public function getIdRol(){
        return $this->idRol;
    }

    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion = $mensajeOperacion;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol WHERE idmenu = ".$this->getidMenu()." AND idrol = ".$this->getIdRol();;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idmenu'], $row['idrol']);
                }
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    
        
    }

    public function insertar()
    {
        $base = new BaseDatos();
        
        $resp = false;
        $dniDuenio = $this->getObjDuenio()->getNroDni();
        $sql = "INSERT INTO menurol(idmenu, idrol)
				VALUES (" . $this->getidMenu() . "," . $this->getidRol() .")";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function modificar(){ //Esto puede estar mal
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE menurol SET idmenu = " . $this->getIdMenu() . " , idrol = " . $this->getIdRol() .
        " WHERE idmenu = " . $this->getIdMenu() . " AND idrol = " . $this->getIdRol();
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
        $sql = "DELETE FROM menurol WHERE idmenu = " . $this->getIdMenu() . " AND idrol = " . $this->getIdRol();
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
        $sql = "SELECT * FROM menurol";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj = new MenuRol();
                    $obj->setear ($row['idmenu'], $row['idrol']); 
                    array_push($arreglo, $obj);
                }
               
            }
            
        }
 
        return $arreglo;
    }

    public function setear($idMenu, $idRol)
    {
        $this->setIdMenu($idMenu);
        $this->setIdRol($idRol);
    }

}