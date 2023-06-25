<?php
require_once 'API_Lista.php';
session_start();
$API = new API_Lista;

$API->AddProdLista($_POST['idProd'], $_POST['lista'],$_SESSION['user']);

?>