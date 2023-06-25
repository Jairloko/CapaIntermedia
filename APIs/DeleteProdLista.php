<?php
require_once 'API_Lista.php';

$API = new API_Lista;

$API->DeleteProdLista($_POST['idProd'],$_POST['listName']);

?>