<?php
class Usuario{
        private $idusuario;
        private $usnombre;
        private $uspass;
        private $usmail;
        private $usdeshabilitado;
        private $mensajeoperacion;
    
        public function __construct(){
            $this->idusuario="";
            $this->usnombre="";
            $this->uspass="";
            $this->usmail="";
            $this->usdeshabilitado="";
            $this->mensajeoperacion ="";
        }

        public function getidusuario(){
            return $this->idusuario;
        }
        public function setidusuario($idusuario){
            $this->idusuario = $idusuario;
        }
        public function getusnombre(){
            return $this->usnombre;
        }
        public function setusnombre($usnombre){
            $this->usnombre = $usnombre;    
        }
        public function getuspass(){
            return $this->uspass;
        }
        public function setuspass($uspass){
            $this->uspass = $uspass;
        }
        public function getusmail(){
            return $this->usmail;
        }
        public function setusmail($usmail){
            $this->usmail = $usmail;
        }
        public function getusdeshabilitado(){
            return $this->usdeshabilitado;
        }
        public function setusdeshabilitado($usdeshabilitado){
            $this->usdeshabilitado = $usdeshabilitado;
        }
        public function getmensajeoperacion(){
            return $this->mensajeoperacion;
        }
        public function setmensajeoperacion($valor){
            $this->mensajeoperacion = $valor;
        }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario WHERE idusuario = ".$this->getidusuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idusuario'], $row['usnombre'], $row['uspass']
                    , $row['usmail'], $row['usdeshabilitado']);
                    
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
        $sql = "INSERT INTO usuario(usnombre,uspass,usmail)
            VALUES('".$this->getusnombre()."','".$this->getuspass()."','".$this->getusmail()."');";
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

    public function modificar(){
        $resp = false;
        $base = new BaseDatos(); //*PARCHE* en la consulta, estaban intercambiados el nombre y el apellido, no se de donde viene la confusion
        // Añade el campo usdeshabilitado a la consulta solo si es diferente de null
        $usdeshabilitado = $this->getusdeshabilitado() ? "'" . $this->getusdeshabilitado() . "'" : 'NULL';
        $sql = "UPDATE usuario SET usnombre='" . $this->getusnombre() . "', uspass='" . $this->getuspass() .
        "', usmail='" . $this->getusmail() . "', usdeshabilitado=" . $usdeshabilitado . " WHERE idusuario=" . $this->getidusuario();
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
        $sql = "DELETE FROM usuario WHERE idusuario=" .$this->getidusuario();
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

    public function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM 
        usuario ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Usuario();
                    $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado']); 
                    array_push($arreglo, $obj);
                }
               
            }
            
        }
 
        return $arreglo;
    }
    
        public function setear($idusuario, $usnombre,$uspass, $usmail, $usdeshabilitado)
        {
            $this->setidusuario($idusuario);
            $this->setusnombre($usnombre);
            $this->setuspass($uspass);
            $this->setusmail($usmail);
            $this->setusdeshabilitado($usdeshabilitado);
        }

}
