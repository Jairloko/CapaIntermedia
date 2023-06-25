<?php
require_once 'API_Prod.php';

$id = $_GET['idProd'];
$API = new API_Prod;
$API->LoadContentProdUpdate($id);
?>