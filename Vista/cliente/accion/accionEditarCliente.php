<?php
include_once '../../../configuracion.php';
$objUsuario = new AbmUsuario;
$datos = data_submitted($_GET);
$param['usnombre'] = $datos['usuario'];
$param['uspass'] = $datos['contrasenia'];
$param['usmail'] = $datos['correo'];
$param['idusuario'] = $datos['id'];
$param['usdeshabilitado'] = NULL;
$objUsuario->modificacion($param);

header("Location: ../cuentaCliente.php");
?>