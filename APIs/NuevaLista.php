<?php

session_start();
require_once 'API_Lista.php';

$API = new API_Lista;

if($API->NuevaLista($_SESSION['user'])){
    
    return true;
}


?>