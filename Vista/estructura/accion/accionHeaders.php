<?php
$rolId = isset($_GET['id']) ? $_GET['id'] : null;

// Carga el header específico del rol según el ID.
if ($rolId == '1') {       //Header para el cliente
    include('../estCliente/headerCliente.php');
} elseif ($rolId == '2') { //Header para el admin
    include('../estAdmin/headerAdmin.php');
} elseif ($rolId == '3') { //Header para el deposito
    include('../estDeposito/headerDeposito.php');
} elseif ($rolId == '4') { //Header para el publico
    include('../estPublico/headerPublico.php');
}

else {
    echo 'Rol no válido';
}
?>