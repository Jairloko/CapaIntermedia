<?php 
require_once 'API_Prod.php';

session_start();
$username = $_SESSION['user'];
$API = new API_Prod;

$API->UpdateProdCar($_POST['idProd'], $_POST['cantidad'],$username);


?>