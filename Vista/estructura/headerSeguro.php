<?php
include_once "../../configuracion.php";

$session = new Session();
$seguro = true;
if(!$session->validar() || !$session->permiso()){
    header("Location:../home/index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Librerias-->
    <link rel="stylesheet" type="text/css" href="../../util/librerias/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="../../util/librerias/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../util/libreriasfontawesome/css/all.min.css">
    <script type="text/javascript" src="../../util/librerias/fontawesome/js/all.min.js"></script>
    
    <!--CSS-->
    <link rel="stylesheet" href="../css/estilos.css">


    <title><?php echo $titulo ?></title>
</head>
<?php
// Navbar
include_once "navbar.php";
?>