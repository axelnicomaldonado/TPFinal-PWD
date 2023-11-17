<?php 
class UsuarioRol {
    private $objusuario;
    private $objrol;
   
    
    private $mensajeoperacion;

   
    public function __construct(){
        $this->objusuario = new Usuario();
        $this->objrol = new Rol();
       }
    public function setear($objusuario, $objrol)
    {
        $this->setobjusuario($objusuario);
        $this->setobjrol($objrol);
       
    }

    public function setearConClave($idusuario, $idjrol)
    {
        $this->getobjrol()->setidrol($idjrol);
        $this->getobjusuario()->setidusuario($idusuario);
    }

    public function getobjusuario(){  return $this->objusuario;}
    public function setobjusuario($objusuario){     $this->objusuario = $objusuario;    }
    public function getobjrol(){      return $this->objrol;     }
    public function setobjrol($objrol){  $this->objrol = $objrol;    }
    
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
        
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
        
    }
    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql="SELECT * FROM usuariorol WHERE idrol = ".$this->getobjrol()->getidrol()." AND idusuario = ".$this->getobjusuario()->getidusuario().";";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    
                    $obj1 = new Usuario();
                    $obj1->setidusuario($row['idusuario']);
                    $obj1->cargar();
                    $obj2 = new Rol();
                    $obj2->setidrol($row['idrol']);
                    $obj2->cargar();
                    $this->setear($obj1,$obj2);
                    
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
        $sql="INSERT INTO usuariorol(idusuario,idrol)  
        VALUES(".$this->getobjusuario()->getidusuario().",".$this->getobjrol()->getIdRol().");";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
               // $this->setidrol($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql = "UPDATE usuariorol SET idrol = " . $this->getobjrol()->getIdRol() . " WHERE idusuario = " . $this->getobjusuario()->getidusuario();
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



    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql="DELETE FROM usuariorol WHERE idrol=".$this->getobjrol()->getidrol()." AND idusuario =".$this->getobjusuario()->getidusuario().";";
        if ($base->Iniciar()) {
            //echo $sql;
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
     
    public function listar($parametro=""){
        $arreglo = array();
        $base = new BaseDatos();
        $sql="SELECT * FROM usuariorol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        if ($base->Iniciar()) {
           // echo $sql;
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new UsuarioRol();
                    
                    $obj->getobjusuario()->setidusuario($row['idusuario']);
                    $obj->getobjrol()->setidrol($row['idrol']);
                    $obj->cargar();
                    array_push($arreglo, $obj);
                }
               
            }
            
        }
        else {
           $this->setmensajeoperacion($base->getError());
        }
        }
        return $arreglo;
    }
    
}


?>
