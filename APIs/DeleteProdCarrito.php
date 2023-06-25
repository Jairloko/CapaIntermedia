<?php
require_once 'API_Prod.php';

session_start();

$API = new API_Prod;

$API->DeleteProdCar($_POST['idProd'],$_SESSION['user']);

?>