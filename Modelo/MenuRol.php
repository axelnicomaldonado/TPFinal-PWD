<?php
class MenuRol{

    private $objMenu;
    private $objRol;
    private $mensajeOperacion;

    public function __construct(){

        $this->objMenu = new Menu;
        $this->objRol = new Rol;
        $this->mensajeOperacion = '';

    }

    public function getObjMenu() {
        return $this->objMenu;
    }

    public function setObjMenu($objMenu){
        $this->objMenu = $objMenu;
    }

    public function getObjRol(){
        return $this->objRol;
    }

    public function setObjRol($objRol){
        $this->objRol = $objRol;
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
        $sql="SELECT * FROM menurol WHERE idmenu = ".$this->getObjMenu()." AND idrol = ".$this->getObjRol();;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idmenu'], $row['idrol']);
                }
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    
        
    }

    public function insertar()
    {
        $base = new BaseDatos();
        
        $resp = false;
        $objMenu = $this->getObjMenu();
        $objRol = $this->getObjRol();
        $sql = "INSERT INTO menurol(idmenu, idrol)
				VALUES (" . $objMenu->getIdMenu() . "," . $objRol->getIdRol() .")";
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
        $objMenu = $this->getObjMenu();
        $objRol = $this->getObjRol();
        $sql = "UPDATE menurol SET idmenu = " . $objMenu->getIdMenu() . " , idrol = " . $this->getIdRol() .
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
        $objMenu = $this->getObjMenu();
        $objRol = $this->getObjRol();
        $sql = "DELETE FROM menurol WHERE idmenu = " . $objMenu->getIdMenu() . " AND idrol = " . $objRol->getIdRol();
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

    public function buscar($idRol, $idMenu){
        $base = new BaseDatos();
        $encontro = false;

        $consulta = "SELECT * FROM menurol WHERE idmenu = '" . $idMenu . "' AND
        idrol = '" . $idRol . "'";

        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($fila = $base->Registro()){
                    // Rol
                    $objRol = new Rol();
                    $objRol->buscar($fila["idrol"]);

                    // Menu
                    $objMenu = new Menu();
                    $objMenu->buscar($fila["idmenu"]);
                    
                    $this->setear(
                        $objMenu,
                        $objRol
                    );

                    $encontro = true;
                }
            }else{$this->setMensajeOperacion("menurol->buscar: ".$base->getError());}
        }else{$this->setMensajeOperacion("menurol->buscar: ".$base->getError());}

        return $encontro;
    }

    public static function listar($parametro=""){
        $arreglo = null;
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

    public function listarRoles($condicion = ""){
        $arreglo = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM menurol";

        if($condicion != ""){
            $consulta .= " WHERE " . $condicion;
        }

        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $arreglo = [];
                while($row = $base->Registro()){
                    $objMenuRol = new MenuRol();
                    $objMenuRol->buscar($row["idrol"], $row["idmenu"]);

                    array_push($arreglo, $objMenuRol);
                }
            }else{$this->setMensajeOperacion("menurol->listar: ".$base->getError());}
        }else{$this->setMensajeOperacion("menurol->listar: ".$base->getError());}

        return $arreglo;
    }


    public function verificarPermiso($idUsuario, $url){
        $base = new BaseDatos;
        $resp = false;
        $sql = "SELECT idusuario, menurol.idrol, menu.idmenu, medescripcion FROM menurol
        INNER JOIN usuariorol ON menurol.idrol = usuariorol.idrol
        INNER JOIN menu ON menu.idmenu = menurol.idmenu
        WHERE idusuario = ". $idUsuario ." AND medescripcion = '". $url ."';";
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                if($base->Registro()){
                    $resp = true;
                }
            }else{$this->setMensajeOperacion("menurol->verificarPermiso: ".$base->getError());}
        }else{$this->setMensajeOperacion("menurol->verificarPermiso: ".$base->getError());}

        return $resp;
    }

    public function setear($objMenu, $objRol)
    {
        $this->setObjMenu($objMenu);
        $this->setObjRol($objRol);
    }

}