<?php
$titulo = "Gestión de usuarios";
include_once("../../configuracion.php");
include_once('../estructura/headerSeguro.php');
$datos = data_submitted();
$obj = new Session();

$objUserRol = new AbmUsuarioRol();
$users = $objUserRol->buscar(null);
if(count($users) > 0) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped table-bordered">';
    echo '<thead class="thead-dark">';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Usuario</th>';
    echo '<th>Mail</th>';
    echo '<th>Rol</th>';
    echo '<th>Acciones</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($users as $objUser) {
        echo '<tr>';
        echo '<td>'.$objUser->getobjusuario()->getidusuario().'</td>';
        echo '<td>'.$objUser->getobjusuario()->getusnombre().'</td>';
        echo '<td>'.$objUser->getobjusuario()->getusmail().'</td>';
        echo '<td>'.$objUser->getobjrol()->getRoDescripcion().'</td>';
        echo '<td>';
        echo '<div class="btn-group btn-group-sm" role="group" aria-label="Acciones">';
        echo '<a class="btn btn-success" role="button" href="./editarUsuarios.php?id='.$objUser->getobjusuario()->getidusuario().'">editar</a>';
        echo '<a class="btn btn-danger btn-space" role="button" href="./accion/accionBorrar.php?id='.$objUser->getobjusuario()->getidusuario().'">borrar</a>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<div class="alert alert-info" role="alert">';
    echo 'No hay usuarios para mostrar.';
    echo '</div>';
}
if (isset($datos) && isset($datos['msg']) && $datos['msg'] != null) {
    if($datos['msg']=="Modificacion realizada con exito!" || $datos['msg']=="Usuario añadido!"){
    echo '<div class="alert alert-success text-center mt-3">' . $datos['msg'] . '</div>';
    }
    else{
    echo '<div class="alert alert-danger text-center mt-3">' . $datos['msg'] . '</div>';
    }
}        
?>
