<?php


function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
    else
        if(!empty($_GET)) {
            $_AAux =$_GET;
        }
    if (count($_AAux)){
        foreach ($_AAux as $indice => $valor) {
            if ($valor=="")
                $_AAux[$indice] = 'null'	;
        }
    }
    return $_AAux;

}


spl_autoload_register(function ($clase) {
    $directorys = array(
        $GLOBALS['ROOT'].'Modelo/',
        $GLOBALS['ROOT'].'Control/',
        $GLOBALS['ROOT'].'Modelo/conector/',
        $GLOBALS['ROOT'].'util/',
    );
    // print_r($directorys) ;
    foreach($directorys as $directory){
        if(file_exists($directory.$clase . '.php')){
            require_once($directory.$clase . '.php');
            return;
        }
    }


});

define("KEY_TOKEN", "AwT.3GC-5w3");



?>
