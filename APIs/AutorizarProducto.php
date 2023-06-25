<?php
require_once 'API_Prod.php';

$API = new API_Prod;

$API->AutorizarProducto($_POST['idProd']);

?>