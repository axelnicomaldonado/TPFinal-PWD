<?php
class Session{

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            // Inicia la sesión solo si no está activa
            session_start();
        }
    }
   
    /**
     * Actualiza las variables de sesión con los valores ingresados.
     */
    public function iniciar($nombreUsuario,$psw){
        $resp = false;
        $obj = new AbmUsuario();
        $param['usnombre']=$nombreUsuario;
        $param['uspass']=$psw;
        $param['usdeshabilitado']='null';

        $resultado = $obj->buscar($param);
        if(count($resultado) > 0){
            $usuario = $resultado[0];
            $_SESSION['idusuario']=$usuario->getidusuario();
            $resp = true;
        } else {
            $this->cerrar();
        }
        return $resp;
    }
    
    /**
     * Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     */
    public function validar(){
        $resp = false;
        if($this->activa() && isset($_SESSION['idusuario']))
            $resp=true;
        return $resp;
    }
    
    /**
     *Devuelve true o false si la sesión está activa o no.
     */
    public function activa(){
        $resp = false;
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                $resp = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                $resp = session_id() === '' ? FALSE : TRUE;
            }
        }
        return $resp;
    }
   
    /**
     * Devuelve el usuario logeado.
     */
    public function getUsuario(){
        $usuario = null;
        if($this->validar()){
            $obj = new AbmUsuario();
             $param['idusuario']=$_SESSION['idusuario'];
             $resultado = $obj->buscar($param);
            if(count($resultado) > 0){
                $usuario = $resultado[0];
            }
        }
        return $usuario;
    }

     /**
     * Devuelve el rol del usuario logeado.
     */
    public function getRol(){
        $list_rol = null;
        if($this->validar()){
            $obj = new AbmUsuario();
             $param['idusuario']=$_SESSION['idusuario'];
             $resultado = $obj->darRoles($param);
            if(count($resultado) > 0){
                $list_rol = $resultado;
            }
        }
        return $list_rol;

    }

    /**
     * Verifica si el cliente tiene permiso para acceder al sitio.
     */
    public function permiso(){
        $permiso = false;

        $ruta = $_SERVER['PHP_SELF'];
        $ruta = explode("/" ,$ruta);
        $cadenaRuta = "../";
        $cadenaRuta .= $ruta[count($ruta)-2] . "/";
        $cadenaRuta .= $ruta[count($ruta)-1];

        $objMenuRol = new MenuRol();
        if($objMenuRol->verificarPermiso($_SESSION["idusuario"],$cadenaRuta)){
            $permiso = true;
        }

        return $permiso;
    }
    
    /**
     *Cierra la sesión actual.
     */
    public function cerrar(){
        $resp = true;
        session_destroy();
        return $resp;
    }
   
}
?>
