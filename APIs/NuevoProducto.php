<?php

session_start();
require_once 'API_Prod.php';

$API = new API_Prod;

if($API->NewProd($_SESSION['user'])){
    
    return true;
}


?>